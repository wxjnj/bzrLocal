<?php

/**
 * Advertising form.
 *
 * @package    bzr
 * @subpackage form
 * @author     wxj
 * @version    SVN: $Id: sfDoctrineFormTemplate.php,v 1.1 2012/05/04 06:47:29 zhaoy Exp $
 */
class AdvertisingForm extends BaseAdvertisingForm
{
  public function configure()
  {
  	$this->useFields(array(
  			'title',
  			'picture',
  			'url',
  			'content',
  			'type',
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
  	));
  	$this->validatorSchema ['picture_delete'] = new sfValidatorPass ();
  	 
  	$this->widgetSchema ['type'] = new sfWidgetFormSelect(array(
  			'choices' => array(1=>'首页头部',2=>'首页中部', 3=>'内页右侧', 4=>'内页底部')
  	));
  	 
  	$this->widgetSchema->setLabels(array(
  			'title'=>'标题',
  			'picture'=>'图片',
  			'content'=>'内容',
  			'url'=>'链接（填写后内容失效）',
  			'type'=>'类型'
  	));
  }
}
