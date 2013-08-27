<?php include_partial('home/header',array('current_id'=>3));?>
<div class="content_box">
	<?php include_partial('home/position',array('current_position'=>'expert'));?>
	<div class="detail_cont clearfix">
		<div class="l">
			<div class="expert_inner">
				<?php if(count($top_experts)!=0):?>
				<div class="groom_expert">
					<h4>领衔专家</h4>
					<div class="one_expert">
						<div class="expert_face">
							<a href="<?php echo url_for('@eshow?token='.$top_experts[0]->getToken());?>">
							<?php if($top_experts[0]->getPicture()==''):?>
							<img src="/../../images/expert.jpg" />
							<?php else :?>
							<img src="/../../uploads/<?php echo $top_experts[0]->getPicture();?>" />
							<?php endif;?>
							</a>
						</div>
						<div class="expert_commend">
							<p><label>姓　　名：</label><em><?php echo $top_experts[0]->getName();?></em></p>
							<p><label>职　　务：</label><em><?php echo $top_experts[0]->getJob();?></em></p>
							<p><label>简　　介：</label><em><?php echo $top_experts[0]->getSubDescription();?></em></p>
							<p><label>研究方向：</label><em><?php echo $top_experts[0]->getDirection();?></em></p>
							<p class="link"><a href="<?php echo url_for('@eshow?token='.$top_experts[0]->getToken());?>">查看更多 &gt;&gt;</a></p>
						</div>
					</div>
				</div>
				<?php endif;?>
				<div class="groom_expert group_expert">
					<h4>专家队伍</h4>
					<div class="expert_list">
					<?php foreach($pager as $value):?>
						<div class="one_expert">
							<div class="expert_face">
								<a href="<?php echo url_for('@eshow?token='.$value->getToken());?>">
								<?php if($value->getPicture()==''):?>
								<img src="/../../images/expert.jpg" />
								<?php else :?>
								<img src="/../../uploads/<?php echo $value->getPicture();?>" />
								<?php endif;?>
								</a>
							</div>
							<div class="expert_commend">
								<p><label>姓　　名：</label><em><?php echo $value->getName();?></em></p>
								<p><label>职　　务：</label><em><?php echo $value->getJob();?></em></p>
								<p><label>简　　介：</label><em><?php echo $value->getSubDescription();?></em></p>
								<p><label>研究方向：</label><em><?php echo $value->getDirection();?></em></p>
								<p class="link"><a href="<?php echo url_for('@eshow?token='.$value->getToken());?>">查看更多 &gt;&gt;</a></p>
							</div>
						</div>
					<?php endforeach;?>	
					</div>
					<?php if($pager->haveToPaginate()):?>
					<div class="page_wrap">
						<div class="page">
							<a href="<?php echo url_for('@emore?page='.$pager->getPreviousPage());?>">上一页</a>
							<?php for($i = 1;$i<=$pager->getLastPage();$i++):?>
								<?php if($i == $pager->getPage()):?>
					    			<a href="javascript:viod(0)" class="on"><?php echo $i;?></a>
					    		<?php else:?>
					    			<a href="<?php echo url_for('@emore?page='.$i);?>"><?php echo $i;?></a>
					    		<?php endif;?>
					    	<?php endfor;?>
							<a href="<?php echo url_for('@emore?page='.$pager->getNextPage());?>">下一页</a>
						</div>
					</div>
					<?php endif;?>
				</div>
			</div>
		</div>
		<div class="r">
			<?php include_component('home', 'rightimages')?>
			<?php include_component('home', 'rightbanner')?>
			<?php include_component('home', 'question')?>
		</div>
	</div>
</div>