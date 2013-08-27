<?php

/**
 * ans actions.
 *
 * @package    bzr
 * @subpackage ans
 * @author     gefei
 * @version    SVN: $Id: actions.class.php,v 1.1 2012/05/04 06:47:45 zhaoy Exp $
 */
class ansActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $page = $request->getParameter('page',1);
    $this->id = $request->getParameter('id');
    $this->forward404Unless($need = Doctrine_Core::getTable('Need')->find(array($request->getParameter('id'))), sprintf('Object ans does not exist (%s).', $request->getParameter('id')));
  	if($need->getUserId() != $this->getUser()->getGuardUser()->getId()){
  		$this->getUser()->setFlash('notice', '对不起，您没有查看此需求的权限！');
  		$this->redirect('@my_need_add?active=10');
  	}
    $this->pager = Doctrine_Core::getTable('Ans')->getPager($page,$this->id);
  }
  public function executeSettrue(sfWebRequest $request)
  {
  	$token = $request->getParameter('token');
  	$this->forward404Unless($ans = Doctrine_Core::getTable('Ans')->findOneByToken($token));
  	//判断需求是否已经关闭
  	if($ans->getNeed()->getIsFinish() == 1){
  		$this->getUser()->setFlash('notice', '此需求已经关闭！');
  		$this->redirect($request->getReferer());
  	}
  	//判断关联需求是否为当前操作用户
  	if($ans->getNeed()->getUserId() != $this->getUser()->getGuardUser()->getId()){
  		$this->getUser()->setFlash('notice', '您没有此操作权限！');
  		$this->redirect($request->getReferer());
  	}
  	//设置最佳答案
  	$ans->is_true = 1;
  	$ans->save();
  	//关闭需求
  	$ans->getNeed()->is_finish = 1;
  	$ans->getNeed()->save();
  	//给最佳答案的提供者添加对应的积分
  	$ans->getUser()->experience = $ans->getUser()->getExperience()+$ans->getNeed()->getPrice();
  	$ans->getUser()->save();
  	//给需求提出人减去对应的积分
  	$ans->getNeed()->getUser()->experience = $ans->getNeed()->getUser()->getExperience()-$ans->getNeed()->getPrice();
  	$ans->getNeed()->getUser()->save();
  	
  	$this->getUser()->setFlash('notice', '您已经设置最佳答案，此需求将关闭！');
  	$this->redirect($request->getReferer());
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new AnsForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new AnsForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($ans = Doctrine_Core::getTable('Ans')->find(array($request->getParameter('id'))), sprintf('Object ans does not exist (%s).', $request->getParameter('id')));
    $this->form = new AnsForm($ans);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($ans = Doctrine_Core::getTable('Ans')->find(array($request->getParameter('id'))), sprintf('Object ans does not exist (%s).', $request->getParameter('id')));
    $this->form = new AnsForm($ans);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($ans = Doctrine_Core::getTable('Ans')->find(array($request->getParameter('id'))), sprintf('Object ans does not exist (%s).', $request->getParameter('id')));
    $ans->delete();

    $this->redirect('ans/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $ans = $form->save();

      $this->redirect('ans/edit?id='.$ans->getId());
    }
  }
}
