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
        <form class="ui form" method="get">
            {{-- ...Hidden Inputs... --}}
            <input type="hidden" name="thumbnail_id" value="">

            <div class="field required ">
                <label>عنوان خبر</label>
                <input type="text" name="title" placeholder="">
            </div>
            <div class="field disabled">
                <label>شناسه عنوان</label>
                <input type="text" name="seo-title" disabled="disabled">
            </div>
            <div class="field disabled">
                <label>نویسنده</label>
                <input type="text" name="writer" disabled="disabled">
            </div>
            <div class="field required">
                <label>محتوای نوشته</label>
                <textarea name="content" id="textarea"></textarea>
            </div>

            <div class="ui message attachment-area">
                <h4 class="ui header">افزودن فایل ضمیمه</h4>
                <div class="ui divider"></div>
                <div class="attachments">
                    <div class="item">
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
                    </div>
                    <div class="item">
                        <div class="filetype">
                            <img src="/media/filetypes/pdf.svg" alt="">
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
                    </div>
                </div>
                <div class="ui form">
                    <div class="fields inline">
                        <div class="three wide field">
                            <div class="ui blue button tiny fluid">انتخاب فایل</div>
                        </div>
                        <div class="ten wide field">
                            <input type="text" name="description" placeholder="عنوان فایل را وارد کنید...">
                        </div>
                        <div class="three wide field">
                            <div class="ui green button tiny fluid">آپلود فایل</div>
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
                    <input type="checkbox" tabindex="0" class="hidden" name="add_slider">
                    <label>به اسلایدر افزوده شود؟</label>
                </div>
            </div>

            <div class="field">
                <div class="ui toggle checkbox">
                    <input type="checkbox" tabindex="0" class="hidden" name="is_important">
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
                formData.append('orig_name', window.thumbnail_orig_name);
                $.ajax('/upload/record/thumbnail/', {
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
                        button_area.find('.message').html(data.text);
                        window.thumbnail_url = data.url;
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

        file_input.change(function () {
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
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/cropper.min.css') }}">
@endsection
