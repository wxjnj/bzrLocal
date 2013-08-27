<div class="-title"></div>
<div class="operate">
  	<span>当前用户：<?php echo $sf_user?></span>
	<span>当前角色：<?php $group = $sf_user->getGuardUser()->getGroups(); echo $group[0];?></span>
	<span><?php echo link_to('【退出】','sf_guard_signout');?></span>
	<span><a href="/help/help.doc" target="_blank" title="帮助">帮助</a></span>
	<span><a href="/" target="_blank" title="首页预览">首页预览</a></span>
</div>