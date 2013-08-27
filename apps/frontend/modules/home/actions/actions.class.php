<?php

/**
 * home actions.
 *
 * @package    nxetd
 * @subpackage home
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php,v 1.91 2013/07/31 01:15:54 gef Exp $
 */
class homeActions extends sfActions {
	
	public function executeTest(sfWebRequest $request){
		
		echo 2;exit;
		$q = Doctrine::getTable('Content')->createQuery('c')
				->select('id,keyword')->orderBy('id');
		
		$pager = new sfDoctrinePager ( 'Content', 1000);
		$pager->setQuery ( $q );
		$pager->setPage ( 2 );//60
		$pager->init ();
		
		foreach($pager as $obj)
		{
			$keyword = $obj->getKeyword();
			if(!empty($keyword) )
			{
				$names = explode(",", $keyword);
				foreach($names as $name)
				{
					$lex = Doctrine::getTable('Lexicon')->findOneBy('name', $name);
					if($lex)
					{
						$lex->Contents[] = $obj;
						$lex->save();
					}
				}
			}
		}
		echo 'ok';
		exit;
		sfContext::getInstance()->getConfiguration()->loadHelpers('url');
		echo url_for('@wall_show?id=1');exit;
		//$request->getCookie('today_login', false);
		//$this->getResponse()->setCookie('today_login', true, time()+3600*24);
	}
	
	/**
	 * 记录看过本文的人还看过的文章id，只保留5条
	 * @param unknown_type $id 
	 */
	private function addRelateArticles($id){
		//得到当前session用户浏览的文章id集合
		$showContentIds = $this->getUser()->getAttribute('showContentIds',array());
		if(!array_key_exists($id, $showContentIds)){
			$showContentIds[$id] = $id;
			$this->getUser()->setAttribute('showContentIds', $showContentIds);
		}
		//获取数据库中本文相关的文章id集合
		$temp = Doctrine::getTable('RelatedArticles')->createQuery('c')->select('c.id2')->where('id1 = ?',$id)->fetchArray();
		$relatedArticles = array();
		foreach($temp as $item){
			$relatedArticles[] = $item['id2'];
		}
		//用户当前session中的id和文章关联id比较，得到session中有而数据库中没有的id集合
		$result = array_diff($showContentIds,$relatedArticles);
		unset($result[$id]);
		//将session中有而数据库中没有的id存入数据库
		foreach($result as $id2){
			$obj = new RelatedArticles();
			$obj->setId1($id);
			$obj->setId2($id2);
			$obj->save();
		}
		//删除多余关联条数，只保留5条
		$list = Doctrine::getTable('RelatedArticles')
					->createQuery('c')
					->where('id1 = ? ',$id)
					->orderBy('c.created_at desc')
					->execute();
		foreach($list as $key=>$item){
			if($key<=4)
				continue;
			$item->delete();
		}
	}
	
	public function executeAutocomplete(sfWebRequest $request){
		$q = $request->getParameter('term');
		$lexicons= Doctrine::getTable('Lexicon')->findAll();
		$items = array();
		foreach($lexicons as $key=>$item){
			$items [$item->getName()] = $item->getName();
		}
		$result = array();
		foreach ($items as $key=>$value) {
			if (strpos(strtolower($key), $q) !== false) {
				array_push($result, array("id"=>$value, "label"=>$key, "value" => strip_tags($key)));
			}
			if (count($result) > 11)
				break;
		}
		echo $this->array_to_json($result);
		exit;
	}
	
	
	public function executePopularWordList(sfWebRequest $request){
		$this->word = Doctrine::getTable('PopularWord')->find($request->getParameter('word_id'));
		if(!$this->word)
			$this->redirect('@homepage');
		$this->list = Doctrine::getTable('WordData')->createQuery('w')
			->where('w.word_id = ?',$this->word->getId())
			->orderBy('w.created_at desc,w.id desc')
			->execute();
	}
	
	public function executeTopList(sfWebRequest $request){
		$page = $request->getParameter('page',1);
		$this->routeName = 'top_list';
		$this->routeParams = '';
		$this->pager = Doctrine::getTable('Link')->getlist($page);
	}
	public function executeTopList2(sfWebRequest $request){
		$page = $request->getParameter('page',1);
		$this->routeName = 'top_list2';
		$this->routeParams = '';
		$this->pager = Doctrine::getTable('Link')->getlist2($page);
		
		$this->setTemplate('topList');
	}
	public function executeSubjectList(sfWebRequest $request){
		$this->subjectList2 = Doctrine::getTable('Subject')
			->getNotNormalList();
		
		$page = $request->getParameter('page',1);
		$params['cate']='society';
		$this->pager = Doctrine::getTable('Subject')->getPager($page,$params);
		$this->routeName = 'homeSubjectList';
		$this->routeParams = '';
	}
	public function executeSubjectList2(sfWebRequest $request){
		$page = $request->getParameter('page',1);
		$params['cate']='work';
		$this->pager = Doctrine::getTable('Subject')->getPager($page,$params);
	
		$this->routeName = 'homeSubjectList2';
		$this->routeParams = '';
	}
	public function executeBuilding(sfWebRequest $request){
	}
	
	public function executeBbsPersonal(sfWebRequest $request){
		if(sfConfig::get('sf_web_debug'))
			return $this->redirect('/bbs_dev.php/personal');
		else
			return $this->redirect('/bbs.php/personal');
	}
	public function executeBbsMyMessages(sfWebRequest $request){
		if(sfConfig::get('sf_web_debug'))
			return $this->redirect('/bbs_dev.php/my_messages');
		else
			return $this->redirect('/bbs.php/my_messages');
	}
	public function executeBbsForumTop(sfWebRequest $request){
		$id = $request->getParameter('id',1);
		if(sfConfig::get('sf_web_debug'))
			return $this->redirect('/bbs_dev.php/forum_top/'.$id);
		else
			return $this->redirect('/bbs.php/forum_top/'.$id);
	}
	public function executeBbs(sfWebRequest $request){
		$id = $request->getParameter('id',1);
		$today = $request->getParameter('today',null);
		$params = '';
		if($today === '0')
			$params = '/0/1/0';
		if($today === '2')
			$params = '/0/1/2';
		if(sfConfig::get('sf_web_debug'))
			return $this->redirect('/bbs_dev.php/posteds/'.$id.$params);
		else
			return $this->redirect('/bbs.php/posteds/'.$id.$params);
	}
	public function executeBbsShowPosted(sfWebRequest $request){
		$id = $request->getParameter('id',1);
		if(sfConfig::get('sf_web_debug'))
			return $this->redirect('/bbs_dev.php/posted_show/'.$id);
		else
			return $this->redirect('/bbs.php/posted_show/'.$id);
	}
	
