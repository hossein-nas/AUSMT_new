@extends('layouts.site_master')

@section('content')
<div class="container">
    @include('.partials.slider')
    @include('.partials.fast_menu')
    @include('.partials.content')
    @include('.partials.panel_area')
</div>
@endsection
