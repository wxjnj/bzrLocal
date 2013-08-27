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
		"buttonImage" : "/images/upload.jpg",
    	'buttonClass' : 'some-class',//按钮样式
    	'buttonText' : '选择文件',//按钮文本
    	'fileSizeLimit' : '1024MB',//单个文件上传大小限制
    	'fileTypeExts' : '*.flv,*.rp;*.jpg;*.jpeg;*.gif;*.png;*.txt;*.xls;*.doc;*.rar;*.zip;*.docx;*.xlsx;*.ppt;*.pptx',//限制上传格式
    	'width'   : 80,//按钮宽度
    	'height'   : 25,//按钮高度
        'multi': false, //多文件上传，
        'cancelImg': '/uploadify/uploadify-cancel.png',//取消按钮
        'removeCompleted': true,
        'onUploadSuccess' : function(file, data, response) {
        	var dataJson = JSON.parse(data);
        	$('#attachment').val(dataJson.name);
        	$('#attachment_name').val(dataJson.true_name);
        	$('#file').html(dataJson.true_name);
        	$('#files').show();
        	$(".blue").html('1');
        }
	});

});
</script>

<?php include_partial('home/header',array('current_id'=>4));?>
<div class="content_box">
	<div class="detail_title">
		<p>您的当前位置：<a href="<?php echo url_for('@homepage');?>">首页</a> &gt; <a href="<?php echo url_for('@study');?>">终生学习</a> &gt; 上传文档</p>
	</div>
	<div class="detail_cont clearfix">
		<div class="l">
			<div class="upload_share">
				<h3>我的文档</h3>
				<ul>
				<?php foreach($pager as $file):?>
					<li><a href="/download.php?fullname=<?php echo $file->getAttachmentName();?>&filename=attachment/<?php echo $file->getAttachment();?>" title="<?php echo $file->getTitle();?>" target="_blank"><?php echo $file->getTitle();?></a></li>
				<?php endforeach;?>
				</ul>
				<?php if($pager->haveToPaginate()):?>
				<div class="page_wrap">
					<div class="page">
						<a href="<?php echo url_for('@document?page='.$pager->getPreviousPage());?>">上一页</a>
						<?php for($i = 1;$i<=$pager->getLastPage();$i++):?>
							<?php if($i == $pager->getPage()):?>
				    			<a href="javascript:viod(0)" class="on"><?php echo $i;?></a>
				    		<?php else:?>
				    			<a href="<?php echo url_for('@document?page='.$i);?>"><?php echo $i;?></a>
				    		<?php endif;?>
				    	<?php endfor;?>
						<a href="<?php echo url_for('@document?page='.$pager->getNextPage());?>">下一页</a>
					</div>
				</div>
				<?php endif;?>
				
				<p class="set_upload">
					<a href="javascripi:void(0)"></a>
				</p>
				<div class="upload_success upload_hidden">
					<div class="upload_tips">
						<h4><span class="blue">0</span>篇文档上传完毕！<span class="red">请填写下列文档信息后点击“提交信息”</span></h4>
						<div class="upload_btn">
							<input type="file" id="upload_app" name="attachment_upload" />
							<input type="hidden" value="" id="attachment" />
							<input type="hidden" value="" id="attachment_name" />
						</div>
					</div>
					<div id="some_file_queue"></div>
					<div class="upload_box clearfix">
						<div class="upload_box_l">
							<p>
								<label>标　题<span class="red">*</span></label>
								<input type="text" class="text" id="title"/>
							</p>
							<p>
								<label>简　介<span class="red">*</span></label>
								<textarea placeholder="选项，最多可输入500个字符"></textarea>
							</p>
							<p>
								<label>分　类<span class="red">*</span></label>
								<select id="classify">
									<option value="0">请选择</option>
									<?php foreach($categories as $category):?>
									<option value="<?php echo $category->getId();?>"><?php echo $category->getName();?></option>
									<?php endforeach;?>
								</select>										
							</p>
							<p>
								<label>关键词</label>
								<input type="text" class="text" placeholder="选填，多个关键字之间用逗号隔" id="keyword"/>
							</p>
							<p><span id="files"><label>文件：</label><span id="file"></span></span></p>									
						</div>
						<div class="upload_box_r">
							<p>
								<label>售　价</label>
								<select id="price">
									<option value="1">免费</option>
									<option value="2">1积分</option>
									<option value="3">2积分</option>
									<option value="4">3积分</option>
									<option value="5">4积分</option>
									<option value="6">5积分</option>
								</select>
							</p>
							<p>
								<label>隐　私</label>
								<span class="check_conceal">
									<input type="radio" name="content" checked="checked" value="0"/> 共有 <em>任何人可以检索和查看</em><br/>
									<input type="radio" name="content" value="1"/> 私有 <em>只有您本人可以查看</em>
								</span>
							</p>									
						</div>
						<a href="javascript:void(0)" class="save_btn">提交信息</a>
					</div>
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
	//点击上传显示影藏
	$(".set_upload").click(function(){
		$(".upload_success").toggle();
		return false;
	});
	
	//点击提交信息验证
	$(".save_btn").click(function(){
		var _title=$.trim($("#title").val());
		var _text=$.trim($("textarea").val());
		var _classify=$("#classify").val();
		var _keyword=$.trim($("#keyword").val());
		var _attachment=$.trim($("#attachment").val());
		var _attachment_name=$.trim($("#attachment_name").val());
		var _sel=$.trim($("#price").val());
		var _radio=$.trim($("input['radio']:checked").val());
		
		if(_title==""){
			alert("请输入标题！");return false;
		}
		else if(_text==""){
			alert("请输入简介内容！");return false;
		}
		else if(_text.length>500){
			alert("简介内容不能超过500个字符！");return false;
		}
		else if(_classify==0){
			alert("请选择分类");return false;
		}
		//else if(_keyword==""){
		//	alert("请输入关键词！");return false;
		//}	
		else if(_attachment==""){
			alert("您还没有上传文件！");return false;
		}	

		$.ajax({
			   type: "POST",
			   url: "<?php echo url_for('@ajax_add_document')?>",
			   data: "title="+_title+'&content='+_text+'&category_id='+_classify+'&keywords='+_keyword+'&attachment='+_attachment+'&attachment_name='+_attachment_name+'&price='+_sel+'&is_security='+_radio,
			   success: function(msg){
				   if(msg == 2){
						alert('请您先登录！');
						location.reload();
				   }
				   else if(msg == 1){
					   alert('提交成功！');
					   location.reload();
				   }else{
					   alert('提交失败！');return false;
				   }
			   }
		});
	});
</script>