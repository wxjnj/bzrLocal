<div class="right_commend">
	<div class="right_title">
		<p>最新需求</p>
		<a href="<?php echo url_for('@add_need');?>" class="link_more">提需求</a>
	</div>
	<ul>
	<?php foreach($needs as $needs):?>
		<li><a href="#"><?php echo Tools::cur_str_utf8($needs->getTitle(), 12)?></a></li>
	<?php endforeach;?>						
	</ul>
</div>