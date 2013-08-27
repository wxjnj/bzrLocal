<?php

/**
 * Question form.
 *
 * @package    nxetd
 * @subpackage form
 * @author     zhaoyun
 * @version    SVN: $Id: QuestionForm.class.php,v 1.3 2013/02/20 03:28:39 gef Exp $
 */
class QuestionForm extends BaseQuestionForm
{
  public function configure()
  {
  	$this->useFields(array('answer_content'));
  	
//   	$this->widgetSchema ['subject_id'] = new sfWidgetFormInputHidden();
//   	$this->widgetSchema['type']->setOption('choices',array('radio' => '单选', 'checkbox' => '多选'));
  	
//   	$this->validatorSchema['title'] = new sfValidatorString(array(), array(
//   			'required'   => '标题必须填写',
//   	));
  	
//   	$edit_mode = $this->getObject ()->getImageUrl() == '' || $this->getObject ()->getImageUrl () == null;
// 	$edit_mode = ! $this->isNew () && ! $edit_mode;
// 	$this->widgetSchema ['imageUrl'] = new sfWidgetFormInputFileEditable ( array (
// 				'file_src' => '/uploads/' . $this->getObject ()->getImageUrl (),
// 				'is_image' => true,
// 				'edit_mode' => $edit_mode,
// 				'template' => '%file%<br/>%input%<br/>%delete%（选中后保存将删除图片）'
// 	) );
// 	$this->validatorSchema ['imageUrl'] = new sfValidatorFile ( array (
// 				'required' => false,
// 				'path' => sfConfig::get ( 'sf_upload_dir' ),
// 				'mime_types' => array (
// 						'image/jpeg',
// 						'image/png',
// 						'image/gif',
// 						'image/pjpeg',
// 						'image/x-png'
// 				)
// 	) );
// 	$this->validatorSchema ['imageUrl_delete'] = new sfValidatorPass ();
	
// 	$this->widgetSchema->setLabels(array(
// 			'title'=>'标题',
// 			'description'=>'描述',
// 			'imageUrl'=>'缩略图',
// 			'linkUrl'=>'链接地址',
// 			'type'=>'类型'
// 	));
  }
}