	public function executeAbout(sfWebRequest $request) {
		$this->type = 'about';
		$this->setTemplate ( 'bottom' );
	}
	public function executeMaps(sfWebRequest $request) {
		$this->type = 'maps';
		$this->setTemplate ( 'bottom' );
	}
	public function executeLink(sfWebRequest $request) {
		$this->type = 'link';
		$this->setTemplate ( 'bottom' );
	}
	public function executePartner(sfWebRequest $request) {
		$this->type = 'partner';
		$this->setTemplate ( 'bottom' );
	}
	public function executeContact(sfWebRequest $request) {
		$this->type = 'contact';
		$this->setTemplate ( 'bottom' );
	}
	public function executeCopyright(sfWebRequest $request) {
		$this->type = 'copyright';
		$this->setTemplate ( 'bottom' );
	}
	public function executeDing(sfWebRequest $request) {
		$id = $request->getParameter ( 'id' );
		$object = Doctrine::getTable ( 'Comment' )->find ( $id );
		if ($object) {
			$object->setHit ( $object->getHit () + 1 );
			$object->save ();
			echo $object->getHit ();
		} else {
			echo 'error';
		}
		exit ();
	}
	public function executePictureDetail(sfWebRequest $request) {
		
		
		$token = $request->getParameter ( 'token' );
		$this->content = Doctrine::getTable ( 'Content' )->findOneBy ( 'token', $token );
		$this->forward404Unless ( $this->content );
		$this->category = $this->content->Category;
		$parent = $this->category->getNode ()->getParent ();
		$this->parentRoute = $this->getParentRoute ( $parent );
		
		$this->content->browseProcess ();
		$this->type = $this->getStyleType ( $this->category );
		$this->list = $this->content->UploadImages;
		
		$mem =  MemcacheManager::getInstance();
		$mem->initialize();
		$this->xiang_guan_tu_ji_list = $mem->get('frontend_xiangguantuji');
		$this->xiang_guan_tu_ji_list = unserialize($this->xiang_guan_tu_ji_list);
		if(!$this->xiang_guan_tu_ji_list){
			$this->xiang_guan_tu_ji_list = Doctrine::getTable('Content')
				->createQuery('t')
				->where('t.is_picture = 1')
				->orderBy('t.browse_count desc')
				->limit(6)->execute();
			$ser =  serialize($this->xiang_guan_tu_ji_list);
			$mem->set('frontend_xiangguantuji',$ser);
// 			$this->xiang_guan_tu_ji_list = Doctrine::getTable('UploadImage')->createQuery('t')
// 				->where('t.source = 1 and t.content_id is not null')
// 				->orderBy('t.created_at desc')
// 				->limit(6)->execute();
		}
// 		if(count($this->xiang_guan_tu_ji_list) < 6){
// 			$this->xiang_guan_tu_ji_list = Doctrine::getTable('Content')->createQuery('t')
// 			->where('t.is_publish = 1 and t.is_picture = 1')->orderBy ( 't.published_date desc' )
//			->andWhere('t.category_id = ?',$this->content->getCategoryId())
// 			->andWhere('t.id != ?',$this->content->getId())
// 			->limit(6)->execute();
// 		}
	}
	/**
	 * 视频的顶、踩
	 * 
	 * @param sfWebRequest $request        	
	 */
	public function executeAjaxDingcai(sfWebRequest $request) {
		$id = $request->getParameter ( 'id' );
		$type = $request->getParameter ( 'type' );
		$video = Doctrine::getTable ( 'UploadVideo' )->find ( $id );
		if (! $video)
			return 'error';
		if ($type == 'ding')
			$video->setDing ( $video->getDing () + 1 );
		elseif ($type == 'cai')
			$video->setCai ( $video->getCai () + 1 );
		$video->save ();
		
		return $this->renderPartial ( 'home/video' . $type, array (
				'video' => $video,
				'type' => 2 
		) );
		exit ();
	}
	
	public function executeCommentList(sfWebRequest $request) {
		$token = $request->getParameter ( 'token' );
		$this->content = Doctrine::getTable ( 'Content' )->findOneBy ( 'token', $token );
		$this->forward404Unless ( $this->content );
		$this->category = $this->content->Category;
		$this->type = $this->getStyleType ( $this->category );
		$page = $request->getParameter ( 'page', 1 );
		$params ['content_id'] = $this->content->getId ();
		$this->pager = Doctrine::getTable ( 'Comment' )->getListPager ( $page, $params );
		
		$this->routeName = 'comment_list';
		$this->routeParams = '##token=' . $token;
	}
	public function executeSearch2(sfWebRequest $request) {
		$this->lingdao = $request->getParameter ( 'lingdao', 1 );
		$page = $request->getParameter ( 'page', 1 );
		$keyword = $request->getParameter ( 'keyword', '' );
		$this->order = $request->getParameter ( 'order', 'datetime' );
		$keyword = $keyword == 'all' ? '' : $keyword;
		$this->routeName = 'search2';
		$this->routeParams = '##keyword=' . $keyword . '##lingdao=1' . '##order=' . $this->order;
		if(!Tools::validInput($keyword)){
			$keyword = '';
		}
		$params ['keyword'] = $keyword;
		$params ['order'] = $this->order;
		
		$this->pager = Doctrine::getTable ( 'Content' )->searchPager2 ( $page, $params );
		
		$this->type = $request->getParameter ( 'type', 'all' );
		$this->type = $this->type == 'all' ? 'article' : $this->type;
		$this->routeParams2 = '##keyword=' . $keyword . '##lingdao=1';
		
		return $this->setTemplate ( 'search' );
	}
	public function executeSearch(sfWebRequest $request) {
		
		$this->lingdao = 0;
		
		$page = $request->getParameter ( 'page', 1 );
		$this->keyword = $request->getParameter ( 'keyword', '' );
		$category = $request->getParameter ( 'category', 'all' );
		$this->type = $request->getParameter ( 'type', 'all' );
		$this->order = $request->getParameter ( 'order', 'datetime' );
		$this->keyword = $this->keyword == 'all' ? '' : $this->keyword;
		$this->type = $this->type == 'all' ? 'article' : $this->type;
		$this->routeName = 'search';
		$this->routeParams = '##keyword=' . $this->keyword . '##category=' . $category . '##type=' . $this->type . '##order=' . $this->order;
		$this->routeParams2 = '##keyword=' . $this->keyword . '##category=' . $category . '##type=' . $this->type;
		$this->routeParams3 = '##keyword=' . $this->keyword . '##category=' . $category . '##order=' . $this->order;
		$category_token_array = null;
		
		if(!Tools::validInput($this->keyword)){
			$this->keyword = '';
		}
		
		if ($this->keyword != '') {
			if (isset ( $_COOKIE ['nxetd_search'] )) {
				$c_search = $_COOKIE ['nxetd_search'];
				$c_search = json_decode ( $c_search, true );
				if (! isset ( $c_search [$this->keyword] )) {
					$c_search [$this->keyword] = $this->keyword;
					$c_search = json_encode ( $c_search );
					setcookie ( 'nxetd_search', $c_search, time () + 60 * 60 * 24 * 30 );
				}
			} else {
				$c_search = array (
						$this->keyword => $this->keyword 
				);
				$c_search = json_encode ( $c_search );
				setcookie ( 'nxetd_search', $c_search, time () + 60 * 60 * 24 * 30 );
			}
		}
		//论坛搜索
		if($this->type == 'all')
		{
			$forum_type = 2;
		}
		else{
			$forum_type = 1;
		}
		
		switch ($category) {
			case 'fngz' :
				$category_token_array = myConstant::fngzTokenCollection ();
				break;
			case 'ghzc' :
				$category_token_array = myConstant::ghzcTokenCollection ();
				break;
			case 'wqdt' :
				$category_token_array = myConstant::wqdtTokenCollection ();
				break;
			case 'nxst' :
				$category_token_array = myConstant::nxstTokenCollection ();
				break;
			case 'nxjt' :
				$category_token_array = myConstant::nxjtTokenCollection ();
				break;
			case 'nxsq' ://论坛搜索 跳至论坛搜索
				$this->redirect ('/bbs.php/search?page=1&text='.$this->keyword.'&search_type='.$forum_type);
				break;
			case 'zt' ://专题搜索
				$this->redirect ('@search?keyword='.$this->keyword.'&type=stati');
				break;
		}
		$params ['token'] = $category_token_array;
		$params ['keyword'] = $this->keyword;
		$params ['type'] = $this->type;
		$params ['id'] = null;
		$params ['order'] = $this->order;
		if ($category_token_array != null) {
			$category_ids = array ();
			foreach ( $category_token_array as $token ) {
				$categoryObject = Doctrine::getTable ( 'Category' )->findOneBy ( 'token', $token );
				$category_ids [] = $categoryObject->getId ();
			}
			$params ['id'] = $category_ids;
		}
		
		if ($this->type == "picture") {
			$this->pager = Doctrine::getTable ( 'UploadImage' )->searchPager ( $page, $params );
		} elseif ($this->type == "article" || $this->type == "video") {
			$this->pager = Doctrine::getTable ( 'Content' )->searchPager ( $page, $params );
		} elseif ($this->type == "stati") {
			$this->pager = Doctrine::getTable ( 'SubjectContent' )->searchPager ( $page, $params );
		}else {
			$this->pager = Doctrine::getTable ( 'Content' )->searchPager ( $page, $params );
		}
	
	}
	
