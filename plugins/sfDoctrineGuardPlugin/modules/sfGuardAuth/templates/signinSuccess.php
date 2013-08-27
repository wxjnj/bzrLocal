<body class="set_login">
	<div class="inner_login">
		<h3>四川省班主任家庭教育专业培训平台</h3>
		<div class="wrap_login clearfix">
			<div class="login_l">
				<ul class="clearfix">
					<li><a href="#">使用说明</a></li>
					<li><a href="#">登录问题</a></li>
					<li class="on last"><a href="#">求助信息</a></li>
				</ul>
				<div class="login_msg">
					<div class="txt">
						<p>这里放的是使用说明内容</p>
					</div>
					<div class="txt">
						<p>这里放的是登录问题内容</p>
					</div>
					<div class="txt showtext">
						<p>管理员 Q Q：8238527</p>
						<p>管理员邮箱：8238527@163.com</p>
						<p>管理员电话：025-86695136</p>
					</div>
				</div>
			</div>
			<div class="login_r">
				<h4>用户登录</h4>
				<?php if($sf_user->getFlash('notice')):?>
				<div class="flash_notice"><?php echo $sf_user->getFlash('notice')?></div>
				<?php endif;?>
				<?php echo get_partial('sfGuardAuth/signin_form', array('form' => $form)) ?>
			</div>
		</div>
		<div class="login_tips">
			<div class="tips_txt">
				<p><strong>温馨提示：</strong></p>
				<p><label>1.</label><em>使用该平台的学员用户，“用户名”等于师训编号；</em></p>
				<p><label>2.</label><em>因为网络方面的问题，密码找回的邮件通知可能出现无法收到的现象，请老师联系本校的校级管理员进行“发送密码”操作，或者致电客服中  心进行人工找回，给您带来的不便深表歉意，谢谢您的配合！</em></p>
				<p><label></label><em>客服电话：<span>025-83662591</span></em></p>
			</div>
		</div>
		<div class="login_tipsbg png"></div>
		<div class="login_footer">
			<p>Copyright &copy; 2007-2013  All Rights Reserved 版权所有·江苏省网上家长学校 四川省家庭教育网 </p>
		</div>
	</div>
</body>
<script type="text/javascript" src="/js/jquery.js"></script>
<!--[if IE 6]>
<script type="text/javascript" src="scripts/png.js"></script>
<script type="text/javascript">
  DD_belatedPNG.fix('.png');
</script>
<![endif]-->
<script type="text/javascript">
	$(".login_l ul li a").click(function(){
		var _par=$(this).parent();
		if(_par.hasClass("on")){
			return false;
		}
		
		_par.addClass("on").siblings().removeClass("on");
		$(".login_msg").find("div.txt").eq(_par.index()).addClass("showtext").siblings().removeClass("showtext");
		return false;
	});
	
	//登录前端验证
	$(".login_btn").click(function(){
		var _name=$.trim($("#signin_username").val());
		var _password=$.trim($("#signin_password").val());
		var _checkword=$.trim($("#signin_captcha").val());
		if(_name==""){
			alert("请输入用户名！");return false;
		}
		else if(_password==""){
			alert("请输入密码！");return false;
		}
		else if(_checkword==""){
			alert("请输入验证码");return false;
		}
		
		return true;
	});
</script>