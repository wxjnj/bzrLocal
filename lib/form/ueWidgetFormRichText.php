<?php
class ueWidgetFormRichText extends sfWidgetFormTextarea
{
	
	/*
	 * array('ueconfig'=>'sdfd')
	 * 
	 * */
  public function renderContentTag($tag, $content = null, $attributes = array())
  {
  	if (empty($tag))
  	{
  		return '';
  	}
  	$ueconfig = '';
  	if(isset($attributes['ueconfig'])){
  		$ueconfig = $attributes['ueconfig'];
  	}
  	$id = $attributes['id']=$this->generateId($attributes['name']);
  	$ue = <<<EEE
<script type="text/javascript">
window.onload = function(){
	var option;
	$ueconfig
	ue = new baidu.editor.ui.Editor(option);
	ue.render('$id');
}
</script>  	
EEE;
  	
  	return sprintf('<%s%s>%s</%s>%s', $tag, $this->attributesToHtml($attributes), $content, $tag,$ue);
  }

  public function getJavaScripts() {
  	return array('/ueditor/editor_config.js','/ueditor/editor_all.js');
  }
  public function getStylesheets() {
	return array('/ueditor/themes/default/ueditor.css' => 'all');
  }
}
