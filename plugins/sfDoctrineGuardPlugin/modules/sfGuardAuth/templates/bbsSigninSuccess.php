<?php use_helper('I18N');use_helper('sfCryptoCaptcha'); ?>
<style>
table tr td,table tr th{padding-top:5px;}
</style>
<div id="header">
    <div class="m_wrap">
         
         <div class="m_rt tebie">
             <div class="top">
		<?php include_partial('home/topU');?>
	</div>
    <div class="m-path-link">
        <?php include_partial('home/mpath');?><span class="m_color">></span>登录
    </div>
    <div class="m-registerWrap">
        <h2 class="m_login">登录</h2>
        <div class="m-register">
            <?php if($sf_user->getFlash('error_login')):?>
				<div class="flash_notice"><?php echo $sf_user->getFlash('error_login')?></div>
			<?php endif;?>
			<?php if($sf_user->getFlash('notice')):?>
				<div class="flash_notice"><?php echo $sf_user->getFlash('notice')?></div>
			<?php endif;?>
			
			<form action="<?php echo url_for('@bbs_guard_signin') ?>" method="post">
			  <?php echo $form->renderHiddenFields();?>
			  <?php //echo $form->renderGlobalErrors() ?>
			  <table width="100%">
			    <tbody>
			      <tr>
			        <th><?php echo $form['username']->renderLabel() ?></th>
			        <td >
			          <?php echo $form['username'] ?>
			        </td>
			        <td> <?php echo $form['username']->renderError() ?></td>
			      </tr>
			      <tr>
			        <th><?php echo $form['password']->renderLabel() ?></th>
			        <td >
			          <?php echo $form['password'] ?>
			        </td>
			         <td> <?php echo $form['password']->renderError() ?></td>
			      </tr>
			      <tr>
			        <th><?php echo $form['captcha']->renderLabel() ?></th>
			        <td>
			          <?php echo $form['captcha'] ?>
			        </td>
			        <td> <?php echo $form['captcha']->renderError() ?></td>
			      </tr>
			      <tr>
			        <td></td>
			        <td><?php echo captcha_image(); echo captcha_reload_button(); ?></td>
			        <td></td>
			      </tr>
			      <tr>
			      	<td></td>
					<td>
					<label for="signin_remember">记住登录状态</label>
					<input id="signin_remember" type="checkbox" name="signin[remember]">
					</td>
				  </tr>
			    </tbody>
			    <tfoot>
			      <tr>
			        <td colspan="3">
			          <input class="m-zc" type="submit" value="登录" />
			          <input class="m-cancle" type="reset" value="重置" />
			          
			          <?php $routes = $sf_context->getRouting()->getRoutes(); ?>
			          <?php if (isset($routes['sf_guard_forgot_password'])): ?>
			            <a href="<?php echo url_for('@sf_guard_forgot_password') ?>"><?php echo __('忘记密码?', null, 'sf_guard') ?></a>
			          <?php endif; ?>
			
			          <?php if (isset($routes['sf_guard_register'])): ?>
			            &nbsp; <a href="<?php echo url_for('@sf_guard_register') ?>"><?php echo __('注册?', null, 'sf_guard') ?></a>
			          <?php endif; ?>
			        </td>
			      </tr>
			    </tfoot>
			  </table>
			</form>
        </div>
    </div>
         </div>
    </div>

</div>
<?php include_partial('home/footer');?>