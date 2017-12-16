@extends('cpanel.layout.master')

@section('main-section')
    <div class="ui message column">
        <div class="header">
            <div class="ui breadcrumb ">
                <div class="section"> خانه</div>
                <i class="left chevron icon divider"></i>
                <div class="section">منو دسترسی سریع</div>
            </div>
        </div>
    </div>


    <div class="ui grid ">
        <div class="twelve wide column">
            <div class="ui segment" id="fastmenu-list-area">
                @if (session('status'))
                    <div class="ui message ">
                        <ul>
                            <li>{{ session('status') }}</li>
                        </ul>
                    </div>
                @endif
                @foreach($Fastmenu as $item)
                    <div class="fastmenu-list">
                        <div class="item">
                            <div class="thumbnail">
                                <img src="{{ $item->icon->specs[0]->file_fullpath }}" alt="">
                            </div>
                            <div class="detail">
                                <div class="title">
                                    {{ $item->title }}
                                </div>
                                <div class="url">
                                    {{ $item->uri }}
                                </div>

                            </div>
                            <div class="select-box">
                                <div class="ui checkbox" data-id="{{$item->id}}" data-name="{{$item->title}}">
                                    <input tabindex="0" class="hidden" type="checkbox">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


                {{-- Modals --}}
                <div class="ui modal delete-item-modal mini longer">
                    <div class="header">حذف آیتم ها</div>
                    <div class="content ">
                        <form action="{{ route('delete_fastmenu_item') }}" method="POST"
                              class="ui form delete-item-form">
                            {{ csrf_field() }}
                            <select name="fastmenu_ids[]" id="all_selcted" multiple class="ui fluid dropdown">

                            </select>
                            <div class="ui message error"></div>
                        </form>

                        <h5 id="message"></h5>

                    </div>
                    <div class="actions">
                        <div class="ui cancel button tiny">انصراف</div>
                        <div class="ui approve button tiny green">تأیید و حذف</div>
                    </div>
                </div>

                <div class="ui modal add-item-modal longer">
                    <div class="header">افزودن آیتم</div>
                    <div class="content ">
                        <form action="{{ route('add_fastmenu_item') }}" method="POST" class="ui form add-item-form">
                            {{ csrf_field() }}
                            <input type="hidden" name="after_of" value="">
                            <div class="field required">
                                <label for="label">عنوان:</label>
                                <input type="text" name="fastmenu_title"
                                       placeholder="عنوان آیتم را در اینجا وارد کنید...">
                            </div>
                            <div class="field required">
                                <label for="label">آدرس:</label>
                                <input type="text" name="fastmenu_url" dir="ltr"
                                       placeholder="آدرس آیتم را در اینجا وارد کنید...">
                            </div>
                            <div class="field required">
                                <select name="lang_id" id="" class="ui dropdown">
                                    <option value="1">فارسی</option>
                                    <option value="2">انگلیسی</option>
                                </select>
                            </div>
                            <div class="field">
                                <label for="">انتخاب تصویر:</label>
                                <div class="icon-selection">
                                    <input type="hidden" name="icon_id" class="icon_id" value="">
                                    @if ( count ($all_Icons) > 0 )
                                        @foreach($all_Icons as $icon)
                                            <div class="icon-selection-item" data-icon-id="{{$icon->id}}">
                                                <img class="ui tiny image"
                                                     src="{{$icon->specs->first()->file_fullpath}}"
                                                     alt="{{$icon->title}}">
                                            </div>
                                        @endforeach
                                    @endif

                                </div>
                            </div>
                            <div class="ui message error"></div>
                        </form>

                        <h5 id="message"></h5>

                    </div>
                    <div class="actions">
                        <div class="ui cancel button tiny">انصراف</div>
                        <div class="ui approve button tiny green">تأیید و ارسال</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="four wide column">
            <div class="ui segment" id="actions">
                <input type="hidden" name="after_of" class="after_of" value="">
                <div class="ui vertical buttons fluid tiny labeled icon ">
                    <button class="ui button add-item">افزودن مورد جدید
                        <i class="plus square outline icon"></i>
                    </button>
                    <button class="ui button edit-item">ویرایش
                        <i class="edit icon"></i>
                    </button>
                    <button class="ui button delete-item">حذف موارد انتخابی
                        <i class="erase icon"></i>
                    </button>
                </div>
                <br>
                <div class="ui vertical buttons fluid tiny labeled icon ">
                    <button class="ui button select-all-items">انتخاب همه موارد
                        <i class="toggle on icon"></i>
                    </button>
                    <button class="ui button deselect-all-items">انتخاب هیچ‌یک
                        <i class="toggle off icon"></i>
                    </button>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var fastmenu_area = $('#fastmenu-list-area');
        var all_items = fastmenu_area.find('.ui.checkbox');
        $('.ui.checkbox').checkbox({
            onChecked: function () {
                $(this).closest('.item').addClass('active');
                var id = $(this).closest('.ui.checkbox').data('id')
                $('.after_of').val(id)
            },
            onUnchecked: function () {
                $(this).closest('.item').removeClass('active');
                $('.after_of').val('');
            }
        });

        /*
        * Event listener for select all items
        * */
        $('.select-all-items').on('click', function () {
            all_items.each(function () {
                $(this).checkbox('set checked').closest('.item').addClass('active');
                ;
            })
        })

        /*
        * Event listener for deselect all items
        * */
        $('.deselect-all-items').on('click', function () {
            all_items.checkbox('set unchecked').closest('.item').removeClass('active');

        })
        $('.icon-selection-item').on('click', function () {
            var a = $(this).siblings('.icon-selection-item');
            a.removeClass('active');
            if (!$(this).hasClass('active')) {
                var id = $(this).addClass('active').data('icon-id');
                $('.icon_id').val(id);
            }
            else {
                var id = $(this).removeClass('active').data('icon-id');
                $('.icon_id').val('');
            }
        });

        /*
        * Adding Event listener for add item btn
        * */
        $('.delete-item').on('click', function () {
            var all_selected = getAllSelectedItems();
            $('.ui.modal.delete-item-modal').modal({
                closable: false,
                onVisible: function () {
                    $(this).modal('refresh')

                },
                onShow: function () {
                    var all = getAllSelectedItems();
                    var count = all.size();
                    var selected = $('#all_selcted')
                    addOptionsToSelect(all, selected);
                    selected.dropdown();
                    $(this).find('#message').html('<p> ' + count + ' مورد پس از تأیید حذف خواهند شد. آیا موافقید؟ </p>')
                },
                onHide: function () {
                },
                onApprove: function () {
                    var _form = $('.delete-item-form');
                    _form.form({
                        fields: {
                            fastmenu_ids: {
                                identifier: 'fastmenu_ids',
                                rules: [
                                    {
                                        type: 'minLength[1]',
                                        prompt: 'موردی را برای حذف انتخاب نکردید'
                                    }
                                ]
                            }
                        }
                    })
                    _form.form('validate form');
                    if (_form.form('is valid'))
                        _form.submit();
                    return false;
                }
            }).modal('show');
        })

        $('.add-item').on('click', function () {
            $('.ui.modal.add-item-modal').modal({
                onShow: function () {
                    var id = $('.after_of').val();
                    var it;
                    if (id)
                        $(this).find('input[name="after_of"]').val(id);
                    else if (it = getLastItem()){
                        var id = it.closest('.ui.checkbox').data('id');
                        $(this).find('input[name="after_of"]').val(id);
                    }
                },
                onHidden: function () {

                },
                onApprove: function () {
                    var _form = $('.add-item-form');
                    var all = getAllSelectedItems();
                    if (all.size() > 1) {
                        alert('بیشتر از یک مورد را انتخاب کردید');
                        return false;
                    }
                    else if (all.size() < 2) {
                        _form.form({
                            fields: {
                                fastmenu_title: {
                                    identifier: 'fastmenu_title',
                                    rules: [
                                        {
                                            type: 'empty',
                                            prompt: 'عنوانی برای این مورد وارد نکردید'
                                        }
                                    ]
                                },
                                fastmenu_url: {
                                    identifier: 'fastmenu_url',
                                    rules: [
                                        {
                                            type: 'empty',
                                            prompt: 'آدرسی برای این مورد وارد نکردید'
                                        }
                                    ]
                                },
                                icon_id: {
                                    identifier: 'fastmenu_url',
                                    rules: [
                                        {
                                            type: 'minLength[1]',
                                            prompt: 'آیکنی برای ایم مورد انتخاب نکردید'
                                        }
                                    ]
                                }

                            }
                        }).form('validate form')
                        if (_form.form('is valid'))
                            _form.submit();
                    }
                    return false;
                }
            }).modal('show');
        })


        /*
        * function for getting selected items
        * */
        function getAllSelectedItems() {
            return all_items.filter(function (ind, data) {
                if ($(data).checkbox('is checked'))
                    return true;
                return false;
            })
        }

        function getLastItem() {
            if ( all_items.size())
                return all_items.last();
            return null;
        }

        function addOptionsToSelect(items, el) {
            el.dropdown('restore defaults');
            el.empty();
            items.each(function (ind, data) {
                var it = $(data);
                el.append('<option selected value="' + it.data('id') + '">' + it.data('name') + ' </option>')
            })
        }
    </script>
@endsection