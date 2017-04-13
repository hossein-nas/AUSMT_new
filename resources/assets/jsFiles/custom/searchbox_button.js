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