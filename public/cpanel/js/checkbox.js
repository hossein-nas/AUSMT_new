$(document).ready(function () {
    check_for_sync_ticks();
    $('.checkbox').bind('click',function(ev) {
        ev.preventDefault();
        if($(this).hasClass('active')){
            $(this).removeClass('active');
            $(this).find('input[type="checkbox"]').prop('checked',false);
        }
        else{
            $(this).addClass('active');
            $(this).find('input[type="checkbox"]').prop('checked',true);
        }
    })
    // $('#submit').bind('click',function () {
    //     $('.checkbox').each(function(){
    //         alert($(this).find('input[type="checkbox"]').prop('checked'));
    //     })
    // })

    function check_for_sync_ticks () {
        $('.checkbox input[type="checkbox"]').each(function () {
            if($(this).parents('.checkbox').hasClass('active') || $(this).prop('checked')==true){
                $(this).prop('checked',true);
                $(this).parents('.checkbox').addClass('active');
            }
        })
    }
})


