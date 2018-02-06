<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--&#91;if lt IE 9&#93;>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <!&#91;endif&#93;-->

    <!------------------------------------- Style Sheet --------------------------------------->
    <link rel="stylesheet" href="{{ asset('assets/css/semantic.rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/cpanel.min.css') }}">

    @yield('styles')
<!---------------------------------- Style Sheet End -------------------------------------->

    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32"/>
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16"/>
    <meta name="theme-color" content="#0F595E">
</head>
<body>

    @include('cpanel.includes.header')

    <div class="ui container main">
        <div class="ui grid">

            <div class="ui four wide column ">
                @include('cpanel.includes.sidebar')
            </div>

            <div class="twelve wide column">

                    @yield('main-section')

            </div>
        </div>
    </div>
<!------------------------------------------- JS ---------------------------------------------->
<script src=" {{ asset('assets/js/libs/jquery-1.9.1.min.js') }}"></script>
<script src="{{ asset('assets/js/cpanel/vendors.min.js') }}"></script>
<script src="{{ asset('assets/js/cpanel/bundle.min.js') }}"></script>
{{--<script src="{{asset('cpanel/js/js.js')}}"></script>--}}
<script>

</script>
@yield('scripts')
<!----------------------------------------- JS End -------------------------------------------->

</body>
</html>