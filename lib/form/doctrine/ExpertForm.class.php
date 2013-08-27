<?php

/**
 * Expert form.
 *
 * @package    bzr
 * @subpackage form
 * @author     gefei
 * @version    SVN: $Id: sfDoctrineFormTemplate.php,v 1.1 2012/05/04 06:47:29 zhaoy Exp $
 */
class ExpertForm extends BaseExpertForm
{
  public function configure()
  {
  	$this->useFields(array(
  			'name',
  			'job',
  			'sub_description',
  			'direction',
  			'description',
  			'picture',
  			'type',
  			'weight'
  	));
  	$this->widgetSchema ['description'] = new ueWidgetFormRichText(array(),array('ueconfig'=>"option = {
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
  	
  	$this->widgetSchema ['type'] = new sfWidgetFormSelect(array(
  			'choices' => array(1=>'专家队伍',2=>'领衔专家')
  	));
  	
  	$this->widgetSchema->setLabels(array(
  			'name'=>'姓名',
  			'job'=>'职务',
  			'sub_description'=>'简介',
  			'direction'=>'研究方向',
  			'description'=>'具体介绍',
  			'picture'=>'照片（182*232）',
  			'type'=>'专家级别',
  			'weight'=>'排序（数字越大越靠前）'
  	));
  }
}
