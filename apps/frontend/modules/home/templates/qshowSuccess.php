<?php include_partial('home/header',array('current_id'=>1));?>
<div class="content_box">
	<div class="detail_title">
		<p>您的当前位置：<a href="<?php echo url_for('@homepage');?>">首页</a> &gt; <a href="#">交流分享</a> &gt; <a href="<?php echo url_for('@qmore');?>">专家答疑</a> &gt; 已解答问题</p>
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
			<div class="expert_detail_show">
				<p><label>问题标题：</label><em><?php echo $content->getTitle();?></em></p>
				<p><label>问题详细：</label><em><?php echo $content->getContent();?></em></p>
				<p><label>提 问 者：</label><em><?php echo $content->getUser();?></em></p>
				<p><label>提问时间：</label><em><?php echo $content->getDateTimeObject('created_at')->format('Y年m月d日')?></em></p>
			</div>
			<div class="expert_detail">
				<?php if($content->getExpert()->getPicture() == ''):?>
				<img src="/../../images/img.jpg" class="expert_face"/>
				<?php else :?>
				<img src="/../../uploads/<?php echo $content->getExpert()->getPicture();?>" class="expert_face"/>
				<?php endif;?>
				<p><strong>答疑专家：</strong><?php echo $content->getExpert();?></p>
				<p><strong>回答内容：</strong></p>
				<?php echo $content->getAnswerContent();?>
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
</script>