<?php

/**
 * Video form.
 *
 * @package    bzr
 * @subpackage form
 * @author     gefei
 * @version    SVN: $Id: sfDoctrineFormTemplate.php,v 1.1 2012/05/04 06:47:29 zhaoy Exp $
 */
class VideoForm extends BaseVideoForm
{
  public function configure()
  {
  	$this->useFields(array(
  			'title',
  			'experter',
  			'sub_description',
  			'url',
  			'url_name',
  			'attachment',
  			'attachment_name',
  			'weight'
  	));
  	$this->widgetSchema['url'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['url_name'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['attachment'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['attachment_name'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema->setLabels(array(
  			'title'=>'讲座名称',
  			'experter'=>'专家',
  			'sub_description'=>'简介',
  			'url'=>'上传视频',
  			'attachment'=>'上传课件',
  			'weight'=>'排序（数字越大越靠前）'
  	));
  }
}
