<?php
/***************************************
if(move_uploaded_file($_FILES["icon"]["tmp_name"], S_ROOT.'./data/album/temp.jpg')){
	$cm->SetVar(S_ROOT.'./data/album/temp.jpg',"file");
	$cm->Prorate(S_ROOT.'./data/album/'.$space['uid'].'/'.$aid.'.jpg',110,110);
	if (is_file( S_ROOT.'./data/album/temp.jpg')){
		unlink(S_ROOT.'./data/album/temp.jpg');
		die(header("Location: cp.php?ac=album&aid=$aid" ));
	}
}else{
	showmessage('no_privilege');
}
***************************************/
/***************************************
 *作者：落梦天蝎（beluckly）
*完成时间：2006-12-18
*类名：CreatMiniature
*功能：生成多种类型的缩略图
*基本参数：$srcFile,$echoType
*方法用到的参数：
$toFile,生成的文件
$toW,生成的宽
$toH,生成的高
$bk1,背景颜色参数 以255为最高
$bk2,背景颜色参数
$bk3,背景颜色参数
*例：
include("creatminiature.php");
$cm=new CreatMiniature();
$cm->SetVar("bei1.jpg","file");
$cm->Distortion("dis_bei.jpg",200,300);
$cm->Prorate("pro_bei.jpg",200,300);
$cm->Cut("cut_bei.jpg",200,300);
$cm->BackFill("fill_bei.jpg",200,300);
***************************************/
class CreatMiniature
{
	//公共变量
	var $srcFile=""; //原图
	var $echoType; //输出图片类型，link--不保存为文件；file--保存为文件
	var $im=""; //临时变量
	var $srcW=""; //原图宽
	var $srcH=""; //原图高
	//设置变量及初始化
	function SetVar($srcFile,$echoType)
	{
		$this->srcFile=$srcFile;
		$this->echoType=$echoType;
		$info = "";
		$data = getimagesize($this->srcFile,$info);
		switch ($data[2])
		{
			case 1:
				if(!function_exists("imagecreatefromgif")){
					echo "你的GD库不能使用GIF格式的图片，请使用Jpeg或PNG格式！返回";
					exit();
				}
				$this->im = ImageCreateFromGIF($this->srcFile);
				break;
			case 2:
				if(!function_exists("imagecreatefromjpeg")){
					echo "你的GD库不能使用jpeg格式的图片，请使用其它格式的图片！返回";
					exit();
				}
				$this->im = ImageCreateFromJpeg($this->srcFile);
				break;
			case 3:
				$this->im = ImageCreateFromPNG($this->srcFile);
				break;
		}
		$this->srcW=ImageSX($this->im);
		$this->srcH=ImageSY($this->im);
	}
	 
	//生成扭曲型缩图
	function Distortion($toFile,$toW,$toH)
	{
		$cImg=$this->CreatImage($this->im,$toW,$toH,0,0,0,0,$this->srcW,$this->srcH);
		return $this->EchoImage($cImg,$toFile);
		ImageDestroy($cImg);
	}
	 
	//生成按比例缩放的缩图
	function Prorate($toFile,$toW,$toH)
	{
		$toWH=$toW/$toH;
		$srcWH=$this->srcW/$this->srcH;
		if($toWH == $srcWH)
		{
			$ftoW=$toW;
			$ftoH=$ftoW*($this->srcH/$this->srcW);
		}
		else
		{
			$ftoH=$toH;
			$ftoW=$ftoH*($this->srcW/$this->srcH);
		}
		if($this->srcW>$toW||$this->srcH>$toH)
		{
			$cImg=$this->CreatImage($this->im,$ftoW,$ftoH,0,0,0,0,$this->srcW,$this->srcH);
			return $this->EchoImage($cImg,$toFile);
			ImageDestroy($cImg);
		}
		else
		{
			$cImg=$this->CreatImage($this->im,$this->srcW,$this->srcH,0,0,0,0,$this->srcW,$this->srcH);
			return $this->EchoImage($cImg,$toFile);
			ImageDestroy($cImg);
		}
	}
	function Prorate2($toFile,$toW,$toH)
	{
		if($this->srcW > 600 ){
			$srcWH=$this->srcW/$this->srcH;
			$ftoW = 600;
			$ftoH = $ftoW / $srcWH;
				
			$cImg=$this->CreatImage($this->im,$ftoW,$ftoH,0,0,0,0,$this->srcW,$this->srcH);
			return $this->EchoImage($cImg,$toFile);
			ImageDestroy($cImg);
				
		}else{
			$cImg=$this->CreatImage($this->im,$this->srcW,$this->srcH,0,0,0,0,$this->srcW,$this->srcH);
			return $this->EchoImage($cImg,$toFile);
			ImageDestroy($cImg);
		}
	}
	function ProrateSmall($toFile)
	{
		if($this->srcW > 240 ){
			$srcWH=$this->srcW/$this->srcH;
			$ftoW = 240;
			$ftoH = $ftoW / $srcWH;
	
			$cImg=$this->CreatImage($this->im,$ftoW,$ftoH,0,0,0,0,$this->srcW,$this->srcH);
			return $this->EchoImage($cImg,$toFile);
			ImageDestroy($cImg);
	
		}else{
			$cImg=$this->CreatImage($this->im,$this->srcW,$this->srcH,0,0,0,0,$this->srcW,$this->srcH);
			return $this->EchoImage($cImg,$toFile);
			ImageDestroy($cImg);
		}
	}
	 
