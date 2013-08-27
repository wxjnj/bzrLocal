<?php

/**
 * job actions.
 *
 * @package    bzr
 * @subpackage job
 * @author     gefei
 * @version    SVN: $Id: actions.class.php,v 1.1 2012/05/04 06:47:45 zhaoy Exp $
 */
class jobActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $page = $request->getParameter('page',1);
    $this->token = $request->getParameter('token');
    $this->forward404Unless($work = Doctrine_Core::getTable('Work')->findOneByToken($this->token));
//   	if($need->getUserId() != $this->getUser()->getGuardUser()->getId()){
//   		$this->getUser()->setFlash('notice', '对不起，您没有查看此需求的权限！');
//   		$this->redirect('@my_need_add?active=10');
//   	}
    $this->pager = Doctrine_Core::getTable('Job')->getPager($page,$this->token);
  }
  
  public function executeMyjob(sfWebRequest $request)
  {
  	$page = $request->getParameter('page',1);
  	//$this->token = $request->getParameter('token');
  	//$this->forward404Unless($work = Doctrine_Core::getTable('Work')->findOneByToken($this->token));
  	//   	if($need->getUserId() != $this->getUser()->getGuardUser()->getId()){
  	//   		$this->getUser()->setFlash('notice', '对不起，您没有查看此需求的权限！');
  	//   		$this->redirect('@my_need_add?active=10');
  	//   	}
  	$this->pager = Doctrine_Core::getTable('Job')->getMyPager($page);
  }

  public function executeNew(sfWebRequest $request)
  {
  	$token = $request->getParameter('token');
  	$this->forward404Unless($this->work = Doctrine_Core::getTable('Work')->findOneByToken($token));

  	if(!$this->work->canAddJob()){
  		$this->getUser()->setFlash('notice', '您已经提交了完成了该作业或者此作业已经过期！。');
  		$this->redirect('@work');
  	}
  	
  	$this->form = new JobForm();
  	$this->form->setDefault('work_id', $this->work->getId());
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new JobForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($job = Doctrine_Core::getTable('Job')->find(array($request->getParameter('id'))), sprintf('Object job does not exist (%s).', $request->getParameter('id')));
    $this->form = new JobForm($job);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($job = Doctrine_Core::getTable('Job')->find(array($request->getParameter('id'))), sprintf('Object job does not exist (%s).', $request->getParameter('id')));
    $this->form = new JobForm($job);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($job = Doctrine_Core::getTable('Job')->find(array($request->getParameter('id'))), sprintf('Object job does not exist (%s).', $request->getParameter('id')));
    $job->delete();

    $this->redirect('job/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $job = $form->save();
      //添加上作者
      if($job->getUserId()==''){
      	$job->user_id = $this->getUser()->getGuardUser()->getId();
      	$job->save();
      }
      $this->getUser()->setFlash('notice', '提交作业成功。');
      $this->redirect('@work');
    }
  }
  public function executeView(sfWebRequest $request)
  {
  	$this->forward404Unless($this->job = Doctrine_Core::getTable('Job')->findOneByToken($request->getParameter('token')));
  }
}
