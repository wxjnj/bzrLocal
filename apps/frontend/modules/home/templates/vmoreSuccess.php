<?php include_partial('home/header',array('current_id'=>1));?>
<div class="content_box">
	<div class="detail_title">
		<p>您的当前位置：<a href="<?php echo url_for('@homepage');?>">首页</a> &gt; <a href="#">网上培训</a> &gt; 视频课程</p>
	</div>
	<div class="view_cont">
		<div class="view_group">
			<ul class="clearfix">
			<?php foreach($pager as $key=>$value):?>
				<li>
					<a href="<?php echo url_for('@videoshow?token='.$value->getToken());?>">
						<img src="images/img.jpg" />
						<span class="view png"></span>
					</a>							
					<span class="fifter_bg"></span>
					<a href="<?php echo url_for('@videoshow?token='.$value->getToken());?>" class="fifter_txt"><span>[<?php echo $value->getExperter();?>]</span><?php echo Tools::cur_str_utf8($value->getTitle(), 10,0,2)?></a>
				</li>
			<?php endforeach;?>
			</ul>
			<?php if($pager->haveToPaginate()):?>
			<div class="page_wrap">
				<div class="page">
					<a href="<?php echo url_for('@vmore?page='.$pager->getPreviousPage());?>">上一页</a>
					<?php for($i = 1;$i<=$pager->getLastPage();$i++):?>
						<?php if($i == $pager->getPage()):?>
			    			<a href="javascript:viod(0)" class="on"><?php echo $i;?></a>
			    		<?php else:?>
			    			<a href="<?php echo url_for('@vmore?page='.$i);?>"><?php echo $i;?></a>
			    		<?php endif;?>
			    	<?php endfor;?>
					<a href="<?php echo url_for('@vmore?page='.$pager->getNextPage());?>">下一页</a>
				</div>
			</div>
			<?php endif;?>
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