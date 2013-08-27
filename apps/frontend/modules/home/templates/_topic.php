<div class="right_commend">
	<div class="right_title">
		<p>精彩推荐</p>
	</div>
	<ul>
	<?php foreach($topics as $topic):?>
		<li>
		<?php if($topic->getUrl() != ''):?>
			<a href="<?php echo $topic->getUrl();?>">
		<?php else: ?>
			<a href="<?php echo url_for('@show?id='.$topic->getId().'&type=Topic');?>">
		<?php endif;?>
		<?php echo Tools::cur_str_utf8($topic->getTitle(), 15)?>
		</a>
		</li>
	<?php endforeach;?>
	</ul>
</div>