	public function executeMessageAdd(sfWebRequest $request) {
		
		if ($this->getUser ()->isAnonymous ()) {
			$url = ($request->getReferer ());
			$this->getUser ()->setAttribute ( 'refererUrlBackend', $url );
			return $this->redirect ( sfConfig::get ( 'app_login' ) );
		}
		
		$text = $request->getParameter ( 'editorValue' );
		$token = $request->getParameter ( 'content_token' );
		
		$tmp = str_replace ( '<p>', '', $text );
		$tmp = str_replace ( '</p>', '', $tmp );
		$tmp = str_replace ( '<br />', '', $tmp );
		
		if (strlen ( $tmp ) == 0) {
			return $this->redirect ( $request->getReferer () );
		}
		
		$object = Doctrine::getTable ( 'Content' )->findOneBy ( 'token', $token );
		$this->forward404Unless ( $object );
		
		$user = $this->getUser ()->getGuardUser ();
		$username = $user->getUsername ();
		$object->addMessage ( $text, $username, $user );
		$this->getUser ()->setFlash ( 'notice', '你的留言已提交，正在等待审核。' );
		return $this->redirect ( $request->getReferer () );
	}
	public function executeCommentReply(sfWebRequest $request) {
		$token = $request->getParameter ( 'content_token' );
		$parent_id = $request->getParameter ( 'parent_id' );
		$text = $request->getParameter ( 'text' );
		
		if (strlen ( trim ( $text ) ) == 0)
			return $this->redirect ( $request->getReferer () );
		
		$object = Doctrine::getTable ( 'Content' )->findOneBy ( 'token', $token );
		$this->forward404Unless ( $object );
		
		$user = $this->getUser ()->getGuardUser ();
		$username = $user->getUsername ();
		$object->addComment ( $text, $username, $user, $parent_id );
		$this->getUser ()->setFlash ( 'notice', '你的评论已提交，正在等待审核。' );
		return $this->redirect ( $request->getReferer () );
	}
	public function executeCommentAdd(sfWebRequest $request) {
		
		if ($this->getUser ()->isAnonymous ()) {
			$url = ($request->getReferer ());
			$this->getUser ()->setAttribute ( 'refererUrlBackend', $url );
			return $this->redirect ( sfConfig::get ( 'app_login' ) );
		}
		
		$text = $request->getParameter ( 'editorValue' );
		$token = $request->getParameter ( 'content_token' );
		
		$tmp = str_replace ( '<p>', '', $text );
		$tmp = str_replace ( '</p>', '', $tmp );
		$tmp = str_replace ( '<br />', '', $tmp );
		
		if (strlen ( $tmp ) == 0) {
			return $this->redirect ( $request->getReferer () );
		}
		
		$object = Doctrine::getTable ( 'Content' )->findOneBy ( 'token', $token );
		$this->forward404Unless ( $object );
		
		$user = $this->getUser ()->getGuardUser ();
		$username = $user->getUsername ();
		$object->addComment ( $text, $username, $user );
		$this->getUser ()->setFlash ( 'notice', '你的评论已提交，正在等待审核。' );
		return $this->redirect ( $request->getReferer () );
	}
	public function executeWangxiaoDataAjax(sfWebRequest $request) {
		$exdata = new ExternalData ();
		$spjz = $exdata->getJsonData ( ExternalData::WX_SHIPINJIANGZUO );
		$fmxt = $exdata->getJsonData ( ExternalData::WX_FUMUXUETANG );
		$jjys = $exdata->getJsonData ( ExternalData::WX_JIAJIAOYUSI );
		$czbfn = $exdata->getJsonData ( ExternalData::WX_CHENGZHANGBUFANNAO );
		$jchd = $exdata->getJsonData ( ExternalData::WX_JINGCAIHUODONG );
		$wx = '{"0":' . $spjz . ',"1":' . $fmxt . ',"2":' . $jjys . ',"3":' . $czbfn . ',"4":'.$jchd. '}';
		echo $wx;
		exit ();
	}
	public function executeLogin(sfWebRequest $request) {
		if ($this->getUser ()->isAnonymous ()) {
			$url = ($request->getReferer ());
			$this->getUser ()->setAttribute ( 'refererUrlBackend', $url );
			return $this->redirect ( sfConfig::get ( 'app_login' ) );
		}
	}
	public function executeRegister(sfWebRequest $request) {
		if ($this->getUser ()->isAnonymous ()) {
			$url = ($request->getReferer ());
			$this->getUser ()->setAttribute ( 'refererUrlBackend', $url );
			return $this->redirect ( sfConfig::get ( 'app_register' ));
		}
	}
	public function executeLoginFrame(sfWebRequest $request) {
	}
	public function executeArticleListAjax(sfWebRequest $request) {
		$category_id = $request->getParameter ( 'category_id' );
		$category = Doctrine::getTable ( 'Category' )->find ( $category_id );
		$date = $request->getParameter ( 'datetime' );
		$type = $request->getParameter ( 'type' );
		$routeParams = '##date=' . $date . '##category_id=' . $category_id . '##type=' . $type;
		$partialName = $request->getParameter ( 'partialName', 'home/articleListBody' );
		
		$routeName = $request->getParameter ( 'routeName', 'article_list' );
		$params = array ();
		$params ['category_id'] = $category_id;
		$params ['date'] = $date;
		$pager = Doctrine::getTable ( 'Content' )->getContentsPager ( 1, $params );
		
		return $this->renderPartial ( $partialName, array (
				'pager' => $pager,
				'category' => $category,
				'routeParams' => $routeParams,
				'routeName' => $routeName 
		) );
	
	}
	public function executeArticleList(sfWebRequest $request) {
		if($request->hasParameter('city')){//特殊处理城市查询
			$this->city = $request->getParameter('city');
			$this->type = $request->getParameter ( 'type' );
			$this->routeParams .= '##type=' . $this->type.'##city='.$this->city;
			$page = $request->getParameter ( 'page' , 1);
			$date = null;
			$params = array ();
			if($request->hasParameter('title') && $request->hasParameter('title')!=''){
				$this->title = trim($request->getParameter('title'));
				$params['title'] = $this->title;
				$this->routeParams .= '##title='.$this->title;
			}
			else{
				$this->title = '';
			}
			if ($request->hasParameter ( 'date' )) {
				$date = $request->getParameter ( 'date' );
				$this->routeParams .= '##date=' . $date;
				$params ['date'] = $date;
			}
			$this->tag = null;
				
			if($request->hasParameter('tag_id')){
				$tag_id = $request->getParameter('tag_id');
				$this->tag = Doctrine::getTable('Tag')->find($tag_id);
				$params['tag_id'] = $tag_id;
				$this->routeParams .= '##tag_id='.$tag_id;
			}
			if($request->hasParameter('tag2_id')){
				$tag_id = $request->getParameter('tag2_id');
				$this->tag = Doctrine::getTable('Tag')->find($tag_id);
				$params['tag2_id'] = $tag_id;
				$this->routeParams .= '##tag2_id='.$tag_id;
			}
			
			$this->pager = Doctrine::getTable ( 'Content' )->getListByCity ( $this->city , $page,$params );
			$this->routeName = null;
			$this->partialName = 'home/articleListBody';
			$this->parentRoute = '@fngz';
			$this->category_id = 2;
			$this->category = new Category();
			$this->category->setToken(sha1 ( time () . rand ( 11111, 99999 ) ));
			$this->category->setName($this->city);
			$this->category->setId(9998);
			
			return;
		}
		$this->city = null;
		$this->category_id = $request->getParameter ( 'category_id' );
		if($this->category_id==9999){
			$this->category = new Category();
			$this->category->setToken(sha1 ( time () . rand ( 11111, 99999 ) ));
			$this->category->setName('领导讲话');
			$this->category->setId(9999);
		}else{
			$this->category = Doctrine::getTable ( 'Category' )->find ( $this->category_id );
			$this->forward404Unless ( $this->category );
		}
		$this->type = $request->getParameter ( 'type' );
		$page = 1;
		if ($request->hasParameter ( 'page' )) {
			$page = $request->getParameter ( 'page' );
		}
		$date = null;
		if ($request->hasParameter ( 'date' )) {
			$date = $request->getParameter ( 'date' );
			$this->routeParams .= '##date=' . $date;
		}
		
		$params = array ();
		if($request->hasParameter('title') && $request->hasParameter('title')!=''){
			$this->title = trim($request->getParameter('title'));
			$params['title'] = $this->title;
			$this->routeParams .= '##title='.$this->title;
		}
		else{
			$this->title = '';
		}
		
		$this->routeParams .= '##category_id=' . $this->category_id . '##type=' . $this->type;
		$params ['category_id'] = $this->category_id;
		
		if ($date) {
			$params ['date'] = $date;
		}
		$this->tag = null;
		if($request->hasParameter('tag_id')){
			$tag_id = $request->getParameter('tag_id');
			$this->tag = Doctrine::getTable('Tag')->find($tag_id);
			$params['tag_id'] = $tag_id;
			$this->routeParams .= '##tag_id='.$tag_id;
		}
		
		if($request->hasParameter('tag2_id')){
			$tag_id = $request->getParameter('tag2_id');
			$this->tag = Doctrine::getTable('Tag')->find($tag_id);
			$params['tag2_id'] = $tag_id;
			$this->routeParams .= '##tag2_id='.$tag_id;
		}
		
		$this->pager = Doctrine::getTable ( 'Content' )->getContentsPager ( $page, $params );
// 		echo 5;exit;
		$parent = $this->category->getNode ()->getParent ();
		if($this->category_id==9999){
			$this->parentRoute = '@fngz';
		}else{
			$this->parentRoute = $this->getParentRoute ( $parent );
		}
		$this->routeName = null;
		$this->partialName = 'home/articleListBody';
		if($this->category->getToken() == myConstant::ZXPD_TU_PIAN_KUN){
			$this->partialName = 'home/pictureLibListBody';
		}
		if ($request->getParameter ( 'is_user', false )) {
			$this->partialName = 'home/guestListBody';
			$this->routeName = 'guest_list';
		}
	}
	public function executeArticleKeywordList(sfWebRequest $request) {
		$this->type = 'fngz';
		$this->keyword = $request->getParameter ( 'keyword' );
		$page = 1;
		if ($request->hasParameter ( 'page' )) {
			$page = $request->getParameter ( 'page' );
		}
	
		$params = array ();
	
		$this->routeName = 'article_keyword_list';
		$this->routeParams .= '##keyword=' . $this->keyword;
		$params ['keyword'] = $this->keyword;
	
		$this->pager = Doctrine::getTable ( 'Content' )->getContentsKeywordPager ( $page, $params );
		
		$this->partialName = 'home/articleListBody';
	}
	public function executeGuestList(sfWebRequest $request) {
		$request->setParameter ( 'is_user', true );
		$this->executeArticleList ( $request );
		$this->setTemplate ( 'articleList' );
	}
	public function executePictureList(sfWebRequest $request) {
		$this->type = $request->getParameter ( 'type' );
		$keyword = $request->getParameter ( 'keyword' );
		$page = $request->getParameter ( 'page', 1 );
		$tokens = array ();
		if ($keyword == 'ghzc')
			$tokens = myConstant::ghzcTokenCollection ();
		elseif ($keyword == 'tupianku')
			$tokens =array( myConstant::ZXPD_XIN_XI_KUAI_DI );
		$params ['token'] = $tokens;
		if ($tokens != null) {
			$category_ids = array ();
			if (is_array ( $tokens )) {
				foreach ( $tokens as $token ) {
					$categoryObject = Doctrine::getTable ( 'Category' )->findOneBy ( 'token', $token );
					$category_ids [] = $categoryObject->getId ();
				}
			} else {
				$categoryObject = Doctrine::getTable ( 'Category' )->findOneBy ( 'token', $tokens );
				$category_ids [] = $categoryObject->getId ();
			}
			$params ['id'] = $category_ids;
		}
		$this->pager = Doctrine::getTable ( 'UploadImage' )->searchPager ( $page, $params );
		
		$this->routeParams = '##keyword=' . $keyword . '##type=' . $this->type;
		$this->routeName = 'picture_list';
	}
	private function getParentRoute($parent) {
		if($parent && $parent->getToken() == myConstant::JGZY_14_DI_SHI)
			$parent = $parent->getNode ()->getParent ();
		$parentRoute = '@homepage';
		if ($parent) {
			switch ($parent->getToken ()) {
				case myConstant::NV_XING_SHE_TUAN :
					$parentRoute = '@shetuan';
					break;
				case myConstant::JIN_GUO_ZHI_YUAN :
					$parentRoute = '@shetuan#volun';
					break;
				case myConstant::GONG_YI_AI_XIN :
					$parentRoute = '@shetuan#love';
					break;
				case myConstant::WEI_QUAN_DA_TING :
					$parentRoute = '@wqdt';
					break;
				case myConstant::WQDT_WO_YAO_ZI_XUN :
					$parentRoute = '@wqdt';
					break;
				case myConstant::GUI_HUA_ZHI_CHUANG :
					$parentRoute = '@ghzc';
					break;
				case myConstant::NV_XING_JIANG_TANG :
					$parentRoute = '@nxjt';
					break;
				case myConstant::NXJT_SHI_PIN_JIANG_ZUO :
					$parentRoute = '@nxjt';
					break;
				case myConstant::ZI_XUN_PIN_DAO :
					$parentRoute = '@fngz';
					break;
				case myConstant::ZXPD_ZI_XUN_GUAN_ZHU :
					$parentRoute = '@fngz';
					break;
				case myConstant::YI_SHI_PIN_DAO :
					$parentRoute = '@fngz';
					break;
				case myConstant::ZXPD_ZI_XUN_GUAN_ZHU :
					$parentRoute = '@fngz';
					break;
				default :
					$parentRoute = '@homepage';
					break;
			}
		}
		return $parentRoute;
	}
	public function executeDetail(sfWebRequest $request) {
	
	}
	
