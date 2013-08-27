<?php

/**
 * File form.
 *
 * @package    bzr
 * @subpackage form
 * @author     gefei
 * @version    SVN: $Id: sfDoctrineFormTemplate.php,v 1.1 2012/05/04 06:47:29 zhaoy Exp $
 */
class FileForm extends BaseFileForm
{
  public function configure()
  {
  	$this->useFields(array(
  			'title',
  			'sub_description',
  			'keywords',
  			'category_id',
  			'price',
  			'is_security',
  			'attachment',
  			'attachment_name',
  			'picture'
  	));
  	$this->widgetSchema['attachment'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['attachment_name'] = new sfWidgetFormInputHidden();
  	
  	$edit_mode = $this->getObject ()->getPicture () == '' || $this->getObject ()->getPicture () == null;
  	$edit_mode = ! $this->isNew () && ! $edit_mode;
  	$this->widgetSchema ['picture'] = new sfWidgetFormInputFileEditable ( array (
  			'file_src' => '/uploads/' . $this->getObject ()->getPicture (),
  			'is_image' => true,
  			'edit_mode' => $edit_mode,
  			'template' => '<table border="0"><tr><td>%input%<br />%delete%（选中保存将删除图片）</td><td><div class="upload_template">%file%</div><td></tr></table>'
  	) );
  	$this->validatorSchema ['picture'] = new sfValidatorFile ( array (
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
  	$this->validatorSchema ['picture_delete'] = new sfValidatorPass ();
  	
  	$this->widgetSchema ['price'] = new sfWidgetFormSelect(array(
  			'choices' => array(1=>'免费',2=>'1积分',3=>'2积分',4=>'3积分',5=>'4积分',6=>'5积分')
  	));
  	
  	$this->widgetSchema->setLabels(array(
  			'title'=>'标题',
  			'sub_description'=>'简介',
  			'keywords'=>'关键词',
  			'category_id'=>'分类',
  			'price'=>'售价',
  			'is_security'=>'隐私',
  			'attachment'=>'上传文档',
  			'picture'=>'缩略图'
  	));
  }
}
