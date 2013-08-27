<?php include_partial('home/header',array('current_id'=>4));?>
<div class="study_nav">
	<h3>最齐全的教师文档聚合地</h3>
	<ul class="clearfix">
		<li><a href="<?php echo url_for('@study_help');?>"><img src="/../../images/study_nav_1.jpg" /></a></li>
		<li><a href="#"><img src="/../../images/study_nav_2.jpg" /></a></li>
		<li><a href="#"><img src="/../../images/study_nav_3.jpg" /></a></li>
		<li><a href="#"><img src="/../../images/study_nav_4.jpg" /></a></li>
	</ul>
</div>
<div class="content_box">
	<div class="detail_title">
		<p>您的当前位置：<a href="<?php echo url_for('@homepage')?>">首页</a> &gt; 终生学习</p>
	</div>
	<div class="detail_cont clearfix">
		<div class="l">
			<div class="study_box">
				<div class="study_search">
				<form method="post" action="<?php echo url_for('@study_search');?>" id="search">
					<input type="text" class="text" name="keywords" placeholder="输入关键词"/>
					<a href="javascript:void(0)">搜　索</a>
				</form>
				</div>
				<div class="study_exp">
					<h3><a href="<?php echo url_for('@fmore?token=1');?>" class="link_more">查看更多 &gt;&gt;</a>课件</h3>
					<ul class="clearfix">
					<?php foreach($courseware as $cobject):?>
						<li><a href="<?php echo url_for('@fshow?token='.$cobject->getToken());?>"><?php echo Tools::cur_str_utf8($cobject->getTitle(), 30,0,2)?></a></li>
					<?php endforeach;?>
					</ul>
				</div>
				<div class="study_exp">
					<h3><a href="<?php echo url_for('@fmore?token=2');?>" class="link_more">查看更多 &gt;&gt;</a>视频</h3>
					<ul class="clearfix">
						<?php foreach($video as $vobject):?>
						<li><a href="<?php echo url_for('@fshow?token='.$vobject->getToken());?>"><?php echo Tools::cur_str_utf8($vobject->getTitle(), 30,0,2)?></a></li>
						<?php endforeach;?>						
					</ul>
				</div>
				<div class="study_exp">
					<h3><a href="<?php echo url_for('@fmore?token=3');?>" class="link_more">查看更多 &gt;&gt;</a>试卷精选</h3>
					<ul class="clearfix">
						<?php foreach($book as $bobject):?>
						<li><a href="<?php echo url_for('@fshow?token='.$bobject->getToken());?>"><?php echo Tools::cur_str_utf8($bobject->getTitle(), 30,0,2)?></a></li>
						<?php endforeach;?>							
					</ul>
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
	<div class="study_inner clearfix">
		<div class="class_build">
			<h3><a href="#">查看更多 &gt;&gt;</a>班级建设</h3>
			<ul>
				<li><a href="#">[写作空间]人生最好的“读书天气 市委党校学习心得</a></li>
				<li><a href="#">[写作空间]人生最好的“读书天气 市委党校学习心得</a></li>
				<li><a href="#">[写作空间]人生最好的“读书天气 市委党校学习心得</a></li>
				<li><a href="#">[写作空间]人生最好的“读书天气 市委党校学习心得</a></li>
				<li><a href="#">[写作空间]人生最好的“读书天气 市委党校学习心得</a></li>
				<li><a href="#">[写作空间]人生最好的“读书天气 市委党校学习心得</a></li>
			</ul>
		</div>
		<div class="class_build">
			<h3><a href="#">查看更多 &gt;&gt;</a>班级建设</h3>
			<ul>
				<li><a href="#">[写作空间]人生最好的“读书天气 市委党校学习心得</a></li>
				<li><a href="#">[写作空间]人生最好的“读书天气 市委党校学习心得</a></li>
				<li><a href="#">[写作空间]人生最好的“读书天气 市委党校学习心得</a></li>
				<li><a href="#">[写作空间]人生最好的“读书天气 市委党校学习心得</a></li>
				<li><a href="#">[写作空间]人生最好的“读书天气 市委党校学习心得</a></li>
				<li><a href="#">[写作空间]人生最好的“读书天气 市委党校学习心得</a></li>
			</ul>
		</div>
		<div class="class_build">
			<h3><a href="#">查看更多 &gt;&gt;</a>班级建设</h3>
			<ul>
				<li><a href="#">[写作空间]人生最好的“读书天气 市委党校学习心得</a></li>
				<li><a href="#">[写作空间]人生最好的“读书天气 市委党校学习心得</a></li>
				<li><a href="#">[写作空间]人生最好的“读书天气 市委党校学习心得</a></li>
				<li><a href="#">[写作空间]人生最好的“读书天气 市委党校学习心得</a></li>
				<li><a href="#">[写作空间]人生最好的“读书天气 市委党校学习心得</a></li>
				<li><a href="#">[写作空间]人生最好的“读书天气 市委党校学习心得</a></li>
			</ul>
		</div>
	</div>			
</div>
<div class="banner_1">
	<?php if($bottom_banner[0]->getUrl() != ''):?>
					<a href="<?php echo $bottom_banner[0]->getUrl();?>">
				<?php else: ?>
					<a href="<?php echo url_for('@show?type=Advertising&id='.$bottom_banner[0]->getId());?>">
				<?php endif;?>
						<img src="/../../uploads/<?php echo $bottom_banner[0]->getPicture();?>" />
					</a>
</div>

<script type="text/javascript">
	//搜索
	$(".study_search a").click(function(){
		var _cont=$.trim($(".study_search input").val());
		if(_cont==""){
			alert("请输入搜索内容！");	return false;		
		}
		$("form#search").submit();
	});
</script>
