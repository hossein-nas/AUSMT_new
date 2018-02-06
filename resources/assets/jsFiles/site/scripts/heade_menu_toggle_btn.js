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