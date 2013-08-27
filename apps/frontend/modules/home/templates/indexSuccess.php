<div class="banner_1">
	<?php if($top_banner[0]->getUrl() != ''):?>
		<a href="<?php echo $top_banner[0]->getUrl();?>">
	<?php else: ?>
		<a href="<?php echo url_for('@show?type=Advertising&id='.$top_banner[0]->getId());?>">
	<?php endif;?>
		<img src="/../../uploads/<?php echo $top_banner[0]->getPicture();?>" />
	</a>
</div>
<div class="cont_top clearfix">
	<div class="l" id="play_pic">
		<div class="slide_pic">
			<ul>
			<?php foreach($images as $image):?>
				<li>
				<?php if($image->getUrl() != ''):?>
					<a href="<?php echo $image->getUrl();?>">
				<?php else: ?>
					<a href="<?php echo url_for('@show?type=Images&id='.$image->getId());?>">
				<?php endif;?>
						<img src="/../../uploads/<?php echo $image->getPicture();?>" />
						<span><?php echo Tools::cur_str_utf8($image->getTitle(), 15,0,2)?></span>
					</a>							
				</li>
			<?php endforeach;?>	
			</ul>
			<div class="slide_num">
				
			</div>
		</div>
	</div>
	<div class="r">
		<div class="r_notice">
			<div class="text_title">
				网站公告		
				<a href="<?php echo url_for('@nmore');?>" class="link_more">查看更多 &gt;&gt;</a>			
			</div>
			<ul class="clearfix">
			<?php foreach($notices as $notice):?>
				<li><span>[<?php echo $notice->getDateTimeObject('created_at')->format('Y-m-d')?>]</span><a href="<?php echo url_for('@nshow?token='.$notice->getToken());?>"><?php echo Tools::cur_str_utf8($notice->getTitle(), 15,0,2)?></a></li>
			<?php endforeach;?>
			</ul>
		</div>
		<div class="r_group">
			<div class="text_title">
					QQ群
			</div>
			<div class="group_num clearfix">
				<a href="#"><span class="n">56752311</span><span class="j">加入</span></a>
				<a href="#"><span class="n">56752311</span><span class="j">加入</span></a>
				<a href="#"><span class="n">56752311</span><span class="j">加入</span></a>
				<a href="#"><span class="n">56752311</span><span class="j">加入</span></a>
				<a href="#"><span class="n">56752311</span><span class="j">加入</span></a>
				<a href="#"><span class="n">56752311</span><span class="j">加入</span></a>
			</div>
		</div>
	</div>
</div>
<div class="cont_nor cont_train">
	<div class="cont_title">
		<p>网上培训</p>
	</div>
	<div class="cont_wrap clearfix">
		<div class="l">
			<div class="text_title view_title">
				视频课程
				<a href="<?php echo url_for('@vmore');?>" class="link_more">查看更多 &gt;&gt;</a>
			</div>
			<div class="show_exp clearfix">
				<div class="show_l">
					<a href="<?php echo url_for('@videoshow?token='.$videos[0]->getToken());?>">
						<img src="/../../images/img.jpg" />
						<span class="view_start png"></span>
					</a>
				</div>
				<div class="show_r">
					<h4><?php echo Tools::cur_str_utf8($videos[0]->getTitle(), 15,0,2)?></h4>
					<p><a href="<?php echo url_for('@videoshow?token='.$videos[0]->getToken());?>">主讲人：  <strong><?php echo $videos[0]->getExperter();?></strong></a></p>
					<p><a href="<?php echo url_for('@videoshow?token='.$videos[0]->getToken());?>">简 介：<?php echo Tools::cur_str_utf8($videos[0]->getSubDescription(), 45)?></a></p>
				</div>
			</div>
			<ul>
			<?php foreach($videos as $key=>$video):?>
			<?php if($key == 0) continue;?>
				<li><a href="<?php echo url_for('@videoshow?token='.$video->getToken());?>"><strong><?php echo $video->getExperter();?>：</strong><?php echo Tools::cur_str_utf8($video->getTitle(), 20,0,2)?></a></li>
			<?php endforeach;?>
			</ul>
		</div>
		<div class="r">
			<div class="text_title homework_title">
				作业专区
				<a href="<?php echo url_for('@wmore');?>" class="link_more">查看更多 &gt;&gt;</a>
			</div>
			<div class="show_exp clearfix">
				<div class="show_l">
					<a href="#">
					<?php if($works[0]->getPicture() != ''):?>
						<img src="/../../uploads/<?php echo $works[0]->getPicture();?>" />
					<?php else: ?>
						<img src="/images/img.jpg" />
					<?php endif;?>
					</a>
				</div>
				<div class="show_r">
					<h4><?php echo Tools::cur_str_utf8($works[0]->getTitle(), 15,0,2)?></h4>
					<p><a href="#">简 介：<?php echo Tools::cur_str_utf8($works[0]->getSubDescription(), 45)?></a></p>
					<p class="more_txt"><a href="#">[详细]</a></p>
				</div>
			</div>
			<ul>
			<?php foreach($works as $key=>$work):?>
			<?php if($key == 0) continue;?>
				<li><a href="/backend.php/job_new/token/<?php echo $work->getToken()?>.html" target="_blank"><?php echo Tools::cur_str_utf8($work->getTitle(), 20,0,2)?></a></li>
			<?php endforeach;?>
			</ul>
		</div>
	</div>
