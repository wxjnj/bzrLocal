<?php use_helper('I18N') ?>
<?php echo __('尊敬的四川省班主任家庭教育专业培训平台用户（ %nick_name%）您好！', array('%nick_name%' => $user->getUsername()), 'sf_guard') ?>,<br/><br/>

<?php echo __('这封电子邮件是通知您如何重置您的密码，如果不是您本人操作请忽略此邮件！', null, 'sf_guard') ?><br/><br/>

<?php echo __('您可以在24小时之内点击下面的链接来重置您的密码:', null, 'sf_guard') ?><br/><br/>

<?php echo link_to(__('点击重置密码', null, 'sf_guard'), '@sf_guard_forgot_password_change?unique_key='.$forgot_password->unique_key, 'absolute=true') ?>