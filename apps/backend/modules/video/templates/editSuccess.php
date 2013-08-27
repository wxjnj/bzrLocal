<table width="100%">
  	<tr>
		<td width="180px" valign="top">
			<?php 
				include_partial('admin/left');
			?>
		</td>
		<td valign="top">
			<div class="content-main">
				<?php if($sf_user->getFlash('notice')):?>
				<div class="flash_notice"><?php echo $sf_user->getFlash('notice')?></div>
				<?php endif;?>
				<?php include_partial('admin/position',array(
						'route'=>'@video',
						'route_name'=>'视频教程',
						'position_name'=>'编辑'));
				?>
				<?php include_partial('form', array('form' => $form)) ?>
			</div>
		
		</td>
	</tr>
</table>
