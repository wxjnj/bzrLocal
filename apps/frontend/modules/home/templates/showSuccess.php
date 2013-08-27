<?php include_partial('home/header',array('current_id'=>1));?>
<div class="content_box">
	<div class="detail_title">
		<p>您的当前位置：<a href="<?php echo url_for('@homepage');?>">首页</a> &gt; <?php echo $name;?></p>
	</div>
	<div class="detail_cont clearfix">
		<div class="l">
			<div class="train">
				<div class="show_exp">
					<h3><?php echo $content;?></h3>
					<p><?php echo $content->getRaw('content');?></p>
				</div>			
			</div>			
		</div>
		<div class="r">
			<?php include_component('home', 'rightimages')?>
			<?php include_component('home', 'rightbanner')?>
			<?php include_component('home', 'topic')?>
		</div>
	</div>
</div>