	public function executeBaiduRedirect(sfWebRequest $request) {
		
		$object = Doctrine::getTable ( 'PopularWord' )->find ( $request->getParameter ( 'id' ) );
		$word = $object->getName();
		$object->setHits ( $object->getHits () + 1 );
		$object->save ();
		
		$url = "http://www.baidu.com/s?wd=" . $word . "&cl=3";
		$this->redirect ( $url );
// 		$url = "http://www.baidu.com/s?wd=" . $object->getName () . "&cl=3";
// 		$url = iconv ( 'UTF-8', 'GBK', $url );
// 		$this->redirect ( $url );
		
// 		$word = iconv ( 'UTF-8', 'GBK', $word );
		//$url = iconv ( 'UTF-8', 'GBK', $url );
	}
	
	private function isExistStaticPage() {
		if (sfConfig::get ( 'app_static_page' )) {
			$file = sfConfig::get ( 'sf_web_dir' ) . '/index.html';
			if (file_exists ( $file ))
				return true;
			else
				return false;
		}
		return false;
	}
	
	public function executeAjaxJyxcNew(sfWebRequest $request) {
		
		
		$content = $request->getParameter ( 'content' );
// 		$content = iconv('GBK', "UTF-8", $content);
		$content = Tools::safeEncoding($content,'UTF-8');
		if (strlen($content)<15) {
			echo "error:字数不能少于5个字。";
			exit ();
		}
		if (! Tools::validInput ( $content )) {
			echo 'error:含有非法字符！';
			exit ();
		}
		$user = $this->getUser ()->getGuardUser ();
		$category = Doctrine::getTable ( 'Category' )->findOneBy ( 'token', myConstant::YSPD_JIAN_YAN_XIAN_CE );
		$jyxc = new Content ();
		$jyxc->setContent ( $content );
		$jyxc->Creater = $user;
		// $jyxc->setUserId(1);
		$jyxc->Category = $category;
		$jyxc->setPublishedDate ( date ( 'Y-m-d H:i:s' ) );
		$jyxc->setExSupport ( 'message' );
		$jyxc->save ();
		
		echo 'success:提交成功！';
		exit ();
	}
	
