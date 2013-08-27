<?php 
use_helper('I18N');
use_helper('sfCryptoCaptcha');
?>
<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
  <?php echo $form->renderHiddenFields();?>
  <ul>
	<li>
		<span><input type="radio" name="type" class="radio" checked="checked" value="学生" />学 员</span>
		<span><input type="radio" name="type" class="radio" value="专家" />专 家</span>
		<span><input type="radio" name="type" class="radio" value="管理" />管 理</span>
	</li>
  </ul>
  <table>
    <tbody>
      <tr>
        <td>用户名：</td>
        <td>
          <?php echo $form['username'] ?><br />
          <?php echo $form['username']->renderError() ?>
        </td>
        <td></td>
      </tr>
      <tr>
        <td>密　码：</td>
        <td>
          <?php echo $form['password'] ?><br />
          <?php echo $form['password']->renderError() ?>
        </td>
         <td> </td>
      </tr>
      <tr>
        <td>验证码：</td>
        <td>
          <?php echo $form['captcha'] ?>
          <?php echo captcha_image(); echo captcha_reload_button(); ?><br />
          <?php echo $form['captcha']->renderError() ?>
        </td>
        <td></td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
      	<td></td>
        <td colspan="2">
          <input class="login_btn" type="submit" value="确　定"/>
          
          <a href="<?php echo url_for('@sf_guard_forgot_password') ?>" class="loss_password">忘记密码？</a>

          <?php if (isset($routes['sf_guard_register'])): ?>
            &nbsp; <a href="<?php echo url_for('@sf_guard_register') ?>"><?php echo __('Want to register?', null, 'sf_guard') ?></a>
          <?php endif; ?>
        </td>
      </tr>
    </tfoot>
  </table>
</form>