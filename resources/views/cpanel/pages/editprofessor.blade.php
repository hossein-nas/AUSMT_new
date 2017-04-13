@extends('cpanel.master')

@section('title')
	افزود عضو هیئت علمی جدید
@endsection

@section('content')
	<div class="form-group">
		{!! Form::open(['url'=>'/admin-panel/professor/edit']) !!}

		{!! Form::hidden('rel_id',$prof->id) !!}

		<div class="item">
			<p class="input">نام و نام خانوادگی :</p>
			{!! Form::text('name',$prof->name,['placeholder'=>'دکتر رسول حاجی زاده']) !!}
		</div>
		<div class="item">
			<p class="input">ایمیل شخصی را وارد کنید :</p>
			{!! Form::email('email',$prof->email,['placeholder'=>'person@example.com']) !!}
		</div>
		<div class="item">
			<p class="input">رشته تحصیلی را وارد کنید :</p>
			{!! Form::text('field',$prof->field,['placeholder'=>'مهندسی برق-مکانیک']) !!}
		</div>
		<div class="item">
			<p class="input">رتبه علمی استاد را وارد کنید :</p>
			{!! Form::text('science_ranking',$prof->science_ranking,['placeholder'=>'استادیار، استاد تمام، ...']) !!}
		</div>
		<div class="item">
			<p class="input">گروه آموزشی استاد را وارد کنید :</p>
			{!! Form::text('educational_group',$prof->educational_group,['placeholder'=>'مهندسی کامپیوتر، برق، دامپزشکی، ...']) !!}
		</div>
		<div class="item">
			<p class="input">دانشکده‌ای که در آن حضور دارد را وارد کنید :</p>
			{!! Form::text('college',$prof->college,['placeholder'=>'فنی مهندسی، دامپزشکی، ...']) !!}
		</div>
		<div class="item upload-image">
			{!! Form::label('name','تصویر شاخص خود را آپلود نمایید :') !!}
			{!! Form::file('post_image',['id'=>'file']) !!}
			{!! Form::hidden('image',$prof->image,['id'=>'image']) !!}
			{!! Form::hidden('destPath','_professors/',['id'=>'destPath']) !!}
			<div id="uploaded-image">
				<img src="{{$prof->image}}" alt="{{$prof->name}}">
			</div>
			<div id="open-window">انتخاب تصویر</div>
			<div id="upload-image">
				آپلود تصویر
			</div>
		</div>

		<div class="item">
			<p class="input">صفحه شخصی را وارد کنید :</p>
			{!! Form::text('homepage',$prof->homepage,['placeholder'=>'www.example.com/professor/name','class'=>'ltr']) !!}
		</div>

		{!! Form::submit('ثبت خبر',['id'=>'submit','class'=>'btn btn-flat-green btn-large float-left btn-wide']) !!}

		{!! Form::close() !!}
	</div>
	@if ($errors->any())
		<ul class="errors">
			@foreach($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
		</ul>
	@endif

@endsection

@section('scripts')
	<script src="{{asset('cpanel/js/upload_image.js')}}"></script>
@endsection