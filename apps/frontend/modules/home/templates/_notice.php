<div class="share_notice">
	<div class="right_title">
		<p>网站公告</p>
	</div>
	<ul>
	<?php foreach($notices as $notice):?>
		<li><a href="<?php echo url_for('@nshow?token='.$notice->getToken())?>"><?php echo Tools::cur_str_utf8($notice->getTitle(), 15)?></a></li>
	<?php endforeach;?>
	</ul>
</div>