<?php
class FilesManager
{
	public static function uploadImages($object,$source='content')
	{
		//gefei 获得对应的内容
		/**
		 * $object 传入对象
		 * $source 来源  posted 发帖  reply 回帖  否则是女性e天地
		 */
		if($source == 'posted')
		{
			$category_id = $object->getForum()->getId();
			$content_id = $object->getId();
		}
		elseif($source == 'reply')
		{
			$category_id = $object->getPosted()->getForum()->getId();
			$content_id = $object->getPosted()->getId();
		}
		else
		{
			$category_id = $object->getCategoryId();
			$content_id = $object->getId();
		}
			
		$content = $object->getContent();
		$infos = self::imagesInfo($content);
		
		if($infos)
		{
			self::saveImageRecords($infos,$category_id,$content_id,$source);
		}
		else if($source == 'content'){
			$object->ImageContent->delete();
			$object->save();
		}
		//如果e天地控件图片存在则保存
		/* 两个缩略图暂时不保存到图片库中，如果客户需要再保存，代码留着。
	    if($source == 'content' && $object->getThumbnails())
	    {
	    	$infos = array('/uploads/'.$object->getThumbnails());
	    	self::saveImageRecords($infos,$category_id,$content_id,$source);
	    }
	    if($source == 'content' && $object->getThumbnails2())
	    {
	    	$infos = array('/uploads/'.$object->getThumbnails2());
	    	self::saveImageRecords($infos,$category_id,$content_id,$source);
	    }
	    */
		if($source == 'posted' && $object->getPicture())
		{
			$infos = array('/uploads/'.$object->getPicture());
			self::saveImageRecords($infos,$category_id,$content_id,$source);
		}
	    //如果存在视频则入库
	    $videos = self::videosInfo($content);
	    if($videos)
	    {
	    	self::saveVideoRecords($videos,$category_id,$content_id,$source);
	    }
	    else if($source == 'content'){
	    	$object->VideoContent->delete();
	    	$object->save();
	    }
	}

	public static function imagesInfo($content)
	{
		//得到所有图片
		preg_match_all("/\<img.*?src\=\"(.*?)\"[^>]*>/i", $content, $match);
		return array_unique($match[1]);
	}
	private static function imagesTitleInfo($content)
	{
		//得到所有图片
		preg_match_all("/\<img.*?title\=\"(.*?)\"[^>]*>/i", $content, $match2);
		return array_unique($match2[1]);
	}
	public static function videosInfo($content)
	{
		//得到所有视频
		preg_match_all("/<embed[^>]*?\\s+src=['\"]?([^\"].*?)['\"]?\\s+[^>]*?>/i", $content, $match);
		return array_unique($match[1]);
	}
	
	public static function generateImage($imagePath,$folderName=null)
	{
		$name = basename($imagePath);
		$rest = substr($imagePath,0,1);
		$length = strlen($imagePath);
		$srcFile =  ($rest == '/')?substr($imagePath,1,($length-1)):$imagePath;
		if($folderName == null)
		{
			$folderName = 'other';
		}
		$path = 'uploads/thumbnails/category'.$folderName.'/';
		$thumbnails = new CreatMiniature();
		$thumbnails->SetVar($srcFile,'file');
		if(!file_exists($path)){
			mkdir("$path", 0777);
		}
		$small_path = $path.'small/';
		if(!file_exists($small_path)){
			mkdir("$small_path", 0777);
		}
		$thumbnails->Prorate($small_path.$name,180,120);
		
		$big_path = $path.'big/';
		if(!file_exists($big_path)){
			mkdir("$big_path", 0777);
		}
		$market = new image($srcFile,$big_path.$name);
		$market->water('images/shuiyin.gif',9,60);//加水印
		$market->makeImage();
		
		$thumbnails->SetVar($big_path.$name,'file');
		$thumbnails->Prorate2($big_path.$name,600,600);
	}
	
