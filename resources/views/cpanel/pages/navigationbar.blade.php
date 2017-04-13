@extends('cpanel.master')

@section('title')
	مدیریت نوار منو
@endsection


@section('content')
	@if($navs->count())
		<ul class="navbar-list">
		@foreach($navs as $nav)
			<li class="root">
				<span class="{{$nav->childs->count()?'hasChild':''}}" data-rel-id="{{$nav->id}}" data-rel-href="{{$nav->href}}">{{$nav->name}}</span>
			</li>
			@if($nav->childs->count())
				<ul>
				@foreach($nav->childs as $childs)
					<li class="childs">
						<span class="{{$childs->childs->count()?'hasChild':''}}" data-rel-id="{{$childs->id}}"  data-rel-href="{{$childs->href}}">{{$childs->name}}</span>
					</li>
					@if($childs->childs->count())
						<ul>
						@foreach($childs->childs as $subChilds)
							<li class="subChilds">
								<span  data-rel-id="{{$subChilds->id}}" data-rel-href="{{$subChilds->href}}">{{$subChilds->name}}</span>
							</li>
						@endforeach
						</ul>
					@endif
				@endforeach
				</ul>
			@endif
		@endforeach
		</ul>

		<div class="add-new-nav-item btn btn-flat-green btn-small btn-margin-vertical">افزودن مورد جدید!</div>
		<div class="delete-nav-item btn btn-flat-red btn-small btn-margin-vertical">حذف کردن!</div>
		{{Form::open(['url'=>'/admin-panel/navigationbar/new/','id'=>'add-new-nav-item'])}}
			{{Form::hidden('parent_id',0)}}
			<div class="navbar-form-group">
				<div class="item">
					{{Form::label('عنوان:')}}
					{{Form::text('name')}}
				</div>
				<div class="item">
					{{Form::label('آدرس:')}}
					{{Form::text('href')}}
				</div>
				{{Form::submit('ثبت کن!',['class'=>'btn btn-flat-green btn-medium float-left btn-wide'])}}
			</div>
		{{Form::close()}}

		{{Form::open(['url'=>'/admin-panel/navigationbar/edit/','id'=>'update-nav-item'])}}
		{{Form::hidden('rel_id',0)}}
		<div class="navbar-form-group">
			<div class="item">
				{{Form::label('عنوان:')}}
				{{Form::text('name')}}
			</div>
			<div class="item">
				{{Form::label('آدرس:')}}
				{{Form::text('href')}}
			</div>
			{{Form::submit('ذخیره کن!',['class'=>'btn btn-flat-blue btn-medium float-left btn-wide'])}}
		</div>
		{{Form::close()}}

		{{Form::open(['url'=>'/admin-panel/navigationbar/delete/','id'=>'delete-nav-item'])}}
		{{Form::hidden('rel_id',0)}}
		<div class="navbar-form-group">
			{{Form::submit('حذف کن!',['class'=>'btn btn-flat-red btn-medium float-left btn-wide'])}}
		</div>
		{{Form::close()}}

		@if ($errors->any())
			<ul class="errors">
				@foreach($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
			</ul>
		@endif

		<div class="help" data="برای استفاده از این بخش به موارد زیر توجه کنید:">
			<ul>
				<li>جهت اضافه نمودن مورد جدید کافیست کلید "افزودن مورد جدید!" را انتخاب کنید، سپس فیلدهای خواسته شده را پرکرده و ثبت کنید.</li>
				<li>اگر میخواهید مورد جدید زیر مجموعه‌ ی مورد ای باشد کافیست موقع اضافه کردن روی آن مورد کلیک کنید.</li>
				<li>حداکثر میتوانید تا ۲ سطح منو داشته باشید و واضح است که جهت اضافه کردن مورد جدید سطح سوم قابل انتخاب نیست. </li>
				<li>جهت ایجاد تغییرات کافیست روی هر مورد دبل کلیک کنید تا صفحه فرم ظاهر شود و پس از اعمال تغییرات میتوانید ذخیره کنید.</li>
				<li>جهت حذف نمودن ابتدا روی کلید "حذف کردن!" را انتخاب کنید، سپس روی هر یک از موارد انتخابی کلیک کرده و سپس کلید حذف کنید.</li>
			</ul>
		</div>
	@endif





@endsection


@section('scripts')
	<script src="{{asset('cpanel/js/radiobtn.js')}}"></script>
	<script src="{{asset('cpanel/js/navigation_bar.js')}}"></script>
@endsection