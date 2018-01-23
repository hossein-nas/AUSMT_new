<div class="ui vertical menu fluid large">
    <div class="item">
        <div class="header">نوشته ها</div>
        <div class="menu">
            <div class="ui dropdown item ">
                پست‌ها
                <i class="dropdown icon"></i>
                <div class="ui vertical menu inverted">
                    <a class="item"><i class="settings icon"></i> مدیریت پست‌ها </a>
                    <div class="ui dropdown item pointing left"><i class="align right icon"></i> ایجاد پست جدید
                        <i class="icon dropdown"></i>
                        <div class="menu ">
                            <a href="{{ route('add_new_news') }}" class="item">ایجاد خبر</a>
                            <a href="/panel/new/post/notification" class="item">ایجاد اطلاعیه</a>
                            <a href="/panel/new/post/incoming" class="item">ایجاد پیش‌آمد</a>
                            <a href="/panel/new/post/seminar" class="item">ایجاد همایش یا سمینار</a>
                            <a href="/panel/new/post/misc" class="item">ایجاد خبر متفرقه</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui dropdown item ">
                برگه‌ها
                <i class="dropdown icon"></i>
                <div class="ui vertical menu">
                    <a class="item"><i class="settings icon"></i> مدیریت برگه‌ها </a>
                    <div class="ui dropdown item pointing left"><i class="align right icon"></i> ایجاد برگه‌ی جدید
                        <i class="icon dropdown"></i>
                        <div class="menu ">
                            <a href="#" class="item">ایجاد برگه‌ی ساده</a>
                            <a href="#" class="item">ایجاد برگه‌ی پیچیده</a>
                            <a href="#" class="item">ساخت پروفایل</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui dropdown item ">
                مجلات
                <i class="dropdown icon"></i>
                <div class="ui vertical menu inverted">
                    <a class="item"><i class="settings icon"></i> مدیریت مجلات </a>
                    <a class="item"><i class="add circle icon"></i> افزودن مجله‌ی جدید</a>
                </div>
            </div>
        </div>
    </div>
    <div class="item">
        <div class="header">بخش دیدگاه‌ها</div>
        <div class="menu">
            <a class="item">تأیید دیدگاه‌ها</a>
            <a class="item">مشاهده آخرین دیدگاه‌ها</a>
            <a href="{{ route('comment_page') }}" class="item">مدیریت دیدگاه‌ها</a>
        </div>
    </div>
    <div class="item">
        <div class="header">ابزارک‌ها</div>
        <div class="menu">
            <a href="#" class="item">اسلایدر</a>
            <a href="{{ route('navbar_page') }}" class="item">نوار منو</a>
            <a href="{{ route('fastmenu_page') }}" class="item">منو دسترسی سریع</a>
            <a href="#" class="item">لینک‌های پاورقی</a>
        </div>
    </div>
    <div class="item">
        <div class="header">بخش‌های سازمانی</div>
        <div class="menu">
            <div class="ui dropdown item">اشخاص
                <i class="dropdown icon"></i>
                <div class="menu">
                    <a class="item"><i class="settings icon"></i> مدیریت اشخاص </a>
                    <a class="item"><i class="add square icon"></i> افزودن شخص جدید </a>
                </div>
            </div>
            <div class="ui dropdown item">واحدهای سازمانی
                <i class="dropdown icon"></i>
                <div class="menu">
                    <a class="item"><i class="settings icon"></i> مدیریت واحدهای سازمانی </a>
                    <a class="item"><i class="add square icon"></i> افزودن واحد جدید </a>
                </div>
            </div>
            <div class="ui dropdown item">نقش‌های سازمانی
                <i class="dropdown icon"></i>
                <div class="menu">
                    <a class="item"><i class="settings icon"></i> مدیریت نقش‌های سازمانی </a>
                    <a class="item"><i class="add square icon"></i> افزودن نقش جدید </a>
                </div>
            </div>
            <div class="ui dropdown item">ساختمان‌ها و فضاها
                <i class="dropdown icon"></i>
                <div class="menu">
                    <a class="item"><i class="settings icon"></i> مدیریت ساختمان‌ها </a>
                    <a class="item"><i class="add square icon"></i> افزودن ساختمان جدید </a>
                </div>
            </div>
        </div>
    </div>
    <div class="item">
        <div class="header">بخش فایل‌ها</div>
        <div class="menu">
            <a href="{{ route('files_management') }}" class="item">مدیریت فایل‌ها</a>
            <a href="{{ route('add_new_file') }}" class="item">افزودن فایل جدید</a>
            <div class="item disabled">گالری</div>
        </div>
    </div>
    <div class="item">
        <div class="header">کاربران سیستم</div>
        <div class="menu">
            <a class="item">مدیریت کاربران</a>
            <a class="item">افزودن کاربر جدید</a>
            <a class="item">افزودن نقش کاربری</a>
        </div>
    </div>
</div>
