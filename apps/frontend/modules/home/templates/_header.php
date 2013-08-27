<div class="header">
	<div class="banner">
		<img src="/../../images/nav_banner.jpg" />
	</div>
	<div class="nav clearfix">
		<ul>
			<li><a href="<?php echo url_for('@homepage');?>" <?php if($current_id == 1 ) echo 'class="on"';?>>首　页</a></li>
			<li><a href="<?php echo url_for('@introduce');?>" <?php if($current_id == 2 ) echo 'class="on"';?>>培训介绍</a></li>
			<li><a href="<?php echo url_for('@emore');?>" <?php if($current_id == 3 ) echo 'class="on"';?>>院校专家</a></li>
			<li><a href="<?php echo url_for('@guide');?>" <?php if($current_id == 4 ) echo 'class="on"';?>>学习指南</a></li>
			<li class="last"><a href="<?php echo url_for('@apply');?>">集体报道绿色通道</a></li>
		</ul>
		<a href="/backend.php" class="link_manage">转入操作后台</a>
	</div>
</div>