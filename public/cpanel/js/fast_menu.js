$(document).ready(function () {
    addButton();
    $('.fast-menu>section').bind('dblclick', function (e) {
        e.stopPropagation();
        $('.fast-menu>section.active').removeClass('active');
        $(this).addClass('active');
        $('.form-group input[name="id"]').val($(this).index());
        $('.form-group input[name="name"]').val($(this).find('p').html());
        $('.form-group input[name="href"]').val($(this).find('a').attr('href'));
        var imgSrc=$(this).find('img').attr('src');
        $('.form-group input[name="image"]').val(imgSrc);
        $('.form-group #uploaded-image').html('<img src="'+imgSrc+'">');
        $('.fast-menu-form').show();
    })
    $('.fast-menu').bind('click', function () {
        $('.fast-menu>section.active').removeClass('active');
        $('.form-group input[name="id"]').val('');
    })

    $('.delete-menu-item').click(function () {
        $('.fast-menu').unbind('click')
        $('.fast-menu>section').unbind('click')
        $('.fast-menu>.addMore').unbind('click').remove();
        $(this).remove();
        $('.form-group').hide();
        $('.fast-menu>section').unbind('dblclick');
        $('.fast-menu>section.active').removeClass('active');
        $('.fast-menu>section').bind('dblclick', function (e) {
            var index=$(this).index();
            var form_data = new FormData();
            form_data.append('id',index)
            $.ajax({
                url: "/admin-panel/fastmenu/delete",
                type: "POST",
                data: form_data,
                processData: false,  // tell jQuery not to process the data
                contentType: false,   // tell jQuery not to set contentType
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success : function(e,b){
                    alert(e)
                },
                error: function (e,b) {
                    alert($.parseJSON( e.responseText ).id)
                },
                complete:function () {
                }
            })
        });
    })

})

function addButton() {
    var last_index=$('.fast-menu>section').size();
    if (last_index< 5) {
        $('.fast-menu>section:last-of-type').after('<div class="addMore">');
        $('.fast-menu>.addMore').bind('dblclick', function () {
            $('.fast-menu-form input[name="id"]').val(last_index);
            $('.fast-menu-form input[name="name"]').val('');
            $('.fast-menu-form input[name="href"]').val('');
            $('.fast-menu-form input[name="image"]').val('');
            $('.fast-menu-form #uploaded-image').html('');
            $('.fast-menu-form').show();
        })
    }
}