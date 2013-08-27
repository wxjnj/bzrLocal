<?php include_partial('home/header',array('current_id'=>1));?>
		<div class="content_box">
			<div class="detail_title">
				<p>您的当前位置：<a href="<?php echo url_for(@homepage);?>">首页</a> &gt; <a href="<?php echo url_for(@study);?>">终生学习</a> &gt; 精品推荐</p>
			</div>
			<div class="detail_cont clearfix">
				<div class="l">
					<div class="comment_tips">
						<a href="<?php echo url_for('@frecomm?token=1')?>" <?php if($category_id == 1) echo 'class="on"';?>>课件</a>
						<a href="<?php echo url_for('@frecomm?token=2')?>" <?php if($category_id == 2) echo 'class="on"';?>>视频</a>
						<a href="<?php echo url_for('@frecomm?token=3')?>" <?php if($category_id == 3) echo 'class="on"';?>>图书</a>
					</div>
					<div class="commend_inner">
						<div class="commend_product">
							<ul>
							    <?php foreach($pager as $key=>$value):?>
								<li class="clearfix">
									<div class="face">
										<a href="#"><img src="images/expert.jpg" /></a>
									</div>
									<div class="txt">
										<p><a href="<?php echo url_for('@fshow?token='.$value->getToken());?>"><strong><?php echo Tools::cur_str_utf8($value->getTitle(), 30,0,2)?></strong></a></p>
										<p>简　介：</p>
										<p><?php echo Tools::cur_str_utf8($value->getSub_description(), 30,0,2)?></p>
										<p class="last"><a href="<?php echo url_for('@fshow?token='.$value->getToken());?>">查看更多 &gt;&gt;</a></p>
									</div>
								</li>
								<?php endforeach;?>			
							</ul>
							<?php if($pager->haveToPaginate()):?>
							<div class="page_wrap">
								<div class="page">
									<a href="<?php echo url_for('@frecomm?token='.$category_id.'&page='.$pager->getPreviousPage());?>">上一页</a>
									<?php for($i = 1;$i<=$pager->getLastPage();$i++):?>
										<?php if($i == $pager->getPage()):?>
				    						<a href="javascript:viod(0)" class="on"><?php echo $i;?></a>
				    					<?php else:?>
				    						<a href="<?php echo url_for('@frecomm?token='.$category_id.'&page='.$i);?>"><?php echo $i;?></a>
				    					<?php endif;?>
				    				<?php endfor;?>
									<a href="<?php echo url_for('@frecomm?token='.$category_id.'&page='.$pager->getNextPage());?>">下一页</a>
								</div>
							</div>
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
	