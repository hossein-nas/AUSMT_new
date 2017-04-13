<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	<title>@yield('title','دانشگاه فناوری های نوین آمل')</title>
	{!! Html::style('assets/css/main.min.css')!!}
	@yield('styles')
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32" />
	<link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16" />

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
{!! Html::script("assets/js/jq.js")!!}
{!! Html::script("assets/js/plugins.min.js")!!}
{!! Html::script("assets/js/scripts.min.js")!!}
@yield('scripts')
<!-- java script  -->
</body>
</html>