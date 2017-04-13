$(document).ready(function () {
    $('.add-new-item').bind('click', function () {
        $('.setting-edit-form').hide();
        $('.setting-add-new-item').show();
        $('.setting-add-new-item').find('input[name="type"]').val($(this).data('type'));
        $('.setting-add-new-item').find('input[name="name"]').val('');
        $('.setting-add-new-item').find('input[name="value"]').val('');
    })
    $('.allsetting .edit').bind('click', function () {
        $('.setting-add-new-item').hide();
        var rel_id = $(this).parents('.item').data('rel-id');
        var name = $(this).parents('.item').find('.alink a').html();
        var value = $(this).parents('.item').find('.alink a').attr('href');
        $('.setting-edit-form').find('input[name="rel_id"]').val(rel_id);
        $('.setting-edit-form').find('input[name="name"]').val(name);
        $('.setting-edit-form').find('input[name="value"]').val(value);
        $('.setting-edit-form').show();
    })
})