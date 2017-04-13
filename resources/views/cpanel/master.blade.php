<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta dir="rtl" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--&#91;if lt IE 9&#93;>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <!&#91;endif&#93;-->

    <link rel="stylesheet" href="{{asset('cpanel/css/cpanel.css')}}"/>
    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />
</head>
<body>
<div class="container">

    <?php
        $dashboard="";
    ?>

    <nav class="nav-vertical col-3">
        <div class="info">
            <section class="thumbnail">
                <section class="photo">
                    <img src="{{asset('cpanel/img')}}/IMG_8161.JPG" alt="">
                </section>
            </section>
            <p class="login-info"><span>حسین نصیری عزیز</span> خوش آمدی</p>
            <div class="button">
                <button type="button" class="setting">تنظیمات شخصی</button>
                <button type="button" class="exit">خروج</button>
            </div>
        </div>
        <ul>

            <li>
                <a href="/admin-panel/" class="fa-home {{$dashboard}}">داشبورد</a>
            </li>

            <li>
                <a href="" class="fa-paperclip" onclick="return false">ارسال مطلب </a>
                <ul class="toggle-menu">
                    <li><a href="/admin-panel/post/new/">ارسال خبر جدید</a></li>
                    <li><a href="/admin-panel/notification/new/">ارسال اطلاعیه جدید</a></li>
                    <li><a href="/admin-panel/seminar/new/">ثبت همایش یا سمینار جدید</a></li>
                    <li><a href="/admin-panel/incoming/new/">ثبت پیشامد جدید</a></li>
                    <li><a href="/admin-panel/manageposts/">مدیریت ارسال شده ها</a></li>
                </ul>
            </li>
            <li>
                <a href="/admin-panel/page/new/" class="fa-file" >ایجاد برگه</a>
            </li>
            <li class="hr">
                <a href="/admin-panel/allprofessors/" class="fa-user ">اعضای هیئت علمی</a>
            </li>
            <li >
                <a href="/admin-panel/allusers/" class="fa-users ">مدیریت اعضا</a>
            </li>
            <li>
                <a href="/admin-panel/navigationbar/" class="fa-th-large ">مدیریت نوار منو</a>
            </li>
            <li>
                <a href="/admin-panel/slider/" class="fa-television ">اسلایــدر</a>
            </li>
            <li>
                <a href="/admin-panel/fastmenu/" class="fa-bars ">منوی دسترسی سریع</a>
            </li>
            <li>
                <a href="/admin-panel/allsetting/" class="fa-cog ">تنظیمات عمومی</a>
            </li>
            <li >
                <a href="/admin-panel/allcomments/" class="fa-commenting "> دیدگاه ها <span class="badge" title="دیدگاه های تایید نشده">{{$unverifiedCommentsCount}}</span></a>
            </li>
            <li >
                <a href="/" class="fa-paper-plane" target="_blank">مشاهده سایت اصلی</a>
            </li>
        </ul>
    </nav>


    <div class="col-13" id="content">
        <span id="heading">@yield('title')</span>
        <div class="row ">
            @yield('content')
        </div>
    </div>
</div>

<!--        ----------------------------------------- js ---------------------------------------------->
<script src="{{asset('cpanel/js/jquery-1.11.2.min.js')}}"></script>
<script src="{{asset('cpanel/js/js.js')}}"></script>
{{--<script src="{{asset('cpanel/js/ck/ckeditor.js')}}"></script>--}}
{{--<script src="{{asset('cpanel/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>--}}
{{--<script src="{{asset('cpanel/js/checkbox.js')}}"></script>--}}
{{--<script src="{{asset('cpanel/js/radiobtn.js')}}"></script>--}}
{{--<script>--}}
    {{--CKEDITOR.replace('post_content',{'language':'fa','height':300,'toolbarCanCollapse ':'true'});--}}
{{--</script>--}}
{{--@yield('scripts')--}}
@yield('scripts')

</body>
</html>