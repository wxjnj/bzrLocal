<?php include_partial('home/header',array('current_id'=>4));?>
<div class="content_box">
	<div class="detail_title">
		<p>您的当前位置：<a href="<?php echo url_for('@homepage')?>">首页</a> &gt; <a href="#">终生学习</a> &gt; 近期活动</p>
	</div>
	<div class="detail_cont clearfix">
		<div class="l">
			<div class="train">
				<div class="show_exp">
					<h3><?php echo $content->getTitle();?></h3>
					<?php echo $content->getRaw('content');?>
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