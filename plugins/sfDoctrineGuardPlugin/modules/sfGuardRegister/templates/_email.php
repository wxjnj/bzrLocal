<?php use_helper('I18N') ?>
<?php echo __('女性e天地的用户（ %username%）您好！', array('%username%' => $user->getUsername()), 'sf_guard') ?>,<br/><br/>

<?php echo __('这封电子邮件是通知您激活论坛的帐号，如果不是您本人操作请忽略此邮件！', null, 'sf_guard') ?><br/><br/>

<?php echo __('您可以点击下面的链接来激活您的帐号:', null, 'sf_guard') ?><br/><br/>

<?php echo link_to(__('点击激活帐号', null, 'sf_guard'), '@email_check?token='.$token, 'absolute=true') ?>