	//生成最小裁剪后的缩图
	function Cut($toFile,$toW,$toH)
	{
		$toWH=$toW/$toH;
		$srcWH=$this->srcW/$this->srcH;
		if($toWH == $srcWH)
		{
			$ctoH=$toH;
			$ctoW=$ctoH*($this->srcW/$this->srcH);
		}
		else
		{
			$ctoW=$toW;
			$ctoH=$ctoW*($this->srcH/$this->srcW);
		}
		$allImg=$this->CreatImage($this->im,$ctoW,$ctoH,0,0,0,0,$this->srcW,$this->srcH);
		$cImg=$this->CreatImage($allImg,$toW,$toH,0,0,($ctoW-$toW)/2,($ctoH-$toH)/2,$toW,$toH);
		return $this->EchoImage($cImg,$toFile);
		ImageDestroy($cImg);
		ImageDestroy($allImg);
	}
	//生成背景填充的缩图
	function BackFill($toFile,$toW,$toH,$bk1=255,$bk2=255,$bk3=255)
	{
		$toWH=$toW/$toH;
		$srcWH=$this->srcW/$this->srcH;
		if($toWH == $srcWH)
		{
			$ftoW=$toW;
			$ftoH=$ftoW*($this->srcH/$this->srcW);
		}
		else
		{
			$ftoH=$toH;
			$ftoW=$ftoH*($this->srcW/$this->srcH);
		}
		if(function_exists("imagecreatetruecolor"))
		{
			@$cImg=ImageCreateTrueColor($toW,$toH);
			if(!$cImg)
			{
				$cImg=ImageCreate($toW,$toH);
			}
		}
		else
		{
			$cImg=ImageCreate($toW,$toH);
		}
		$backcolor = imagecolorallocate($cImg, $bk1, $bk2, $bk3); //填充的背景颜色
		ImageFilledRectangle($cImg,0,0,$toW,$toH,$backcolor);
		if($this->srcW>$toW||$this->srcH>$toH)
		{
			$proImg=$this->CreatImage($this->im,$ftoW,$ftoH,0,0,0,0,$this->srcW,$this->srcH);
			if($ftoW == $toW)
			{
				ImageCopyMerge($cImg,$proImg,($toW-$ftoW)/2,0,0,0,$ftoW,$ftoH,100);
			}
			else if($ftoH == $toH)
			{
				ImageCopyMerge($cImg,$proImg,0,($toH-$ftoH)/2,0,0,$ftoW,$ftoH,100);
			}
			else
			{
				ImageCopyMerge($cImg,$proImg,0,0,0,0,$ftoW,$ftoH,100);
			}
		}
		else
		{
			ImageCopyMerge($cImg,$this->im,($toW-$ftoW)/2,($toH-$ftoH)/2,0,0,$ftoW,$ftoH,100);
		}
		return $this->EchoImage($cImg,$toFile);
		ImageDestroy($cImg);
	}
	 