	public function executeIndex(sfWebRequest $request) {
		//网站公告
		$this->notices  = Doctrine::getTable('Notice')->getList(10);
		//轮播图片
		$this->images  = Doctrine::getTable('Images')->getList(10,1);
		//参与单位
		$this->links  = Doctrine::getTable('Link')->getList(10);
		//成功案例
		$this->cases  = Doctrine::getTable('SuccessCase')->getList(5);
		//视频课程
		$this->videos  = Doctrine::getTable('Video')->getList(4);
		//作业专区
		$this->works  = Doctrine::getTable('Work')->getList(4);
		//专家
		$this->experts  = Doctrine::getTable('Expert')->getList();
		//学员分享
		$this->shares  = Doctrine::getTable('Share')->getList(4);
		//已回答专家答疑
		$this->finish_questions  = Doctrine::getTable('Question')->getFinishedList(3);
		//文档数量
		$this->file_num = Doctrine::getTable('File')->getNum();
		//课件
		$this->kejians = Doctrine::getTable('File')->getList(4,1);
		//视频
		$this->shipins = Doctrine::getTable('File')->getList(4,2);
		//图书
		$this->tushus = Doctrine::getTable('File')->getList(4,3);
		//首页头部广告图片
		$this->top_banner = Doctrine::getTable('Advertising')->getList(1,1);
		//首页中部广告图片
		$this->center_banner = Doctrine::getTable('Advertising')->getList(1,2);
		
		$this->setLayout('layouti');
 	}
	public function executeNmore(sfWebRequest $request) {
		//网站公告
		$page = $request->getParameter('page',1);
    	$this->pager = Doctrine_Core::getTable('Notice')->getPager($page);
	}	
	public function executeNshow(sfWebRequest $request) {
		//网站公告
		$this->forward404Unless ( $this->content = Doctrine::getTable('Notice')->findOneByToken($request->getParameter('token')));
	}	
	public function executeShow(sfWebRequest $request) {
		//轮播图片介绍
		$type = $request->getParameter('type','Images');
		if($type == 'Images'){
			$this->name = '轮播图片';
		}
		elseif($type == 'Topic'){
			$this->name = '精彩推荐';
		}
		elseif($type == 'SuccessCase'){
			$this->name = '成功案例';
		}
		elseif($type == 'Advertising'){
			$this->name = '广告图片';
		}
		else{
			$this->name = '';
		}
		$this->forward404Unless ( $this->content = Doctrine::getTable($type)->find($request->getParameter('id')));
	}
	public function executeVmore(sfWebRequest $request) {
		//视频课程
		$page = $request->getParameter('page',1);
		$this->pager = Doctrine_Core::getTable('Video')->getPager($page);
	}
	public function executeVideoShow(sfWebRequest $request) {
		//视频播放
		$this->forward404Unless ( $this->content = Doctrine::getTable('Video')->findOneByToken($request->getParameter('token')));
	}
	public function executeWorkVideoShow(sfWebRequest $request) {
		//作业视频播放
		$this->forward404Unless ( $this->content = Doctrine::getTable('Work')->findOneByToken($request->getParameter('token')));
	}
	public function executeWmore(sfWebRequest $request) {
		//作业
		$page = $request->getParameter('page',1);
		$this->pager = Doctrine_Core::getTable('Work')->getPager($page);
	}
	public function executeAjaxAddQuestion(sfWebRequest $request) {
		//提交专家答疑
		if(!$this->getUser()->getGuardUser()){
			echo 2;exit;
		}else{
			$title = $request->getParameter('title');
			$content = $request->getParameter('text');
			$expert_id = $request->getParameter('expert');
			
			$question = new Question();
			$question->title = $title;
			$question->content = $content;
			$question->expert_id = $expert_id;
			$question->user_id = $this->getUser()->getGuardUser()->getId();
			$question->save();
			echo 1;exit;
		}
	}
	public function executeSmore(sfWebRequest $request) {
		//分享轮播图片
		$this->images  = Doctrine::getTable('Images')->getList(10,2);
		//学员分享
		$page = $request->getParameter('page',1);
		$this->pager = Doctrine_Core::getTable('Share')->getPager($page,'rank');
	}
	public function executeShareshow(sfWebRequest $request) {
		//学员分享
		$this->forward404Unless ( $this->content = Doctrine::getTable('Share')->findOneByToken($request->getParameter('token')));
	}
	public function executeQmore(sfWebRequest $request) {
		//已回答专家答疑
		$this->finish_questions  = Doctrine::getTable('Question')->getFinishedList(5);
		//未回答专家答疑
		$this->ufinish_questions  = Doctrine::getTable('Question')->getUFinishedList(5);
		//专家
		$this->experts = Doctrine::getTable('Expert')->getListAll();
	}
	public function executeQlist(sfWebRequest $request) {
		$this->type = $request->getParameter('type');
		$page = $request->getParameter('page',1);
		$this->pager = Doctrine_Core::getTable('Question')->getPager($page,$this->type);
		//专家
		$this->experts = Doctrine::getTable('Expert')->getListAll();
	}
	public function executeQshow(sfWebRequest $request) {
		//专家答疑显示
		$this->forward404Unless ( $this->content = Doctrine::getTable('Question')->findOneByToken($request->getParameter('token')));
		//专家
		$this->experts = Doctrine::getTable('Expert')->getListAll();
	}
	public function executeEmore(sfWebRequest $request) {
		//领衔专家
		$this->top_experts = Doctrine::getTable('Expert')->getListTop(1);
		//专家队伍
		$page = $request->getParameter('page',1);
		$this->pager = Doctrine_Core::getTable('Expert')->getListNormal($page);
	}
	public function executeEshow(sfWebRequest $request) {
		//专家显示
		$this->forward404Unless ( $this->content = Doctrine::getTable('Expert')->findOneByToken($request->getParameter('token')));
	}
	public function executeIntroduce(sfWebRequest $request) {
		
	}
	public function executeApply(sfWebRequest $request) {
	
	}
	public function executeAjaxAddApply(sfWebRequest $request) {
		//提交集体报名信息
		if(!$this->getUser()->getGuardUser()){
			echo 2;exit;
		}else{
			$name = $request->getParameter('name');
			$person = $request->getParameter('person');
			$add = $request->getParameter('add');
			$tel = $request->getParameter('tel');
			$commed = $request->getParameter('commed');
			
			$apply = new Apply();
			$apply->company = $name;
			$apply->contacter = $person;
			$apply->address = $add;
			$apply->tel = $tel;
			$apply->content = $commed;
			$apply->save();
			
			echo 1;exit;
		}
	}
	public function executeGuide(sfWebRequest $request) {
	
	}
	public function executeDocument(sfWebRequest $request) {
		//终身学习分类
		$this->categories = Doctrine::getTable('Category')->findAll();
		//我的文档展示
		$page = $request->getParameter('page',1);
		$this->pager = Doctrine_Core::getTable('File')->getMyPager($page);
	}
	public function executeAshow(sfWebRequest $request) {
		//最新活动内容显示
		$this->forward404Unless ( $this->content = Doctrine::getTable('Activity')->findOneByToken($request->getParameter('token')));
	}
	public function executeAddNeed(sfWebRequest $request) {
		//未结束的需求
		$this->un_finish_nees = Doctrine::getTable('Need')->getUnFinishedList(20); 
	}
	public function executeAjaxAddNeed(sfWebRequest $request) {
		//提交需求
		if(!$this->getUser()->getGuardUser()){
			echo 2;exit;
		}else{
			$title = $request->getParameter('title');
			$content = $request->getParameter('text');
			$price = $request->getParameter('price');
			
			$user = $this->getUser()->getGuardUser();
			//判断当前用户积分是否足够此次悬赏的金额，如果不足，则提示不能添加
			if($user->getExperience() < $price){
				echo 3;exit;
			}
			
			$need = new Need();
			$need->title = $title;
			$need->description = $content;
			if($price != ''){
				$need->price = $price;
			}
			$need->user_id = $user->getId();
			$need->save();
			
			//给需求提出人减去对应的积分
			$user->experience = $user->getExperience()-$price;
			$user->save();
			
			echo 1;exit;
		}
	}
	public function executeNeedShow(sfWebRequest $request) {
		$page = $request->getParameter('page',1);
		$this->pager = Doctrine_Core::getTable('Need')->getMyAnswerPager($page);
		//未回答的需求内容页
		$this->token = $request->getParameter('token');
		$this->forward404Unless ( $this->content = Doctrine::getTable('Need')->findOneByToken($this->token));
	}
	public function executeAjaxAddNeedAns(sfWebRequest $request) {
		//回答需求
		if(!$this->getUser()->getGuardUser()){
			echo 2;exit;
		}else{
			$content = $request->getParameter('content');
			$attachment = $request->getParameter('attachment');
			$attachment_name = $request->getParameter('attachment_name');
			$need_id = $request->getParameter('need_id');
			//判断此需求是否已经结束（即设置了最佳答案）
			$need = Doctrine::getTable('Need')->find($need_id);
			if($need->getIsFinish() == 1){
				echo 3;exit;
			}
			$ans = new Ans();
			$ans->content = $content;
			$ans->attachment = $attachment;
			$ans->attachment_name = $attachment_name;
			$ans->need_id = $need_id;
			$ans->user_id = $this->getUser()->getGuardUser()->getId();
			$ans->save();
			
			echo 1;exit;
		}
	}
	public function executeStudy(sfWebRequest $request) {
		//课件
		$this->courseware = Doctrine::getTable('File')->getTypeFiles(1,12);
		//视频
		$this->video = Doctrine::getTable('File')->getTypeFiles(2,12);
		//图书
		$this->book = Doctrine::getTable('File')->getTypeFiles(3,12);
		//内页底部广告图片
		$this->bottom_banner = Doctrine::getTable('Advertising')->getList(1,4);
	}
	public function executeStudyHelp(sfWebRequest $request) {
	
	}
	public function executeFshow(sfWebRequest $request) {
		//文件资料内容页
		$this->forward404Unless ( $this->content = Doctrine::getTable('File')->findOneByToken($request->getParameter('token')));
		//添加阅读次数
		$this->content->read_num = $this->content->getReadNum()+1;
		$this->content->save();
	}
	public function executeAjaxAddDocument(sfWebRequest $request) {
		//提交文件
		if(!$this->getUser()->getGuardUser()){
			echo 2;exit;
		}else{
			$title = $request->getParameter('title');
			$content = $request->getParameter('content');
			$keywords = $request->getParameter('keywords');
			$price = $request->getParameter('price');
			$is_security = $request->getParameter('is_security');
			$attachment = $request->getParameter('attachment');
			$attachment_name = $request->getParameter('attachment_name');
			$category_id = $request->getParameter('category_id');
	
			$file = new File();
			$file->title = $title;
			$file->sub_description = $content;
			$file->keywords = $keywords;
			$file->price = $price;
			$file->is_security = $is_security;
			$file->attachment = $attachment;
			$file->attachment_name = $attachment_name;
			$file->category_id = $category_id;
			$file->user_id = $this->getUser()->getGuardUser()->getId();
			$file->save();
				
			echo 1;exit;
		}
	}
	public function executeDownload(sfWebRequest $request) {
		//下载文件
		if(!$this->getUser()->getGuardUser()){
			echo 2;exit;
		}else{
			$user = $this->getUser()->getGuardUser();
			$file_token = $request->getParameter('file_token');
			$file = Doctrine::getTable('File')->findOneByToken($file_token);
			//首先判断目标文件夹中是否存在此对应的文档
			if (!file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/attachment/'.$file->getAttachment())) {
				echo 4;exit;
			}
			
			//判断是否为免费文档
			//或者判断当前用户是否有此文档的下载记录，满足一个则允许下载
			$record = Doctrine::getTable('DownloadRecords')->getResult($file->getId(),$user->getId());
			if($file->getPrice() == 0 || $record == 1){
				echo 1;exit;
			}else{
				//判断当前用户积分是否足够
				if($user->getExperience() < $file->getPrice()){
					echo 3;exit;
				}
				else{
					$user->experience = $user->getExperience()-$file->getPrice();
					$user->save();
					//保存下载记录
					$record = new DownloadRecords();
					$record->file_id = $file->getId();
					$record->user_id = $user->getId();
					$record->price = $file->getPrice();
					$record->save();
					echo 1;exit;
				}
			}
		}
	}
	public function executeStudySearch(sfWebRequest $request) {
		$page = $request->getParameter('page',1);
		$this->keywords=$request->getParameter('keywords');
		$_array = array();
		$_array['keywords'] = $this->keywords;
		$this->pager = Doctrine_Core::getTable('File')->getPager($page, $_array);
	}
	public function executeFmore(sfWebRequest $request) {
		//
		$page = $request->getParameter('page',1);
		$this->category_id = $request->getParameter('token');
		//获取分类名
		$this->name = Doctrine::getTable('Category')->find($this->category_id);
		$_array = array();
		$_array['category_id'] = $this->category_id;
		$this->pager = Doctrine_Core::getTable('File')->getPager($page, $_array);
	}
	public function executeFrecomm(sfWebRequest $request) {
		//
		$page = $request->getParameter('page',1);
		$this->category_id = $request->getParameter('token',1);
		$_array = array();
		$_array['category_id'] = $this->category_id;
		$_array['is_rank'] = 1;
		$this->pager = Doctrine_Core::getTable('File')->getPager($page, $_array);
	}
	
	
	
	
	
// 	public function executeShowContent(sfWebRequest $request) {
		
// 		if ($request->hasParameter ( 'video_id' )) {
// 			$this->video = Doctrine::getTable ( 'UploadVideo' )->find ( $request->getParameter ( 'video_id' ) );
// 			$this->content = $this->video->Contents[0];
// 		}else{
// 			$token = $request->getParameter ( 'token' );
// 			$this->content = Doctrine::getTable ( 'Content' )->findOneBy ( 'token', $token );
// 		}
// 		$this->forward404Unless ( $this->content );
		
// 		//记录看过本文的人还看过的文章id，只保留5条
// 		$this->addRelateArticles( $this->content->getId() );
		
// 		if($this->content->getLinkUrl()){
// 			return $this->redirect($this->content->getLinkUrl());
// 		}
		
// 		//文章关键词
// 		$this->keywords = explode(',', $this->content->getKeyword());
// 		//猜你喜欢 关键词存cookie
// 		if($request->getCookie('keywords'))
// 		{
// 			$cookie_keywords = $request->getCookie('keywords');
// 			if($this->content->getKeyword()!='')
// 			{
// 				$str = $cookie_keywords.'#'.str_replace(',','#',$this->content->getKeyword());
// 			}
// 			else{
// 				$str = $cookie_keywords;
// 			}
			
// 			//取数据
// 			$this->arr = array_unique(explode('#', $str));
// 			$this->getResponse()->setCookie('keywords', $str,time()+3600*24*7);
			
// 			$this->arr_str = $str;
// 			//$this->read = Doctrine::getTable('Content')->findRead($arr,$this->content->getCategoryId(),$this->content->getId());
// 			//print_r($this->read->toArray());exit;
// 		}
// 		else{
// 			$this->arr_str = str_replace(',','#',$this->content->getKeyword());
// 			$this->getResponse()->setCookie('keywords', $this->arr_str,time()+3600*24*7);
			
// 			//取当前文章关键词相关的5篇
// 			//$this->read = Doctrine::getTable('Content')->findRead($this->keywords,$this->content->getCategoryId(),$this->content->getId());
// 		}
		
// 		$this->category = $this->content->Category;
// 		$parent = $this->category->getNode ()->getParent ();
// 		$this->parentRoute = $this->getParentRoute ( $parent );
		
// 		$this->content->browseProcess ();
// 		$this->type = $this->getStyleType ( $this->category );
		
// 		$page = $request->getParameter ( 'page', 1 );
// 		$params ['content_id'] = $this->content->getId ();
// 		$this->pager = Doctrine::getTable ( 'Comment' )->getListPager ( $page, $params );
		
// 		$this->routeName = 'comment_list';
// 		if ($request->hasParameter ( 'video_id' )) {
// 			$this->routeParams = '##video_id=' . $request->getParameter ( 'video_id' );
// 		}else{
// 			$this->routeParams = '##token=' . $token;
// 		}
		
// 		$content_type = $request->getParameter ( 'model', 'article' );
		
// 		switch ($content_type) {
// 			case 'article' :
				
// 				$this->setTemplate ( 'articleDetail' );
// 				break;
// 			case 'video' :
// 				if ($request->hasParameter ( 'video_id' )) {
// 					$this->video = Doctrine::getTable ( 'UploadVideo' )->find ( $request->getParameter ( 'video_id' ) );
// 				}
// 				 else {
// 					$this->video = Doctrine::getTable ( 'UploadVideo' )->createQuery('t')
// 						->select('t.*,c.id,c.token,c.title')
// 						->leftJoin('t.Contents c')
// 						->where('c.id = ?',$this->content->getId ())
// 						->limit(1)
// 						->fetchOne();
// 				}
// 				if (! $this->video)
// 					$this->getUser ()->setAttribute ( 'nxetd_message_404', '抱歉，该视频不存在' );
// 				$this->forward404Unless ( $this->video );
// 				$this->video->setViewNum ( $this->video->getViewNum () + 1 );
// 				$this->video->save ();
// 				$params2 ['category_id'] = $this->category->getId ();
// 				$this->videoList = Doctrine::getTable ( 'UploadVideo' )->getListPager ( 1, $params2 );
// 				$list = Doctrine::getTable ( 'UploadVideo' )->getListQuery ( $params2 )->execute ();
// 				$this->playerCount = 0;
// 				foreach ( $list as $item ) {
// 					$this->playerCount += $item->getViewNum ();
// 				}
				
// 				$this->setTemplate ( 'videoDetail' );
// 				break;
// 			default :
// 				$this->setTemplate ( 'articleDetail' );
// 				break;
// 		}
	
	
	//猜你喜欢ajax
	public function executeAjaxCainixihuan(sfWebRequest $request) {
		$content_id = $request->getParameter ( 'content_id' );
		$category_id = $request->getParameter ( 'category_id' );
		$str = $request->getParameter ( 'keywords' );
		$arr = array_unique(explode('#', $str));
		$this->read = Doctrine::getTable('Content')->findRead($arr,$category_id,$content_id);
		
		return $this->renderPartial ( 'home/cainixihuan', array (
				'read' => $this->read
		) );
		exit ();
	}
	//看过的人还看过ajax
	public function executeAjaxReaded(sfWebRequest $request) {
		$content_id = $request->getParameter ( 'content_id' );
		$category_id = $request->getParameter ( 'category_id' );
		$some_ids = Doctrine::getTable('RelatedArticles')->createQuery('c')->select('c.id2')->where('id1 = ?',$content_id)->fetchArray();
		$arids = array();
		foreach($some_ids as $v){
			$arids[] = $v['id2'];
		}
		$this->somebody_reads = Doctrine::getTable('Content')->comes($arids,$category_id,$content_id);
		
		return $this->renderPartial ( 'home/readed', array (
				'somebody_reads' => $this->somebody_reads
		));
		exit ();
	}
	//扩展阅读ajax
	public function executeAjaxKuozhanyuedu(sfWebRequest $request) {
		$content_id = $request->getParameter ( 'content_id' );
		$this->content = Doctrine::getTable('Content')->find($content_id);
		return $this->renderComponent ( 'home', 'kuozhanyuedu', array (
				'content'=>$this->content
		));
		exit ();
	}
	
	
	public function executeAjaxVidePager(sfWebRequest $request) {
		$params2 ['category_id'] = $request->getParameter ( 'category_id' );
		$page = $request->getParameter ( 'page', 1 );
		$this->videoList = Doctrine::getTable ( 'UploadVideo' )->getListPager ( $page, $params2 );
		$this->video = Doctrine::getTable ( 'UploadVideo' )->find ( $request->getParameter ( 'id' ) );
		
		return $this->renderPartial ( 'home/videoPage', array (
				'videoList' => $this->videoList,
				'video' => $this->video,
				'category_id' => $params2 ['category_id'] 
		) );
		exit ();
	
	}
	public function executeAjaxShowVideo(sfWebRequest $request) {
		$video = Doctrine::getTable ( 'UploadVideo' )->find ( $request->getParameter ( 'id' ) );
		$video->setViewNum ( $video->getViewNum () + 1 );
		$video->save ();
		return $this->renderPartial ( 'home/videoPlayer', array (
				'video' => $video 
		) );
		exit ();
	}
	
