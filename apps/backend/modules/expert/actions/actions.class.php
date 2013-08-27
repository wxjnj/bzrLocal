<?php

/**
 * expert actions.
 *
 * @package    bzr
 * @subpackage expert
 * @author     gefei
 * @version    SVN: $Id: actions.class.php,v 1.1 2012/05/04 06:47:45 zhaoy Exp $
 */
class expertActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $page = $request->getParameter('page',1);
    $this->pager = Doctrine_Core::getTable('Expert')->getPager($page);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ExpertForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ExpertForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($expert = Doctrine_Core::getTable('Expert')->find(array($request->getParameter('id'))), sprintf('Object expert does not exist (%s).', $request->getParameter('id')));
    $this->form = new ExpertForm($expert);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($expert = Doctrine_Core::getTable('Expert')->find(array($request->getParameter('id'))), sprintf('Object expert does not exist (%s).', $request->getParameter('id')));
    $this->form = new ExpertForm($expert);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($expert = Doctrine_Core::getTable('Expert')->find(array($request->getParameter('id'))), sprintf('Object expert does not exist (%s).', $request->getParameter('id')));
    $expert->delete();

    $this->redirect('expert/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $expert = $form->save();

      $this->redirect('expert/edit?id='.$expert->getId());
    }
  }
}
