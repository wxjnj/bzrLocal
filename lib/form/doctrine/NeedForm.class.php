<?php

/**
 * Need form.
 *
 * @package    bzr
 * @subpackage form
 * @author     gefei
 * @version    SVN: $Id: sfDoctrineFormTemplate.php,v 1.1 2012/05/04 06:47:29 zhaoy Exp $
 */
class NeedForm extends BaseNeedForm
{
  public function configure()
  {
  	$this->useFields(array(
  			'title',
  			'description',
  			'price'
  	));
  	$this->widgetSchema->setLabels(array(
  			'title'=>'标题',
  			'description'=>'详细内容',
  			'price'=>'悬赏分值'
  	));
  }
}
