<?php

/**
 * Notice form.
 *
 * @package    bzr
 * @subpackage form
 * @author     gefei
 * @version    SVN: $Id: sfDoctrineFormTemplate.php,v 1.1 2012/05/04 06:47:29 zhaoy Exp $
 */
class NoticeForm extends BaseNoticeForm
{
  public function configure()
  {
  	$this->useFields(array(
  			'title',
  			'content',
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
  	$this->widgetSchema->setLabels(array(
  			'title'=>'标题',
  			'content'=>'内容',
  			'weight'=>'排序（数字越大越靠前）'
  	));
  }
}
