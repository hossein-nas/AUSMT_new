@extends('cpanel.master')

@section('title')
	تنظیمات عمومی سایت
@endsection

@section('content')
	<section class="allsetting">
		<article class="quick-access" sub=":: بخش دسترسی سریع ::">
			@if($allQuickAccess->count())
				@foreach($allQuickAccess as $key=>$item)
					<div class="item" data-rel-id="{{$item->id}}">
						<ul>
							<li>{{$key+1}}</li>
							<li class="alink">
								{{link_to($item->value,$item->name,['target'=>'_blank'])}}
							</li>
							<li>
								{{link_to('/admin-panel/allsetting/delete/'.$item->id ,'حذف',['class'=>'actions delete','onclick'=>'return confirm("آیا از حذف این مورد اطمینان دارید؟")'])}}
								<div class="actions edit">ویرایش</div>
							</li>
						</ul>
					</div>
				@endforeach
				<span class="add-new-item"  data-type="1">افزودن مورد جدید</span>

			@else
				<div class="no-text"></div>
			@endif

		</article>
		<article class="links" sub=":: بخش پیوندها ::">
			@if($allLinks->count())
				@foreach($allLinks as $key=>$item)
					<div class="item" data-rel-id="{{$item->id}}">
						<ul>
							<li>{{$key+1}}</li>
							<li class="alink">
								{{link_to($item->value,$item->name,['target'=>'_blank'])}}
							</li>
							<li>
								{{link_to('/admin-panel/allsetting/delete/'.$item->id ,'حذف',['class'=>'actions delete','onclick'=>'return confirm("آیا از حذف این مورد اطمینان دارید؟")'])}}
								<div class="actions edit">ویرایش</div>
							</li>
						</ul>
					</div>
				@endforeach
				<span class="add-new-item" data-type="2">افزودن مورد جدید</span>
			@else
				<div class="no-text"></div>
			@endif
		</article>

		<div class="setting-edit-form">
			{{Form::open(['url'=>'/admin-panel/allsetting/edit/'])}}
				{{Form::hidden('rel_id')}}
				<div class="item">
					{{Form::label('عنوان : ')}}
					{{Form::text('name')}}
				</div>
				<div class="item">
					{{Form::label('آدرس : ')}}
					{{Form::text('value',null,['class'=>'ltr'])}}
				</div>
				{{Form::submit('ذخیره کن!',['class'=>'submit-btn'])}}
			{{Form::close()}}
		</div>
		<div class="setting-add-new-item ">
			{{Form::open()}}
				{{Form::hidden('type')}}
				<div class="item">
					{{Form::label('عنوان : ')}}
					{{Form::text('name')}}
				</div>
				<div class="item">
					{{Form::label('آدرس : ')}}
					{{Form::text('value',null,['class'=>'ltr'])}}
				</div>
				{{Form::submit('ثبت کن!',['class'=>'submit-btn'])}}
			{{Form::close()}}
		</div>
	</section>

	@if ($errors->any())
		<ul class="errors">
			@foreach($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
		</ul>
	@endif
@endsection

@section('scripts')
	<script src="{{asset('cpanel/js/setting.js')}}"></script>
@endsection