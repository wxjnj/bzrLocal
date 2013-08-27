<?php

/**
 * sfGuardUser form.
 *
 * @package    nxetd
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfGuardUserForm.class.php,v 1.9 2012/08/12 07:23:58 zhaoy Exp $
 */
class sfGuardUserForm extends PluginsfGuardUserForm {
	public function configure() {
		$this->useFields ( array (
				'nick_name',
				'email_address',
				'username',
				'password',
				'is_active',
				'groups_list'
		) );
		
		$this->widgetSchema ['password'] = new sfWidgetFormInputPassword ();

		$this->widgetSchema ['groups_list'] = new sfWidgetFormDoctrineChoice ( array (
				'multiple' => false,
				'expanded' => false,
				'model' => 'sfGuardGroup',
				//'query' => $query
		) );
// 		$this->widgetSchema ['permissions_list'] = new sfWidgetFormDoctrineChoice ( array (
// 				'multiple' => true,
// 				'expanded' => true,
// 				'model' => 'sfGuardPermission',
// 				//'query' => $query
// 		) );
		// gefei 添加数据验证
		
		$this->validatorSchema ['username'] = new sfValidatorString ( array (
				'required' => true 
		), array (
				'required' => '请填写用户名' 
		) );
		
		$this->validatorSchema ['nick_name'] = new sfValidatorString ( array (
				'min_length' => 2 
		), array (
				'required' => '请输入昵称，不得低于2个字符，比如：昵称' 
		) );
		$this->validatorSchema ['email_address'] = new sfValidatorEmail ( array ('required'=>false), array (
				'invalid' => '邮件地址无效',
// 				'required' => '请填写邮件地址' 
		));
		
		$this->widgetSchema->setLabels ( array (
				'username' => '用户名',
				'email_address' => '邮箱',
				'nick_name' => '昵称',
				'password' => '密码',
				'real_name' => '真实姓名',
				'is_active' => '是否激活',
				'groups_list' => '角色列表',
				'permissions_list' => '权限列表'
		) );
		
	
		//$form = new ExpertForm();


		$this->embedRelation('Expert');
		
		
	}

}
