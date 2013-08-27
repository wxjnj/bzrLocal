<?php include_partial('home/header',array('current_id'=>4));?>
<div class="content_box">
	<div class="detail_title">
		<p>您的当前位置：<a href="<?php echo url_for('@homepage');?>">首页</a> &gt; <a href="#">网上培训</a> &gt; 作业专区</p>
	</div>
	<div class="detail_cont clearfix">
		<div class="l">
			<div class="homework_area">
				<ul>
				<?php foreach($pager as $key=>$value):?>
					<li>
						<p class="tit"><a href="/backend.php/job_new/token/<?php echo $value->getToken()?>.html" target="_blank"><strong>[课程名] </strong><?php echo $value->getTitle();?></a><span class="timediff"><?php echo $value->getDateTimeObject('created_at')->format('Y年m月d日')?></span></p>
						<p><strong>作业简介：</strong><?php echo Tools::cur_str_utf8($value->getSubDescription(), 60)?></p>
						<p class="term_time"><a href="/backend.php/job_new/token/<?php echo $value->getToken()?>.html" target="_blank">点击完成作业 &gt;&gt;</a>有效期：<?php echo $value->getDateTimeObject('end_time')->format('Y年m月d日')?>前提交</p>
						<?php if($value->getVideoUrl() != ''):?>
						<p class="watch_view"><a href="<?php echo url_for('@workvideoshow?token='.$value->getToken());?>">观看复习视频</a></p>
						<?php endif;?>
					</li>
				<?php endforeach;?>
				</ul>
				<?php if($pager->haveToPaginate()):?>
				<div class="page_wrap">
					<div class="page">
						<a href="<?php echo url_for('@wmore?page='.$pager->getPreviousPage());?>">上一页</a>
						<?php for($i = 1;$i<=$pager->getLastPage();$i++):?>
							<?php if($i == $pager->getPage()):?>
				    			<a href="javascript:viod(0)" class="on"><?php echo $i;?></a>
				    		<?php else:?>
				    			<a href="<?php echo url_for('@wmore?page='.$i);?>"><?php echo $i;?></a>
				    		<?php endif;?>
				    	<?php endfor;?>
						<a href="<?php echo url_for('@wmore?page='.$pager->getNextPage());?>">下一页</a>
					</div>
				</div>
				<?php endif;?>
			</div>
		</div>
		<div class="r">
			<div class="right_homework">
				<div class="right_title">
					<p>作业提交指南</p>
				</div>
				<div class="inner_text">
					<p><strong>简　介：</strong></p>
					<p>　　家庭教育（亲子教育）已变成一个世界性的课题，有80%的家庭存在着不同程度的青少年心智障碍、逃课厌学、紧张失眠、考试压力、亲子冲突、离家出走、网络成瘾、毒品滥用、就业困惑、性问题、早恋早孕、性爱堕落、盲目追星、意志涣散......</p>
					<p class="last"><a href="#">查看更多 &gt;&gt;</a></p>
				</div>
			</div>
			<?php include_component('home', 'rightbanner');?>
			<?php include_component('home', 'topic');?>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(".one_exp h4 a").click(function(){
		var _this=$(this);
		var _show=$(this).parents("div.one_exp").find("div.hide_exp");
		if($(this).hasClass("on")){		
			_show.slideUp(500,function(){
				_this.removeClass("on").text("展开");
			});
		}
		else{		
			_show.slideDown(500,function(){
				_this.addClass("on").text("收起");
			});
		}
		return false;
	});
</script>