<?php
class homeComponents extends sfComponents {
	public function executeTopic(){
		$this->topics = Doctrine::getTable ( 'Topic' )->getList(10);
	}
	public function executeRightbanner(){
		//内页右侧广告图片
		$this->right_banner = Doctrine::getTable('Advertising')->getList(1,3);
	}
	public function executeRightimages(){
		$this->images  = Doctrine::getTable('Images')->getList(10,1);
	}
	public function executeNotice(){
		$this->notices  = Doctrine::getTable('notice')->getList(6);
	}
	public function executeLeftbanner(){
	}
	public function executeContact(){
	}
	public function executeQuestion(){
		//专家
		$this->experts  = Doctrine::getTable('Expert')->getList();
	}
	public function executeUserandactivity(){
		//近期活动
		$this->activities = Doctrine::getTable('Activity')->getList(5);
	}
	public function executeHotdocument(){
		//热门文档
		$this->documents = Doctrine::getTable('File')->getHotList(5);
	}
	public function executeNewneed(){
		//最新需求
		$this->needs = Doctrine::getTable('Need')->getList(5);
	}
	public function executeSharing(){
		//最新文件
		$this->files = Doctrine::getTable('File')->getShareList(10);
	}
	
	
	
	public function executeTuijianshipin(){
		$keyword = $this->content->getKeyword();
		$content_table =  Doctrine::getTable('Content');
		$content_table->initMem ();
		$q = $content_table->createQuery('t')
			->where('t.is_publish = 1 and t.keyword like ?','%'.$keyword.'%')
 			->andWhere('t.content_type = ?','video')
			->orderBy('t.browse_count desc')
			->limit(4);
		$this->list = $content_table->getNormalExecute('frontend_tuijianshipin',$q);
	}
	
	public function executeFngzLeftBottom(){
		$mem = MemcacheManager::getInstance();
		$mem->initialize ();
		$this->tupian_list = $mem->get('frontend_fngz_tupian');
		$this->tupian_list = unserialize($this->tupian_list);
		if(!$this->tupian_list){
			$tokens = myConstant::fngzTokenCollection();
			if ($tokens != null) {
				$category_ids = array ();
				foreach ( $tokens as $token ) {
					$categoryObject = Doctrine::getTable ( 'Category' )->findOneBy ( 'token', $token );
					$category_ids [] = $categoryObject->getId ();
				}
			}
			$content_table =  Doctrine::getTable('Content');
			$this->tupian_list = Doctrine::getTable('UploadImage')->getList($category_ids,4,1);
			$ser = serialize($this->tupian_list);
			$mem->set('frontend_fngz_tupian',$ser);
		}
		
		$this->shipin_list = $mem->get('frontend_fngz_shipin');
		$this->shipin_list = unserialize($this->shipin_list);
		
		if(!$this->shipin_list){
			$xinxi = Doctrine::getTable('Category')->findOneBy('token', myConstant::ZXPD_XIN_XI_KUAI_DI);
			$this->shipin_list = Doctrine::getTable('UploadVideo')->getList(array($xinxi->getId()),4,1);
			$ser = serialize($this->shipin_list);
			$mem->set('frontend_fngz_shipin',$ser);
		}
		$this->wenjian_list = $mem->get('frontend_fngz_wenjian');
		$this->wenjian_list = unserialize($this->wenjian_list);
		if(!$this->wenjian_list){
			$this->wenjian_list = $content_table->getResultBy ( array (
				myConstant::ZXPD_WEN_JIAN_KU
			), 8, 1);
			$ser = serialize($this->wenjian_list);
			$mem->set('frontend_fngz_wenjian',$ser);
		}
		
		$this->fagui_list = $mem->get('frontend_fngz_fagui');
		$this->fagui_list = unserialize($this->fagui_list);
		if(!$this->fagui_list){
			$this->fagui_list =$content_table->getResultBy ( array (
				myConstant::ZXPD_FA_GUI_KU
			), 8, 1 );
			$ser = serialize($this->fagui_list);
			$mem->set('frontend_fngz_fagui',$ser);
		}
		
		
		
		
	}
	
