@extends('cpanel.layout.master')

@section('main-section')
    <div class="ui message column">
        <div class="header">
            <div class="ui breadcrumb ">
                <div class="section"> خانه</div>
                <i class="left chevron icon divider"></i>
                <div class="section">مدیریت فایل‌ها</div>
            </div>
        </div>
    </div>

    <div class="ui grid ">
        <div class="eight wide column">
            <div class="ui segment" id="file_category">
                <h5 class="ui horizontal divider header">دسته بندی فایل‌ها</h5>
                @if ( count($categories) > 0 )
                    <div class="ui list divided">
                        @foreach($categories as $cat)
                            @include('cpanel.pages.files.includes.recursive_category_list')
                        @endforeach
                    </div>
                @endif

                @if (session('status'))
                    <div class="ui message ">
                        <ul>
                            <li>{{ session('status') }}</li>
                        </ul>
                    </div>
                @endif

                <div class="tiny three ui buttons">
                    <button class="ui button add-category">افزودن</button>
                    <button class="ui button edit-category">ویرایش</button>
                    <button class="ui button delete-category">حذف</button>
                </div>
                <div class="ui modal new-category tiny">
                    <div class="header">
                        افزودن دسته بندی جدید
                    </div>
                    <div class=" content">
                        <form class="ui form" method="POST" action="{{ route('add_file_category') }}">
                            {{ csrf_field() }}
                            <div class="field">
                                <label>نام دسته بندی</label>
                                <input name="category_name" placeholder="نام دسته بندی را وارد کنید" type="text">
                            </div>
                            <div class="field">
                                <label>نام پوشه</label>
                                <input name="dir_name" placeholder="نام فولدری را به انگلیسی وارد کنید" type="text">
                            </div>
                            <div class="field">
                                <label>توضیحات</label>
                                <input name="description" placeholder="توضیحی در مورد این دسته وارد کنید" type="text">
                            </div>
                            <div class="field">
                                <label>انتخاب پوشه والد</label>
                                <select class="ui fluid dropdown" name="parent_category">

                                </select>
                            </div>
                            <div class="field">
                                <div class="ui checkbox">
                                    <input tabindex="0" class="hidden" type="checkbox" name="removable">
                                    <label>آیا این دسته قابل حذف شدن است ؟</label>
                                </div>
                            </div>
                            <div class="ui error message">

                            </div>
                        </form>

                    </div>
                    <div class="actions">
                        <div class="ui button ok">تأیید و ارسال</div>
                    </div>
                </div>

                <div class="ui modal edit-category tiny">
                    <div class="header">
                        ویرایش دسته‌ها
                    </div>
                    <div class=" content">
                        <form class="ui form edit-category-form" method="POST"
                              action="{{ route('edit_file_category') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="cat_id">
                            <div class="field">
                                <label>نام دسته بندی</label>
                                <input name="category_name" placeholder="نام دسته بندی را وارد کنید" type="text">
                            </div>
                            <div class="field">
                                <label>توضیحات</label>
                                <input name="description" placeholder="توضیحی در مورد این دسته وارد کنید" type="text">
                            </div>

                            <div class="ui error message">

                            </div>
                        </form>

                    </div>
                    <div class="actions">
                        <div class="ui button ok">تأیید و ثبت</div>
                    </div>
                </div>


                <div class="ui modal detele-category mini">
                    <div class="header">
                        حذف دسته‌ها
                    </div>
                    <div class=" content">
                        <h5>آیا واقعا قصد دارید این دسته را حذف کنید؟</h5>
                        <form action="{{ route('delete_file_category') }} " method="POST" class="delete_category_form">
                            {{ csrf_field() }}
                            <input type="hidden" name="cat_id" >
                        </form>
                    </div>
                    <div class="actions">
                        <div class="ui button tiny cancel red">انصراف</div>
                        <div class="ui button tiny ok green">تأیید و حذف</div>
                    </div>
                </div>
            </div>

        </div>
        <div class="eight wide column">
            <div class="ui segment">
                <h5 class="ui horizontal divider header">جزئیات دسته‌ها</h5>
                <table class="ui very basic celled table category_deatil_table">
                    <tbody>
                    <tr class="category_name">
                        <td class="four wide"> نام دسته</td>
                        <td class="twelve wide "></td>
                    </tr>
                    <tr class="dir_name">
                        <td class="four wide"> نام پوشه</td>
                        <td class="twelve wide "></td>
                    </tr>
                    <tr class="base_path">
                        <td class="four wide"> مسیر ریشه</td>
                        <td class="twelve wide right aligned" dir="ltr"></td>
                    </tr>
                    <tr class="parent_category">
                        <td class="four wide"> دسته والد</td>
                        <td class="twelve wide "></td>
                    </tr>
                    <tr class="removable">
                        <td class="four wide"> قابلیت حذف</td>
                        <td class="twelve wide "></td>
                    </tr>
                    <tr class="description">
                        <td class="four wide">توضیحات</td>
                        <td class="twelve wide "></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="sixteen wide column">
                <div class="ui segment"></div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var file_category = $('#file_category');
        initCheckbox();

        // adding event listener to 'add-category' element
        $('.ui.modal.new-category').modal();
        file_category.find('.add-category').on('click', function () {
            $('.ui.modal.new-category').modal({
                onShow: function () {
                    $('.ui.checkbox').checkbox();
                    //add selectbox options
                    var cats = file_category.find('.ui.checkbox');
                    var dropdwn = $(this).find('.field .ui.dropdown');
                    dropdwn.find('select').empty();
                    cats.each(function (indx, e) {
                        var elem = $(e);
                        dropdwn.find('select').append('<option value="' + elem.data('id') + '">' + elem.find('label').html() + '</option>');
                    })
                },
                onApprove: function () {
                    $('.ui.form').form('validate form');
                    $('.ui.form').form('submit');
                    return false;
                },
                onHidden: function () {
                    initCheckbox();
                }
            }).modal('show');
        })

        // validating form
        $('.ui.form').form({
            on: 'change',
            fields: {
                category_name: {
                    identifier: 'category_name',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'لطفا نام دسته بندی را وارد کنید'
                        },
                        {
                            type: 'minLength[3]',
                            prompt: 'طول نام دسته بندی حداقل ۳ کاراکتر می‌باشد'
                        }
                    ]
                },
                dir_name: {
                    identifier: 'dir_name',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'لطفا نام پوشه دسته را به انگلیسی وارد کنید'
                        },
                        {
                            type: 'regExp',
                            value: /[A-Za-z0-9_]+/i,
                            prompt: 'لطفا نام پوشه دسته را به حروف انگلیسی وارد کنید'
                        }
                    ]
                }
            }
        })

        // edit category modal
        $('.ui.modal.edit-category').modal();
        file_category.find('.edit-category').on('click', function (e) {
            // geting checked checkbox info
            initCheckbox();
            var $el = getCheckedElement();
            if (!$el) {
                noElemChecked();
                return;
            }


            $('.ui.modal.edit-category').modal({
                onShow: function () {

                },
                onVisible: function () {
                    // seting form init data
                    var dd = {
                        cat_id: $el.data('id'),
                        category_name: $el.find('label').html(),
                        description: $el.data('description'),
                    }

                    $('.ui.form.edit-category-form').form('set values', dd)
                },
                onApprove: function () {
                    $('.ui.form').form('validate form');
                    $('.ui.form').form('submit');
                    return false;
                },
                onHidden: function () {
                    initCheckbox();
                }
            }).modal('show');
        });


        /*
        * Adding event listener to Delete button
        * */
        $('.delete-category').on('click', function () {
            // geting checked checkbox info
            initCheckbox();
            var $el = getCheckedElement();
            if (!$el) {
                noElemChecked();
                return;
            }
            if (!$el.parents('.item').hasClass('removable')) {
                showFailureModal();
                return;
            }
            $('.ui.modal.detele-category').modal({
                closable: false,
                onApprove:function(){
                    $(".delete_category_form").find('input[name="cat_id"]').val( $el.data('id') )
                    $('.delete_category_form').submit();
                }
            }).modal('show')

        })

        // functions
        function initCheckbox() {
            $('.ui.checkbox.file_categories').checkbox({
                onChecked: function () {
                    var elem = $(this).parent()[0];
                    var a = file_category.find('.ui.file_categories').each(function (ind, dataa) {
                        if (elem != dataa)
                            $(dataa).checkbox('set unchecked');
                    })
                    var details = {
                        category_name: $(elem).find('label').html(),
                        dir_name: $(elem).data('dir-name'),
                        description: $(elem).data('description'),
                        base_path: $(elem).data('base-path'),
                        parent_category: $(elem).data('parent-cat-name'),
                        removable: $(elem).data('removable'),
                    }
                    showDetailEvent(details);
                },
                onUnchecked: function () {
                    cleaningDetailTable();
                }
            });
        }

        function getCheckedElement() {
            var ret = false;
            file_category.find('.ui.file_categories').each(function (ind, dataa) {
                if ($(dataa).checkbox('is checked'))
                    ret = $(dataa);
            })
            return ret;
        }

        function showFailureModal() {
            alert('دسته‌ای که انتخاب کردید قابل حذف نیست');
            return false;
        }

        function noElemChecked() {
            alert('دسته‌ای را انتخاب نکردید لطفا دسته‌ای را انتخاب کنید');
            return false;
        }

        function showDetailEvent(details) {
            // showing detail in 'category_detail_table'
            var cat_detail_table = $('.category_deatil_table');
            cat_detail_table.find('.category_name td:nth-child(2)').html(details.category_name);
            cat_detail_table.find('.dir_name td:nth-child(2)').html(details.dir_name);
            cat_detail_table.find('.description td:nth-child(2)').html(details.description);
            cat_detail_table.find('.base_path td:nth-child(2)').html(details.base_path);
            cat_detail_table.find('.parent_category td:nth-child(2)').html(details.parent_category);
            if (details.removable == '1') {
                cat_detail_table.find('.removable td:nth-child(2)').html('بلی');
                cat_detail_table.find('.removable').removeClass('negative');
                cat_detail_table.find('.removable').addClass('positive');
            }
            else {
                cat_detail_table.find('.removable td:nth-child(2)').html('خیر');
                cat_detail_table.find('.removable').removeClass('positive');
                cat_detail_table.find('.removable').addClass('negative');
            }
        }

        function cleaningDetailTable() {
            var cat_detail_table = $('.category_deatil_table');
            cat_detail_table.find('tr').each(function (ind, d) {
                $(d).find('td:nth-child(2)').html('');
                $(d).removeClass('positive');
                $(d).removeClass('negative');
            })
        }
    </script>
@endsection