<?php use_helper('I18N') ?>
<?php echo __('尊敬的四川省班主任家庭教育专业培训平台用户（ %nick_name%）您好！', array('%nick_name%' => $user->getUsername()), 'sf_guard') ?>,

<?php echo __('下面是您的用户名和新密码:') ?> 

<?php echo __('用户名', null, 'sf_guard') ?>: <?php echo $user->getUsername() ?> 
<?php echo __('密码', null, 'sf_guard') ?>: <?php echo $password ?>