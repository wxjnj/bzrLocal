<?php include_partial('home/header',array('current_id'=>1));?>
<div class="content_box">
	<div class="detail_title">
		<p>您的当前位置：<a href="<?php echo url_for('@homepage');?>">首页</a> &gt; 网站公告</p>
	</div>
	<div class="detail_cont clearfix">
		<div class="l">
			<div class="notice_list">	
				<ul>
				<?php foreach($pager as $key=>$value):?>
					<li <?php if(($key+1)%5 == 0) echo 'class="border_li"';?>><span>[<?php echo $value->getDateTimeObject('created_at')->format('Y-m-d')?>]</span><a href="<?php echo url_for('@nshow?token='.$value->getToken());?>"><?php echo Tools::cur_str_utf8($value->getTitle(), 30,0,2)?></a></li>
				<?php endforeach;?>
				</ul>
				<?php if($pager->haveToPaginate()):?>
				<div class="page_wrap">
					<div class="page">
						<a href="<?php echo url_for('@nmore?page='.$pager->getPreviousPage());?>">上一页</a>
						<?php for($i = 1;$i<=$pager->getLastPage();$i++):?>
							<?php if($i == $pager->getPage()):?>
				    			<a href="javascript:viod(0)" class="on"><?php echo $i;?></a>
				    		<?php else:?>
				    			<a href="<?php echo url_for('@nmore?page='.$i);?>"><?php echo $i;?></a>
				    		<?php endif;?>
				    	<?php endfor;?>
						<a href="<?php echo url_for('@nmore?page='.$pager->getNextPage());?>">下一页</a>
					</div>
				</div>
				<?php endif;?>
			</div>	
		</div>
		<div class="r">
			<?php include_component('home', 'rightimages')?>
			<?php include_component('home', 'rightbanner')?>
			<?php include_component('home', 'topic')?>
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