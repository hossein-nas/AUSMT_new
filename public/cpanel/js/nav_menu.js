/**
 * Created by Hossein PC on 8/23/2016.
 */

$(document).ready(function () {
    var type = window.location.hash.substr(0);
    if($('.nav-menu .header li a[class="active"]').length == 0 && type.length == 0){
        $('.nav-menu .header li:first-child a').addClass('active');
        window.location.hash=$('.nav-menu .header li a[class="active"]').attr('href');
    }else if($('.nav-menu .header li a[class="active"]').length > 0 && type.length == 0){
        window.location.hash=$('.nav-menu .header li a[class="active"]').attr('href');
    }else if ($('.nav-menu .header li a[class="active"]').length == 0 && type.length > 0 ){
        $('.nav-menu .header li a[href="'+type+'"]').addClass('active');
    }else if ($('.nav-menu .header li a[class="active"]').length > 0 && type.length > 0 ){
        window.location.hash=$('.nav-menu .header li a[class="active"]').attr('href');
    }
    $('.nav-menu .body '+ window.location.hash.substr(0)).fadeIn();

    $('.nav-menu .header li a').bind('click', function () {
        var href= $(this).attr('href');
        window.location.hash = href;
        $(this).parents('.header').find('a[class="active"]').removeClass('active');
        $(this).addClass('active');
        $(this).parents('.nav-menu').find('.body >div').hide();
        $(this).parents('.nav-menu').find('.body '+ window.location.hash.substr(0)).fadeIn();
    })




})