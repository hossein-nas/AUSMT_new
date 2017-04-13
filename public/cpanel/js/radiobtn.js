$(document).ready(function (e) {
    check_for_sync_ticks();
    $('.radiobtn').bind('click',function(ev) {
        ev.preventDefault();
        if(!$(this).hasClass('active')) {
            var thisName = $(this).find('input[type="radio"]').prop('name');
            if (thisName.length > 1)
                sync_ticks_on_change(thisName);
            $(this).addClass('active');
            $(this).find('input[type="radio"]').prop('checked', true);
        }
    })
    // $('#submit').bind('click',function () {
    //     $('.radiobtn').each(function(){
    //         alert($(this).find('input[type="radio"]').prop('checked'));
    //     })
    // })

    function check_for_sync_ticks () {
        $('.radiobtn input[type="radio"]').each(function () {
            if($(this).parents('.radiobtn').hasClass('active') || $(this).prop('checked')==true){
                $(this).prop('checked',true);
                $(this).parents('.radiobtn').addClass('active');
            }
        })
    }


    /*
     *   in baraye sharayete ii ke radio button ha ham nam bashan on moghe tick baiad avaz beshe nemitone ro joftesh bemone
     *   aval hamasho barmidarim baed oni ke click shode ro active mikonim
     * */
    function sync_ticks_on_change (elemName) {
        console.log('.radiobtn input[name="'+elemName+'"]');
        $('.radiobtn input[name="'+elemName+'"]').each(function () {
            $(this).parents('div').removeClass('active');
        })
    }
})
