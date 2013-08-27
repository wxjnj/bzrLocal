<?php 
use_helper('sfCryptoCaptcha');
?>
<div class="login">	
	<div class="inner">
		<?php if(!$sf_user->isAuthenticated()):?>
		<form action="<?php echo url_for('@bbs_frontend_signin') ?>" method="post" name="login">
			<?php echo $form->renderHiddenFields();?>
			<label>用户名：<?php echo $form['username'] ?><?php echo $form['username']->renderError() ?></label>
			<label>密码：<?php echo $form['password'] ?><?php echo $form['password']->renderError() ?></label>
			<label>验证码：<?php echo $form['captcha'] ?><?php echo $form['captcha']->renderError() ?></label>
			<label><?php echo captcha_image(); echo captcha_reload_button(); ?></label>
			<input type="submit" class="submit" value="" />
			<a class="register" href=""></a>
		</form>
		<?php else:?>
		欢迎您，<?php echo $sf_user;?>
		<?php echo link_to('安全退出','@sf_guard_signout',array('class'=>'signout'));?>
		<?php endif;?>
	</div>
</div>