</div>
<div class="cont_nor cont_share">
	<div class="cont_title">
		<p>交流分享</p>
	</div>
	<div class="cont_wrap clearfix">
		<div class="l">
			<div class="text_title person_title">
				专家答疑
				<a href="<?php echo url_for('@qmore');?>" class="link_more">查看更多 &gt;&gt;</a>
			</div>
			<div class="share_ask clearfix">
				<div class="ask_l">
					<p><input type="text" placeholder="输入问题标题" /></p>
					<p class="ask_textarea"><textarea placeholder="输入问题详细"></textarea></p>
				</div>
				<div class="ask_r">
					<select>
						<option value="0">选择专家</option>
						<?php foreach($experts as $expert):?>
						<option value="<?php echo $expert->getId();?>"><?php echo $expert->getName();?></option>
						<?php endforeach;?>
					</select>
					<a href="javascript:void(0)">提　交</a>
				</div>
			</div>
			<ul class="none_bg">
			<?php foreach($finish_questions as $question):?>
				<li><a href="<?php echo url_for('@qshow?token='.$question->getToken());?>"><span class="green">[已回答]</span><?php echo Tools::cur_str_utf8($question->getTitle(), 18,0,2)?><span class="answer_person"><?php echo $question->getEname();?></span></a></li>
			<?php endforeach;?>
			</ul>
		</div>
		<div class="r">
			<div class="text_title share_title">
				学员分享
				<a href="<?php echo url_for('@smore');?>" class="link_more">查看更多 &gt;&gt;</a>
			</div>
			<div class="show_exp clearfix">
				<div class="show_l">
					<a href="<?php echo url_for('@shareshow?token='.$shares[0]->getToken());?>">
					<?php if($shares[0]->getPicture() != ''):?>
						<img src="/../../uploads/<?php echo $shares[0]->getPicture();?>" />
					<?php else: ?>
						<img src="/images/img.jpg" />
					<?php endif;?>
					</a>
				</div>
				<div class="show_r">
					<h4><?php echo Tools::cur_str_utf8($shares[0]->getTitle(), 15,0,2)?></h4>
					<p><a href="<?php echo url_for('@shareshow?token='.$shares[0]->getToken());?>">简 介：<?php echo Tools::cur_str_utf8($shares[0]->getSubDescription(), 45)?></a></p>
					<p class="more_txt"><a href="<?php echo url_for('@shareshow?token='.$shares[0]->getToken());?>">[详细]</a></p>
				</div>
			</div>
			<ul>
			<?php foreach($shares as $key=>$share):?>
			<?php if($key == 0) continue;?>
				<li><a href="<?php echo url_for('@shareshow?token='.$share->getToken());?>"><?php echo Tools::cur_str_utf8($share->getTitle(), 20,0,2)?><span class="answer_person"><?php echo $share->getUname();?></span></a></li>
			<?php endforeach;?>
			</ul>
		</div>
	</div>
</div>
<div class="banner_1">
	<?php if($center_banner[0]->getUrl() != ''):?>
		<a href="<?php echo $center_banner[0]->getUrl();?>">
	<?php else: ?>
		<a href="<?php echo url_for('@show?type=Advertising&id='.$center_banner[0]->getId());?>">
	<?php endif;?>
		<img src="/../../uploads/<?php echo $center_banner[0]->getPicture();?>" />
	</a>
