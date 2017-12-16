@extends('cpanel.layout.master')

@section('main-section')
    <div class="ui message column">
        <div class="header">
            <div class="ui breadcrumb ">
                <div class="section"> خانه</div>
                <i class="left chevron icon divider"></i>
                <div class="section">افزودن فایل جدید</div>
            </div>
        </div>
    </div>

    <div class="ui segment add_new_file_segment">
        <div class="ui grid">
            <div class="ui six wide column">
                <div class="ui header tiny center aligned"> ابتدا دسته مورد نظر را انتخاب کنید:</div>
                <div class="ui divider"></div>
                @if ( count($categories) > 0 )
                    <div class="ui list divided all-categories">
                        @foreach($categories as $cat)
                            @include('cpanel.pages.files.includes.recursive_category_list')
                        @endforeach
                    </div>
                @endif
            </div>
            <ui class="ten wide column select_file_area ">
                <div class="ui header tiny center aligned">انتخاب فایل را انتخاب کنید:</div>
                <div class="ui divider"></div>
                <div class="select_file_btn_area">
                    <div class="ui button teal tiny select_file_btn">انتخاب فایل</div>
                </div>
                <form class="ui form select_file_form" method="POST" enctype="multipart/form-data" action="{{ route('upload_new_file') }}">
                    <div class="field required">
                        <label>عنوان فایل</label>
                        <input name="file_title" placeholder="عنوانی را برای این فایل بنویسید..." type="text">
                    </div>
                    <div class="field ">
                        <label>توضیحی</label>
                        <input name="file_description" placeholder="توضیحی در مورد این فایل بنویسید..." type="text">
                    </div>
                    <div class="field ">
                        <input name="submit" class="ui button blue submit_upload_file_btn" value="ارسال و ذخیره"
                               type="submit">
                    </div>
                    {{ csrf_field() }}
                    <input type="file" name="selected_file" id="select_file_input" class="file-input">
                    <input type="hidden" name="cat_id"/>
                    <input type="hidden" name="file_orig_name" class="file_orig_name">
                    <input type="hidden" name="filesize" class="filesize">
                    <div class="ui error message">

                    </div>

                    @if (session('status'))
                        <div class="ui message ">
                            <ul>
                                <li>{{ session('status') }}</li>
                            </ul>
                        </div>
                    @endif
                </form>

            </ui>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        /*
        * Initiating checkboxes
        * */
        $('.ui.checkbox').checkbox();
        $('.ui.checkbox.file_categories').checkbox({
            beforeChecked: function () {
                var all_checkboxes = $('.all-categories');

                // unckecking all of old checked checkboxes
                all_checkboxes.find('.ui.checkbox').each(function (ind, d) {
                    $(d).checkbox('set unchecked');
                })

            },
            onChecked: function (e) {
                var id = ($(this).parent().data('id'));
                $(this).parent().checkbox('check');
                $('input[name="cat_id"]').val(id)
            },
            onUnchecked: function () {
                $('input[name="cat_id"]').val(null);
            }
        });

        /*
        * Adding event listener to .select_file_btn to open file picker window
        * */
        $('.select_file_btn').on('click', function () {
            $('#select_file_input').click();
            $('#select_file_input').on('change', function (e) {
                e.stopPropagation();
                $(this).addClass('selected');
                var file = $("#select_file_input")[0].files[0];
                var lastDot = file.name.lastIndexOf('.');
                var f = {
                    file_orig_name: file.name.substr(0, lastDot),
                    filesize: file.size,
                }
                for (var prop in f) {
                    if ($('.' + prop).get().length)
                        $('.' + prop).val(f[prop]);
                    else
                        $('.select_file_form').append('<input type="hidden" name="' + prop + '" class="' + prop + '" value="' + f[prop] + '">\n')
                }
                var select_file_area = $('.all-categories').parent();
                initFileDetailTable(f, select_file_area);
            });


            /*
            * Initiating file details table
            * .select_file_form
            * */
            function initFileDetailTable(detail, selector) {
                selector.find('.file_details').detach();
                var file_details = $('<div>').addClass('file_details').appendTo(selector);
                $('<div class="file_orig_name">').html('نام فایل:').appendTo(file_details)
                $('<div class="file_orig_name" >').html(detail.file_orig_name).appendTo(file_details);
                $('<div class="filesize">').html('حجم فایل:').appendTo(file_details);
                $('<div class="filesize" >').html(detail.filesize + " بایت").appendTo(file_details)
            }

            /*
            * Form validation and sending
            * */

        })
        $('.submit_upload_file_btn').on('click', function (e) {
            e.stopPropagation();

            $('.ui.form.select_file_form').form({
                fields: {
                    seleted_file: {
                        identifier: 'seleted_file',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'فایل را انتخاب نکردید'
                            }
                        ]
                    },
                    file_title: {
                        identifier: 'file_title',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'عنوان فایل را وارد نکردید'
                            }
                        ]
                    },
                    cat_id: {
                        identifier: 'cat_id',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'دسته‌ای را انتخاب نکردید'
                            },
                            {
                                type: 'integer',
                                prompt: 'شناسه پوشه نامعتبر می‌باشد'
                            }
                        ]
                    },
                    file_orig_name: {
                        identifier: 'file_orig_name',
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'فایل را به درستی انتخاب نکردید'
                            },
                            {
                                type: 'regExp',
                                value: /[A-Za-z0-9 _\-\.]+/i,
                                prompt: 'اسم فایلی که انتخاب کردید نامناسب می‌باشد'
                            }
                        ]
                    }

                }
            });
            var form = $('.ui.form.select_file_form');
            form.form('validate form');

            if (!form.form('is valid'))
                return false;
        })
    </script>
@endsection