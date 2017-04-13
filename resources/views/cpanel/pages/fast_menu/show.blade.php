@extends('cpanel.master')
@section('title')
	بخش مدیریت منوی دسترسی سریع
@endsection

@section('content')
	<div class="fast-menu-content">
		@if(count($f_menu))
			<div class="fast-menu">
				@foreach($f_menu as $key => $it)
					<section >
						<a href="{{$it['href']}}">
							<img src="{{$it['image']}}" alt="{{$it['name']}}">
							<p>{{$it['name']}}</p>
						</a>
					</section>
				@endforeach
			</div>
		@endif

		<div class="btn btn-flat-red btn-small btn-margin-vertical delete-menu-item">حذف کردن!</div>

		<div class="form-group fast-menu-form">
			{!! Form::open() !!}
			{{Form::hidden('id')}}

			<div class="item">
				<p class="input">عنوان :</p>
				{{Form::text('name')}}
			</div>
			<div class="item">
				<p class="input">آدرس :</p>
				{{Form::text('href')}}
			</div>
			<div class="item upload-image">
				{!! Form::label('name','َعکس خود را انتخاب کنید:') !!}
				{!! Form::file('post_image',['id'=>'file']) !!}
				{!! Form::hidden('image',null,['id'=>'image']) !!}
				{!! Form::hidden('destPath','fast_menu/icons/',['id'=>'destPath']) !!}
				<div id="uploaded-image">
				</div>
				<div id="open-window">انتخاب تصویر</div>
				<div id="upload-image">
					آپلود تصویر
				</div>
			</div>
			{!! Form::submit('ثبت کن!',['id'=>'submit','class'=>'btn btn-flat-green btn-large float-left btn-wide']) !!}

			{!! Form::close() !!}
		</div>
	</div>
	<div class="help" data="برای استفاده از این بخش به موارد زیر توجه کنید:">
		<ul>
			<li>جهت ویرایش هریک از منو ها کافیست رویش دبل کلیک کنید و با ظاهر شدن فرم مشخصات را تغییر و ثبت
				کنید.
			</li>
			<li>جهت اضافه نمودن منوی جدید کافیست روی علامت + دبل کلیک کنید و با ظاهر شدن فرم مشخصات را وارد کنید و
				ثبت کنید.
			</li>
			<li>جهت حذف نمودن ابتدا روی کلید "حذف کردن!" کلیک کنید و سپس میتونید با دبل کلیک روی هر کدام از منو ها
				حذفش کنید.
			</li>
		</ul>
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
	<script src="{{asset('cpanel/js/fast_menu.js')}}"></script>
@endsection

