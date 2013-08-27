<?php use_javascript('jquery.uploadify-3.1.min.js')?>
<?php use_javascript('json2.js')?>

<?php use_stylesheet('uploadify.css')?>
<script type="text/javascript">
$(function() {
	$('#upload_app').uploadify({
		'queueID'  : 'some_file_queue',
		'swf'      : '/uploadify/uploadify.swf',
		'uploader' : '/uploadify/uploadify-file.php',
		'auto'     : true,//是否自动上传
		"buttonImage" : "/images/upload_app.jpg",
    	'buttonClass' : 'some-class',//按钮样式
    	'buttonText' : '',//按钮文本
    	'fileSizeLimit' : '1024MB',//单个文件上传大小限制
    	'fileTypeExts' : '*.flv,*.rp;*.jpg;*.jpeg;*.gif;*.png;*.txt;*.xls;*.doc;*.rar;*.zip;*.docx;*.xlsx;*.ppt;*.pptx',//限制上传格式
    	'width'   : 102,//按钮宽度
    	'height'   : 32,//按钮高度
        'multi': false, //多文件上传，
        'cancelImg': '/uploadify/uploadify-cancel.png',//取消按钮
        'removeCompleted': true,
        'onUploadSuccess' : function(file, data, response) {
        	var dataJson = JSON.parse(data);
        	$('#attachment').val(dataJson.name);
        	$('#attachment_name').val(dataJson.true_name);
        	$('#file').html(dataJson.true_name);
        	$('#files').show();
        }
	});

});
</script>

<?php include_partial('home/header',array('current_id'=>4));?>
<div class="content_box">
	<div class="detail_title">
		<p>您的当前位置：<a href="#">首页</a> &gt; <a href="#">终生学习</a> &gt; 回复需求</p>
	</div>
	<div class="detail_cont clearfix">
		<div class="l">
			<div class="upload_share">
				<h3>我回答过的需求</h3>
				<ul class="answer">
				<?php foreach($pager as $need):?>
					<li><a href="<?php echo url_for('@needshow?token='.$need->getToken());?>"><?php echo Tools::cur_str_utf8($need->getTitle(), 25)?></a></li>
				<?php endforeach;?>
				</ul>
				<?php if($pager->haveToPaginate()):?>
				<div class="page_wrap">
					<div class="page">
						<a href="<?php echo url_for('@needshow?page='.$pager->getPreviousPage().'&token='.$token);?>">上一页</a>
						<?php for($i = 1;$i<=$pager->getLastPage();$i++):?>
							<?php if($i == $pager->getPage()):?>
				    			<a href="javascript:viod(0)" class="on"><?php echo $i;?></a>
				    		<?php else:?>
				    			<a href="<?php echo url_for('@needshow?page='.$i.'&token='.$token);?>"><?php echo $i;?></a>
				    		<?php endif;?>
				    	<?php endfor;?>
						<a href="<?php echo url_for('@needshow?page='.$pager->getNextPage().'&token='.$token);?>">下一页</a>
					</div>
				</div>
				<?php endif;?>
				<div class="this_ask">
					<p><strong>标　　题：</strong><?php echo $content->getTitle();?></p>
					<p><strong>详细内容：</strong><?php echo $content->getDescription();?></p>
					<p><strong>悬赏分值：</strong><span class="blue"><strong><?php if($content->getPrice()) echo $content->getPrice(); else echo '无';?></strong></span></p>
				</div>
				<div class="this_answer">
				<?php if($content->getIsFinish() == 1):?>
					<div class="this_tips">
						最佳答案：<br />
						<?php echo $content->tureanswer()->getContent();?>[<?php echo $content->tureanswer()->getUname();?>]<br />
						<?php if($content->tureanswer()->getAttachment()!=''):?>
							<a href="/download.php?fullname=<?php echo $content->tureanswer()->getAttachmentName();?>&filename=attachment/<?php echo $content->tureanswer()->getAttachment();?>" target="_blank">点击下载附件</a>	
						<?php endif;?>
					</div>
				<?php else :?>
					<div class="this_tips">
						我的回答：
						<input type="file" id="upload_app" name="attachment_upload"  />
						<input type="hidden" value="" id="attachment" />
						<input type="hidden" value="" id="attachment_name" />
						<div id="some_file_queue"></div>
						<span id="files">附件：<span id="file"></span></span>
					</div>
					<textarea></textarea>
					<p class="inset_btn"><a href="javascript:void(0)">提　交</a></p>
				<?php endif;?>
				</div>						
			</div>
		</div>
		<div class="r">
			<?php include_component('home', 'userandactivity');?>
			<?php include_component('home', 'hotdocument');?>
			<?php include_component('home', 'newneed');?>
			<?php include_component('home', 'rightbanner');?>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(".inset_btn").click(function(){
		var _text=$.trim($(".this_answer textarea").val());
		var _attachment=$.trim($(".this_answer #attachment").val());
		var _attachment_name=$.trim($(".this_answer #attachment_name").val());
		if(_text==""){
			alert("请输入回答内容！");return false;
		}

		$.ajax({
			   type: "POST",
			   url: "<?php echo url_for('@ajax_add_need_ans')?>",
			   data: "content="+_text+'&attachment='+_attachment+'&attachment_name='+_attachment_name+'&need_id='+<?php echo $content->getId();?>,
			   success: function(msg){
				   if(msg == 2){
						alert('请您先登录！');
						location.reload();
				   }
				   else if(msg == 3){
					   alert('此需求已经结束！');
					   location.reload();
				   }
				   else if(msg == 1){
					   alert('回答成功！');
					   location.reload();
				   }else{
					   alert('回答失败！');return false;
				   }
			   }
		});
	});
</script>