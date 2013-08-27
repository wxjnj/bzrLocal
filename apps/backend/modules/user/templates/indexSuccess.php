<table width="100%">
  	<tr>
		<td width="180px" valign="top"><?php include_partial('admin/left') ?></td>
		<td valign="top">
			<div class="content-main">
				<?php if($sf_user->getFlash('notice')):?>
				<div class="flash_notice"><?php echo $sf_user->getFlash('notice')?></div>
				<?php endif;?>
					<table class="search-table" cellspacing="0" cellpadding="0">
						<tr>
							<td align="center">
								<form action="<?php echo url_for('@user?type='.$type)?>" method="get">
											<script type="text/javascript">


			function doValidate()
			  {
				var value = $("#search_username").val();
				
			   vkeyWords=/^[^`~!@#$%^&*()+=|\\\][\]\{\}:;'\,.<>/?]{1}[^`~!@$%^&()+=|\\\][\]\{\}:;'\,.<>?]{0,19}$/;
			   if(value==null || value=="")
			   {
			    alert("请输入正确的查询参数");
			    return false;
			   }
			   if(!vkeyWords.test(value))
			   {
			    alert("您输入的查询参数不正确,请重新输入!");
			    $("#keyword").val("");
			    return false;
			   }   
			   return true;
			  }


</script>
								<table class="search-table2" cellspacing="0" cellpadding="0" border="0">
									<tr>
										<td></td>
										<td>用户名：&nbsp;</td>
										<td><input type="text" class="text" value="" name="search_username" id="search_username"/></td>
										<td>&nbsp;<input type="submit" class="input-search" value="" onclick="return doValidate() " /></td>
									</tr>
								</table>
			
								</form>
							</td>
						</tr>
					</table>
				
				<table class="list-table" cellspacing="0" cellpadding="0">
				  <thead>
				    <tr>
				      <th colspan="8" class="hd-title">
				      	<div class="layout">
				      		<div class="layout-l user-title"><b><?php echo $type=='student'?'学生管理':'老师管理'?></b></div>
				      		<div class="layout-r user-new">
				      			<a href="<?php echo url_for('user/new') ?>">添加用户</a>
				      		</div>
				      	</div>
				      
				      </th>
				    </tr>
				    <tr>
				      <th>Id</th>
				      <th>用户名</th>
				      <th>角色</th>
				      <th>昵称</th>
				      <th>状态</th>
				      <th>积分</th>
				      <th>最后登录</th>
				      <th>操作</th>
				    </tr>
				  </thead>
				  <tbody>
				    <?php foreach ($pager->getResults() as $key => $sf_guard_user): ?>
				    <tr>
				      <td><?php echo $sf_guard_user->getId() ?></td>
				      <td><?php echo $sf_guard_user->getUsername() ?></td>
				      <td>
				      <?php foreach($sf_guard_user->getGroups() as $value): ?>
				      <?php echo $value;?><br />
				      <?php endforeach;?>
				      </td>
				      <td><?php echo $sf_guard_user->getNickName() ?></td>
				      <td><?php echo $sf_guard_user->getActiveState() ?></td>
				      <td><?php echo $sf_guard_user->getExperience() ?></td>
				      <td><?php echo $sf_guard_user->getLastLogin() ?></td>
				      <td>
				      	
				      	<?php 
				      			if($sf_guard_user->getIsActive())
				      				echo link_to('禁用','@user_active?id='.$sf_guard_user->getId());
				      			else
				      				echo link_to('激活','@user_active?id='.$sf_guard_user->getId());
				      	
				      	?>
				      	
				      	<a href="<?php echo url_for('user/edit?id='.$sf_guard_user->getId()) ?>">修改</a>&nbsp;|&nbsp;
				      	<a href="<?php echo url_for('@user_delete?id='.$sf_guard_user->getId()) ?>" onclick="return confirm('确定删除？')">删除</a>
				      	
				      </td>
				    </tr>
				    <?php endforeach; ?>
				    <tr>
				    	<?php 
			    		    $ex_param ='';
			    			if($searchRoute != '')
			    				$ex_param = '&'.$searchRoute;
			    		?>
				    	<td colspan="8">
				    		共&nbsp;<?php echo $pager->getLastPage()?>&nbsp;页/<?php echo $pager->getNbResults()?>条记录&nbsp;
				    		<a href="<?php echo url_for('@pager?module=user&action=index&type='.$type.$ex_param.'&page=1');?>">首页</a>&nbsp;
				    		<?php if($pager->getPage() != 1):?>
				    		
				    		<a href="<?php echo url_for('@pager?module=user&action=index&type='.$type.$ex_param.'&page='.$pager->getPreviousPage());?>">上页</a>&nbsp;
				    		<?php endif;?>
				    		<?php for($i = 1;$i<=$pager->getLastPage();$i++):?>
				    			<?php if($i == $pager->getPage()):?>
				    			<b><?php echo $i;?></b>&nbsp;
				    			<?php else:?>
				    			<a href="<?php echo url_for('@pager?module=user&action=index&type='.$type.$ex_param.'&page='.$i);?>"><?php echo $i;?></a>&nbsp;
				    			<?php endif;?>
				    		<?php endfor;?>
				    		<?php if($pager->getPage() != $pager->getLastPage()):?>
				    		<a href="<?php echo url_for('@pager?module=user&action=index&type='.$type.$ex_param.'&page='.$pager->getNextPage());?>">下页</a>&nbsp;
				    		<?php endif;?>
				    		
				    		<a href="<?php echo url_for('@pager?module=user&action=index&type='.$type.$ex_param.'&page='.$pager->getLastPage());?>">末页</a>
				    	</td>
				    </tr>
				    
				  </tbody>
				</table>
				
				  
			</div>
		
		</td>
	</tr>
</table>





