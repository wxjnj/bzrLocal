<?php

/**
 * video actions.
 *
 * @package    bzr
 * @subpackage video
 * @author     gefei
 * @version    SVN: $Id: actions.class.php,v 1.1 2012/05/04 06:47:45 zhaoy Exp $
 */
class videoActions extends sfActions
{
  public function executeIndex(sfWebRequest $request) {
		$page = $request->getParameter('page',1);
		$params ['is_title'] = 1;
		$this->pager = Doctrine::getTable('Video')->getListPager($page,$params,10);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new VideoForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new VideoForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($video = Doctrine_Core::getTable('Video')->find(array($request->getParameter('id'))), sprintf('Object video does not exist (%s).', $request->getParameter('id')));
    $this->form = new VideoForm($video);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($video = Doctrine_Core::getTable('Video')->find(array($request->getParameter('id'))), sprintf('Object video does not exist (%s).', $request->getParameter('id')));
    $this->form = new VideoForm($video);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($video = Doctrine_Core::getTable('Video')->find(array($request->getParameter('id'))), sprintf('Object video does not exist (%s).', $request->getParameter('id')));
    $video->delete();

    $this->redirect('video/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $video = $form->save();
      
      //视频截图
      $input_file = '/uploads/video/'.$video->getUrl();
      $output_file = '/uploads/ffmpeg/'.$video->getId().'.jpg';
      $start_time = 12;
      FfmpegManager::PrtSc(sfConfig::get('sf_web_dir').$input_file,sfConfig::get('sf_web_dir').$output_file,$start_time);
      $video->thumbnailsPath = $output_file;
      $video->save();
      
      $this->redirect('video/edit?id='.$video->getId());
    }
  }
}
