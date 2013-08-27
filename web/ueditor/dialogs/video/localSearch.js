jQuery(document).ready(function(){
	jQuery("#localSearchButton").click(function(){
		var text = $('#localSearchText').val();
		if(text.length == 0)
			return false;
		$('.loading').show();
		$.ajax({
			type: 'post',
			url: '/backend.php/videoLocalSearch',
			data: 'text='+text,
			success: function(data){
				$('#videoLocalSearchList').html(data);
			},
			complete: function(){
				$('.loading').hide();
			}
		});
	})
})