<?php

/**
 * need actions.
 *
 * @package    bzr
 * @subpackage need
 * @author     gefei
 * @version    SVN: $Id: actions.class.php,v 1.1 2012/05/04 06:47:45 zhaoy Exp $
 */
class needActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $page = $request->getParameter('page',1);
  	$this->pager = Doctrine_Core::getTable('Need')->getPager($page);
  }
  public function executeMyAdd(sfWebRequest $request)
  {
  	$page = $request->getParameter('page',1);
  	$this->pager = Doctrine_Core::getTable('Need')->getMyAddPager($page);
  }
  public function executeMyAnswer(sfWebRequest $request)
  {
  	$page = $request->getParameter('page',1);
  	$this->pager = Doctrine_Core::getTable('Need')->getMyAnswerPager($page);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new NeedForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new NeedForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($need = Doctrine_Core::getTable('Need')->find(array($request->getParameter('id'))), sprintf('Object need does not exist (%s).', $request->getParameter('id')));
    $this->form = new NeedForm($need);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($need = Doctrine_Core::getTable('Need')->find(array($request->getParameter('id'))), sprintf('Object need does not exist (%s).', $request->getParameter('id')));
    $this->form = new NeedForm($need);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($need = Doctrine_Core::getTable('Need')->find(array($request->getParameter('id'))), sprintf('Object need does not exist (%s).', $request->getParameter('id')));
    $need->delete();

    $this->redirect('need/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $need = $form->save();
      //添加上作者
      if($need->getUserId()==''){
      	$need->user_id = $this->getUser()->getGuardUser()->getId();
      	$need->save();
      }
      
      $this->getUser()->setFlash('notice', '保存成功。');
      $this->redirect('need/edit?id='.$need->getId());
    }
  }
}
