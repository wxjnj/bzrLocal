<?php

/**
 * sfGuardChangeUserPasswordForm for changing a users password
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Jonathan H. Wage <jonwage@gmail.com>
 * @version    SVN: $Id: sfGuardChangeUserPasswordForm.class.php,v 1.2 2012/07/13 01:10:17 gef Exp $
 */
class sfGuardChangeUserPasswordForm extends BasesfGuardChangeUserPasswordForm
{
  /**
   * @see sfForm
   */
  public function configure()
  {
  	
  	parent::setup();

    $this->useFields(array('password'));

    $this->widgetSchema['password'] = new sfWidgetFormInputPassword();
    $this->validatorSchema['password']->setOption('required', true);
    $this->widgetSchema['password_again'] = new sfWidgetFormInputPassword();
    $this->validatorSchema['password_again'] = clone $this->validatorSchema['password'];
    $this->validatorSchema['password_again']->setOption('required', true);
  	$this->validatorSchema['password']->setMessage('required', '请输入密码');
  	$this->validatorSchema['password_again']->setMessage('required', '请输入密码');
  	$this->mergePostValidator(new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'password_again', array(), array('invalid' => '两次输入的密码不一致，请重新输入！.')));
  	$this->widgetSchema->setLabels ( array (
  			'password' => '密码',
  			'password_again' => '确认密码',
  	));
  }
}