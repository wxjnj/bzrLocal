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
        	$('#job_attachment').val(dataJson.name);
        	$('#job_attachment_name').val(dataJson.true_name);
        	$('.attachment_url').html("<li>"+dataJson.true_name+"</li>");
        } 
	});


});
</script>

<form action="<?php echo url_for('job/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
<?php echo $form->renderHiddenFields(false) ?>
  <table class="full-table form-table" cellspacing="0" cellpadding="0" border="0">
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th>作业标题</th>
        <td>
          <?php echo $work->getTitle(); ?>
        </td>
      </tr>
      <tr>
        <th>作业简介</th>
        <td>
          <?php echo $work->getSubDescription(); ?>
        </td>
      </tr>
      <tr>
        <th>作业截至日期</th>
        <td>
          <?php echo $work->getDateTimeObject('end_time')->format('Y-m-d'); ?>
        </td>
      </tr>
      <?php if($work->getVideoUrl() != ''):?>
      <tr>
        <th>视频地址</th>
        <td>
          <a href="<?php echo $work->getVideoUrl();?>">点击观看视频</a>
        </td>
      </tr>
      <?php endif;?>
      <?php if($work->getVideo() != ''):?>
      <tr>
        <th>相关文档</th>
        <td>
          <a href="/download.php?fullname=<?php echo $work->getVideoName();?>&filename=attachment/<?php echo $work->getVideo();?>" title="<?php echo $work->getTitle();?>" target="_blank"><?php echo $work->getVideoName();?></a>
        </td>
      </tr>
      <?php endif;?>
      <tr>
        <th><?php echo $form['title']->renderLabel() ?></th>
        <td>
          <?php echo $form['title']->renderError() ?>
          <?php echo $form['title'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['content']->renderLabel() ?></th>
        <td>
          <?php echo $form['content']->renderError() ?>
          <?php echo $form['content'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['attachment']->renderLabel() ?></th>
        <td><input type="file" name="attachment_upload" id="attachment_upload" /><ul class="attachment_url"><li><?php echo $form->getObject()->getAttachmentName();?></li></ul></td>
      </tr>
    </tbody>
  </table>
  <table class="full-table form-button-table" cellspacing="0" cellpadding="0" border="0">
		<tr>
			<td width="80px">
				  <a href="<?php echo url_for('@work') ?>">
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
		var title = $('#job_title').val();

		if(title == ''){
			alert('标题不能为空！');return false;
		}
	});
});
</script>