	private function getStyleType(Category $category) {
		if($category->getToken() == myConstant::NV_XING_JIANG_TANG)
			return 'nxjt';
		if($category->getId() == 74)
			return 'shetuan';
		$parent = $category->getNode ()->getParent ();
		if($parent)
			$parent2 = $parent->getNode ()->getParent ();
		else 
			$parent2 = null;
		
		if ($parent->getToken () == myConstant::ZI_XUN_PIN_DAO || $parent->getToken () == myConstant::YI_SHI_PIN_DAO || ($parent2 && $parent2->getToken () == myConstant::ZI_XUN_PIN_DAO) || ($parent2 && $parent2->getToken () == myConstant::YI_SHI_PIN_DAO)) {
			return 'fngz';
		} else if ($parent->getToken () == myConstant::NV_XING_SHE_TUAN || $parent->getToken () == myConstant::JIN_GUO_ZHI_YUAN || ($parent2 && $parent2->getToken () == myConstant::NV_XING_SHE_TUAN) || ($parent2 && $parent2->getToken () == myConstant::JIN_GUO_ZHI_YUAN)) {
			return 'shetuan';
		} else if ($parent->getToken () == myConstant::GUI_HUA_ZHI_CHUANG || ($parent2 && $parent2->getToken () == myConstant::GUI_HUA_ZHI_CHUANG)) {
			return 'ghzc';
		} else if ($parent->getToken () == myConstant::WEI_QUAN_DA_TING || ($parent2 && $parent2->getToken () == myConstant::WEI_QUAN_DA_TING)) {
			return 'wqdt';
		} else if ($parent->getToken () == myConstant::NV_XING_JIANG_TANG || ($parent2 && $parent2->getToken () == myConstant::NV_XING_JIANG_TANG)) {
			return 'nxjt';
		} else {
			return 'luntan';
		}
	
	}
	