	public function executeWqdtLeftBottom(){
		$content_table =  Doctrine::getTable('Content');
		$content_table->initMem ();
		$this->xuexi_list = $content_table->getResultBy ( array (
				myConstant::WQDT_ZAI_XIAN_XUE_XI
		), 4, 1 ,null,'article',true,'frontend_xuexi' );
	}
	
	public function executeNxjtLeftBottom(){
		$content_table =  Doctrine::getTable('Content');
		$content_table->initMem ();
		$this->list = $content_table->getResultBy ( array (
				myConstant::NXJT_BEI_JING_YUE_DU
		), 8, 1 ,null,'article',true,'frontend_nxjt' );
	}
	
	public function executeKuozhanyuedu(){
		//$mem = MemcacheManager::getInstance();
		//$mem->initialize ();
		//$this->list = $mem->get('frontend_kuozhanyuedu');
		//$this->list = unserialize($this->list);
		
		if(true){
			$keyword = $this->content->getKeyword();
			$content_id = $this->content->getId();
// 			echo $keyword.'1';
			$this->list = Doctrine::getTable('Content')->Kuozhanyuedus($keyword,$content_id);
			//$ser = serialize($this->list);
			//$mem->set('frontend_kuozhanyuedu',$ser);
		}
	}
	
	public function executePopularWord() {
		$this->list = Doctrine::getTable ( 'PopularWord' )->getListByLimit ( 7 ,1,true,'frontend_popularword1');
	}
	public function executeRightPopularWord() {
		$this->list = Doctrine::getTable ( 'PopularWord' )->getListByLimit ( 10, false,true,'frontend_popularword2' );
	}
	public function executeHoursClickList() {
		$content_table =  Doctrine::getTable('Content');
		$content_table->initMem ();
		$this->list = $content_table->getContentsHot48 ( $this->token, 10,true,'frontend_hoursclicklist' );
	}
	public function executeChannelRecommend(){
		$this->list = Doctrine::getTable ( 'Content' )->getListRecommend(10,true,'frontend_channelrecommend');
	}
	public function executeChannelRecommend1(){
		$this->list = Doctrine::getTable ( 'Content' )->getListRecommend(10,true,'frontend_channelrecommend');
	}
	public function executePictureList(){
		$mem = MemcacheManager::getInstance();
		$mem->initialize ();
		$this->zi_xun_list = $mem->get('frontend_picturezixunlist');
		$this->zi_xun_list = unserialize($this->zi_xun_list);
		if(!$this->zi_xun_list){
			$c1 = Doctrine::getTable ( 'Category' )->findOneBy('token', myConstant::ZXPD_RE_DIAN_JU_JIAO);
			$c2 = Doctrine::getTable ( 'Category' )->findOneBy('token', myConstant::ZXPD_FU_ER_YAO_WEN);
			$this->zi_xun_list = Doctrine::getTable ( 'UploadImage' )->getList(array($c1->getId(),$c2->getId()),
					6,1);
			$ser = serialize($this->zi_xun_list);
			$mem->set('frontend_picturezixunlist',$ser);
		}
		$this->gong_zuo_list = $mem->get('frontend_picgongzuolist');
		$this->gong_zuo_list = unserialize($this->gong_zuo_list);
		if(!$this->gong_zuo_list){
			$c3 = Doctrine::getTable ( 'Category' )->findOneBy('token', myConstant::ZXPD_XIN_XI_KUAI_DI);
			$this->gong_zuo_list = Doctrine::getTable ( 'UploadImage' )->getList(array($c3->getId()),
					6,1);
			$ser = serialize($this->gong_zuo_list);
			$mem->set('frontend_picgongzuolist',$ser);
		}
		$this->she_qu_list =  $mem->get('frontend_picshequlist');
		$this->she_qu_list = unserialize($this->she_qu_list);
		if(!$this->she_qu_list){
			$this->she_qu_list = Doctrine::getTable ( 'UploadImage' )->getShequPictureList(6);
			$ser = serialize($this->she_qu_list);
			$mem->set('frontend_picshequlist',$ser);
		}
		
		
	}
	public function executeVideoList(){
		$mem = MemcacheManager::getInstance();
		$mem->initialize ();
		
		$this->gong_zuo_list = $mem->get('frontend_videolistgongzuolist');
		if(!$this->gong_zuo_list){
			$c1 = Doctrine::getTable ( 'Category' )->findOneBy('token', myConstant::ZXPD_XIN_XI_KUAI_DI);
			$this->gong_zuo_list = Doctrine::getTable ( 'UploadVideo' )->getList(array($c1->getId()));
			$mem->set('frontend_videolistgongzuolis',$this->gong_zuo_list);
		}
		$this->jiang_tang_list = $mem->get('frontend_videolistjiangtanglist');
		if(!$this->jiang_tang_list){
			$c1 = Doctrine::getTable ( 'Category' )->findOneBy('token', myConstant::NXJT_GE_DI_JIANG_TAN);
			$c2 = Doctrine::getTable ( 'Category' )->findOneBy('token', myConstant::NXJT_SHENG_JI_JIANG_TAN);
			$this->jiang_tang_list =Doctrine::getTable ( 'UploadVideo' )->getList(array($c1->getId(),$c2->getId()));
			
			$mem->set('frontend_videolistjiangtanglist',$this->jiang_tang_list);
		}
	}
	public function executeImageNews() {
		$mem = MemcacheManager::getInstance();
		$mem->initialize ();
		if($this->category_id == 18)
			$this->category_id = 5;
		$this->list = $mem->get('frontent_imagenews_'.$this->category_id,null);
		$this->list = unserialize($this->list);
		if(!$this->list)
		{		
			
// 			$category = Doctrine::getTable('Category')->find($this->category_id);
// 			$ids = array();
			
// 			if($this->category_id == 54){
// 				$ids[] = 54;
// 			}
// 			else{
// 				foreach ($category->getNode()->getParent()->getNode()->getChildren() as $child){
// 					$ids[] = $child->getId();
// 				}
// 			}
			$q = Doctrine::getTable ( 'Content' )
			->createQuery ( 't' )
			->select('t.id,t.token,t.title,t.sub_title,t.created_at,t.updated_at,t.summary,t.published_date')
			->where ( 't.is_publish = 1 and t.is_delete = 0 and t.thumbnails is not null and t.thumbnails != "" and t.category_id != 7' )
			->andWhere('t.category_id = 5')//暂时改成图片新闻就显示信息快递的新闻
			//->andWhereIn('t.category_id',$ids)
			->orderBy('t.published_date desc')
			->limit ( 6 );
			$this->list = $q->execute();
			$ser = serialize($this->list);
			$mem->set('frontent_imagenews_'.$this->category_id,$ser);
		}
	}
	public function executeFriendLink($request){
		// 得到调研思考分类中推荐到首页显示的内容的关联调查
		// 友情链接
		$link_table = Doctrine::getTable ( 'Link' );
		$link_table->initMem ();
		$this->textLinks = $link_table->getListByKeyword('wenzi',20,true,'frontend_friendlinktext');
		$this->imageLinks = $link_table->getListByKeyword('tupian',9,true,'frontend_friendlinkimage');
		$this->fulianLinks = $link_table->getListByKeyword('fulian',null,true,'frontend_friendlinkfulian');
		$this->shifulianLinks = $link_table->getListByKeyword('shifulian',null,true,'frontend_friendlinkshifulian');
		$this->xianfulianLinks = $link_table->getListByKeyword('xianfulian',null,true,'frontend_friendlinkxianfulian');
		$this->zhengfuLinks = $link_table->getListByKeyword('zhengfu',null,true,'frontend_friendlinkzhengfu');
		$this->nvxingLinks = $link_table->getListByKeyword('nvxing');
		$this->ertongLinks = $link_table->getListByKeyword('ertong');
	}
	public function executeComment(){
	}
	public function executeCommentPicture(){
	}
	public function executeMessage(){
	}
}