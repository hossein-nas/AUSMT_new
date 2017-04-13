/**
 * Created by Hossein PC on 18/09/2016.
 */

$(document).ready(function () {
    $(".navbar-list span").bind('dblclick',function () {
        $(".navbar-list .active").removeClass('active');
        $(this).addClass('active');
        var name = $(this).html();
        var href = $(this).data('rel-href');
        var id = $(this).data('rel-id');
        $('.add-new-nav-item').remove();
        $('.delete-nav-item').remove();
        $('#update-nav-item').show();
        $('#update-nav-item').find('input[name="name"]').val(name);
        $('#update-nav-item').find('input[name="href"]').val(href);
        $('#update-nav-item').find('input[name="rel_id"]').val(id);
    })

    $('.add-new-nav-item').bind('click',function () {
        $(".navbar-list span").unbind('dblclick')
        var next = $(this).next();
        $(this).remove();
        next.remove();
        $('#add-new-nav-item').show();
        $(".navbar-list span").bind('click',function () {
            if($(this).parent().hasClass('root') || $(this).parent().hasClass('childs')){
                $(".navbar-list .active").removeClass('active');
                $(this).addClass('active');
                $('#add-new-nav-item input[name="parent_id"]').val($(this).data('rel-id'));
            }
        })
    })

    $('.delete-nav-item').bind('click',function () {
        $(".navbar-list span").unbind('dblclick')
        var prev = $(this).prev();
        $(this).remove();
        prev.remove();
        $('#delete-nav-item').show();
        $(".navbar-list span").bind('click',function () {
            $(".navbar-list .active").removeClass('active');
            $(this).addClass('active');
            $('#delete-nav-item input[name="rel_id"]').val($(this).data('rel-id'));
        })
    })

})