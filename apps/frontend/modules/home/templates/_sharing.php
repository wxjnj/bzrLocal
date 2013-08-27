<div class="share_notice">
	<div class="right_title">
		<p>分享动态</p>
	</div>
	<ul>
	<?php foreach($files as $file):?>
		<li>
		<a href="javascript:void(0)"><strong>[<?php echo $file->getUname();?>] </strong>
		提交了
		<?php if($file->getCategoryId() == 1):?>
		课件
		<?php elseif($file->getCategoryId() == 2):?>
		视频
		<?php elseif($file->getCategoryId() == 3):?>
		图书
		<?php endif;?>
		</a>
		</li>
	<?php endforeach;?>
	</ul>
</div>