</div>
<div class="cont_nor cont_study">
	<div class="cont_title">
		<p><a href="<?php echo url_for('@study');?>" style="color:#DDE7ED;">终生学习</a></p>
		<div class="cont_title_r">
			当前已有<span><?php echo $file_num;?></span>份文档<a href="<?php echo url_for('@document');?>"></a>
		</div>
	</div>
	<div class="cont_wrap clearfix">
		<div class="study_l">
			<div class="text_title study_title">
				课件
				<a href="<?php echo url_for('@fmore?token=1');?>" class="link_more">查看更多 &gt;&gt;</a>
			</div>
			<div class="study_text">
				<a href="<?php echo url_for('@fshow?token='.$kejians[0]->getToken());?>">
				<?php if($kejians[0]->getPicture()==''):?>
				<img src="/../../images/img.jpg" class="study_show"/>
				<?php else:?>
				<img src="/../../uploads/<?php echo $kejians[0]->getPicture();?>" class="study_show"/>
				<?php endif;?>
				</a>
				<h4><?php echo Tools::cur_str_utf8($kejians[0]->getTitle(), 20,0,2)?></h4>
				<ul>
				<?php foreach($kejians as $key=>$kejian):?>
				<?php if($key == 0) continue;?>
					<li><a href="<?php echo url_for('@fshow?token='.$kejian->getToken());?>"><?php echo Tools::cur_str_utf8($kejian->getTitle(), 20,0,2)?></a></li>
				<?php endforeach;?>
				</ul>
			</div>
		</div>
		<div class="study_l study_m">
			<div class="text_title study_title">
				视频
				<a href="<?php echo url_for('@fmore?token=2');?>" class="link_more">查看更多 &gt;&gt;</a>
			</div>
			<div class="study_text">
				<a href="<?php echo url_for('@fshow?token='.$shipins[0]->getToken());?>">
				<?php if($shipins[0]->getPicture()==''):?>
				<img src="/../../images/img.jpg" class="study_show"/>
				<?php else:?>
				<img src="/../../uploads/<?php echo $shipins[0]->getPicture();?>" class="study_show"/>
				<?php endif;?>
				</a>
				<h4><?php echo Tools::cur_str_utf8($shipins[0]->getTitle(), 20,0,2)?></h4>
				<ul>
				<?php foreach($shipins as $key=>$shipin):?>
				<?php if($key == 0) continue;?>
					<li><a href="<?php echo url_for('@fshow?token='.$shipin->getToken());?>"><?php echo Tools::cur_str_utf8($shipin->getTitle(), 20,0,2)?></a></li>
				<?php endforeach;?>
				</ul>
			</div>
		</div>
		<div class="study_l study_r">
			<div class="text_title study_title">
				图书
				<a href="<?php echo url_for('@fmore?token=3');?>" class="link_more">查看更多 &gt;&gt;</a>
			</div>
			<div class="study_text">
				<a href="<?php echo url_for('@fshow?token='.$tushus[0]->getToken());?>">
				<?php if($tushus[0]->getPicture()==''):?>
				<img src="/../../images/img.jpg" class="study_show"/>
				<?php else:?>
				<img src="/../../uploads/<?php echo $tushus[0]->getPicture();?>" class="study_show"/>
				<?php endif;?>
				</a>
				<h4><?php echo Tools::cur_str_utf8($tushus[0]->getTitle(), 20,0,2)?></h4>
				<ul>
				<?php foreach($tushus as $key=>$tushu):?>
				<?php if($key == 0) continue;?>
					<li><a href="<?php echo url_for('@fshow?token='.$tushu->getToken());?>"><?php echo Tools::cur_str_utf8($tushu->getTitle(), 20,0,2)?></a></li>
				<?php endforeach;?>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="cont_nor cont_cooper">
	<div class="cont_title">
		<p>合作单位</p>
	</div>
	<div class="cont_wrap clearfix">
		<div class="l">
			<div class="text_title join_title">
				参与单位
			</div>
			<div class="contact_wrap">
				<ul class="clearfix">
				<?php foreach($links as $link):?>
					<li><a href="<?php echo $link->getUrl();?>"><?php echo $link->getTitle();?></a></li>
				<?php endforeach;?>
				</ul>
			</div>
		</div>
		<div class="r">
			<div class="text_title exp_title">
				成功案例
			</div>
			<ul>
			<?php foreach($cases as $case):?>
				<li>
				<?php if($case->getUrl() != ''):?>
					<a href="<?php echo $case->getUrl();?>">
				<?php else: ?>
					<a href="<?php echo url_for('@show?id='.$case->getId().'&type=SuccessCase');?>">
				<?php endif;?>
				<?php echo Tools::cur_str_utf8($notice->getTitle(), 20,0,2)?>
				</a>
				</li>
			<?php endforeach;?>
			</ul>
		</div>
	</div>
</div>

