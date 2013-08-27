<div class="right_commend">
	<div class="right_title">
		<p>热门文档</p>
	</div>
	<ul>
	<?php foreach($documents as $document):?>
		<li><a href="<?php echo url_for('@fshow?token='.$document->getToken());?>"><span class="blue">[<?php echo $document->getCname();?>]</span><?php echo Tools::cur_str_utf8($document->getTitle(), 15)?></a></li>
	<?php endforeach;?>
	</ul>
</div>