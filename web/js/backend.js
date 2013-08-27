/*弹出框屏幕居中显示*/
function popPosition(dom){
	
	var width = $(dom).width();
	var height = $(dom).height();
	var _scrollHeight = $(document).scrollTop();
	var	_windowHeight = $(window).height();
	var	_windowWidth = $(window).width();
	var	_popupHeight = $(dom).height();
	var	_popupWeight =$(dom).width();
	var	_posiTop = (_windowHeight - _popupHeight)/2 + _scrollHeight + 10;
	var	_posiLeft = (_windowWidth - _popupWeight)/2;
	var bodyHeight=$('body').height();
	$('body').prepend("<div class='winMark'></div>");
	$('.winMark').css('height','100%');	
	if(_posiTop<0){
		_posiTop = 10;
	}
	$(dom).css({"left":_posiLeft,"top":_posiTop}).fadeIn();
				
};

$(document).ready(function(){

	$('.menu').find('li.title').toggle(function(){ 
		$(this).nextAll('li').slideDown('100'); 
		$(this).find('span').attr('class','arrow_show');
	 },function(){ 
		 $(this).nextAll('li').slideUp('100');
		 $(this).find('span').attr('class','arrow_hide');
	});
//	$('.menu').find('li.title').nextAll('li').hide();
	$('.menu ul li a.active').parent().parent().find('li.title').nextAll('li').show();
//	$('.menu .on').find('li.title').nextAll('li').show();
	var tmp = '';
	$(".hoverchangle tr").hover(function(){
		 tmp = $(this).css('background-color');
		$(this).css('background','#FFCC99');
	},function(){
		
		$(this).css('background',tmp);
	});
	
	
	$('.file_upload').css({'opacity':'0'});

	$('.navigationHead a').click(function(){
		var id = $(this).attr('id');
		id = id.split('_');
		id = id[0];
		
		if(id == 'ltglA')
			return true;
		
		var li = $(this).parent();
		$('.navigationHead ul li').removeClass('on');
		li.addClass('on');
//		alert(id);
		$('.navigationBody .navigationBodyDiv').hide();
		$('.navigationBody #'+id).show();
	})
})

