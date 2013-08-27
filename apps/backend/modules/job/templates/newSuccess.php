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
						'route'=>'@work',
						'route_name'=>'作业专区',
						'position_name'=>'完成作业'));
				?>
				<?php include_partial('form', array('form' => $form,'work'=>$work)) ?>
			</div>
		
		</td>
	</tr>
</table>
