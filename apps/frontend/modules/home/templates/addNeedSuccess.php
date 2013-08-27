<?php include_partial('home/header',array('current_id'=>4));?>
<div class="content_box">
	<div class="detail_title">
		<p>您的当前位置：<a href="#">首页</a> &gt; <a href="#">终生学习</a> &gt; 提需求</p>
	</div>
	<div class="detail_cont clearfix">
		<div class="l">
			<div class="ask_need">
				<div class="need_box">
					<p>
						<label>标　　题：</label>
						<input type="text" class="text" id="title"/>
					</p>
					<p>
						<label>详细内容：</label>
						<textarea></textarea>
					</p>
					<p>
						<label>悬赏分值：</label>
						<input type="text" class="text small_text" id="num"/>
						<a href="javascript:void(0)">提　交</a>
					</p>
				</div>
				<ul>
				<?php foreach($un_finish_nees as $need):?>
					<li><a href="<?php echo url_for('@needshow?token='.$need->getToken());?>"><?php echo Tools::cur_str_utf8($need->getTitle(), 25)?></a><strong><a href="<?php echo url_for('@needshow?token='.$need->getToken());?>">我要回答</a></strong></li>
				<?php endforeach;?>
				</ul>
			</div>	
		</div>
		<div class="r">
			<?php include_component('home', 'userandactivity');?>
			<?php include_component('home', 'hotdocument');?>
			<?php include_component('home', 'newneed');?>
			<?php include_component('home', 'rightbanner');?>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(".need_box a").click(function(){
		var _title=$.trim($("#title").val());
		var _cont=$.trim($(".need_box textarea").val());
		var _num=$.trim($("#num").val());
		if(_title==""){ //255
			alert("请输入标题！");return false;
		}
		if(_title.length>255){
			alert("标题内容不能超过255个字符！");return false;
		}
		else if(_cont==""){  //2000
			alert("请输入详细内容！");return false;
		}
		else if(_cont.length>2000){
			alert("详细内容不能超过2000个字符！");return false;
		}
		else if(!(!/[^\d]/g.test(_num)&&parseInt(_num)>0||_num=="")){  //可以为空如果填写必须是正整数
			alert("请输入合法悬赏分值！");return false;
		}			
		
		$.ajax({
			   type: "POST",
			   url: "<?php echo url_for('@ajax_add_need')?>",
			   data: "title="+_title+'&content='+_cont+'&price='+_num,
			   success: function(msg){
				   if(msg == 2){
						alert('请您先登录！');
						location.reload();
				   }else if(msg == 3){
					   alert('您的积分不足，不能设置此悬赏分值，请调整您的分值后再尝试提交！');
					   return false;
				   }
				   else if(msg == 1){
					   alert('提交成功！');
					   location.reload();
				   }else{
					   alert('提交失败！');return false;
				   }
			   }
		});
	});
</script>
