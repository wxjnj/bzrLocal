<?php

/**
 * apply actions.
 *
 * @package    bzr
 * @subpackage apply
 * @author     gefei
 * @version    SVN: $Id: actions.class.php,v 1.1 2012/05/04 06:47:45 zhaoy Exp $
 */
class applyActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $page = $request->getParameter('page',1);
    $this->pager = Doctrine_Core::getTable('Apply')->getPager($page);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ApplyForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ApplyForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($apply = Doctrine_Core::getTable('Apply')->find(array($request->getParameter('id'))), sprintf('Object apply does not exist (%s).', $request->getParameter('id')));
    $this->form = new ApplyForm($apply);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($apply = Doctrine_Core::getTable('Apply')->find(array($request->getParameter('id'))), sprintf('Object apply does not exist (%s).', $request->getParameter('id')));
    $this->form = new ApplyForm($apply);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($apply = Doctrine_Core::getTable('Apply')->find(array($request->getParameter('id'))), sprintf('Object apply does not exist (%s).', $request->getParameter('id')));
    $apply->delete();

    $this->redirect('apply/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $apply = $form->save();
      $this->redirect('apply/edit?id='.$apply->getId());
    }
  }
}
