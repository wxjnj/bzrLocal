<div class="right_banner">
	<?php if($right_banner[0]->getUrl() != ''):?>
					<a href="<?php echo $right_banner[0]->getUrl();?>">
				<?php else: ?>
					<a href="<?php echo url_for('@show?type=Advertising&id='.$right_banner[0]->getId());?>">
				<?php endif;?>
						<img src="/../../uploads/<?php echo $right_banner[0]->getPicture();?>" />
					</a>
</div>
