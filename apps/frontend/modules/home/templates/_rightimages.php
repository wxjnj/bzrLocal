<div class="pic_news" id="play_pic">
	<div class="right_title">
		<p>图片新闻</p>
	</div>
	<div class="inner_pic">
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
						<span><?php echo Tools::cur_str_utf8($image->getTitle(), 10,0,2)?></span>
					</a>							
				</li>
			<?php endforeach;?>
			</ul>
			<div class="slide_num">
				
			</div>
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
</script>