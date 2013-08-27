<?php include_partial('home/header',array('current_id'=>4));?>
<div class="content_box">
	<div class="detail_title">
		<p>您的当前位置：<a href="<?php echo url_for('@homepage');?>">首页</a> &gt; <a href="#">网上培训</a> &gt; <a href="<?php echo url_for('@wmore');?>">作业专区</a></p>
	</div>
	<div class="view_detail">
		<div class="view_show">
			<embed type="application/x-shockwave-flash" class="edui-faked-video" pluginspage="http://www.macromedia.com/go/getflashplayer" src="/../../flash/videoplayer3.swf?videoURL=/../../uploads/video/<?php echo $content->getVideo();?>&amp;btncolor=0x333333&amp;accentcolor=0x31b8e9&amp;txtcolor=0xdddddd&amp;volume=30&amp;autoload=on&amp;autoplay=off&amp;vTitle=Super Mario Brothers Lego Edition&amp;showTitle=yes" wmode="transparent" play="true" loop="false" menu="false" allowscriptaccess="never" allowfullscreen="true" height="459" align="none" width="859" />
		</div>
	</div>
</div>