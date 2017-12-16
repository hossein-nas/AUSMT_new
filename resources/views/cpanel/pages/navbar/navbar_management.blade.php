@extends('cpanel.layout.master')
@section('main-section')
    <div class="ui message column">
        <div class="header">
            <div class="ui breadcrumb ">
                <div class="section"> خانه</div>
                <i class="left chevron icon divider"></i>
                <div class="section">نوار منو</div>
            </div>
        </div>
    </div>


    <div class="ui grid ">
        <div class="twelve wide column">
            <div class="ui segment" id="navbar-list-area">
                <div id="nav-list">
                    @if (session('status'))
                        <div class="ui message ">
                            <ul>
                                <li>{{ session('status') }}</li>
                            </ul>
                        </div>
                    @endif
                    @foreach( $orderedNav as $nav )
                        <div class="nav-item root">
                            <div class="content">
                                <div class="ui checkbox" data-nav-id="{{$nav->id}}" data-name="{{$nav->title}}">
                                    <input type="checkbox" name="example">
                                    <label>{{ $nav->title }}</label>
                                </div>
                            </div>
                            @if( count ( $nav->childs) > 0 )
                                @foreach( $nav->childs as $child )
                                    @if (  $child->type->name == 'child')
                                        <div class="nav-item child">
                                            <div class="content">
                                                <div class="ui checkbox" data-nav-id="{{$child->id}}"
                                                     data-name="{{$child->title}}">
                                                    <input type="checkbox" name="example">
                                                    <label>{{ $child->title }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif (  $child->type->name == 'group' )
                                        <div class="nav-item group">
                                            <div class="checkboxx">
                                                <div class="ui checkbox " data-nav-id="{{$child->id}}"
                                                     data-name="{{$child->title}}">
                                                    <input type="checkbox" name="example">
                                                </div>
                                            </div>
                                            <div class="content">
                                                <d class="title">
                                                    <span>نام گروه:</span>
                                                    {{ $child->title }}
                                                </d>
                                                @if ( count($child->childs) > 0)
                                                    @foreach( $child->childs as $child )
                                                        <div class="nav-item child">
                                                            <div class="content">
                                                                <div class="ui checkbox" data-nav-id="{{$child->id}}"
                                                                     data-name="{{$child->title}}">
                                                                    <input type="checkbox" name="example">
                                                                    <label>{{ $child->title }}</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    @endif

                                @endforeach
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="four wide column">
            <div class="ui segment " id="actions">
                <input type="hidden" name="item-nav" class="item-nav">
                <div class="ui vertical buttons fluid tiny labeled icon ">
                    <button class="ui button add-nav-item">افزودن مورد جدید
                        <i class="plus square outline icon"></i>
                    </button>
                    <button class="ui button edit-nav-item">ویرایش
                        <i class="edit icon"></i>
                    </button>
                    <button class="ui button delete-nav-item">حذف یک مورد
                        <i class="erase icon"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>


    {{--  Modals --}}
    <div class="ui modal adding-new-navbar mini">
        <div class="header">افزودن مورد جدید به نوار منو</div>
        <div class="content">
            <form action="{{ route('add_new_nav_item') }}" method="POST" class="ui form add_new_navar_form" >
                {{ csrf_field() }}
                <div class="ui message error"></div>
                <input type="hidden" name="parent_nav" class="parent_nav" value="">
                <div class="field">
                    <label for="label">عنوان:</label>
                    <input type="text" name="nav_title" placeholder="عنوان آیتم را در اینجا وارد کنید...">
                </div>
                <div class="field">
                    <label for="label">آدرس:</label>
                    <input type="text" name="url" dir="ltr" placeholder="Enter valid URL...">
                </div>
                <div class="field">
                    <label for="label">نوع آیتم:</label>
                    <select name="nav_type" id="lang" class="ui dropdown nav_type">
                        <option value="">انتخاب کنید</option>
                        <option value="1">ریشه</option>
                        <option value="2">گروه</option>
                        <option value="3">فرزند</option>
                    </select>
                </div>
                <div class="field">
                    <label for="label">زبان:</label>
                    <select name="lang_id" id="lang" class="ui dropdown">
                        <option value="1">فارسی</option>
                        <option value="2">English</option>
                    </select>
                </div>

            </form>
        </div>
        <div class="actions">
            <div class="ui cancel button tiny">انصراف</div>
            <div class="ui approve button tiny green">تأیید و ثبت</div>
        </div>
    </div>



    <div class="ui modal deleting-new-navbar mini">
        <div class="header">حذف ایتم از نوار منو</div>
        <div class="content">
            <p>آیا مطمئن هستید می‌خواهید آین آیتم را حذف کنید؟</p>
            <p class="danger">توجه داشته باشید که اگر حذف کنید تمامی آیتم های زیر مجموعه نیز حذف خواهد شد!</p>
            <form action="{{ route('delete_nav_item') }}" method="POST" class="ui form add_new_navar_form" >
                {{ csrf_field() }}
                <div class="ui message error"></div>
                <input type="hidden" name="navbar_id" class="navbar_id" value="">
            </form>
        </div>
        <div class="actions">
            <div class="ui cancel button tiny">انصراف</div>
            <div class="ui approve button tiny green">تأیید و ثبت</div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // variables
        var navbar_list_area = $('#navbar-list-area');
        var all_items = navbar_list_area.find('.ui.checkbox');


        /*
        * Initiating checkbox
        * */
        $('.ui.checkbox').checkbox({
            onChecked: function () {
                var val = $(this).closest('.ui.checkbox').data('nav-id');
                $('#actions').find('input.item-nav').val(val).trigger('change');
            },
            onUnchecked: function () {
                $('#actions').find('input.item-nav').val('').trigger('change');
            }
            , beforeChecked: function () {
                all_items.checkbox('set unchecked');
            }
        });

        /*
        * Adding event listner to add-nav-item
        * */
        $('.add-nav-item').on('click', function () {

            var el = generatInsertNextOf();
            el.find('.ui.dropdown').dropdown();
            $('.adding-new-navbar').find('.form.ui').append(el);
            $('.ui.dropdown.nav_type').dropdown({
                onChange:function(a,b,c){

                },
                action: function(name,val){
                    var selected = getSelectedNavItem();
                    if ( val != 1  && !selected ){
                        showWarningOnlyRootElem();
                        $(this).dropdown('set selected',1);
                        $(this).dropdown('hide');
                        return false;
                    }
                    else if ( val == 1 && selected ){
                        alert('آیتم ریشه فقط در اینجا نمیتوان اضافه کرد');
                        $(this).dropdown('set selected',3);
                        $(this).dropdown('hide');
                    }
                    else if ( val != 3 && getItemType(selected) == 'group' )
                    {
                        alert('به آیتم گروه فقط میتوان آیتم فرزند اضافه کرد');
                        $(this).dropdown('set selected',3);
                        $(this).dropdown('hide');
                    }
                    else if (getItemType(selected) == 'child' )
                    {
                        alert('به آیتم فرزند نمیتوان چیزی اضافه نمود.');
                        $(this).dropdown('hide');
                        $('.adding-new-navbar').modal('hide');
                    }
                    else{
                        $(this).dropdown('set selected',val);
                        $(this).dropdown('hide');
                    }
                }
            })

            $('.adding-new-navbar').modal({
                observeChanges: true,
                closable:false,
                onShow: function () {
                    var nav_id = $('#actions').find('input.item-nav').val();
                    $(this).find('.parent_nav').val(nav_id);
                },
                onHide: function () {
                    $(this).find('.nextOf').detach();
                },
                onApprove: function(){
                    $('.add_new_navar_form').form({
                        fields: {
                            nav_title: {
                                identifier: 'nav_title',
                                rules: [
                                    {
                                        type: 'empty',
                                        prompt: 'عنوان آیتم را وارد نکردید'
                                    }
                                ]
                            },
                            url: {
                                identifier: 'url',
                                rules: [
                                    {
                                        type: 'empty',
                                        prompt: 'یک آدرس معتبر وارد کنید'
                                    }
                                ]
                            },
                            nav_type: {
                                identifier: 'nav_type',
                                rules: [
                                    {
                                        type: 'minLength[1]',
                                        prompt: 'نوع آیتم را مشخص نکردید'
                                    }
                                ]
                            }
                        }
                    })
                    $('.add_new_navar_form').form('validate form')
                    if( $('.add_new_navar_form').form('is valid'))
                        return $(this).find('.ui.form').submit();
                    return false;
                }
            }).modal('show');


        });

        $('.delete-nav-item').on('click', function () {

            $('.deleting-new-navbar').modal({
                closable:false,
                onShow: function () {
                    var nav_id = $('#actions').find('input.item-nav').val();
                    $(this).find('.navbar_id').val(nav_id);
                },
                onHide: function () {
                    $(this).find('.navbar_id').val('');
                },
                onApprove: function(){
                    var _form = $(this).find('.ui.form');
                    _form.form({
                        fields: {
                            navbar_id: {
                                identifier: 'navbar_id',
                                rules: [
                                    {
                                        type: 'empty',
                                        prompt: 'آیتمی را برای حذف انتخاب نکردید'
                                    }
                                ]
                            }
                        }
                    })
                    _form.form('validate form')
                    if (_form.form('is valid')) {
                        _form.submit();
                    }
                    return false;

                }
            }).modal('show');
        })

        $('input.item-nav').on('change', function () {
            if ($(this).val() == '')
                $(this).removeClass('selected');
            else
                $(this).addClass('selected');
        })


        /*
        * Function for checking selected item
        * */
        function checkSelectedNavItem() {
            if ($('input.item-nav').val != '') {
                return $('input.item-nav').val();
            }
            return false;
        }

        /*
        * Getselected Nav Item
        * */
        function getSelectedNavItem() {
            if (!checkSelectedNavItem())
                return false;
            var ret;
            all_items.each(function (ind, data) {

                if ($(data).checkbox('is checked'))
                    ret = $(this);
            })
            return ret;
        }

        /*
        * Showing warning for not selected nav item
        * */
        function showWarningNotSelectedNavItem() {
            alert('لطفا ابتدا آیتمی را انتخاب کنید')
        }

        /*
        * Showing warning for Not adding item to child element
        * */
        function showWarningNotAddToChild(){
            alert('به نوع فرزند نمیتوان آیتم اضافه کرد');
        }

        /*
        * Showing error to not to add child or  gourp elem to root
        * */
        function showWarningOnlyRootElem(){
            alert('فقط میتوان آیتم ریشه را اضافه نمود')
        }


        /*
        * Getting root level item navs
        * */
        function getRootItemNavs() {
            var a = all_items.filter(function (ind, data) {
                var _item = $(this).closest('.nav-item');
                if (_item.hasClass('root'))
                    return true;
                return false;
            })
            return a;
        }

        /*
        * Get direct child nav items of giveng elem
        * */
        function getDirectChilrenOf(elem) {
            var _item = elem.closest('.nav-item');
            if (_item.hasClass('root')) {
                return _item.find('>.nav-item').find('.ui.checkbox');
            }
            else
                return _item.find('.content>.nav-item').find('.ui.checkbox');
        }

        /*
        * Generating Insert next to Element
        * */
        function generatInsertNextOf() {
            var _selected = getSelectedNavItem();
            var elem;
            if (!_selected)
                elem = getRootItemNavs();
            else {
                var nav_type = _selected.closest('.nav-item');
                elem = getDirectChilrenOf(_selected);
            }

            var pNode = $('<div>').addClass('field nextOf');
            $('<label>').html('درج شود بعد از:').appendTo(pNode);
            var _select = $('<select>').prop('name', 'after_of').addClass('ui dropdown');
            _select.append('<option > -- ابتدا -- </option>');
            elem.each(function (ind, data) {
                var el = $(data);
                var name = el.data('name');
                $('<option>').val(el.data('nav-id')).html(name).appendTo(_select);
            });
            _select.find('option').last().prop('selected','selected');
            _select.appendTo(pNode);
            return pNode;
        }

        /*
        * Detecting item type
        * */
        function getItemType($it){
            if ($it.closest('.nav-item').hasClass('root'))
                return 'root';
            else if ($it.closest('.nav-item').hasClass('group'))
                return 'group';
            else
                return 'child';
        }

    </script>
@endsection