<?php

/**
 * work actions.
 *
 * @package    bzr
 * @subpackage work
 * @author     gefei
 * @version    SVN: $Id: actions.class.php,v 1.1 2012/05/04 06:47:45 zhaoy Exp $
 */
class workActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
  	$search_params = array();
  	$page = 1;
  	$this->searchRoute = '';
  	if($request->hasParameter('search_title'))
  	{
  		$search_params['title'] = $request->getParameter('search_title');
  		$this->searchRoute .= 'search_username='.$search_params['title'];
  	}
  	if($request->hasParameter('search_username'))
  	{
  		$search_params['username'] = $request->getParameter('search_username');
  		$this->searchRoute .= 'search_username='.$search_params['username'];
  	}
  	if($request->hasParameter('page'))
  	{
  		$page = $request->getParameter('page');
  	}
    $this->pager = Doctrine_Core::getTable('Work')->getListPager($search_params, $page);
  }

  public function executeMywork(sfWebRequest $request)
  {
  	$page = $request->getParameter('page',1);	
  	$this->pager = Doctrine_Core::getTable('Work')->getMyPager($page);
  }
  
  public function executeNew(sfWebRequest $request)
  {
  	$classes_id = $request->getParameter('classes_id');
    $this->form = new WorkForm();
    $this->form->setDefault('classes_id', $classes_id);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new WorkForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($work = Doctrine_Core::getTable('Work')->find(array($request->getParameter('id'))), sprintf('Object work does not exist (%s).', $request->getParameter('id')));
    $this->form = new WorkForm($work);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($work = Doctrine_Core::getTable('Work')->find(array($request->getParameter('id'))), sprintf('Object work does not exist (%s).', $request->getParameter('id')));
    $this->form = new WorkForm($work);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($work = Doctrine_Core::getTable('Work')->find(array($request->getParameter('id'))), sprintf('Object work does not exist (%s).', $request->getParameter('id')));
    $work->delete();

    $this->redirect('work/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $work = $form->save();
      $work->user_id = $this->getUser()->getGuardUser()->getId();
      $work->save();
      
      $this->redirect('work/edit?id='.$work->getId());
    }
  }
}
