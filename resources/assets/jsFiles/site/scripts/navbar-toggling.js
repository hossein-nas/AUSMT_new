$(document).ready(function($) {
	$(".togglemenu,nav").on('click',function(){
		var nav=$('nav .navigation');
		nav.on('click',function  (event) {
			event.stopPropagation();
		})
		if(!nav.hasClass('show')){
			nav.parent().show();
			nav.animate({marginLeft:0},500).addClass('show');
		}
		else{
			nav.animate({marginLeft:'-80%'},500,function(){nav.parent().hide()}).removeClass('show');
		}
	})
});