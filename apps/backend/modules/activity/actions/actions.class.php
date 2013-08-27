<?php

/**
 * activity actions.
 *
 * @package    bzr
 * @subpackage activity
 * @author     gefei
 * @version    SVN: $Id: actions.class.php,v 1.1 2012/05/04 06:47:45 zhaoy Exp $
 */
class activityActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $page = $request->getParameter('page',1);
    $this->pager = Doctrine_Core::getTable('Activity')->getPager($page);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ActivityForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ActivityForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($activity = Doctrine_Core::getTable('Activity')->find(array($request->getParameter('id'))), sprintf('Object activity does not exist (%s).', $request->getParameter('id')));
    $this->form = new ActivityForm($activity);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($activity = Doctrine_Core::getTable('Activity')->find(array($request->getParameter('id'))), sprintf('Object activity does not exist (%s).', $request->getParameter('id')));
    $this->form = new ActivityForm($activity);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($activity = Doctrine_Core::getTable('Activity')->find(array($request->getParameter('id'))), sprintf('Object activity does not exist (%s).', $request->getParameter('id')));
    $activity->delete();

    $this->redirect('activity/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $activity = $form->save();
      $this->getUser()->setFlash('notice', '保存成功。');
      $this->redirect('activity/edit?id='.$activity->getId());
    }
  }
}
