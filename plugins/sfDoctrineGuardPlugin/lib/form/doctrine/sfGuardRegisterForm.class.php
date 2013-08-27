<?php

/**
 * sfGuardRegisterForm for registering new users
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Jonathan H. Wage <jonwage@gmail.com>
 * @version    SVN: $Id: sfGuardRegisterForm.class.php,v 1.10 2012/08/10 02:10:24 gef Exp $
 */
class sfGuardRegisterForm extends BasesfGuardRegisterForm
{
  /**
   * @see sfForm
   */
  public function configure()
  {
  	$this->useFields ( array (
  			'username',
  			'email_address',
  			'password',
  			'password_again',
  			'real_name',
  			'phone',
  			'card',
  			'adress'
  	));
  	$this->widgetSchema ['adress'] = new sfWidgetFormTextarea();
  	
  	$this->widgetSchema ['captcha'] = new sfWidgetFormInput (array(),array('class'=>'txtcaptcha'));
  	$this->validatorSchema ['captcha'] = new sfValidatorSfCryptoCaptcha ( array (
  			'required' => true,
  			'trim' => true
  	), array (
  			'wrong_captcha' => '验证码输入错误。',
  			'required' => '必填'
  	) );
  	
  	$this->validatorSchema['email_address'] = new sfValidatorEmail(array('required'=>true),array('invalid' => '无效的邮箱'));
  	
  	$this->validatorSchema['username'] = new sfValidatorRegex(
  			array('pattern' => '/^[_a-zA-Z0-9\x{4e00}-\x{9fa5}]{3,10}$/u','required'=>true),
  			array('invalid' => '无效的用户名（只能用 中文、英文、数字、下划线、3-10个字符）','required'=>'请填写用户名'
  	));
  	
  	$this->validatorSchema['password'] = new sfValidatorString(array('min_length' => 6), array(
  			'min_length' => '密码至少6位！',
  	));
  	
//   	$this->validatorSchema['phone'] = new sfValidatorRegex(
//   			array('pattern' => '/^((\+86)?|\(\+86\))0?1[358]\d{9}$/','required'=>true),
//   			array('invalid' => '无效的手机号码','required'=>'请填写手机号码'
//   	));
//   	$this->validatorSchema['card'] = new sfValidatorRegex(
//   			array('pattern' => '/\d{17}[\d|X]|\d{15}/','required'=>true),
//   			array('invalid' => '无效的身份证号码','required'=>'请填写身份证号码'
//   	));
  	
//   	$this->validatorSchema['real_name'] = new sfValidatorString(
//   			array('required'=>true),
//   			array('required'=>'姓名为必填项')
//   	);
  	$this->widgetSchema->setLabels ( array (
  			'username' => '用户名',
  			'password' => '密码',
  			'password_again' => '确认密码',
  			'email_address' => 'Email',
  			'real_name' => '姓名',
  			'phone' => '手机',
  			'card' => '身份证号码',
  			'adress' => '地址',
  			'captcha' => '验证码'
  	));
  	$this->validatorSchema->setPostValidator(
  			new sfValidatorAnd(array(
  					new sfValidatorDoctrineUnique(
  							array('model' => 'sfGuardUser', 'column' => array('username')),
  							array( 'invalid' => '您输入的用户名已经存在！')
  					),
//   					new sfValidatorDoctrineUnique(
//   							array('model' => 'sfGuardUser', 'column' => array('phone')),
//   							array( 'invalid' => '您输入的手机号码已经存在！')
//   					),
  					new sfValidatorDoctrineUnique(
  							array('model' => 'sfGuardUser', 'column' => array('email_address')),
  							array( 'invalid' => '您输入的邮箱已经存在！')
  					),
  			))
  	);
  	
  	$this->validatorSchema['password']->setOption('required', true);
  	$this->validatorSchema['password']->setMessage('required', '请输入密码');
  	$this->validatorSchema['password_again'] = clone $this->validatorSchema['password'];
  	
  	$this->mergePostValidator(new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'password_again', array(), array('invalid' => '两次密码必须相同')));
  }
}