<?php include_partial('home/header',array('current_id'=>2));?>
<div class="content_box">
	<div class="detail_title">
		<p>您的当前位置：<a href="<?php echo url_for('@homepage');?>">首页</a> &gt; 培训介绍</p>
	</div>
	<div class="detail_cont clearfix">
		<div class="l">
			<div class="train">
				<div class="show_exp">
					<h3>四川省中小学班主任家庭教育指导能力提升专题培训项目</h3>
					<h4>家庭教育在儿童成长中的重要性</h4>
					<p>　　家庭教育（亲子教育）已变成一个世界性的课题，有80%的家庭存在着不同程度的青少年心智障碍、逃课厌学、紧张失眠、考试压力、亲子冲突、离家出走、网络成瘾、毒品滥用、就业困惑、性问题、早恋早孕、性爱堕落、盲目追星、意志涣散、不擅理财、与老人冲突、自虐自杀、未成年合法权益、单亲（或隔代）教育、团体斗殴、伤害事故、暴力事件、青少年犯罪等问题，亲子情感与行为的困惑日夜严重，几十年、甚至几百年的家庭教育观念和方式受到了严重挑战，甚至破坏了社会的安定。</p>
					<h4>相关法律法规</h4>
					<p>　　《未成年人保护法》等法律法规的修订，预示家庭亲子教育咨询与青少年法律援助的市场需求会快速增长。中国是一个拥有十几亿人口大国，庞大的人口基数中家庭教育指导师的占有比率极低。随着社会经济和科技资讯的快速变化发展，以及中国社会的急速转型，家庭教育指导与法律援助市场已处在快速腾飞发展阶段，中国家庭（亲子）教育指导市场亦迅猛扩展。</p>
					<h4>培训目的以及时间安排</h4>
					<p>　　该证书表明持证人已通过劳动与社会保障部国家职业资格培训鉴定实验基地、中国国际婚姻家庭协会的相关职业资格考核评审和国际注册，具备了相应职业、级别的工作能力和业务水平，可作为从事本专业工作和用人单位招收录用本专业人员的依据。并登录在国家职业资格培训鉴定实验基地网站和中国国际婚姻家庭协会网证书查询栏中，对证书进行网上查验。高级家庭教育指导师优秀论文将编辑出版，在协会刊物上和协会网站上刊登发布。</p>
				</div>
				<div class="one_exp">
					<h4>课程大纲简析<a href="#">展开</a></h4>
					<div class="hide_exp">
						<p>　　家庭教育（亲子教育）已变成一个世界性的课题，有80%的家庭存在着不同程度的青少年心智障碍、逃课厌学、紧张失眠、考试压力、亲子冲突、离家出走、网络成瘾、毒品滥用、就业困惑、性问题、早恋早孕、性爱堕落、盲目追星、意志涣散、不擅理财、与老人冲突、自虐自杀、未成年合法权益甚至破坏了社会的安定。</p>
					</div>
				</div>
				<div class="one_exp">
					<h4>课程培训方式<a href="#">展开</a></h4>
					<div class="hide_exp">
						<p>　　家庭教育（亲子教育）已变成一个世界性的课题，有80%的家庭存在着不同程度的青少年心智障碍、逃课厌学、紧张失眠、考试压力、亲子冲突、离家出走、网络成瘾、毒品滥用、就业困惑、性问题、早恋早孕、性爱堕落、盲目追星、意志涣散、不擅理财、与老人冲突、自虐自杀、未成年合法权益甚至破坏了社会的安定。</p>
					</div>
				</div>
				<div class="one_exp">
					<h4>课程培训方式<a href="#">展开</a></h4>
					<div class="hide_exp">
						<p>　　家庭教育（亲子教育）已变成一个世界性的课题，有80%的家庭存在着不同程度的青少年心智障碍、逃课厌学、紧张失眠、考试压力、亲子冲突、离家出走、网络成瘾、毒品滥用、就业困惑、性问题、早恋早孕、性爱堕落、盲目追星、意志涣散、不擅理财、与老人冲突、自虐自杀、未成年合法权益甚至破坏了社会的安定。</p>
					</div>
				</div>
			</div>			
		</div>
		<div class="r">
			<?php include_component('home', 'rightimages');?>				
			<?php include_component('home', 'rightbanner');?>
			<?php include_component('home', 'topic');?>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(".one_exp h4 a").click(function(){
		var _this=$(this);
		var _show=$(this).parents("div.one_exp").find("div.hide_exp");
		if($(this).hasClass("on")){		
			_show.slideUp(500,function(){
				_this.removeClass("on").text("展开");
			});
		}
		else{		
			_show.slideDown(500,function(){
				_this.addClass("on").text("收起");
			});
		}
		return false;
	});
</script>
