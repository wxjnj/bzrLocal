<?php 
 $routeParams = str_replace('##', '&', $routeParams);
 if($routeName == null){
 	$routeName = 'article_list';
 }
?>
<div class="page">
	<a href="<?php echo url_for('@'.$routeName.'?page='.$pager->getPreviousPage().$routeParams)?>"> < 上一页</a>
	<?php if( ($pager->getPage()-4) > 1):?>
	<a href="<?php echo url_for('@'.$routeName.'?page=1'.$routeParams)?>">1</a>
	...
	<?php endif;?>
	<?php if(($tmp = $pager->getPage()-4)>=1):?>
	<a href="<?php echo url_for('@'.$routeName.'?page='.$tmp.$routeParams)?>"><?php echo $tmp?></a>
	<?php endif;?>
	<?php if(($tmp = $pager->getPage()-3)>=1):?>
	<a href="<?php echo url_for('@'.$routeName.'?page='.$tmp.$routeParams)?>"><?php echo $tmp?></a>
	<?php endif;?>
	<?php if(($tmp = $pager->getPage()-2)>=1):?>
	<a href="<?php echo url_for('@'.$routeName.'?page='.$tmp.$routeParams)?>"><?php echo $tmp?></a>
	<?php endif;?>
	<?php if(($tmp = $pager->getPage()-1)>=1):?>
	<a href="<?php echo url_for('@'.$routeName.'?page='.$tmp.$routeParams)?>"><?php echo $tmp?></a>
	<?php endif;?>
	<a href="<?php echo url_for('@'.$routeName.'?page='.$pager->getPage().$routeParams)?>" class="on"><?php echo $pager->getPage()?></a>
	<?php if(($tmp = $pager->getPage()+1)<=$pager->getLastPage()):?>
	<a href="<?php echo url_for('@'.$routeName.'?page='.$tmp.$routeParams)?>"><?php echo $tmp?></a>
	<?php endif;?>
	<?php if(($tmp = $pager->getPage()+2)<=$pager->getLastPage()):?>
	<a href="<?php echo url_for('@'.$routeName.'?page='.$tmp.$routeParams)?>"><?php echo $tmp?></a>
	<?php endif;?>
	<?php if(($tmp = $pager->getPage()+3)<=$pager->getLastPage()):?>
	<a href="<?php echo url_for('@'.$routeName.'?page='.$tmp.$routeParams)?>"><?php echo $tmp?></a>
	<?php endif;?>
	<?php if(($tmp = $pager->getPage()+4)<=$pager->getLastPage()):?>
	<a href="<?php echo url_for('@'.$routeName.'?page='.$tmp.$routeParams)?>"><?php echo $tmp?></a>
	<?php endif;?>
	
	<?php if($pager->getPage() == 1 || $pager->getPage() == 2 || $pager->getPage() == 3
			||$pager->getPage() == 4 ):?>
		<?php if(($tmp = $pager->getPage()+5)<=$pager->getLastPage()):?>
		<a href="<?php echo url_for('@'.$routeName.'?page='.$tmp.$routeParams)?>"><?php echo $tmp?></a>
		<?php endif;?>
		<?php if(($tmp = $pager->getPage()+6)<=$pager->getLastPage()):?>
		<a href="<?php echo url_for('@'.$routeName.'?page='.$tmp.$routeParams)?>"><?php echo $tmp?></a>
		<?php endif;?>
		<?php if(($tmp = $pager->getPage()+7)<=$pager->getLastPage()):?>
		<a href="<?php echo url_for('@'.$routeName.'?page='.$tmp.$routeParams)?>"><?php echo $tmp?></a>
		<?php endif;?>
		<?php if($pager->getPage() == 1 || $pager->getPage() == 2):?>
			<?php if(($tmp = $pager->getPage()+8)<=$pager->getLastPage()):?>
			<a href="<?php echo url_for('@'.$routeName.'?page='.$tmp.$routeParams)?>"><?php echo $tmp?></a>
			<?php endif;?>
		<?php endif;?>
		<?php if($pager->getPage() == 1 ):?>
			<?php if(($tmp = $pager->getPage()+9)<=$pager->getLastPage()):?>
			<a href="<?php echo url_for('@'.$routeName.'?page='.$tmp.$routeParams)?>"><?php echo $tmp?></a>
			<?php endif;?>
		<?php endif;?>
	<?php endif;?>
	
	<?php if(($pager->getPage()+4) < $pager->getLastPage()):?>
	...
	<a href="<?php echo url_for('@'.$routeName.'?page='.$pager->getLastPage().$routeParams)?>"><?php echo $pager->getLastPage()?></a>
	<?php endif;?>
	<a href="<?php echo url_for('@'.$routeName.'?page='.$pager->getNextPage().$routeParams)?>">下一页 > </a>
	&nbsp;
	<input type="text" style="width:25px;" id="page_direct_text" class="page_direct_text"/>
	<span id="page_direct" class="page_direct">跳转</span>
</div>
<script>
$(function(){
	$(".page_direct").click(function(){
		var text = $(this).prev(".page_direct_text").val();
		if (text.length==0 || (/[^\d]/.test(text)) ) {
			return false;
		}
		var url = "<?php echo url_for('@'.$routeName.'?page=xxx'.$routeParams)?>";
		url = url.replace("xxx",text);
		window.location.href=url;
	});
	
});
</script>