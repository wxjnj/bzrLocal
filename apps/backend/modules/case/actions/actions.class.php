<?php

/**
 * case actions.
 *
 * @package    bzr
 * @subpackage case
 * @author     gefei
 * @version    SVN: $Id: actions.class.php,v 1.1 2012/05/04 06:47:45 zhaoy Exp $
 */
class caseActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $page = $request->getParameter('page',1);
    $this->pager = Doctrine_Core::getTable('SuccessCase')->getPager($page);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new SuccessCaseForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new SuccessCaseForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($success_case = Doctrine_Core::getTable('SuccessCase')->find(array($request->getParameter('id'))), sprintf('Object success_case does not exist (%s).', $request->getParameter('id')));
    $this->form = new SuccessCaseForm($success_case);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($success_case = Doctrine_Core::getTable('SuccessCase')->find(array($request->getParameter('id'))), sprintf('Object success_case does not exist (%s).', $request->getParameter('id')));
    $this->form = new SuccessCaseForm($success_case);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($success_case = Doctrine_Core::getTable('SuccessCase')->find(array($request->getParameter('id'))), sprintf('Object success_case does not exist (%s).', $request->getParameter('id')));
    $success_case->delete();

    $this->redirect('case/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $success_case = $form->save();

      $this->redirect('case/edit?id='.$success_case->getId());
    }
  }
}
