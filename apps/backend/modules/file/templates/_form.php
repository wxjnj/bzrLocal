<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<?php use_javascript('jquery.uploadify-3.1.min.js')?>
<?php use_javascript('json2.js')?>

<?php use_stylesheet('/uploadify/uploadify.css')?>
<script type="text/javascript">
$(function() {
	$('#attachment_upload').uploadify({
		'swf'      : '/uploadify/uploadify.swf',
		'uploader' : '/uploadify/uploadify-file.php',
		'auto'     : true,//是否自动上传
    	'buttonClass' : 'some-class',//按钮样式
    	'buttonText' : '选择文档',//按钮文本
    	'fileSizeLimit' : '1024MB',//单个文件上传大小限制
    	'fileTypeExts' : '*.flv,*.rp;*.jpg;*.jpeg;*.gif;*.png;*.txt;*.xls;*.doc;*.rar;*.zip;*.docx;*.xlsx;*.ppt;*.pptx',//限制上传格式
    	'height'   : 30,//按钮高度
        'multi': false, //多文件上传，
        'cancelImg': '/uploadify/uploadify-cancel.png',//取消按钮
        'removeCompleted': true,
        'onUploadSuccess' : function(file, data, response) {
        	var dataJson = JSON.parse(data);
        	$('#file_attachment').val(dataJson.name);
        	$('#file_attachment_name').val(dataJson.true_name);
        	$('.attachment_url').html("<li>"+dataJson.true_name+"</li>");
        } 
	});


});
</script>

<form action="<?php echo url_for('file/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
<?php echo $form->renderHiddenFields(false) ?>
  <table class="full-table form-table" cellspacing="0" cellpadding="0" border="0">
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['title']->renderLabel() ?></th>
        <td>
          <?php echo $form['title']->renderError() ?>
          <?php echo $form['title'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['sub_description']->renderLabel() ?></th>
        <td>
          <?php echo $form['sub_description']->renderError() ?>
          <?php echo $form['sub_description'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['keywords']->renderLabel() ?></th>
        <td>
          <?php echo $form['keywords']->renderError() ?>
          <?php echo $form['keywords'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['category_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['category_id']->renderError() ?>
          <?php echo $form['category_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['price']->renderLabel() ?></th>
        <td>
          <?php echo $form['price']->renderError() ?>
          <?php echo $form['price'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['is_security']->renderLabel() ?></th>
        <td>
          <?php echo $form['is_security']->renderError() ?>
          <?php echo $form['is_security'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['attachment']->renderLabel() ?></th>
        <td><input type="file" name="attachment_upload" id="attachment_upload" /><ul class="attachment_url"><li><?php echo $form->getObject()->getAttachmentName();?></li></ul></td>
      </tr>
      <?php if($sf_user->hasPermission('管理')):?>
      <tr>
        <th><?php echo $form['picture']->renderLabel() ?></th>
        <td>
          <?php echo $form['picture']->renderError() ?>
          <?php echo $form['picture'] ?>
        </td>
      </tr>
      <?php endif;?>
    </tbody>
  </table>
  <table class="full-table form-button-table" cellspacing="0" cellpadding="0" border="0">
		<tr>
			<td width="80px">
				  <a href="<?php echo url_for('@file') ?>">
					<img height="22" border="0" width="60" src="/images/button_back.gif">
				 </a>

			</td>
			<td width="100px">
				<input type="submit" value="" class="input-submit" id="submit"/>
			</td>
			<td></td>
		</tr>
	</table>
</form>
<script type="text/javascript">
$(function() {
	//表单提交判断
	$('#submit').click(function(){
		var title = $('#file_title').val();
		var attachment = $('#file_attachment').val();

		if(title == ''){
			alert('标题不能为空！');return false;
		}
		if(attachment == ''){
			alert('必须上传文件！');return false;
		}
	});
});
</script>