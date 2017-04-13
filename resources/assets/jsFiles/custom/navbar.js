$(document).ready(function() {
	$('.navbar li').on('click',function () {
		var currentElem = $(this);
		if(!currentElem.hasClass('active') && $('.navbar li:animated').size()==0){
			var activeBody=$('.navbar li.active').removeClass('active').data('rel');
			var currentBody=currentElem.addClass('active').data('rel');
			var activeStr = '.content .body .' + activeBody;
			var currentStr = '.content .body .' + currentBody;
			$(activeStr).animate({'opacity':'0'},300,function(){
				$(this).hide();
				$(currentStr).show().animate({'opacity':'1'},300);
			});
		}
	})
});