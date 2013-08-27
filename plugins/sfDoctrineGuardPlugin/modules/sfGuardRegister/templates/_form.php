<?php use_helper('I18N');use_helper('sfCryptoCaptcha');?>
<script>
$(document).ready(function(){	
	$("#sf_guard_user_username").blur(function(){
	username = $("#sf_guard_user_username").val();
		$.ajax({
		   type: "POST",
		   url: "<?php echo url_for('sfGuardRegister/checkUsername')?>",
		   data: "username="+username,
		   success: function(msg){
			   $("#username_error").html(msg);
			   $("#username_error").show();
		   }
		});
	});
	$("#sf_guard_user_email_address").blur(function(){
		email = $("#sf_guard_user_email_address").val();
			$.ajax({
			   type: "POST",
			   url: "<?php echo url_for('sfGuardRegister/checkEmail')?>",
			   data: "email="+email,
			   success: function(msg){
				   $("#email_error").html(msg);
				   $("#email_error").show();
			   }
			});
	});
	$("#sf_guard_user_password").blur(function(){
		password = $("#sf_guard_user_password").val();
			$.ajax({
			   type: "POST",
			   url: "<?php echo url_for('sfGuardRegister/checkPassword')?>",
			   data: "password="+password,
			   success: function(msg){
				   $("#password_error").html(msg);
				   $("#password_error").show();
			   }
			});
	});
	$("#sf_guard_user_password_again").blur(function(){
		password = $("#sf_guard_user_password").val();
		password_again = $("#sf_guard_user_password_again").val();
			$.ajax({
			   type: "POST",
			   url: "<?php echo url_for('sfGuardRegister/checkPasswordAgain')?>",
			   data: "password="+password+'&password_again='+password_again,
			   success: function(msg){
				   $("#password_again_error").html(msg);
				   $("#password_again_error").show();
			   }
			});
	});

	$("#sf_guard_user_captcha").blur(function(){
		captcha = $("#sf_guard_user_captcha").val();
		$.ajax({
			   type: "POST",
			   url: "<?php echo url_for('sfGuardRegister/checkCaptcha')?>",
			   data: "captcha="+captcha,
			   success: function(msg){
				   $("#captcha_error").html(msg);
				   $("#captcha_error").show();
			   }
		});
	});
	
	$("form").submit(function () {
		return formCheck();
	});
	function formCheck()
	{
		var bool = true;

		username = $("#sf_guard_user_username").val();
		email = $("#sf_guard_user_email_address").val();
		password = $("#sf_guard_user_password").val();
		password_again = $("#sf_guard_user_password_again").val();
		phone = $("#sf_guard_user_phone").val();
		captcha = $("#sf_guard_user_captcha").val();
		
		if($("#sf_guard_user_username").val() == ''){
		     alert("用户名不能为空！请重新输入");
		     $("#sf_guard_user_username").focus();
		     bool = false;
		}
		else if(!$("#sf_guard_user_email_address").val().match(/^(\w)+(\.\w+)*@(\w)+((\.\w+)+)$/)){
		     alert("邮箱格式不正确！请重新输入");
		     $("#sf_guard_user_email_address").focus();
		     bool = false;
		}
		else if($("#sf_guard_user_password").val() == ''){
		     alert("密码不能为空！请重新输入");
		     $("#sf_guard_user_password").focus();
		     bool = false;
		}
		else if(captcha == '')
		{
			$("#captcha_error").html('请输入验证码');
			$("#sf_guard_user_captcha").focus();
			bool = false;
		}
		
		return bool;
	}
});
</script>
<form action="<?php echo url_for('@sf_guard_register') ?>" method="post">
  <?php echo $form->renderHiddenFields(true);?>
  <table class="register">
    <tr>
      <th><?php echo $form['username']->renderLabel(); ?></th>
      <td>
        <?php echo $form['username']->renderError(); ?>
        <?php echo $form['username']->render(); ?>
        <span style="color:red;">*</span>
        <br /><div id="username_error" class="register_error">中文、英文、数字、下划线、3-10个字符</div>
      </td>
    </tr>
    <tr>
      <th><?php echo $form['email_address']->renderLabel(); ?></th>
      <td>
        <?php echo $form['email_address']->renderError(); ?>
        <?php echo $form['email_address']->render(); ?>
        <span style="color:red;">*</span>
        <br /><div class="register_error" id="email_error" style="display:none;"></div>
      </td>
    </tr>
    <tr>
      <th><?php echo $form['password']->renderLabel(); ?></th>
      <td>
        <?php echo $form['password']->renderError(); ?>
        <?php echo $form['password']->render(); ?>
        <span style="color:red;">*</span>
        <br /><div  class="register_error" id="password_error">密码格式必须为数字、字母或特殊符号组成的6-22个字符</div>
      </td>
    </tr>
    <tr>
      <th><?php echo $form['password_again']->renderLabel(); ?></th>
      <td>
        <?php echo $form['password_again']->renderError(); ?>
        <?php echo $form['password_again']->render(); ?>
        <span style="color:red;">*</span>
        <br /><div  class="register_error" id="password_again_error" style="display:none;"></div>
      </td>
    </tr>
    <tr>
      <th><?php echo $form['phone']->renderLabel(); ?></th>
      <td>
        <?php echo $form['phone']->renderError(); ?>
        <?php echo $form['phone']->render(); ?>
        <br /><div  class="register_error" id="phone_error" style="display:none;"></div>
      </td>
    </tr>
	<tr>
      <th><?php echo $form['captcha']->renderLabel('验证码'); ?></th>
      <td>
        <?php echo $form['captcha']->renderError(); ?>
        <?php echo $form['captcha']->render(); ?>
        <span style="color:red;">*</span>
        <?php echo captcha_image(); echo captcha_reload_button(); ?>
        <br /><div  class="register_error" id="captcha_error" style="display:none;"></div>
      </td>
    </tr>
  
    <tfoot>
      <tr>
      	<td></td>
        <td >
          <input type="submit" name="register" value="提交" style="height:25px;width:40px;"/>
        </td>
      </tr>
    </tfoot>
  </table>
</form>