<script type="text/javascript">
	//幻灯片
	var slideFunction=function(oD){
		var oDiv=oD.find("div.slide_pic");
		var oNum=oD.find("div.slide_num");
		var _li=oDiv.find("li");
		var oWidth=_li.width();		
		var n=_li.length;
		var _start=0;//初始值
		var str=[];
		var inter;
		for(var i=0;i<n;i++){
			str[str.length]="<span></span>";
		}
		oNum.html(str.join(""));
		//默认载入所有li定位到右侧 第一个显示
		_li.css({"left":oWidth+"px"});
		_li.eq(0).css({"left":"0px"});
		oNum.find("span:eq(0)").addClass("on");
		
		//单个点击
		oNum.find("span").click(function(){
			if($(this).hasClass("on")||_li.is(":animated")){
				return false;
			}		
			var _inx=$(this).index();
			_start=_inx;
			var _last=oNum.find("span.on").index();
			$(this).addClass("on").siblings().removeClass("on");
			if(_inx>_last){  //往右点击
				_li.eq(_inx).css({"zIndex":"10","left":oWidth+"px"}).animate({left:"0px"},500);
				_li.eq(_last).css({"zIndex":"1"}).animate({left:-oWidth+"px"},500,function(){
					_li.eq(_last).css({"left":-oWidth+"px"});
				});
			}
			else if(_inx<_last){//往左点击
				_li.eq(_inx).css({"zIndex":"10","left":-oWidth+"px"}).animate({left:"0px"},500);
				_li.eq(_last).css({"zIndex":"1"}).animate({left:oWidth+"px"},500,function(){
					_li.eq(_last).css({"left":-oWidth+"px"});
				});
			}
		})
		
		//自动播放
		function interFn(){
			var _last=oNum.find("span.on").index();
			if(_start<(n-1)){
				_start++;
				oNum.find("span").eq(_start).addClass("on").siblings().removeClass("on");
				_li.eq(_start).css({"zIndex":"10","left":oWidth+"px"}).animate({left:"0px"},500);
				_li.eq(_last).css({"zIndex":"1"}).animate({left:-oWidth+"px"},500,function(){
					_li.eq(_last).css({"left":-oWidth+"px"});
				});
			}
			else{
				_start=0;
				oNum.find("span").eq(_start).addClass("on").siblings().removeClass("on");
				_li.eq(_start).css({"zIndex":"10","left":-oWidth+"px"}).animate({left:"0px"},500);
				_li.eq(_last).css({"zIndex":"1"}).animate({left:oWidth+"px"},500,function(){
					_li.eq(_last).css({"left":-oWidth+"px"});
				});
			}
		}
		
		inter=setInterval(interFn,5000);
		
		//清除
		oNum.find("span").mousedown(function(){
			clearInterval(inter);
		});
		oNum.find("span").mouseup(function(){
			inter=setInterval(interFn,5000);
		})
		
	}
	slideFunction($("#play_pic"));
	
	//验证
	$(".share_ask a").click(function(){
		var _title=$.trim($(".share_ask input").val());
		var _text=$.trim($(".share_ask textarea").val());
		var _sel=$(".share_ask select").val();
		if(_title==""){
			alert("请输入问题标题！");return false;
		}
		else if(_text==""){
			alert("请输入问题内容！");return false;
		}
		else if(_sel==0){
			alert("请选择专家");return false;
		}

		$.ajax({
		   type: "POST",
		   url: "<?php echo url_for('@ajax_add_question')?>",
		   data: "title="+_title+'&text='+_text+'&expert='+_sel,
		   success: function(msg){
			   if(msg == 2){
					alert('请您先登录！');
					location.reload();
			   }
			   else if(msg == 1){
				   alert('提交成功，请耐心等待专家答复！');
				   location.reload();
			   }else{
				   alert('提交失败！');return false;
			   }
		   }
		});
	});
	
	//合作单位滚动
	
	var contactAni=function(){
		var _oD=$(".contact_wrap");
		var _oUl=_oD.find("ul");
		var _h=_oUl.find("li").height();
		var _inter;
		if(_oUl.height()<=_oD.height()){
			return false;
		}
		
		function _setTime(){
			_oUl.animate({"marginTop":-_h+"px"},500,function(){
				_oUl.find("li:lt(2)").appendTo(_oUl);
				_oUl.css("marginTop","0px");
			})
		}
		
		_inter=setInterval(_setTime,3000);
		
		_oUl.mouseover(function(){
			clearInterval(_inter);
		}).mouseleave(function(){
			_inter=setInterval(_setTime,3000);
		})
	}()
</script>