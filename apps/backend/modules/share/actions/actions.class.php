<?php

/**
 * share actions.
 *
 * @package    bzr
 * @subpackage share
 * @author     gefei
 * @version    SVN: $Id: actions.class.php,v 1.1 2012/05/04 06:47:45 zhaoy Exp $
 */
class shareActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $page = $request->getParameter('page',1);
    $this->pager = Doctrine_Core::getTable('Share')->getPager($page);
  }
  public function executeMyshare(sfWebRequest $request)
  {
  	$page = $request->getParameter('page',1);
  	$this->pager = Doctrine_Core::getTable('Share')->getMyPager($page);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ShareForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ShareForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($share = Doctrine_Core::getTable('Share')->find(array($request->getParameter('id'))), sprintf('Object share does not exist (%s).', $request->getParameter('id')));
    //判断是否有权限进行编辑操作
    if($share->getIsRank() == 1 && !$this->getUser()->hasPermission('管理')){
    	$this->getUser()->setFlash('notice', '您的分享内容已经被管理员设置为推荐，不能再修改。');
    	$this->redirect($request->getReferer());
    }
    if($share->getUserId() != $this->getUser()->getGuardUser()->getId() && !$this->getUser()->hasPermission('管理')){
    	$this->getUser()->setFlash('notice', '您没有权限操作此分享内容。');
    	$this->redirect($request->getReferer());
    }
    $this->form = new ShareForm($share);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($share = Doctrine_Core::getTable('Share')->find(array($request->getParameter('id'))), sprintf('Object share does not exist (%s).', $request->getParameter('id')));
    $this->form = new ShareForm($share);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
	
    $this->forward404Unless($share = Doctrine_Core::getTable('Share')->find(array($request->getParameter('id'))), sprintf('Object share does not exist (%s).', $request->getParameter('id')));
    //判断是否有权限进行删除操作
    if($share->getUserId() != $this->getUser()->getGuardUser()->getId() && !$this->getUser()->hasPermission('管理')){
    	$this->getUser()->setFlash('notice', '您没有权限操作此分享内容。');
    	$this->redirect($request->getReferer());
    }
    
    $share->delete();

    $this->redirect('share/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $share = $form->save();
      //添加上作者
      if($share->getUserId()==''){
      	$share->user_id = $this->getUser()->getGuardUser()->getId();
      	$share->save();
      }
      $this->getUser()->setFlash('notice', '保存成功。');
      $this->redirect('share/edit?id='.$share->getId());
    }
  }
  //推荐
  public function executeRank(sfWebRequest $request)
  {
  	$this->forward404Unless($share = Doctrine_Core::getTable('Share')->find(array($request->getParameter('id'))), sprintf('Object share does not exist (%s).', $request->getParameter('id')));
  	
  	$share->is_rank = 1;
  	$share->save();
  	
  	$this->getUser()->setFlash('notice', '推荐成功。');
  	$this->redirect($request->getReferer());
  }
  //取消推荐
  public function executeUnRank(sfWebRequest $request)
  {
  	$this->forward404Unless($share = Doctrine_Core::getTable('Share')->find(array($request->getParameter('id'))), sprintf('Object share does not exist (%s).', $request->getParameter('id')));
  	 
  	$share->is_rank = 0;
  	$share->save();
  	 
  	$this->getUser()->setFlash('notice', '取消推荐成功。');
  	$this->redirect($request->getReferer());
  }
}
