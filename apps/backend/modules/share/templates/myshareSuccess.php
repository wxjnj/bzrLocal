<table width="100%">
	<tr>
		<td width="180px" valign="top">
			<?php 
				include_partial('admin/left');
			?>
		</td>
		<td valign="top">
			<div>
				<?php if($sf_user->getFlash('notice')):?>
				<div class="flash_notice"><?php echo $sf_user->getFlash('notice')?></div>
				<?php endif;?>
				<table class="list-table hoverchangle" cellspacing="0"
					cellpadding="0">

					<thead>
						<tr>
							<th colspan="10" class="hd-title">
								<div class="layout">
									<div class="layout-l user-title">◆&nbsp;学员分享</div>
									<div class="layout-r user-new"><?php echo link_to('添加分享','@share_new');?></div>
								</div>
							</th>
						</tr>
						<tr>
							<th width="4%">ID</th>
							<th width="66%">标题</th>
							<th width="10%">分享日期</th>
							<th width="20%">操作</th>
						</tr>
					</thead>
					<tbody>
				    <?php foreach ($pager as $key => $object): ?>
				    <tr>
						<td><?php echo $object->getId() ?></td>
						<td><?php echo $object->getTitle();?></td>
						<td><?php echo $object->getDateTimeObject('created_at')->format('Y-m-d')?></td>
						<td>
						<?php if($object->getIsRank() != 1):?>
						<?php echo link_to('编辑','@share_edit?id='.$object->getId())?>
						<?php endif;?>
				      	<?php echo link_to('删除','@share_delete?id='.$object->getId(),array('method'=>'delete','confirm'=>'确定删除？'));?>
				        </td>
					</tr>
				    <?php endforeach; ?>
				    <?php if($pager->haveToPaginate()):?>
				    <tr>
				    	<?php $ex_param ='';?>
				    	<td colspan="4">
				    		共&nbsp;<?php echo $pager->getLastPage()?>&nbsp;页/<?php echo $pager->getNbResults()?>条记录&nbsp;
				    		<a
								href="<?php echo url_for('@pager?module=share&action=myshare'.$ex_param.'&page=1');?>">首页</a>&nbsp;
				    		<?php if($pager->getPage() != 1):?>
				    		
				    		<a
								href="<?php echo url_for('@pager?module=share&action=myshare'.$ex_param.'&page='.$pager->getPreviousPage());?>">上页</a>&nbsp;
				    		<?php endif;?>
				    		<?php for($i = 1;$i<=$pager->getLastPage();$i++):?>
				    			<?php if($i == $pager->getPage()):?>
				    			<b><?php echo $i;?></b>&nbsp;
				    			<?php else:?>
				    			<a
								href="<?php echo url_for('@pager?module=share&action=myshare'.$ex_param.'&page='.$i);?>"><?php echo $i;?></a>&nbsp;
				    			<?php endif;?>
				    		<?php endfor;?>
				    		<?php if($pager->getPage() != $pager->getLastPage()):?>
				    		<a
								href="<?php echo url_for('@pager?module=share&action=myshare'.$ex_param.'&page='.$pager->getNextPage());?>">下页</a>&nbsp;
				    		<?php endif;?>
				    		
				    		<a
								href="<?php echo url_for('@pager?module=share&action=myshare'.$ex_param.'&page='.$pager->getLastPage());?>">末页</a>
							</td>
					</tr>
					<?php endif;?>
					</tbody>

				</table>
			</div>
		</td>
	</tr>
</table>