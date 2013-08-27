<?php include_partial('home/header',array('current_id'=>1));?>
<div class="content_box">
	<div class="detail_title">
		<p>您的当前位置：<a href="<?php echo url_for('@homepage');?>">首页</a> &gt; <a href="#">网上培训</a> &gt; <a href="<?php echo url_for('@vmore');?>">视频课程</a></p>
	</div>
	<div class="view_detail">
		<div class="view_show">
			<embed type="application/x-shockwave-flash" class="edui-faked-video" pluginspage="http://www.macromedia.com/go/getflashplayer" src="/../../flash/videoplayer3.swf?videoURL=/../../uploads/video/<?php echo $content->getUrl();?>&amp;btncolor=0x333333&amp;accentcolor=0x31b8e9&amp;txtcolor=0xdddddd&amp;volume=30&amp;autoload=on&amp;autoplay=off&amp;vTitle=Super Mario Brothers Lego Edition&amp;showTitle=yes" wmode="transparent" play="true" loop="false" menu="false" allowscriptaccess="never" allowfullscreen="true" height="459" align="none" width="859" />
		</div>
		<div class="view_text">
			<p><strong>讲座名称：</strong><?php echo $content->getTitle();?></p>
			<p><strong>专　　家：</strong><?php echo $content->getExperter();?></p>
			<p><strong>简　　介：</strong><?php echo $content->getSubDescription();?></p>
			<?php if($content->getAttachment() != ''):?>
			<p><strong>课　　件：</strong><a href="/download.php?fullname=<?php echo $content->getAttachmentName();?>&filename=attachment/<?php echo $content->getAttachment();?>" title="<?php echo $content->getTitle();?>" target="_blank">点击此处</a>下载课件</p>
			<?php endif;?>
		</div>
	</div>
</div>