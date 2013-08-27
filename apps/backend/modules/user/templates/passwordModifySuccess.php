

<table width="100%">
  	<tr>
		<td width="180px" valign="top"><?php include_partial('admin/left') ?></td>
		<td valign="top">
			
			<div class="content-main">
				<?php if($sf_user->getFlash('notice')):?>
				<div class="flash_notice"><?php echo $sf_user->getFlash('notice')?></div>
				<?php endif;?>
				<?php include_partial('admin/position',array('route'=>null,'route_name'=>'系统管理','position_name'=>'修改密码'));?>
				<form action="<?php echo url_for('user/passwordModify')?>" method="post">
					<table  class="full-table form-table" cellspacing="0" cellpadding="0" border="0">
						<tr>
							<td width="100">原始密码：</td>
							<td>
								<input type="password" name="oldPassword" id="oldPassword"/>
								<span style="color:red" class="error" id="oldPasswordError">* 不能少于3个字符。</span>
							</td>
						</tr>
						<tr>
							<td>新密码：</td>
							<td>
								<input type="password" name="newPassword" id="newPassword"/>
								<span style="color:red" class="error" id="newPasswordError">* 不能少于3个字符。</span>
							</td>
						</tr>
						<tr>
							<td>原再次确认：</td>
							<td>
								<input type="password" name="newPassword2" id="newPassword2"/>
								<span style="color:red " class="error" id="newPasswordError2">* 两次密码不一致。</span>
							
							</td>
						</tr>
					</table>
					<table class="full-table form-button-table" cellspacing="0" cellpadding="0" border="0">
						<tr>
							<td width="80px">
				
							</td>
							<td width="100px">
								<input type="submit" value="" class="input-submit" id="submit"/>
							</td>
							<td></td>
						</tr>
					</table>
				</form>
			</div>
		
		</td>
	</tr>
</table>
<script>
$(function(){
	$('.error').hide();
	$('#submit').click(function(){
		var oldPassword = $('#oldPassword').val();
		var newPassword = $('#newPassword').val();
		var newPassword2 = $('#newPassword2').val();

		if(oldPassword.length <= 3){
			$('#oldPasswordError').show();
			return false;
		}
		if(newPassword.length <= 3){
			$('#newPasswordError').show();
			return false;
		}
		if(newPassword2 != newPassword){
			$('#newPasswordError2').show();
			return false;
		}
	});
	
})
</script>

