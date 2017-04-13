$(document).ready(function (e) {
    $('#open-window').click(function () {
        $('#file').click();
    })
    $('#upload-image').click(function () {
        if($('#file').val().length==0){
            alert('عکسی انتخاب نشده است.');
            // return false;
        }else{
            var form_date = new FormData();
            form_date.append('image',$('#file')[0].files[0], $('#file').val());
            if($(".upload-image input[name=\"destPath\"]").size())
                form_date.append('destPath',$(".upload-image input[name=\"destPath\"]").val());
                $.ajax({
                url: "/admin-panel/upload-image",
                type: "POST",
                data: form_date,
                enctype: 'multipart/form-data',
                processData: false,  // tell jQuery not to process the data
                contentType: false,   // tell jQuery not to set contentType
                timeout:60000,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                xhr: function () {
                    var myXhr = $.ajaxSettings.xhr();
                    if(myXhr.upload){
                        $('#upload-image .percent').remove()
                        $('#upload-image').append('<span class="percent"></span>')
                        myXhr.upload.addEventListener('progress', function (e) {
                            if(e.lengthComputable){
                                $('#upload-image .percent').html(parseInt((e.loaded/ e.total)*100));
                            }
                        })
                    }
                    return myXhr;
                },
                success : function(e,b){
                    $('#uploaded-image').html('<image src="'+e+'" title="تصویر شاخص"/>');
                    $('#image').val(e);
                    createFlashMsg('تصویر با موفقیت آپلود شد.');
                },
                error: function (e,b) {
                    var response = $.parseJSON(e.responseText).error;
                    createFlashMsg(response);
                }
            })

        }
    })
});