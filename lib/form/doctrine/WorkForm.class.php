<?php

/**
 * Work form.
 *
 * @package    bzr
 * @subpackage form
 * @author     gefei
 * @version    SVN: $Id: sfDoctrineFormTemplate.php,v 1.1 2012/05/04 06:47:29 zhaoy Exp $
 */
class WorkForm extends BaseWorkForm
{
  public function configure()
  {
  	$this->useFields(array(
  			'title',
  			'sub_description',
  			'end_time',
  			'video_url',
  			'video',
  			'video_name',
  			'picture',
  			'classes_id'
  	));
  	$this->widgetSchema['video'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['video_name'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['classes_id'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema ['end_time'] = new sfWidgetFormDatePickerTime ( array (
  			'with_time' => false
  	) );
  	
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
  	
  	$this->widgetSchema->setLabels(array(
  			'title'=>'标题',
  			'sub_description'=>'简介',
  			'end_time'=>'截至日期',
  			'video_url'=>'视频地址',
  			'video'=>'上传附件',
  			'picture'=>'缩略图（182*112）',
  			'classes_id'=>'班级列表'
  	));
  }
}
