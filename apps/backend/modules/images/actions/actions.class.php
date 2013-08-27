<?php

/**
 * images actions.
 *
 * @package    bzr
 * @subpackage images
 * @author     gefei
 * @version    SVN: $Id: actions.class.php,v 1.1 2012/05/04 06:47:45 zhaoy Exp $
 */
class imagesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $page = $request->getParameter('page',1);
    $this->pager = Doctrine_Core::getTable('Images')->getPager($page);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ImagesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ImagesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($images = Doctrine_Core::getTable('Images')->find(array($request->getParameter('id'))), sprintf('Object images does not exist (%s).', $request->getParameter('id')));
    $this->form = new ImagesForm($images);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($images = Doctrine_Core::getTable('Images')->find(array($request->getParameter('id'))), sprintf('Object images does not exist (%s).', $request->getParameter('id')));
    $this->form = new ImagesForm($images);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($images = Doctrine_Core::getTable('Images')->find(array($request->getParameter('id'))), sprintf('Object images does not exist (%s).', $request->getParameter('id')));
    $images->delete();

    $this->redirect('images/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $images = $form->save();

      $this->redirect('images/edit?id='.$images->getId());
    }
  }
}
