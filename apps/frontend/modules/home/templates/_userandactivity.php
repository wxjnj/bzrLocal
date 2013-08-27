<div class="right_person">
	<div class="person_message">
		<h4>欢迎回来，<span class="blue"><?php echo $sf_user->getGuardUser()->getNickName();?></span></h4>
		<h4>积　　分：<span class="blue"><?php echo $sf_user->getGuardUser()->getExperience();?></span></h4>
		<h4><span><?php echo link_to('【退出】','sf_guard_signout');?></span></h4>
	</div>
	<div class="person_active">
		<h4>近期活动：</h4>
		<ul>
		<?php foreach($activities as $activity):?>
			<li><a href="<?php echo url_for('@ashow?token='.$activity->getToken());?>"><?php echo Tools::cur_str_utf8($activity->getTitle(), 12)?><span>[<a href="<?php echo url_for('@ashow?token='.$activity->getToken());?>">查看</a>]</span></a></li>
		<?php endforeach;?>
		</ul>
	</div>
</div>