	public function executeTiJiaoDiaoCha(sfWebRequest $request) {
		$myuser = $this->getUser ();
		
		
		if($myuser->isAuthenticated ())
			$user_id = $myuser->getGuardUser ()->getId ();
		else 
			$user_id = null;
		$question_id = $request->getParameter ( 'question_id' );
		$arrChk = $request->getParameter ( 'arrChk' );
		$answers_id = substr ( $arrChk, 0, - 1 );
		$result = Doctrine::getTable ( 'QuestionAnswerResults' )->findResults ( $user_id, $question_id );
		if (count ( $result ) > 0) {
			echo "您已经投过票，不要重复投票！";
		} else {
			$answers = new QuestionAnswerResults ();
			$answers->user_id = $user_id;
			$answers->question_id = $question_id;
			$answers->answer_id = $answers_id;
			$answers->save ();
			echo "投票成功，感谢您的参与！";
		}
		
		exit ();
	}
	
	// 得到调查结果
	public function executeViewResults(sfWebRequest $request) {
		
		$question_id = $request->getParameter ( 'question_id' );
		$question = Doctrine::getTable ( 'Questions' )->find ( $question_id );
		$category_name = '问卷调查';
		$question_title = $question->getTitle ();
		$results = Doctrine::getTable ( 'QuestionAnswerResults' )->findByQuestionId ( $question_id );
		$arr = array ();
		foreach ( $results as $value ) {
			foreach ( explode ( ',', $value->getAnswerId () ) as $v ) {
				if ($v != '') {
					$arr [] = $v;
				}
			}
		}
		
		$views = array_count_values ( $arr );
		$result = array ();
		$vote_count = 0;
		
		foreach ( $views as $key => $value ) {
			$answer = Doctrine::getTable ( 'Answers' )->find ( $key );
			if($answer){
				$vote_count += $value;
			
				$result [$answer->getTitle ()] = $value;
			}
		}
		
		$html = <<<EEE
<div class="title"><span>$category_name</span></div>
<p>$question_title</p>
<ul>
EEE;
		foreach ( $result as $key => $value ) {
			$x = $value / $vote_count * 100;
			$html .= <<<EEE
	<li>$key</li>
			<li>
				<div class="bar">
					<div class="water" style="width:$x%"></div>
				</div>
				<b>$value</b>
	</li>  		
EEE;
		}
		$html .= <<<EEE
	<li>
		<h3>感谢您的参与!</h3>
		<input class="close" type="button" />
	</li>				
</ul>
<script>
$(function(){
	$('.survey input.close').click(function(){
											
		$(this).parents('.survey').fadeOut();			
		$('.winMark').fadeOut().remove();
											
	})
})
</script>
EEE;
		echo $html;
		exit ();
	}
	public function executeError404(sfWebRequest $request) {
	
	}

	
	private function array_to_json( $array ){

    if( !is_array( $array ) ){
        return false;
    }

    $associative = count( array_diff( array_keys($array), array_keys( array_keys( $array )) ));
    if( $associative ){

        $construct = array();
        foreach( $array as $key => $value ){

            // We first copy each key/value pair into a staging array,
            // formatting each key and value properly as we go.

            // Format the key:
            if( is_numeric($key) ){
                $key = "key_$key";
            }
            $key = "\"".addslashes($key)."\"";

            // Format the value:
            if( is_array( $value )){
                $value = $this->array_to_json( $value );
            } else if( !is_numeric( $value ) || is_string( $value ) ){
                $value = "\"".addslashes($value)."\"";
            }

            // Add to staging array:
            $construct[] = "$key: $value";
        }

        // Then we collapse the staging array into the JSON form:
        $result = "{ " . implode( ", ", $construct ) . " }";

    } else { // If the array is a vector (not associative):

        $construct = array();
        foreach( $array as $value ){

            // Format the value:
            if( is_array( $value )){
                $value = $this->array_to_json( $value );
            } else if( !is_numeric( $value ) || is_string( $value ) ){
                $value = "'".addslashes($value)."'";
            }

            // Add to staging array:
            $construct[] = $value;
        }

        // Then we collapse the staging array into the JSON form:
        $result = "[ " . implode( ", ", $construct ) . " ]";
    }

    return $result;
}
}
