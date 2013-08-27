<?php
class bbsGuardUserForm extends PluginsfGuardUserForm {
	public function configure() {
		$this->useFields ( array (
				'username',
				'email_address',
				'password',
				'groups_list',
				'role_manager_bbs_id',
				'forums_list',
				'head_portrait'
 		) );
		$this->widgetSchema ['forums_list'] = new sfWidgetFormDoctrineChoice ( array (
				'model' => 'Forum',
				'add_empty' => '请选择版块（可选）',
				'multiple' => true,
				'expanded' => true,
				'order_by' => array (
						'root_id, lft',
						''
				),
				'method' => 'getIndentedName'
		) );
		
		$this->validatorSchema['email_address'] = new sfValidatorEmail(array('required'=>true),array('required'=>'邮箱为必填项'),array('invalid' => '无效的邮箱'));
		$this->validatorSchema['username'] = new sfValidatorString(
				array('required'=>true),
				array('required'=>'用户名为必填项')
		);
		$this->validatorSchema->setPostValidator(
  			new sfValidatorAnd(array(
  					new sfValidatorDoctrineUnique(
  							array('model' => 'sfGuardUser', 'column' => array('username')),
  							array( 'invalid' => '您输入的用户名已经存在！')
  					),
  					new sfValidatorDoctrineUnique(
  							array('model' => 'sfGuardUser', 'column' => array('email_address')),
  							array( 'invalid' => '您输入的邮箱已经存在！')
  					),
  			))
  		);
		$edit_mode = $this->getObject ()->getHeadPortrait () == '' || $this->getObject ()->getHeadPortrait () == null;
		$edit_mode = ! $this->isNew () && ! $edit_mode;
		$this->widgetSchema ['head_portrait'] = new sfWidgetFormInputFileEditable ( array (
				'file_src' => '/uploads/' . $this->getObject ()->getHeadPortrait (),
				'is_image' => true,
				'edit_mode' => $edit_mode,
				'template' => '%file%<br/>%input%<br/>%delete%（选中后保存将删除图片）'
		) );
		$this->validatorSchema ['head_portrait'] = new sfValidatorFile ( array (
				'required' => false,
				'path' => sfConfig::get ( 'sf_upload_dir' ),
				'mime_types' => array (
						'image/jpeg',
						'image/png',
						'image/gif',
						'image/pjpeg',
						'image/x-png'
				)
		) );
		$this->validatorSchema ['head_portrait_delete'] = new sfValidatorPass ();
  	
		$this->widgetSchema ['password'] = new sfWidgetFormInputPassword ();
  		$this->validatorSchema['password']->setOption('required', false);
  		$this->validatorSchema['password']->setMessage('required', '请输入密码');
  		
  		$this->widgetSchema->setLabels ( array (
  				'username' => '用户名',
  				'email_address' => '邮箱',
  				'password' => '密码',
  				'groups_list' => '用户组',
  				'role_manager_bbs_id' => '关联角色',
  				'forums_list' => '版块列表',
  				'head_portrait'=>'头像'
  		) );
  	}

}
