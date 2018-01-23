@extends('cpanel.layout.master')

@section('main-section')
    <div class="ui attached message column">
        <div class="header">
            <div class="ui breadcrumb ">
                <a class="section"> خانه </a>
                <i class="left chevron icon divider"></i>
                <a class="section">پست‌ها</a>
                <i class="left chevron icon divider"></i>
                <div class="active section">افزودن پست جدید</div>
            </div>
        </div>
    </div>

    <div class="ui segment attached fluid column">
        <form class="ui form" method="post" action="{{ route('new_record', ['type'=>'news']) }}">
            {{-- ...Hidden Inputs... --}}
            {{ csrf_field() }}
            <input type="hidden" name="thumbnail_id" value="">
            <input type="hidden" name="lang_id" value="1">

            <div class="field required ">
                <label>عنوان خبر</label>
                <input type="text" name="title" id="title" placeholder="">
            </div>
            <div class="field disabled">
                <label>شناسه عنوان</label>
                <input type="text" name="seo_title" disabled="disabled">
            </div>
            <div class="field disabled">
                <label>نویسنده</label>
                <input type="text" name="writer" disabled="disabled">
            </div>
            <div class="field required">
                <label>محتوای نوشته</label>
                <textarea name="content" id="textarea"></textarea>
            </div>
            <div class="field tag-dropdown">
                <label for="tags">انتخاب تگ ها:</label>
                <select name="tags[]" id="" class="ui dropdown selection search	" multiple>
                    @foreach($all_tags as $tag )
                        <option value="{{ $tag->name }}"> {{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="ui message attachment-area">
                <h4 class="ui header">افزودن فایل ضمیمه</h4>
                <div class="ui divider"></div>
                <div class="attachments">
                    {{--<div class="item">
                        <div class="filetype">
                            <img src="/media/filetypes/jpg.svg" alt="">
                        </div>
                        <div class="body">
                            <h3 class="file-title">
                                فرم درخواست مهمانی
                            </h3>
                            <label for="file size" class="filesize">
                                ۳.۲ مگابایت
                            </label>
                            <label for="original name" class="orig-name">
                                form-mehmani.pdf
                            </label>
                        </div>
                        <div class="delete-button">
                            <span>حذف</span>
                        </div>
                    </div>--}}

                </div>
                <div class="ui form">
                    <div class="fields inline">
                        <div class="three wide field">
                            <div class="ui blue button tiny fluid" id="select-attachment-btn">انتخاب فایل</div>
                            <input type="file" id="attachment_file" class="attachment-file-input">
                        </div>
                        <div class="ten wide field">
                            <input type="text" id="attachment" class="description" placeholder="عنوان فایل را وارد کنید...">
                        </div>
                        <div class="three wide field">
                            <div class="ui green button tiny fluid" id="upload_attachment_btn">آپلود فایل</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ui message upload-thumbnail">
                <h4 class="ui header">افزودن تصویر شاخص</h4>
                <div class="ui divider"></div>
                <div class="ui grid body">
                    <div class="row">
                        <div class="ten wide column">
                            <div class="thumbnail-upload-btn ui button green">آپلود تصویر شاخص</div>
                            <div class="ui modal thumbnail-upload-modal">
                                <i class="close icon"></i>
                                <div class="header">
                                    انتخاب تصویر شاخص
                                </div>
                                <div class="image content">
                                    <div class="description ui two column grid">
                                        <div class="row">
                                            <div class="column buttons">
                                                <input type="file" name="record_thumbnail" accept="image/*"
                                                       class="file-input">
                                                <div class="ui vertical basic buttons">
                                                    <button class="ui button select-photo">انتخاب تصویر شاخص</button>
                                                    <button class="ui button disabled crop-photo">برش تصویر</button>
                                                    <button class="ui button disabled upload-photo">بارگذاری تصویر
                                                        شاخص
                                                    </button>
                                                </div>
                                                <label for="" class="message"></label>
                                            </div>
                                            <div class="column image-canvas">
                                                <div class="image-wrapper bgc">
                                                    {{--<img class="ui fluid image bordered rounded middle aligned huge" src="/media/photos/medium/1.png">--}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="actions">
                                    <div class="ui button cancel">لغو</div>
                                    <div class="ui button ok">تأئید</div>
                                </div>
                            </div>
                        </div>
                        <div class="six wide column thumbnail-image">

                        </div>
                    </div>
                </div>
            </div>

            <div class="field">
                <div class="ui toggle checkbox">
                    <input type="checkbox" tabindex="0" class="hidden" name="add_slider" value="1">
                    <label>به اسلایدر افزوده شود؟</label>
                </div>
            </div>

            <div class="field">
                <div class="ui toggle checkbox">
                    <input type="checkbox" tabindex="0" class="hidden" name="is_important" value="1">
                    <label> به اخبار مهم افزوده شود؟</label>
                </div>
            </div>

            <button class="ui button primary" type="submit">ارسال و ثبت پست</button>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        $(".ui.checkbox").checkbox();
        $('.tag-dropdown .ui.dropdown').dropdown({
            allowAdditions: true,
            keys: {
                'delimiter' :191
            }
        })
    </script>

    <script src={{ asset('assets/js/libs/CKEditor/ckeditor.js') }}></script>
    <script src={{ asset('assets/js/libs/cropper.min.js') }}></script>
    <script>
        CKEDITOR.replace('textarea', {
            language: 'fa',
            filebrowserUploadUrl: '/upload/images'
        });

        $('.thumbnail-upload-btn').click(function () {
            $('.ui.modal')
                .modal('setting', 'transition', 'fade up')
                .modal({
                    onShow: function () {
                    },
                    onHidden: function () {
                        var modal = $('.thumbnail-upload-modal');
                        modal.find('.image-wrapper').empty();
                        modal.find('.buttons').find('button.upload-photo,button.crop-photo').addClass('disabled');
                    },
                    onApprove: function () {
                        if ( window.thumbnail_url === undefined ){
                            alert('عکسی را آپلود نکردید...');
                            return false;
                        }
                        $('input[name="thumbnail_id"]').val(window.thumbnail_id);
                        var img = $('<img src="" alt="" class="ui medium rounded bordered image" />')
                        img.prop('src',window.thumbnail_url);
                        if( !$('.thumbnail-image img').size() ) // check for empty
                            $('.thumbnail-image').append(img);
                        else
                            $('.thumbnail-image img').prop('src',window.thumbnail_url);
                        return true;
                    },
                    closable: false,
                })
                .modal('show');
        })

        var modal = $('.thumbnail-upload-modal');
        var button_area = $('.thumbnail-upload-modal').find('.buttons');
        var file_input = modal.find('.file-input');
        var select_photo_btn = modal.find('.select-photo')
        var crop_photo_btn = modal.find('.crop-photo')
        var upload_photo_btn = modal.find('.upload-photo')

        select_photo_btn.click(function () {
            file_input.click();
        });

        upload_photo_btn.click(function () {
            if ( $(this).hasClass('disabled') )
                return

            window.cropper.getCroppedCanvas().toBlob(function (blob) {
                var formData = new FormData();
                formData.append('record_thumbnail', blob);
                formData.append('file_orig_name', window.thumbnail_orig_name);
                formData.append('cat_id', 7);
                formData.append('file_title', '');
                formData.append('responsive_image', 1);
                $.ajax('/upload/record/thumbnail', {
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        upload_photo_btn.addClass('loading')
                    },
                    success: function (data,result) {
                        upload_photo_btn.removeClass('loading')
                        upload_photo_btn.addClass('disabled')
                        button_area.find('.message').html('فایل با موفقیت افزوده شد');
                        window.thumbnail_url = data.multivalue.file_fullpath;
                        window.thumbnail_id = data.id;
                        setTimeout(function(){button_area.find('.message').html('')},5000)
                    },
                    error: function (data) {
                        upload_photo_btn.removeClass('loading')
                        upload_photo_btn.addClass('disabled')
                        button_area.find('.message').html(data.text);
                    },
                });
            });
        });

        crop_photo_btn.click(function () {

            if ($(this).hasClass('disabled'))
                return;
            var CroppedCanvasOptions = {
                maxWidth: 1200,
                maxHeight: 750,
                fillColor: '#fff'
            }
            window.cropper.getCroppedCanvas(CroppedCanvasOptions).toBlob(function (blob) {
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onload = function (e) {
                    window.cropper.disable();
                    var data = e.target.result
                    var wrapper = $(".thumbnail-upload-modal .image-wrapper");
                    wrapper.empty();
                    wrapper.append("<img class=\"ui fluid image middle aligned huge\" src=\"\">")
                    wrapper.find('img').prop('src', data);
                }
            })

            $(this).addClass('disabled')
            upload_photo_btn.removeClass('disabled');
        });

        file_input.change(function (e) {
            e.stopPropagation();
            if ($(this).val() != "") {
                window.thumbnail_url = undefined;
                window.thumbnail_orig_name = $(this).val();
                $('.crop-photo').removeClass('disabled');
                var file = file_input[0].files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function (e) {
                        // browser completed reading file - display it
                        var image_file = e.target.result;
                        var img = $("<img/>");
                        img.addClass('ui fluid image middle aligned huge');
                        img.prop('src', image_file);
                        img.prop('id', 'image');
                        if ($(".thumbnail-upload-modal .image-wrapper").find('img').size() > 0) {
                            $(".thumbnail-upload-modal .image-wrapper").empty();
//                            window.cropper.destroy();
                        }
                        $(".thumbnail-upload-modal .image-wrapper").append(img);
                        var image = $(".thumbnail-upload-modal .image-wrapper").find('img');
                        init_cropper(image.get()[0]);
                    };
                }
            }
        });

        function init_cropper(image) {
            window.cropper = new Cropper(image, {
                aspectRatio: 16 / 10,
                viewMode: 2,
                autoCropArea: .95,
                rotatable: false,
                scalable: false,
                zoomable: false,
                zoomOnTouch: false,
                zoomOnWheel: false,
            });
        }
    </script>


    <script>
        $('input#title').on('keyup', function(){
            var text = $(this).val().trim();
            var res = text.replace(/[ ]/g, "-");
            var res = res.replace(/[.]/g, "");
            $('input[name="seo_title"]').val(res);
        })
    </script>

    <script>

        $('#select-attachment-btn').click(function(){
            $('#attachment_file').click();
        })

        $('#upload_attachment_btn').click(function(){
            var _this = $(this);
            var formData = new FormData();
            var attachment_file = $('#attachment_file')[0].files[0];
            var description = $('.description').val();
            var index = attachment_file.name.lastIndexOf('.');
            var name = attachment_file.name.substr(0,index);
            formData.append('attachment_file', attachment_file )
            formData.append('cat_id', 1 )
            formData.append('file_title', description )
            formData.append('file_description', description )
            formData.append('file_orig_name', name )
            $.ajax('/panel/files/upload/attachment', {
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function(){
                    _this.addClass('loading')
                },
                success: function (data,result) {
                    var _attachments = $('.attachments');
                    var _item = $('<div>').addClass('item');
                    var _file_type = $('<div>').addClass('filetype').html('<img src="'+ data.icon_path+'" alt="'+ data.orig_name +'"/>');
                    _file_type.appendTo(_item);
                    var _body = $('<div>').addClass('body');
                    $('<h3>').addClass('file-title').html(data.title).appendTo(_body);
                    $('<label>').addClass('filesize').html(data.filesize).appendTo(_body);
                    var elem = $('<label>').addClass('orig-name').html(data.orig_name).appendTo(_body);
                    _body.appendTo(_item);
                    _item.appendTo(_attachments);
                    ellipseInMiddle(elem);
                },
                error: function (data) {
                    alert('ss');
                },
            }).done(function(){
                _this.removeClass('loading');
            });

            function ellipseInMiddle(el){
                var middle
                var str = el.html();
                var el_width = el.width();
                var el_height = parseInt( el.height() )
                var el_line_height = parseInt( el.css('line-height') );
                var i = 0;
                console.log(el_height)
                console.log(el_line_height);

                if (el_height-1 <= el_line_height )
                    return ;

                while ( el_height > el_line_height ){
                    console.log('width : ' + el.width() );
                    console.log('height : ' + el.height() );
                    middle = parseInt( el.html().length/2 )
                    str = el.html().substr(0,middle-2) + el.html().substr(middle+2);
                    el_height = parseInt( el.height() );
                    el.html(str);
                }
                str = str = el.html().substr(0,middle-1) + ' ... ' + el.html().substr(middle);
                el.html(str);
            }
        })
    </script>

@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/cropper.min.css') }}">
@endsection
