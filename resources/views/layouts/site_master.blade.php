<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>@yield('title','دانشگاه فناوری های نوین آمل')</title>
    {!! Html::style('assets/css/main.min.css')!!}
    @yield('styles')
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--&#91;if lt IE 9&#93;>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <!&#91;endif&#93;-->
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32"/>
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16"/>
    <meta name="theme-color" content="#0F595E">

</head>
<body>


@include('partials.header')
@include('partials.navigationbar')

<div class="container">

    @yield('content')

</div>

@include('partials.footer')

<section id="off-positioning-area">

</section>
<!-- java script  -->
{!! Html::script("assets/js/libs/jquery-1.9.1.min.js")!!}
{!! Html::script("assets/js/site/vendors.min.js")!!}
{!! Html::script("assets/js/site/bundle.min.js")!!}
@yield('scripts')
<!-- java script  -->
</body>
</html>