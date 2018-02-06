$(document).ready(function (e) {

    (function(){
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
    })();
})