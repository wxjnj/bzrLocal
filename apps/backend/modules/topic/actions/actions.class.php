<?php

/**
 * topic actions.
 *
 * @package    bzr
 * @subpackage topic
 * @author     gefei
 * @version    SVN: $Id: actions.class.php,v 1.1 2012/05/04 06:47:45 zhaoy Exp $
 */
class topicActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $page = $request->getParameter('page',1);
    $this->pager = Doctrine_Core::getTable('Topic')->getPager($page);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new TopicForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TopicForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($topic = Doctrine_Core::getTable('Topic')->find(array($request->getParameter('id'))), sprintf('Object topic does not exist (%s).', $request->getParameter('id')));
    $this->form = new TopicForm($topic);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($topic = Doctrine_Core::getTable('Topic')->find(array($request->getParameter('id'))), sprintf('Object topic does not exist (%s).', $request->getParameter('id')));
    $this->form = new TopicForm($topic);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($topic = Doctrine_Core::getTable('Topic')->find(array($request->getParameter('id'))), sprintf('Object topic does not exist (%s).', $request->getParameter('id')));
    $topic->delete();

    $this->redirect('topic/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $topic = $form->save();

      $this->redirect('topic/edit?id='.$topic->getId());
    }
  }
}
