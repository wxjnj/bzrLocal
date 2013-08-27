<?php include_partial('home/header',array('current_id'=>3));?>
<div class="content_box">
	<div class="detail_title">
		<p>您的当前位置：<a href="#">首页</a> &gt; 院校专家</p>
	</div>
	<div class="detail_cont clearfix">
		<div class="l">
			<div class="expert_inner">
				<div class="groom_expert">
					<div class="one_expert">
						<div class="expert_face">
							<?php if($content->getPicture()==''):?>
								<img src="/../../images/expert.jpg" />
							<?php else :?>
								<img src="/../../uploads/<?php echo $content->getPicture();?>" />
							<?php endif;?>
						</div>
						<div class="expert_commend">
							<p><label>姓　　名：</label><em><?php echo $content->getName();?></em></p>
							<p><label>职　　务：</label><em><?php echo $content->getJob();?></em></p>
							<p><label>简　　介：</label><em><?php echo $content->getSubDescription();?></em></p>
							<p><label>研究方向：</label><em><?php echo $content->getDirection();?></em></p>
						</div>
					</div>
				</div>			
				<div class="groom_expertdetail">
					<?php echo $content->getRaw('description');?>
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