	function CreatImage($img,$creatW,$creatH,$dstX,$dstY,$srcX,$srcY,$srcImgW,$srcImgH)
	{
		if(function_exists("imagecreatetruecolor"))
		{
			@$creatImg = ImageCreateTrueColor($creatW,$creatH);
			if($creatImg)
				ImageCopyResampled($creatImg,$img,$dstX,$dstY,$srcX,$srcY,$creatW,$creatH,$srcImgW,$srcImgH);
			else
			{
				$creatImg=ImageCreate($creatW,$creatH);
				ImageCopyResized($creatImg,$img,$dstX,$dstY,$srcX,$srcY,$creatW,$creatH,$srcImgW,$srcImgH);
			}
		}
		else
		{
			$creatImg=ImageCreate($creatW,$creatH);
			ImageCopyResized($creatImg,$img,$dstX,$dstY,$srcX,$srcY,$creatW,$creatH,$srcImgW,$srcImgH);
		}
		return $creatImg;
	}
	 
	//输出图片，link---只输出，不保存文件。file--保存为文件
	function EchoImage($img,$to_File)
	{
		switch($this->echoType)
		{
			case "link":
				if(function_exists('imagejpeg')) return ImageJpeg($img);
				else return ImagePNG($img);
				break;
			case "file":
				if(function_exists('imagejpeg')) return ImageJpeg($img,$to_File);
				else return ImagePNG($img,$to_File);
				break;
		}
	}
}

/**
 * CK FRAMEWORK 2.0 image图形库 
 * 基于GD扩展
 * @author wujibing <283109896@qq.com>
 * @copyright 2010-2012 weiboxia.com
 * @link ck.weiboxia.com
 * @version 2.0
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
class image
{
	/**
	 * 图像资源
	 * @var imageResource
	 */
	private $_imageResource;
	/**
	 * 生成的文件
	 * @var string
	 */
	private $_makeFile;
	/**
	 * 是否输出图片
	 * @var blooean
	 */
	private $_isMakeImage = true;
	/**
	 * 构造函数
	 * @param string $imageFile 源文件
	 * @param string $makeFile 生成新的图片地址
	 */
	public function __construct($imageFile,$makeFile)
	{
		$this->_makeFile = $makeFile;
		$this->_imageResource = imageResource::createByFile($imageFile);
		$this->_isMakeImage = false;
	}
	/**
	 * 水印
	 * @param string $waterImage 水印图片
	 * @param int $postion 水印位置 
	 * 1 2 3
	 * 4 5 6
	 * 7 8 9这样布局 其他数字为随机点
	 * @param int $pct 透明度
	 */
	public function water($waterImage,$postion = 0,$pct = 80)
	{
		$waterResoure = imageResource::createByFile($waterImage);
		//获取水印图片的宽高
		$waterWidth = $waterResoure->getWidth();
		$waterHeight = $waterResoure->getHeight();
		//获取原始图片的宽高
		$imageWidth = $this->_imageResource->getWidth();
		$imageHeight = $this->_imageResource->getHeight();
		
		$waterWidth > $imageWidth && $waterWidth = $imageWidth;
		$waterHeight >$imageHeight && $waterHeight = $imageHeight;
		
		$waterX = $waterY = 0;
		switch ($postion)
		{
			case 1:
				break;
			case 4:
				$waterX = 0;
				$waterY = ($imageHeight - $waterHeight) / 2;
				break;
			case 7:
				$waterX = 0;
				$waterY = $imageHeight - $waterHeight;
				break;
			case 2:
				$waterX = ($imageWidth - $waterWidth) / 2;
				$waterY = 0;
				break;
			case 5:
				$waterX = ($imageWidth - $waterWidth) / 2;
				$waterY = ($imageHeight - $waterHeight) / 2;
				break;
			case 8:
				$waterX = ($imageWidth - $waterWidth) / 2;
				$waterY = $imageHeight - $waterHeight;
				break;
			case 3:
				$waterX = $imageWidth - $waterWidth;
				$waterY = 0;
				break;
			case 6:
				$waterX = $imageWidth - $waterWidth;
				$waterY = ($imageHeight - $waterHeight) / 2;
				break;
			case 9:
				$waterX = $imageWidth - $waterWidth - 18;
				$waterY = $imageHeight - $waterHeight;
				break;
			default:
				$waterX = rand(0,($imageWidth - $waterWidth));
				$waterY = rand(0,($imageHeight - $waterHeight));
		}
		// 设定图像的混色模式
		imagealphablending($this->_imageResource->resource, true);
		imagecopymerge($this->_imageResource->resource, $waterResoure->resource, $waterX, $waterY, 0, 0, $waterWidth,$waterHeight,$pct);
	}
	/**
	 * 缩略图
	 * @param int $width 缩略图宽度
	 * @param int $height 缩略图高度
	 
	public function thumb($width,$height)
	{
		$imageWidth = $this->_imageResource->getWidth();
		$imageHeight = $this->_imageResource->getHeight();
		$ratio = $imageWidth / $imageHeight;  //原图比例
		$thumbRatio = $width / $height; //缩略后比例
		
		$thumbResource = imageResource::createByTrueColor($width, $height, $this->_imageResource->getType());
		if($ratio >= $thumbRatio)
		{
			$imageWidth = $imageHeight * $thumbRatio;
		} else
		{
			$imageHeight = $imageWidth / $thumbRatio;
		}
		imagecopyresampled($thumbResource->resource, $this->_imageResource->resource, 0, 0, 0, 0, $width,$height, $imageWidth, $imageHeight);

		$this->_imageResource = $thumbResource;
	}
	*/
	/**
	 * 生成文件
	 */
	public function makeImage()
	{
		$this->outImage($this->_makeFile);
	}
	/**
	 * 浏览器查看图片
	 */
	public function browseImage()
	{
		header("content-type:image/".$this->_imageResource->getType()."\r\n");
		$this->outImage();
	}
	/**
	 * 怕用户忘记使用makeImage&browseImage方法
	 */
	public function __destruct()
	{
		if(!$this->_isMakeImage)
		{
			$this->makeImage();
		}
	}
	/**
	 * 输出图片
	 * @param string $fileName 输出的文件名
	 */
	private function outImage($fileName = '')
	{
		$this->_isMakeImage = true;
		$funcName = $this->_imageResource->getType();
		$funcName = 'image'.$funcName;
		$funcName($this->_imageResource->resource,$fileName);
	}
}

