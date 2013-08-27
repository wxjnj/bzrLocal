<?php include_partial('home/header',array('current_id'=>1));?>
<div class="content_box">
	<div class="detail_title">
		<p>您的当前位置：<a href="#">首页</a> &gt; <a href="#">交流分享</a> &gt; 专家答疑</p>
	</div>
	<div class="expert_cont clearfix">
		<div class="l">
			<div class="edu_expert">
				<div class="right_title">
					<p>院校专家</p>
				</div>
				<div class="edu_list">
					<span class="up"></span>
					<div class="list_inner">
						<ul>
						<?php foreach($experts as $expert):?>
							<li>
								<div class="person">
								<a href="<?php echo url_for('@eshow?token='.$expert->getToken());?>">
								<?php if($expert->getPicture()==''):?>
									<img src="/../../images/img.jpg" />
								<?php else :?>
									<img src="/../../uploads/<?php echo $expert->getPicture();?>" />
								<?php endif;?>
								</a>
								</div>
								<p><strong>姓　　名：</strong><?php echo $expert->getName();?></p>
								<p><strong>研究方向：</strong><?php echo $expert->getJob();?></p>
								<p><a href="<?php echo url_for('@eshow?token='.$expert->getToken());?>">查看更多 &gt;&gt;</a></p>
							</li>
						<?php endforeach;?>
						</ul>
					</div>
					<span class="down"></span>
				</div>
			</div>
		</div>
		<div class="r">
			<div class="expert_askform">
				<p><input type="text" class="text" placeholder="输入问题标题"/></p>
				<p><textarea placeholder="输入问题详细"></textarea></p>
				<p>
					<select>
						<option value="0">选择专家</option>
						<?php foreach($experts as $expert):?>
						<option value="<?php echo $expert->getId();?>"><?php echo $expert;?></option>
						<?php endforeach;?>
					</select>
					<a href="javascript:void(0)">提　交</a>
				</p>
			</div>
			<div class="expert_answer">
				<h4><a href="<?php echo url_for('@qlist?type=finished');?>">已解答问题</a></h4>
				<ul>
				<?php foreach($finish_questions as $finish_question):?>
					<li><a href="<?php echo url_for('@qshow?token='.$finish_question->getToken());?>"><span class="green">[已回答]</span><?php echo Tools::cur_str_utf8($finish_question->getTitle(), 30,0,2)?><span class="person"><?php echo $finish_question->getEname();?></span></a></li>
				<?php endforeach;?>
				</ul>
			</div>
			<div class="expert_answer">
				<h4><a href="<?php echo url_for('@qlist?type=unfinished');?>">未解答问题</a></h4>
				<ul>
				<?php foreach($ufinish_questions as $ufinish_question):?>
					<li><a href="#"><span class="green">[未回答]</span><?php echo Tools::cur_str_utf8($ufinish_question->getTitle(), 30,0,2)?><span class="person"><?php echo $ufinish_question->getEname();?></span></a></li>
				<?php endforeach;?>
				</ul>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var expertChange=function(){
		var n=0;
		var len=$(".list_inner ul li").length;
		var _up=$(".edu_list span.up");
		var _ul=$(".list_inner ul");
		var _h=_ul.find("li").height()+21;
		var _down=$(".edu_list span.down");
		_up.click(function(){
			if(n==0||len<=3||_ul.is(":animated")){
				return false;
			}
			
			n--;
			_ul.animate({"marginTop":-(_h*n)+"px"},500);
		});
		
		_down.click(function(){
			if(n>=(len-3)||len<=3||_ul.is(":animated")){
				return false;
			}			
			n++;
			_ul.animate({"marginTop":-(_h*n)+"px"},500);
		})
	}()
	
	//表单验证
	$(".expert_askform a").click(function(){
		var _title=$.trim($(".expert_askform input").val());
		var _text=$.trim($(".expert_askform textarea").val());
		var _sel=$(".expert_askform select").val();
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
</script>