	public static function saveImageRecords($infos,$category_id,$content_id,$source='content')
	{
		if($source == 'content')
		{
			$content = Doctrine::getTable('Content')->find($content_id);
			$content->ImageContent->delete();
			$uploadImages =  new Doctrine_Collection(Doctrine_Core::getTable('UploadImage'));
			//保存图片信息
			foreach($infos as $key=>$value)
			{
				if(strpos($value, '/dialogs/attachment/fileTypeImages')>0)
				{//不上传ue本身的附件图标
					continue;
				}
				$name = basename($value);
				if($source == 'content')
				{
					$result = Doctrine::getTable('UploadImage')->findOneBy('name', $name);
				}
				else
				{
					$result = Doctrine::getTable('UploadImage')->findOneBy('name', $name);
				}
				//判断图片是否存在
				if(!$result)
				{
					$rest = substr($value,0,1);
					$length = strlen($value);
					if($rest == '/')
					{
						$str =  substr($value,1,($length-1));
					}
					else
					{
						$str = $value;
					}
					$image_info = getimagesize($str);
					if($category_id == '')
					{
						$category_id = -1;
						$filename = 'other';
					}
					else{
						$filename = $category_id;
					}
					$image = new UploadImage();
					$image->category_id = $category_id;
					$image->content_id = $content_id;
					$image->width = $image_info[0];
					$image->height = $image_info[1];
					$image->name = $name;
			
					if($content){
						$imgTitle = self::imagesTitleInfo($content->getContent());
						$title = isset($imgTitle[$key])?$imgTitle[$key]:$content->getTitle();
						$image->setTitle($title);
					}
					//如果不是e天地的内容，则标记为论坛
					if($source != 'content')
					{
						$image->source = 2;
					}
					if($image_info[0] > $image_info[1])
					{
						$image->im_type = 1;
					}
					elseif($image_info[0] < $image_info[1])
					{
						$image->im_type = 2;
					}
					$image->path = $value;
					//如果是论坛的更改文件夹命名方式 forum开头
					if($source == 'content')
					{
						$image->thumbnails_path = '/uploads/thumbnails/category'.$filename.'/';
					}
					else
					{
						$image->thumbnails_path = '/uploads/thumbnails/forum'.$filename.'/';
					}
					$image->upload_time = time();
					$image->save();
					$uploadImages[]= $image;
					$thumbnails = new CreatMiniature();
					$thumbnails->SetVar($str,'file');
					//如果是论坛的更改文件夹命名方式 forum开头
					if($source == 'content')
					{
						$path  = 'uploads/thumbnails/category'.$filename.'/';
					}
					else
					{
						$path  = 'uploads/thumbnails/forum'.$filename.'/';
					}
			
					if(!file_exists($path)){
						mkdir("$path", 0777);
					}
					$small_path = $path.'small/';
					if(!file_exists($small_path)){
						mkdir("$small_path", 0777);
					}
					$thumbnails->Prorate($small_path.$name,180,120);
			
					$big_path = $path.'big/';
					if(!file_exists($big_path)){
						mkdir("$big_path", 0777);
					}
					if($category_id != 31 && $category_id != 32 && $category_id != 3 && $category_id != 4){
						//专家预告和专家简介和热点聚焦和妇儿要闻就不加水印
						$market = new image($str,$big_path.$name);
						$market->water('images/shuiyin.gif',9,60);//加水印
						$market->makeImage();
					}
					$thumbnails->SetVar($big_path.$name,'file');
					$thumbnails->Prorate2($big_path.$name,600,600);
				}
				else{
					if($content){
						$imgTitle = self::imagesTitleInfo($content->getContent());
						$title = isset($imgTitle[$key])?$imgTitle[$key]:$content->getTitle();
						$result->setTitle($title);
						$result->save();
					}
					$uploadImages[] = $result;
				}
			}
			$content->UploadImages = $uploadImages;
			$content->save();
		}
		else 
		{
			//保存图片信息
			foreach($infos as $key=>$value)
			{
				if(strpos($value, '/dialogs/attachment/fileTypeImages')>0)
				{//不上传ue本身的附件图标
					continue;
				}
				$name = basename($value);
				//$result = Doctrine::getTable('UploadImage')->findOneBy('name', $name);
				$result = Doctrine::getTable('UploadImage')->getResultBbs($content_id,$name,2);
				//判断图片是否存在
				if($result == 0)
				{
					$rest = substr($value,0,1);
					$length = strlen($value);
					if($rest == '/')
					{
						$str =  substr($value,1,($length-1));
					}
					else
					{
						$str = $value;
					}
					
					$image_info = getimagesize($str);
					if($category_id == '')
					{
						$category_id = -1;
						$filename = 'other';
					}
					else{
						$filename = $category_id;
					}
					$image = new UploadImage();
					$image->category_id = $category_id;
					$image->content_id = $content_id;
					$image->width = $image_info[0];
					$image->height = $image_info[1];
					$image->name = $name;
			
					//标记为论坛
					$image->source = 2;
					if($image_info[0] > $image_info[1])
					{
						$image->im_type = 1;
					}
					elseif($image_info[0] < $image_info[1])
					{
						$image->im_type = 2;
					}
					$image->path = $value;
					//如果是论坛的更改文件夹命名方式 forum开头
					$image->thumbnails_path = '/uploads/thumbnails/forum'.$filename.'/';
					$image->upload_time = time();
					$image->save();
					
					//判断是否是图片，以处理类似中格式的远程图片http://wsic.ac.cn/FckHandler.ashx?id=2993
					if(stripos($name, '.jpg')<=0 && stripos($name, '.gif')<=0 && stripos($name, '.png')<=0 && stripos($name, '.jpeg')<=0 && stripos($name, '.bmp')<=0)
					{
						continue;
					}
					
					$thumbnails = new CreatMiniature();
					$thumbnails->SetVar($str,'file');
				
					//是论坛的更改文件夹命名方式 forum开头
					$path  = 'uploads/thumbnails/forum'.$filename.'/';
			
					if(!file_exists($path)){
						mkdir("$path", 0777);
					}
					$small_path = $path.'small/';
					if(!file_exists($small_path)){
						mkdir("$small_path", 0777);
					}
					$thumbnails->Prorate($small_path.$name,180,120);
			
					$big_path = $path.'big/';
					if(!file_exists($big_path)){
						mkdir("$big_path", 0777);
					}
					
					$thumbnails->SetVar($big_path.$name,'file');
					$thumbnails->Prorate2($big_path.$name,600,600);
				}
			}
		}
	}

