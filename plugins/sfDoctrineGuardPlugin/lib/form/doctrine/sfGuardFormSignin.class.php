<?php

/**
 * sfGuardFormSignin for sfGuardAuth signin action
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardFormSignin.class.php,v 1.7 2012/07/23 08:57:35 gef Exp $
 */
class sfGuardFormSignin extends BasesfGuardFormSignin {
	/**
	 *
	 * @see sfForm
	 */
	public function configure() {
		$this->widgetSchema ['captcha'] = new sfWidgetFormInput (array(),array('class'=>'txtcaptcha'));
		$this->validatorSchema ['captcha'] = new sfValidatorSfCryptoCaptcha ( array (
				'required' => true,
				'trim' => true 
		), array (
				'wrong_captcha' => '验证码输入错误。',
				'required' => '必填' 
		) );
		
		$this->validatorSchema ['username'] = new sfValidatorString(array('required' => true), array('required' => '必填','invalid'=>'密码错误'));
		$this->validatorSchema ['password'] = new sfValidatorString(array('required' => true), array('required' => '必填'));
		
		$this->widgetSchema ['username'] = new sfWidgetFormInputText(array(),array('class'=>'txt'));
		$this->widgetSchema ['password'] = new sfWidgetFormInputPassword(array('type' => 'password'),array('class'=>'txt'));
		
		//$this->useFields(array('username' ,'password','captcha'));
		$this->widgetSchema->setLabels ( array (
				'username' => '用户名',
				'password' => '密码',
				'captcha' => '验证码'
		) );
		
		$this->validatorSchema->setPostValidator(new sfGuardValidatorUser(array(),array('invalid'=>'密码错误')));
		$this->errorSchema = new sfValidatorErrorSchema ( $this->validatorSchema );
	
	}
}
