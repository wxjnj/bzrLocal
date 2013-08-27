<div class="right_expert">
	<div class="right_title">
		<p>专家答疑</p>
	</div>
	<ul>
		<li><input type="text" class="text" placeholder="输入问题标题"/></li>
		<li><textarea placeholder="输入问题详细"></textarea></li>
		<li>
			<select>
				<option value="0">选择专家</option>
				<?php foreach($experts as $expert):?>
				<option value="<?php echo $expert->getId();?>"><?php echo $expert->getName();?></option>
				<?php endforeach;?>
			</select>
		</li>
		<li><a href="javascript:void(0)">提交</a></li>
	</ul>
</div>
<script type="text/javascript">
	//验证
	$(".right_expert a").click(function(){
		var _title=$.trim($(".right_expert input").val());
		var _text=$.trim($(".right_expert textarea").val());
		var _sel=$(".right_expert select").val();
	
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