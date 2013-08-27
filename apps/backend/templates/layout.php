<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <title>
    	<?php if (!include_slot('title')): ?>
		   四川省班主任家庭教育专业培训平台
		<?php endif ?>
    </title>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <?php 
  	if($sf_user->hasAttribute('style'))
  	{
  		$style = $sf_user->getAttribute('style');
  	}
  	else
  	{
  		$style = "style0";
  	}
  ?>
  <body class="<?php echo $style?>">
  	<div class="header">
  		<?php include_partial('admin/header') ?>
  	</div>
  	<div class="separator">
  	</div>
  	<div class="main">
  		<?php echo $sf_content ?>
  	</div>
  </body>
</html>


