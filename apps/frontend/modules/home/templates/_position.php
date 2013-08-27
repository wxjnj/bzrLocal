<div class="detail_title">
	<p>
	您的当前位置：<a href="<?php echo url_for('@homepage');?>">首页</a> &gt; 
	<?php if($current_position == 'expert'):?>
	院校专家
	<?php elseif($current_position == 'apply') :?>
	集体报名绿色通道
	<?php endif;?>
	</p>
</div>