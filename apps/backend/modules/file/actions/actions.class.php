<?php

/**
 * file actions.
 *
 * @package    bzr
 * @subpackage file
 * @author     gefei
 * @version    SVN: $Id: actions.class.php,v 1.1 2012/05/04 06:47:45 zhaoy Exp $
 */
class fileActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $page = $request->getParameter('page',1);
  	$this->pager = Doctrine_Core::getTable('File')->getPager($page);
  }
  public function executeMyFile(sfWebRequest $request)
  {
  	$page = $request->getParameter('page',1);
  	$this->pager = Doctrine_Core::getTable('File')->getMyPager($page);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new FileForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new FileForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($file = Doctrine_Core::getTable('File')->find(array($request->getParameter('id'))), sprintf('Object file does not exist (%s).', $request->getParameter('id')));
    $this->form = new FileForm($file);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($file = Doctrine_Core::getTable('File')->find(array($request->getParameter('id'))), sprintf('Object file does not exist (%s).', $request->getParameter('id')));
    $this->form = new FileForm($file);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($file = Doctrine_Core::getTable('File')->find(array($request->getParameter('id'))), sprintf('Object file does not exist (%s).', $request->getParameter('id')));
    $file->delete();

    $this->redirect('file/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $file = $form->save();
      //添加上作者
	  if($file->getUserId()==''){
	  	$file->user_id = $this->getUser()->getGuardUser()->getId();
	  	$file->save();
	  }
	  $this->getUser()->setFlash('notice', '保存成功。');
      $this->redirect('file/edit?id='.$file->getId());
    }
  }
  //推荐
  public function executeRank(sfWebRequest $request)
  {
  	$this->forward404Unless($file = Doctrine_Core::getTable('File')->find(array($request->getParameter('id'))), sprintf('Object share does not exist (%s).', $request->getParameter('id')));
  	 
  	$file->is_rank = 1;
  	$file->save();
  	 
  	$this->getUser()->setFlash('notice', '推荐成功。');
  	$this->redirect($request->getReferer());
  }
  //取消推荐
  public function executeUnRank(sfWebRequest $request)
  {
  	$this->forward404Unless($file = Doctrine_Core::getTable('File')->find(array($request->getParameter('id'))), sprintf('Object share does not exist (%s).', $request->getParameter('id')));
  
  	$file->is_rank = 0;
  	$file->save();
  
  	$this->getUser()->setFlash('notice', '取消推荐成功。');
  	$this->redirect($request->getReferer());
  }
}
