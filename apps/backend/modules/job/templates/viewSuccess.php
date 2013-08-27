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
						'position_name'=>'作业详情'));
				?>
				<table class="full-table form-table" cellspacing="0" cellpadding="0" border="0">
				    <tbody>
				      <tr>
				        <th>作业标题</th>
				        <td>
				          <?php echo $job->getWork()->getTitle(); ?>
				        </td>
				      </tr>
				      <tr>
				        <th>作业简介</th>
				        <td>
				          <?php echo $job->getWork()->getSubDescription(); ?>
				        </td>
				      </tr>
				      <tr>
				        <th>作业截至日期</th>
				        <td>
				          <?php echo $job->getWork()->getDateTimeObject('end_time')->format('Y-m-d'); ?>
				        </td>
				      </tr>
				      <?php if($job->getWork()->getVideoUrl() != ''):?>
				      <tr>
				        <th>视频地址</th>
				        <td>
				          <a href="<?php echo $job->getWork()->getVideoUrl();?>">点击观看视频</a>
				        </td>
				      </tr>
				      <?php endif;?>
				      <?php if($job->getWork()->getVideo() != ''):?>
				      <tr>
				        <th>相关文档</th>
				        <td>
				          <a href="/download.php?fullname=<?php echo $job->getWork()->getVideoName();?>&filename=attachment/<?php echo $job->getWork()->getVideo();?>" title="<?php echo $job->getWork()->getTitle();?>" target="_blank"><?php echo $job->getWork()->getVideoName();?></a>
				        </td>
				      </tr>
				      <?php endif;?>
				      <tr>
				        <th>回答标题</th>
				        <td>
				          <?php echo $job->getTitle(); ?>
				        </td>
				      </tr>
				      <tr>
				        <th>回答标题</th>
				        <td>
				          <?php echo $job->getRaw('content'); ?>
				        </td>
				      </tr>
				      <tr>
				        <th>附件：</th>
				        <td>
				          <a href="/download.php?fullname=<?php echo $job->getAttachmentName();?>&filename=attachment/<?php echo $job->getAttachment();?>" title="<?php echo $job->getTitle();?>" target="_blank"><?php echo $job->getAttachmentName();?></a>
				        </td>
				      </tr>
				    </tbody>
				  </table>
			</div>
		</td>
	</tr>
</table>
