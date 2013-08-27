<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" >
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <title>
    	<?php if (!include_slot('title')): ?>
		    四川省班主任家庭教育专业培训平台
		<?php endif ?>
    </title>
    <meta name="description" content="四川省班主任家庭教育专业培训平台" />
    <meta name="keywords" content="四川省班主任家庭教育专业培训平台" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <meta name="baidu-site-verification" content="SKA56GODW8C187iA" />
    <meta name="robots" content="all" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
    <!--[if IE 6]>
	<script type="text/javascript" src="scripts/png.js"></script>
	<script type="text/javascript">
	  DD_belatedPNG.fix('.png');
	</script>
	<![endif]-->
  </head>
  <body>
  	<div class="top_nav">
		<div class="inner">
			<a href="#" class="set_index">设为首页</a>
			<a href="#" class="set_join">加入收藏</a>
		</div>
	</div>
	<div class="box">
		<?php echo $sf_content ?>
	</div>
	<div class="footer">
		<p>Copyright &copy; 2007-2013  All Rights Reserved 版权所有·江苏省网上家长学校 四川省家庭教育网</p>
	</div>
  </body>
</html>
