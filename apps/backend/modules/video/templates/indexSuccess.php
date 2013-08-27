<table width="100%">
  	<tr>
		<td width="180px" valign="top"><?php include_partial('admin/left') ?></td>
		<td valign="top">
			<div>
				<?php if($sf_user->getFlash('notice')):?>
				<div class="flash_notice"><?php echo $sf_user->getFlash('notice')?></div>
				<?php endif;?>
				<table class="list-table" cellspacing="0" cellpadding="0">
					
				  <thead>
				    <tr>
				      <th colspan="10" class="hd-title">
				      	<div class="layout">
				      		<div class="layout-l user-title">◆&nbsp;视频库</div>
				      		<div class="layout-r user-new"><?php echo link_to('上传视频','@video_new');?></div>
				      	</div>
				      </th>
				    </tr>
				    <tr>
				      <th width="4%">ID</th>
				      <th >讲座名称</th>
				      <th >专家</th>
				      <th width="170">视频截图</th>
				      <th width="100">操作</th>
				    </tr>
				  </thead>
				  <tbody>
			   		<?php foreach($pager as $object):?>
			   		<tr>
			   			<td><?php echo $object->getId()?></td>
			   			<td><?php echo $object->getTitle()?></td>
			   			<td><?php echo $object->getExperter()?></td>
			   			<td><img src="<?php echo $object->getThumbnailsPath()?>" width="160" height="90"/></td>
			   			<td>
			   			<?php echo link_to('编辑','@video_edit?id='.$object->getId())?>
			   			<?php echo link_to('删除','@video_delete?id='.$object->getId(), array('method' => 'delete', 'confirm' => '您确定要删除吗？'));?>
			   			</td>
				    </tr>
			   	    <?php endforeach;?>
			   	    <?php if($pager->haveToPaginate()):?>
				    <tr>
				    	<td colspan="5">
				    		共&nbsp;<?php echo $pager->getLastPage()?>&nbsp;页/<?php echo $pager->getNbResults()?>条记录&nbsp;
				    		<a href="<?php echo url_for('@pager?module=video&action=index&page=1');?>">首页</a>&nbsp;
				    		<?php if($pager->getPage() != 1):?>
				    		
				    		<a href="<?php echo url_for('@pager?module=video&action=index&page='.$pager->getPreviousPage());?>">上页</a>&nbsp;
				    		<?php endif;?>
				    		<?php if( ($pager->getPage()-2) > 1):?>
							<a href="<?php echo url_for('@pager?module=video&action=index&page=1');?>">1</a>
							...
							<?php endif;?>
							<?php if(($tmp = $pager->getPage()-2)>=1):?>
							<a href="<?php echo url_for('@pager?module=video&action=index&page='.$tmp);?>"><?php echo $tmp;?></a>
							<?php endif;?>
							<?php if(($tmp = $pager->getPage()-1)>=1):?>
							<a href="<?php echo url_for('@pager?module=video&action=index&page='.$tmp);?>"><?php echo $tmp;?></a>
							<?php endif;?>
							<a href="<?php echo url_for('@pager?module=video&action=index&page='.$pager->getPage());?>"><?php echo $pager->getPage();?></a>&nbsp;
							<?php if(($tmp = $pager->getPage()+1)<=$pager->getLastPage()):?>
							<a href="<?php echo url_for('@pager?module=video&action=index&page='.$tmp);?>"><?php echo $tmp;?></a>
							<?php endif;?>
							<?php if(($tmp = $pager->getPage()+2)<=$pager->getLastPage()):?>
							<a href="<?php echo url_for('@pager?module=video&action=index&page='.$tmp);?>"><?php echo $tmp;?></a>
							<?php endif;?>
							<?php if(($pager->getPage()+2) < $pager->getLastPage()):?>
							...
							<a href="<?php echo url_for('@pager?module=video&action=index&page='.$pager->getLastPage());?>"><?php echo $pager->getLastPage();?></a>
							<?php endif;?>
				    		<?php if($pager->getPage() != $pager->getLastPage()):?>
				    		<a href="<?php echo url_for('@pager?module=video&action=index&page='.$pager->getNextPage());?>">下页</a>&nbsp;
				    		<?php endif;?>
				    		
				    		<a href="<?php echo url_for('@pager?module=video&action=index&page='.$pager->getLastPage());?>">末页</a>
				    	</td>
				    </tr>
				    <?php endif;?>
				  </tbody>
				  
				</table>
			</div>
		</td>
	</tr>
</table>
