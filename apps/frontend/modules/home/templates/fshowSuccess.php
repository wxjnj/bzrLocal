<?php include_partial('home/header',array('current_id'=>4));?>
<div class="content_box">
	<div class="detail_title">
		<p>您的当前位置：<a href="#">首页</a> &gt; <a href="#">终生学习</a> &gt; <a href="#">教研资料</a> &gt; 正文</p>
	</div>
	<div class="detail_cont clearfix">
		<div class="l">
			<div class="data_detail">
				<h3><img src="images/word_ico.jpg" /><?php echo $content->getTitle()?><span><?php echo $content->getReadNum();?>人阅读</span></h3>
				<div class="inner_data" style="padding:20px;">
					<?php echo $content->getSubDescription();?>
				</div>
				<div class="data_down clearfix">
					<a href="javascript:void(0)"></a>
					<div>
						<p>文档大小：62KB</p>
						<p>所需积分：<?php echo $content->getPrice();?></p>
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
<script>
$(function(){
	$(".data_down a").click(function(){
		if(confirm("您确定要下载此文档吗？下载成功后会扣除您相应的积分"))
		{
			$.ajax({
				   type: "POST",
				   url: "<?php echo url_for('@download')?>",
				   data: "file_token="+'<?php echo $content->getToken();?>',
				   success: function(msg){
					   if(msg == 2){
							alert('请您先登录！');
							location.reload();
					   }
					   else if(msg == 3){
							alert('您的积分不足，暂时不能下载此文档！');return false;
					   }
					   else if(msg == 4){
							alert('此文档不存在或已经被删除，暂时无法下载！');return false;
					   }
					   else if(msg == 1){
							location.href = "/download.php?fullname=<?php echo $content->getAttachmentName();?>&filename=attachment/<?php echo $content->getAttachment();?>";
					   }
					   else{
						   alert('下载失败！');return false;
					   }
				   }
			});
		}
	});
	
})
</script>