/**
 * image资源类
 * @author admin
 *
 */
class imageResource
{
	/**
	 * 资源
	 * @var resource
	 */
	public $resource;
	/**
	 * 宽度
	 * @var int
	 */
	private $_width = 0;
	/**
	 * 高度
	 * @var int
	 */
	private $_height = 0;
	/**
	 * 图像类型
	 * @var string
	 */
	private $_type = '';
	
	private function __construct($resource,$width,$height,$type)
	{
		$this->resource = $resource;
		$this->_width = $width;
		$this->_height = $height;
		$this->_type = $type;
	}
	/**
	 * 创建真彩色资源
	 * @param int $width 宽
	 * @param int $height 高
	 * @param string $type 图形类型
	 * @return imageResource
	 */
	public static function createByTrueColor($width,$height,$type)
	{
		!in_array($type, array('jpeg','png','gif','bmp')) ? $type = 'jpeg' : '';
		return new self(imagecreatetruecolor($width,$height), $width, $height, $type);
	}
	/**
	 * 根据图形文件创建资源
	 * @param string $fileName 文件名
	 * @throws imageNotTypeException
	 * @return @return imageResource
	 */
	public static function createByFile($fileName)
	{
		$imageType = strtolower(substr(strrchr($fileName,"."),1));
		$funcName = '';
		switch ($imageType)
		{
		    case 'jpeg':case 'jpg':
		        $imageType = 'jpeg';
		        break;
		    case 'gif':
		    case 'png':
		    case 'bmp':
		    break;
		    default:
		        throw new imageNotTypeException($imageType);
		}
		$funcName = 'imagecreatefrom'.$imageType;
		$resource = $funcName($fileName);
		return new self($resource, imagesx($resource), imagesy($resource), $imageType);
	}
	/**
	 * 获取宽度
	 */
	public function getWidth()
	{
		return $this->_width;
	}
	/**
	 * 获取高度
	 */
	public function getHeight()
	{
		return $this->_height;
	}
	/**
	 * 获取类型
	 */
	public function getType()
	{
		return $this->_type;
	}
	public function __destruct()
	{
		if(is_resource($this->resource))
		{
			imagedestroy($this->resource);
		}
	}
}
/**
 * 不支持的图片类型异常
 * @author admin
 *
 */
class imageNotTypeException extends Exception
{
	public function __construct($imageType)
	{
		parent::__construct('image类不支持'.$imageType.'类型图片');
	}
}