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
									<div class="layout-l user-title">◆&nbsp;所有文档</div>
								</div>
							</th>
						</tr>
						<tr>
							<th width="4%">ID</th>
							<th width="16%">标题</th>
							<th width="10%">简介</th>
							<th width="10%">分类</th>
							<th width="10%">关键词</th>
							<th width="10%">售价</th>
							<th width="10%">是否隐私</th>
							<th width="10%">上传者</th>
							<th width="10%">上传日期</th>
							<th width="10%">操作</th>
						</tr>
					</thead>
					<tbody>
				    <?php foreach ($pager as $key => $object): ?>
				    <tr>
						<td><?php echo $object->getId() ?></td>
						<td><?php echo $object->getTitle();?></td>
						<td><?php echo $object->getSubDescription();?></td>
						<td><?php echo $object->getCname();?></td>
						<td><?php echo $object->getKeywords();?></td>
						<td><?php echo $object->getPrice();?></td>
						<td><?php echo $object->getIsSecurity()=='1'?'是':'否';?></td>
						<td><?php echo $object->getUname();?></td>
						<td><?php echo $object->getDateTimeObject('created_at')->format('Y-m-d')?></td>
						<td>
						<?php if($object->getIsRank() == 0):?>
						<?php echo link_to('推荐','@file_rank?id='.$object->getId())?>
						<?php else :?>
						<?php echo link_to('取消推荐','@file_unrank?id='.$object->getId())?>
						<?php endif;?>
						<?php echo link_to('编辑','@file_edit?id='.$object->getId())?>
				      	<?php echo link_to('删除','@file_delete?id='.$object->getId(),array('method'=>'delete','confirm'=>'确定删除？'));?>
				        </td>
					</tr>
				    <?php endforeach; ?>
				    <?php if($pager->haveToPaginate()):?>
				    <tr>
				    	<?php $ex_param ='';?>
				    	<td colspan="4">
				    		共&nbsp;<?php echo $pager->getLastPage()?>&nbsp;页/<?php echo $pager->getNbResults()?>条记录&nbsp;
				    		<a
								href="<?php echo url_for('@pager?module=file&action=index'.$ex_param.'&page=1');?>">首页</a>&nbsp;
				    		<?php if($pager->getPage() != 1):?>
				    		
				    		<a
								href="<?php echo url_for('@pager?module=file&action=index'.$ex_param.'&page='.$pager->getPreviousPage());?>">上页</a>&nbsp;
				    		<?php endif;?>
				    		<?php for($i = 1;$i<=$pager->getLastPage();$i++):?>
				    			<?php if($i == $pager->getPage()):?>
				    			<b><?php echo $i;?></b>&nbsp;
				    			<?php else:?>
				    			<a
								href="<?php echo url_for('@pager?module=file&action=index'.$ex_param.'&page='.$i);?>"><?php echo $i;?></a>&nbsp;
				    			<?php endif;?>
				    		<?php endfor;?>
				    		<?php if($pager->getPage() != $pager->getLastPage()):?>
				    		<a
								href="<?php echo url_for('@pager?module=file&action=index'.$ex_param.'&page='.$pager->getNextPage());?>">下页</a>&nbsp;
				    		<?php endif;?>
				    		
				    		<a
								href="<?php echo url_for('@pager?module=file&action=index'.$ex_param.'&page='.$pager->getLastPage());?>">末页</a>
							</td>
					</tr>
					<?php endif;?>
					</tbody>

				</table>
			</div>
		</td>
	</tr>
</table>