<?php

/**
 * Link form.
 *
 * @package    bzr
 * @subpackage form
 * @author     gefei
 * @version    SVN: $Id: sfDoctrineFormTemplate.php,v 1.1 2012/05/04 06:47:29 zhaoy Exp $
 */
class LinkForm extends BaseLinkForm
{
  public function configure()
  {
  	$this->useFields(array(
  			'title',
  			'url',
  			'weight'
  	));
  	
  	$this->widgetSchema->setLabels(array(
  			'title'=>'标题',
  			'url'=>'链接',
  			'weight'=>'排序（数字越大越靠前）'
  	));
  }
}
