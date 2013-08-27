<?php

/**
 * Job form.
 *
 * @package    bzr
 * @subpackage form
 * @author     gefei
 * @version    SVN: $Id: sfDoctrineFormTemplate.php,v 1.1 2012/05/04 06:47:29 zhaoy Exp $
 */
class JobForm extends BaseJobForm
{
  public function configure()
  {
  	$this->useFields(array(
  			'title',
  			'content',
  			'work_id',
  			'attachment',
  			'attachment_name',
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
  	$this->widgetSchema['work_id'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['attachment'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['attachment_name'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema->setLabels(array(
  			'title'=>'标题',
  			'content'=>'内容',
  			'attachment'=>'上传文档'
  	));
  }
}