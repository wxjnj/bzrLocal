<?php

/**
 * Classes form.
 *
 * @package    bzr
 * @subpackage form
 * @author     gefei
 * @version    SVN: $Id: sfDoctrineFormTemplate.php,v 1.1 2012/05/04 06:47:29 zhaoy Exp $
 */
class ClassesForm extends BaseClassesForm
{
  public function configure()
  {
  	$this->useFields ( array (
  			'name',
  			'description',
  			'student_list'
  	) );
  	$this->validatorSchema ['name'] = new sfValidatorString ( array (
  			'required' => true
  	), array (
  			'required' => '请填写名字'
  	) );
  	$this->widgetSchema->setLabels ( array (
  			'name' => '名字',
  			'description' => '简介',
  			'student_list'=> '学生列表'
  	) );
  	
  }
}
