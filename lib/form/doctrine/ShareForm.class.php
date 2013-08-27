<?php

/**
 * Share form.
 *
 * @package    bzr
 * @subpackage form
 * @author     gefei
 * @version    SVN: $Id: sfDoctrineFormTemplate.php,v 1.1 2012/05/04 06:47:29 zhaoy Exp $
 */
class ShareForm extends BaseShareForm
{
  public function configure()
  {
  	$this->useFields(array(
  			'title',
  			'sub_description',
  			'content',
  			'picture',
  			'weight'
  	));
  	$this->widgetSchema ['content'] = new ueWidgetFormRichText(array(),array('ueconfig'=>"option = {
  			toolbars:[['Source','Bold', 'Italic', 'Underline', 'StrikeThrough', 'RemoveFormat', 'AutoTypeSet', '|','Undo', 'Redo', '|',
  			'BlockQuote', '|', 'PastePlain', '|', 'ForeColor', 'InsertOrderedList', 'SelectAll', 'ClearDoc', '|', 'CustomStyle',
  			'Paragraph', '|', 'LineHeight','Indent', '|','FontFamily', 'FontSize', '|','InsertTable', 'DeleteTable',
  			'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyJustify', '|',
  			'Link', 'Unlink',  '|',  'InsertImage', 'Emotion', 'InsertVideo', 'Attachment','WordImage','Preview'
  			]],
  			minFrameHeight:200
  	}"));
  	
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
  			'content'=>'分享内容',
  			'picture'=>'缩略图（182*112）',
  			'weight'=>'排序（数字越大越靠前）'
  	));
  }
}
