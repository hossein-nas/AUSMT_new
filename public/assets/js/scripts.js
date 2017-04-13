;(function() {
    // Initialize
    var bLazy = new Blazy({
        selector: 'img',
        breakpoints: [{
                width: 480, // max-width
                src: 'data-src-small'
            },
            {
                width: 768, // max-width
                src: 'data-src-medium'
            },
            {
                width: 1200, // max-width
                src: 'data-src'
            },
            {
                width: 2880, // max-width
                src: 'data-src'
            }
        ]
    });
})();
$( document ).ready( function ()
{

	$( '.comment .reply' ).click( function ()
	{
		window.location = '#' + $( this ).data( 'parent' );
	} );

	$( '.rep' ).click( function ()
	{
		window.location = '#'+'write-comment';
		var scroll_pos = $(document).scrollTop();
		$(document).scrollTop(scroll_pos-50);
		$( '.write-comment .replier' ).remove();
		var rep = '<label for="replier" class="replier"><a href="#';
		var id = $( this ).parent().attr( 'id' );
		var name = $( this ).parent().find( '.name' ).html()
		rep = rep + id + '">' + name + '</a><span class="cancel"></span></label>';
		id = id.replace( 'num-', '' );
		id = parseInt( id );
		$( 'input[name="parent_id"]' ).val( id );
		$( '.write-comment' ).prepend( rep );

		$( '.replier .cancel' ).click( function ()
		{
			$( this ).parent().remove();
			$( 'input[name="parent_id"]' ).val( 0 );
		} );
	} )

} );
$(document).ready(function () {
    $('.toggle-btn').on('click',function (e) {
        var parent = $(this).parent();
        var last_sibil = $(this).siblings().last();
        var top = last_sibil.position().top;
        var bottom_post = last_sibil.outerHeight() + top +10;
        if( parent.hasClass('opened') ){
            parent.animate({'height':'3.4rem'},150,'easeOutCirc').removeClass('opened');
            $(this).find('i').html('more_vert');
        }else{
            parent.animate({'height':bottom_post},200,'easeOutCirc').addClass('opened');
            $(this).find('i').html('clear');
        }
    })
})
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
$(document).ready(function () {
    if($(window).width()<768)
        return;
    $('#search-btn').on('mouseover',function () {
        var input = $(this).prev();
        input.animate({'margin-right':'0'},250,function () {
            $(this).focus();
        });
    })
})
jQuery(function($){
    'use strict';

    // -------------------------------------------------------------
    //   Slider
    // -------------------------------------------------------------
    (function () {
        var $frame = $('section.slider');
        var $slidee = $frame.find('.slidee');
        var $next = $frame.find('.arrow .next')
        var $prev = $frame.find('.arrow .prev')
        var $pages = $frame.find('.pages')
        var $options = {
            slidee: $slidee,
            horizontal: 1,
            cycleBy: 'pages',
            cycleInterval: 7000,
            pauseOnHover: 1,
            keyboardNavBy: 'item',
            itemNav: 'basic',
            smart: 1,
            mouseDragging: 1,
            touchDragging: 1,
            releaseSwing: 1,
            speed: 1010,
            elasticBounds: 1,
            easing: 'easeInOutCubic',
            dragHandle: 1,
            dynamicHandle: 1,
            next: $next,
            prev: $prev,
            //pages
            pagesBar: $pages,
            pageBuilder: function (index) {
                return '<li>' + (index + 1) + '</li>';
            },
            activatePageOn: 'click',
        }
        var sly = new Sly($frame,$options);
        set_items_h_w($slidee)
        sly.init();
        $(window).on('resize',function () {
            set_items_h_w($slidee);
            sly.reload();
        })
     }());

    function set_items_h_w($slidee){
        var win_width = $(window).width();
        if(win_width<1200){
            var width = win_width+'px';
            var height = (win_width/1.6)+'px';
            $slidee.find('>.items').css({'width':width,'height':height})
            $slidee.parents('.slider').css({'width':width,'height':height})
        }
    }

    // -------------------------------------------------------------
    //   Fast Menu
    // -------------------------------------------------------------
    (function () {
        var $frame = $('section.fast-menu .frame');
        var $slidee = $frame.find('.slidee');
        var $next1 = $frame.parent().find('section.arrow-forward i')
        var $prev1 = $frame.parent().find('section.arrow-backward i')
        var $options = {
            cycleBy: 'pages',
            cycleInterval: 5000,
            pauseOnHover: 1,
            // keyboardNavBy: 'item',
            // itemNav: 'centered',
            smart: 1,
            mouseDragging: 1,
            touchDragging: 1,
            releaseSwing: 1,
            speed: 1010,
            elasticBounds: 1,
            easing: 'easeInOutCubic',
            dragHandle: 1,
            dynamicHandle: 1,
            nextPage: $next1,
            prevPage: $prev1,
        }
        if($(window).width()>768){
            $options.horizontal=1;
            $options.keyboardNavBy='item';
            $options.itemNav='centered';
        }
        var sly = new Sly($frame,$options);
        console.log(sly);
        sly.init();

        $(window).on('resize',function () {
            sly.reload();
        })
    }());


    // -------------------------------------------------------------
    //   Time Line
    // -------------------------------------------------------------
    (function () {
        var $frame = $('.timeline>.body');
        var $slidee = $frame.find('.slidee');
        var $scrollbar = $frame.find('.scrollbar');
        var $options = {
            cycleBy: 'pages',
            cycleInterval: 5000,
            slidee:$slidee,
            pauseOnHover: 1,
            smart: 1,
            // mouseDragging: 1,
            touchDragging: 1,
            releaseSwing: 1,
            speed: 500,
            elasticBounds: 1,
            easing: 'easeInOutCubic',
            dragHandle: 1,
            dynamicHandle: 1,
            scrollBar: $scrollbar,
            clickBar:  1,
            syncSpeed: 0.5
        }

        var sly = new Sly($frame,$options);
        sly.init();
        $(window).on('resize',function () {
            sly.reload();
        })
    }());


    // -------------------------------------------------------------
    //   Slideshow
    // -------------------------------------------------------------
    (function () {
        var $frame = $('.panel>.body.panel-horizontal-slideshow');
        var $slidee = $frame.find('.slidee');
        var $pages = $frame.find('.pages');
        var $options = {
            slidee: $slidee,
            horizontal: 1,
            cycleBy: 'pages',
            cycleInterval: 4000,
            pauseOnHover: 1,
            itemNav: 'basic',
            smart: 1,
            mouseDragging: 1,
            touchDragging: 1,
            releaseSwing: 1,
            speed: 777,
            elasticBounds: 1,
            easing: 'easeInOutBack',
            dragHandle: 1,
            dynamicHandle: 1,
            //pages
            pagesBar: $pages,
            pageBuilder: function (index) {
                return '<li class="item"></li>';
            },
            activatePageOn: 'click'
        }
        var sly = new Sly($frame,$options);
        sly.init();
        $(window).on('resize',function () {
            sly.reload();
        })
    }());




    // -------------------------------------------------------------
    //   Publications...
    // -------------------------------------------------------------
    (function () {
        var $frame = $('.publications>.body');
        var $wrapper = $frame.find('.wrapper');
        var $slidee = $frame.find('.slidee');
        var $scrollbar = $frame.find('.scrollbar');
        var $options = {
            slidee:$slidee,
            smart: 1,
            // mouseDragging: 1,
            touchDragging: 1,
            releaseSwing: 1,
            speed: 500,
            elasticBounds: 1,
            easing: 'easeInOutCubic',
            dragHandle: 1,
            dynamicHandle: 1,
            scrollBar: $scrollbar,
            clickBar:  1,
            syncSpeed: 0.5
        }

        var sly = new Sly($wrapper,$options);
        sly.init();
        $(window).on('resize',function () {
            sly.reload();
        })
    }());

});
$(document).ready(function (e) {

    if( $(window).width() < 768)
        return;

    var nav = $('nav');
    var nav_height = nav.outerHeight();
    var nav_pos = nav.position().top;
    var nav_bottom_pos = nav_height + nav_pos + 60;
    var old_pos = $(window).scrollTop();
    var scroll_pos = $(window).scrollTop();

    $(window).scroll(function (e) {
        // if that off positioning area is empty or not
        var off_position_area_is_empty = !$('#off-positioning-area>*').length;

        old_pos = scroll_pos;
        scroll_pos = $(window).scrollTop();
        if ( (scroll_pos > nav_bottom_pos) && off_position_area_is_empty ){
            nav.clone().appendTo('#off-positioning-area');
            var sticky_nav = $('#off-positioning-area nav');
            sticky_nav.css({
                'position':'fixed',
                'top' : '-100px',
                'width' : '100%',
                'right': 0,
                'z-index':9999
            }).animate({
                'top':0
            },250).addClass('box-shadow');
        }
        else if ( (scroll_pos < nav_bottom_pos) && !off_position_area_is_empty ){
            var sticky_nav = $('#off-positioning-area nav');
            sticky_nav.animate({
                'top': '-60px'
            },150,function () {
                $('#off-positioning-area').empty();
            })
        }
    })
    console.log(nav_pos);
})
$(document).ready(function () {
    function time_updater() {
        var time = $('.time-box .time .seperator');
        if(time.css('opacity')==1)
            time.css({'opacity':0});
        else
            time.css({'opacity':1});
    }
    setInterval(time_updater,1000);
    setTime();
    function setTime(){
        var data = new FormData();
        data.append('day', $('.time-box .date span').html());
        data.append('weekDayName',$('.time-box .day').html());
        data.append('hour',$('.time-box .time .hour').html());
        data.append('min',$('.time-box .time .min').html());
        $.ajax({
            url: '/getLocalTime/',
            type: 'POST',
            timeout:60000,
            data:data,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            xhr: function () {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
            },
            error:function () {
                console.log("time_updater fail.");
            }
        }).done(function (a) {
            var hour =$.parseJSON(a).hour;
            var min =$.parseJSON(a).min;
            var weekDayName =$.parseJSON(a).weekDayName;
            var day =$.parseJSON(a).day;
            $('.time-box .date span').html(day);
            $('.time-box .day').html(weekDayName);
            $('.time-box .time .hour').html(hour);
            $('.time-box .time .min').html(min);
        });
        setTimeout(setTime,60000);
    }
});

