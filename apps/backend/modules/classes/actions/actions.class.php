<?php

/**
 * topic actions.
 *
 * @package    bzr
 * @subpackage topic
 * @author     gefei
 * @version    SVN: $Id: actions.class.php,v 1.1 2012/05/04 06:47:45 zhaoy Exp $
 */
class classesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $page = $request->getParameter('page',1);
    $this->pager = Doctrine_Core::getTable('Classes')->getPager($page);
  }

  public function executeNew(sfWebRequest $request)
  {
  	var_dump(1);
    $this->form = new ClassesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ClassesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($classes= Doctrine_Core::getTable('Classes')->find(array($request->getParameter('id'))), sprintf('Object classes does not exist (%s).', $request->getParameter('id')));
    $this->form = new ClassesForm($classes);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($classes = Doctrine_Core::getTable('Classes')->find(array($request->getParameter('id'))), sprintf('Object classes does not exist (%s).', $request->getParameter('id')));
    $this->form = new ClassesForm($classes);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {

    $request->checkCSRFProtection();

    $this->forward404Unless($classes = Doctrine_Core::getTable('Classes')->find(array($request->getParameter('id'))), sprintf('Object classes does not exist (%s).', $request->getParameter('id')));
    $classes->delete();

    $this->redirect('classes/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $classes = $form->save();
      $classes->user_id = $this->getUser()->getGuardUser()->getId();
      $classes->save();

      $this->redirect('classes/edit?id='.$classes->getId());
    }
  }
}
