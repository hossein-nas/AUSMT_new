@extends('cpanel.master')

@section('title')
    مدیریت محتوای ارسال شده
@endsection


@section('content')

    <div class="nav-menu">
        <div class="header">
            <ul>
                <li><a href="#post" >اخبــار</a></li>
                <li><a href="#notfication" >اطلاعیه ها</a></li>
                <li><a href="#seminar" >همایش و سمینار‌ ها</a></li>
                <li><a href="#incoming"  >پیشآمد ‌ها</a></li>
                <li><a href="#other" >متفرقـه</a></li>
                <li><a href="#page" >بـرگه ‌هـا</a></li>
            </ul>
        </div>
        <div class="body">
            <div id="post">             @include('cpanel.pages.includes.post')              </div>
            <div id="notfication">      @include('cpanel.pages.includes.notfication')       </div>
            <div id="seminar">          @include('cpanel.pages.includes.seminar')           </div>
            <div id="incoming">         @include('cpanel.pages.includes.incoming')          </div>
            <div id="other">            @include('cpanel.pages.includes.other')             </div>
            <div id="page">             @include('cpanel.pages.includes.pages')             </div>
        </div>
    </div>



@endsection


@section('scripts')
    <script src="{{asset('cpanel/js/nav_menu.js')}}"></script>
@endsection