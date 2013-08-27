<table>
<tr><td>
<div class="navigation">
	<div class="navigationBody">
		<table>
			<tr>
			<td>
			<div class="menu">
				<?php 
				$active = '8';
				$request = sfContext::getInstance()->getRequest();
				if($request->hasParameter('active')){
					$active = $request->getParameter('active');
					$sf_user->setAttribute('linkActiveState',$active);
				}elseif($sf_user->hasAttribute('linkActiveState')){
					$active = $sf_user->getAttribute('linkActiveState');
				}
				?>
				<?php if($sf_user->hasPermission('专家')):?>
				
				<?php else :?>
				
				<?php endif;?>
				<div id="nrglA" class="navigationBodyDiv">
					<ul>
						<li class="title"><span class="arrow_hide"></span><p>集体报名</p></li>
						<li><a <?php if($active==1)echo 'class="active"'?> href="<?php echo url_for('@apply?active=1')?>">集体报名</a></li>
					</ul>
					<ul>
						<li class="title"><span class="arrow_hide"></span><p>专家答疑</p></li>
						<li><a <?php if($active==2)echo 'class="active"'?> href="<?php echo url_for('@question?active=2')?>">专家答疑</a></li>
						<li><a <?php if($active==211)echo 'class="active"'?> href="<?php echo url_for('@myquestion?active=211')?>">我的答疑</a></li>
					</ul>
					<ul>
						<li class="title"><span class="arrow_hide"></span><p>视频课程</p></li>
						<li><a <?php if($active==3)echo 'class="active"'?> href="<?php echo url_for('@video?active=3')?>">视频课程</a></li>
					</ul>
					<ul>
						<li class="title"><span class="arrow_hide"></span><p>站内公告</p></li>
						<li><a <?php if($active==4)echo 'class="active"'?> href="<?php echo url_for('@notice?active=4')?>">站内公告</a></li>
					</ul>
					<ul>
						<li class="title"><span class="arrow_hide"></span><p>终生学习</p></li>
						<li><a <?php if($active==5)echo 'class="active"'?> href="<?php echo url_for('@share?active=5')?>">学员分享</a></li>
						<li><a <?php if($active==15)echo 'class="active"'?> href="<?php echo url_for('@myshare?active=15')?>">我的分享</a></li>
						<li><a <?php if($active==6)echo 'class="active"'?> href="<?php echo url_for('@expert?active=6')?>">院校专家</a></li>
						<li><a <?php if($active==7)echo 'class="active"'?> href="<?php echo url_for('@category?active=7')?>">分类管理</a></li>
						<li><a <?php if($active==8)echo 'class="active"'?> href="<?php echo url_for('@my_file?active=8')?>">我的文件</a></li>
						<li><a <?php if($active==9)echo 'class="active"'?> href="<?php echo url_for('@file?active=9')?>">所有文件</a></li>
						<li><a <?php if($active==10)echo 'class="active"'?> href="<?php echo url_for('@my_need_add?active=10')?>">我提出的需求</a></li>
						<li><a <?php if($active==11)echo 'class="active"'?> href="<?php echo url_for('@my_need_answer?active=11')?>">我回答的需求</a></li>
						<li><a <?php if($active==12)echo 'class="active"'?> href="<?php echo url_for('@need?active=12')?>">所有需求</a></li>
						<li><a <?php if($active==13)echo 'class="active"'?> href="<?php echo url_for('@activity?active=13')?>">近期活动</a></li>
						<li><a <?php if($active==14)echo 'class="active"'?> href="<?php echo url_for('@work?active=14')?>">作业专区</a></li>
						<li><a <?php if($active==212)echo 'class="active"'?> href="<?php echo url_for('@myclasses?active=212')?>">我的班级</a></li>
						<li><a <?php if($active==213)echo 'class="active"'?> href="<?php echo url_for('@mywork?active=213')?>">我的作业</a></li>
						<li><a <?php if($active==214)echo 'class="active"'?> href="<?php echo url_for('@myjob?active=214')?>">我完成的作业</a></li>
					</ul>
					<ul>
						<li class="title"><span class="arrow_hide"></span><p>系统管理</p></li>
						<li><a <?php if($active==201)echo 'class="active"'?> href="<?php echo url_for('@user?type=student&active=201')?>">学生管理</a></li>
						<li><a <?php if($active==202)echo 'class="active"'?> href="<?php echo url_for('@user?type=teacher&active=202')?>">老师管理</a></li>
						<li><a <?php if($active==203)echo 'class="active"'?> href="<?php echo url_for('@passwordModify?active=203')?>">修改密码</a></li>
						<li><a <?php if($active==204)echo 'class="active"'?> href="<?php echo url_for('@role?active=204')?>">角色管理</a></li>
						<li><a <?php if($active==209)echo 'class="active"'?> href="<?php echo url_for('@permission?active=209')?>">权限管理</a></li>
						<li><a <?php if($active==205)echo 'class="active"'?> href="<?php echo url_for('@images?active=205')?>">轮播图片管理</a></li>
						<li><a <?php if($active==206)echo 'class="active"'?> href="<?php echo url_for('@link?active=206')?>">参与单位管理</a></li>
						<li><a <?php if($active==207)echo 'class="active"'?> href="<?php echo url_for('@topic?active=207')?>">精彩推荐管理</a></li>
						<li><a <?php if($active==208)echo 'class="active"'?> href="<?php echo url_for('@case?active=208')?>">成功案例管理</a></li>
						<li><a <?php if($active==210)echo 'class="active"'?> href="<?php echo url_for('@advertising?active=210')?>">广告图片管理</a></li>
					</ul>
				</div>
			</div>
			</td>
			</tr>
		</table>
	</div>
</div>
</td></tr>
</table>