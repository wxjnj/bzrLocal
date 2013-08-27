<?php

/**
 * advertising actions.
 *
 * @package    bzr
 * @subpackage advertising
 * @author     gefei
 * @version    SVN: $Id: actions.class.php,v 1.1 2012/05/04 06:47:45 zhaoy Exp $
 */
class advertisingActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $page = $request->getParameter('page',1);
    $this->pager = Doctrine_Core::getTable('advertising')->getPager($page);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new AdvertisingForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new AdvertisingForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($advertising = Doctrine_Core::getTable('Advertising')->find(array($request->getParameter('id'))), sprintf('Object advertising does not exist (%s).', $request->getParameter('id')));
    $this->form = new AdvertisingForm($advertising);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($advertising = Doctrine_Core::getTable('Advertising')->find(array($request->getParameter('id'))), sprintf('Object advertising does not exist (%s).', $request->getParameter('id')));
    $this->form = new AdvertisingForm($advertising);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($advertising = Doctrine_Core::getTable('Advertising')->find(array($request->getParameter('id'))), sprintf('Object advertising does not exist (%s).', $request->getParameter('id')));
    $advertising->delete();

    $this->redirect('advertising/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $advertising = $form->save();
      $this->getUser()->setFlash('notice', '保存成功。');

      $this->redirect('advertising/edit?id='.$advertising->getId());
    }
  }
}
