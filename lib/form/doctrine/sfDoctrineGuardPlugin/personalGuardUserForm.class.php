<?php
class personalGuardUserForm extends PluginsfGuardUserForm {
	public function configure() {
		$this->useFields ( array (
				'nick_name',
				'customstatus',
				'idiograph',
				'introduce',
				'sex',
				'birthday',
				'phone',
				'adress',
				'qq',
				'card',
				'head_portrait',
				'questions',
				'answer'
 		));
		$edit_mode = $this->getObject ()->getHeadPortrait () == '' || $this->getObject ()->getHeadPortrait () == null;
		$edit_mode = ! $this->isNew () && ! $edit_mode;
		$this->widgetSchema ['head_portrait'] = new sfWidgetFormInputFileEditable ( array (
				'file_src' => '/uploads/' . $this->getObject ()->getHeadPortrait(),
				'is_image' => true,
				'edit_mode' => $edit_mode,
				'template' => '<table border="0"><tr><td><div style="overflow:hidden;width:120px;height:120px;">%file%</div><td></tr><tr><td>%input%<br />%delete%（选中保存将删除图片）</td></tr></table>'
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
		));
		$this->validatorSchema ['head_portrait_delete'] = new sfValidatorPass ();
		
		$this->widgetSchema['idiograph'] = new sfWidgetFormTextarea();
		$this->widgetSchema['introduce'] = new sfWidgetFormTextarea();
		$this->widgetSchema['adress'] = new sfWidgetFormTextarea();
	
		$this->widgetSchema['birthday'] =new sfWidgetFormDatePickerTime(array('with_time'=>false));		
		
		$this->widgetSchema->setLabels ( array (
				'nick_name' => '昵称',
				'customstatus' => '自定义头衔',
				'idiograph' => '个性签名',
				'introduce' => '自我介绍',
				'sex' => '性别',
				'birthday' => '生日',
				'adress' => '地址',
				'qq' => 'QQ',
				'card' => '身份证',
				'head_portrait' => '头像',
				'questions'=>'安全提问',
				'answer'=>'回答'
		) );
		$this->widgetSchema['sex']->setOption('choices',array(0 => '男', 1 => '女'));
		$this->widgetSchema['questions']->setOption('choices',array(0 => '无安全提问', 1 => '母亲的名字',2 => '父亲的名字',3 => '出生的城市',4 => '您最喜欢的餐馆的名字',5 => '您其中一位老师的名字',6 => '您个人计算机的型号',7 => '驾照的最后四位数'));
	}
}