	public static function saveVideoRecords($videos,$category_id,$content_id,$source)
	{
		if($source == 'content')
		{
			$content = Doctrine::getTable('Content')->find($content_id);
			$content->VideoContent->delete();
			$uploadVideos = new Doctrine_Collection(Doctrine::getTable('UploadVideo'));
			//保存视频信息
			foreach($videos as $value)
			{
				$name = basename($value);
				if(strpos($name, 'btncolor')>0){
					$name = explode('&amp;btncolor', $name);
					$name = $name[0];
				}
				
				if($source == 'content')
				{
					$video = Doctrine::getTable('UploadVideo')->findOneBy('name', $name);
				}
				else
				{
					//$video = Doctrine::getTable('UploadVideo')->findOneBy('name', $name);
					$result = Doctrine::getTable('UploadVideo')->getResult($category_id,$value,2);
				}
					
				//判断视频是否存在
				if(!$video)
				{
					$type = trim(substr(strrchr($name,'.'), 1,3));
					if($category_id == '')
					{
						$category_id = -1;
					}
					$video = new UploadVideo();
					$video->category_id = $category_id;
					$video->content_id = $content_id;
					$video->name = $name;
					$video->type = $type;
					$video->path = $value;
					$video->title = $content->getTitle();
					$video->upload_time = time();
					//如果不是e天地的内容，则标记为论坛
					if($source != 'content')
					{
						$video->source = 2;
					}
					$video->save();
					$uploadVideos[] = $video;
			
				}
				else{
					$uploadVideos[] = $video;
				}
				$video->category_id = $category_id;
				$video->content_id = $content_id;
				$tmp = explode("videoURL=", $value);
				$input_file = $tmp[1]; // uploadvideo or uploadvideo/womenvideo
				if(strpos($input_file, 'btncolor')>0){
					$input_file = explode('&amp;btncolor', $input_file);
					$input_file = $input_file[0];
				}
				// 			$input_file = '/ueditor/server/upload/uploadvideo/womenvideo/'.$name;
				$output_file = '/uploads/ffmpeg/'.$video->getId().'.jpg';
				$start_time = 12;
				//file_put_contents('/home/app/shujian/web/testffmpeg.txt', FfmpegManager::PrtSc2(sfConfig::get('sf_web_dir').$input_file,sfConfig::get('sf_web_dir').$output_file,$start_time));
				FfmpegManager::PrtSc(sfConfig::get('sf_web_dir').$input_file,sfConfig::get('sf_web_dir').$output_file,$start_time);
				$video->thumbnails_path = $output_file;
				if($video->getTitle() == null || trim($video->getTitle()) == ''){
					$video->setTitle($content->getTitle());
				}
				$video->save();
			}
			$content->UploadVideos =  $uploadVideos;
			$content->save();
		}
		else 
		{
			//保存视频信息
			foreach($videos as $value)
			{
				$name = basename($value);
				if(strpos($name, 'btncolor')>0){
					$name = explode('&amp;btncolor', $name);
					$name = $name[0];
				}
				
				//$video = Doctrine::getTable('UploadVideo')->findOneBy('name', $name);
				$result = Doctrine::getTable('UploadVideo')->getResultBbs($content_id,$value,2);
					
				//判断视频是否存在
				if($result == 0)
				{
					$type = trim(substr(strrchr($name,'.'), 1,3));
					if($category_id == '')
					{
						$category_id = -1;
					}
					$video = new UploadVideo();
					$video->category_id = $category_id;
					$video->content_id = $content_id;
					$video->name = $name;
					$video->type = $type;
					$video->path = $value;
					//$video->title = $content->getTitle();
					$video->upload_time = time();
					//标记为论坛
					$video->source = 2;
					$video->save();			
				}
				
				$video->category_id = $category_id;
				$video->content_id = $content_id;
				$tmp = explode("videoURL=", $value);
				$input_file = $tmp[1]; // uploadvideo or uploadvideo/womenvideo
				if(strpos($input_file, 'btncolor')>0){
					$input_file = explode('&amp;btncolor', $input_file);
					$input_file = $input_file[0];
				}
				// 			$input_file = '/ueditor/server/upload/uploadvideo/womenvideo/'.$name;
				$output_file = '/uploads/ffmpeg/'.$video->getId().'.jpg';
				$start_time = 12;
				//file_put_contents('/home/app/shujian/web/testffmpeg.txt', FfmpegManager::PrtSc2(sfConfig::get('sf_web_dir').$input_file,sfConfig::get('sf_web_dir').$output_file,$start_time));
				FfmpegManager::PrtSc(sfConfig::get('sf_web_dir').$input_file,sfConfig::get('sf_web_dir').$output_file,$start_time);
				$video->thumbnails_path = $output_file;
// 				if($video->getTitle() == null || trim($video->getTitle()) == ''){
// 					$video->setTitle($content->getTitle());
// 				}
				$video->save();
			}
		}
	}
}