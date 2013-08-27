<?php include_partial('home/header',array('current_id'=>1));?>
		<div class="content_box">
			<div class="detail_title">
				<p>您的当前位置：<a href="<?php echo url_for(@homepage);?>">首页</a> &gt; <a href="<?php echo url_for(@study);?>">终生学习</a> &gt; <?php echo $name;?></p>
			</div>
			<div class="detail_cont clearfix">
				<div class="l">
					<div class="upload_share">
						<h3><?php echo $name;?></h3>
						<ul>
							<?php foreach($pager as $key=>$value):?>
								<li><a href="<?php echo url_for('@fshow?token='.$value->getToken());?>"><?php echo Tools::cur_str_utf8($value->getTitle(), 30,0,2)?></a></li>
							<?php endforeach;?>
						</ul>
						<?php if($pager->haveToPaginate()):?>
						<div class="page_wrap">
							<div class="page">
								<a href="<?php echo url_for('@fmore?token='.$category_id.'&page='.$pager->getPreviousPage());?>">上一页</a>
								<?php for($i = 1;$i<=$pager->getLastPage();$i++):?>
									<?php if($i == $pager->getPage()):?>
				    					<a href="javascript:viod(0)" class="on"><?php echo $i;?></a>
				    				<?php else:?>
				    					<a href="<?php echo url_for('@fmore?token='.$category_id.'&page='.$i);?>"><?php echo $i;?></a>
				    				<?php endif;?>
				    			<?php endfor;?>
								<a href="<?php echo url_for('@fmore?token='.$category_id.'&page='.$pager->getNextPage());?>">下一页</a>
							</div>
						</div>
						<?php endif;?>
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
	