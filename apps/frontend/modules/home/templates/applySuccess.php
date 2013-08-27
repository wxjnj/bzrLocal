<?php include_partial('home/header',array('current_id'=>5));?>
<div class="content_box">
	<?php include_partial('home/position',array('current_position'=>'apply'));?>
	<div class="detail_cont clearfix">
		<div class="l">
			<div class="green_enter">
				<ul>
					<li>
						<label>单位名称：</label>
						<input type="text" class="text" id="name"/>
					</li>
					<li>
						<label>联 系 人：</label>
						<input type="text" class="text" id="person"/>
					</li>
					<li>
						<label>联系地址：</label>
						<input type="text" class="text" id="address"/>
					</li>
					<li>
						<label>联系电话：</label>
						<input type="text" class="text" id="tel"/>
					</li>
					<li>
						<label>留　　言：</label>
						<textarea></textarea>
					</li>
					<li class="last"><a href="javascript:void(0)">提交</a></li>
				</ul>
				<p class="green_tips">注：本站工作人员将在您提交信息的3个工作日内与您联系</p>
			</div>					
		</div>
		<div class="r">
			<?php include_component('home', 'rightimages');?>				
			<?php include_component('home', 'rightbanner');?>
			<?php include_component('home', 'contact');?>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(".green_enter li.last a").click(function(){
		var _name=$.trim($("#name").val());
		var _person=$.trim($("#person").val());
		var _add=$.trim($("#address").val());
		var _tel=$.trim($("#tel").val());
		var _commed=$.trim($("textarea").val());
		
		if(_name==""){
			alert("请输入单位名称！");return false;
		}
		else if(_person==""){
			alert("请输入联系人！");return false;
		}
		else if(_add==""){
			alert("请输入联系地址");return false;
		}
		else if(_tel==""){
			alert("请输入联系电话");return false;
		}

		$.ajax({
			   type: "POST",
			   url: "<?php echo url_for('@ajax_add_apply')?>",
			   data: "name="+_name+'&person='+_person+'&add='+_add+'&tel='+_tel+'&commed='+_commed,
			   success: function(msg){
				   if(msg == 2){
						alert('请您先登录！');
						location.reload();
				   }
				   else if(msg == 1){
					   alert('提交成功，我们的工作人员会在3个工作日内与您联系！');
					   location.reload();
				   }else{
					   alert('提交失败！');return false;
				   }
			   }
		});
	});
</script>