<?php include_partial('home/header',array('current_id'=>1));?>
<div class="content_box">
	<div class="detail_title">
		<p>您的当前位置：<a href="<?php echo url_for('@homepage');?>">首页</a> &gt; <a href="#">交流分享</a> &gt; <a href="<?php echo url_for('@smore');?>">学员分享</a> &gt; 正文</p>
	</div>
	<div class="expert_cont clearfix">
		<div class="l">
			<?php include_component('home', 'notice');?>
			<?php include_component('home', 'leftbanner');?>
			<div class="share_notice">
				<div class="right_title">
					<p>分享动态</p>
				</div>
				<ul>
					<li><a href="#"><strong>[朱子阳] </strong>提交了作业</a></li>
					<li><a href="#"><strong>[朱子阳] </strong>上传了课件</a></li>
					<li><a href="#"><strong>[朱子阳] </strong>上传了课件</a></li>
					<li><a href="#"><strong>[朱子阳] </strong>提交了作业</a></li>
					<li><a href="#"><strong>[朱子阳] </strong>上传了课件</a></li>
					<li><a href="#"><strong>[朱子阳] </strong>提交了作业</a></li>
				</ul>
			</div>
			<?php include_component('home', 'leftbanner');?>
		</div>
		<div class="r">
			<div class="stu_sharedetail">
				<h3><?php echo $content->getTitle();?></h3>
				<?php echo $content->getRaw('content');?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var expertChange=function(){
		var n=0;
		var len=$(".list_inner ul li").length;
		var _up=$(".edu_list span.up");
		var _ul=$(".list_inner ul");
		var _h=_ul.find("li").height()+21;
		var _down=$(".edu_list span.down");
		_up.click(function(){
			if(n==0||len<=3||_ul.is(":animated")){
				return false;
			}
			
			n--;
			_ul.animate({"marginTop":-(_h*n)+"px"},500);
		});
		
		_down.click(function(){
			if(n>=(len-3)||len<=3||_ul.is(":animated")){
				return false;
			}			
			n++;
			_ul.animate({"marginTop":-(_h*n)+"px"},500);
		})
	}()
</script>