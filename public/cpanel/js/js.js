$(document).ready(function () {
    $('.nav-vertical>ul>li>a').click(function(){
        $(this).next().slideToggle(300);
    });
});

function createFlashMsg(msg) {
    $('body .flashMsg').remove();
    $('<div class="flashMsg" >').append(msg).append('<div class="gotIt">').appendTo('body').animate({"bottom":'20px'},700).animate({"bottom":0},250);
    $('body .flashMsg .gotIt').bind('click',destroyFlashMsg);
    setTimeout(destroyFlashMsg,5000);
}
function destroyFlashMsg(msg) {
    $('body .flashMsg .gotIt').unbind('click');
    $('body .flashMsg').animate({"bottom":'20px'},250).animate({"bottom":'-100px'},700,function () {
        $(this).remove()
    })
}

