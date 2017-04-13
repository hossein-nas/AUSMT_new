@extends('cpanel.master')

@section('title')
	اعضای هیئت علمی
@endsection

@section('content')
	@if($professors->count())
		@foreach($professors as $prof)
		<article class="prof">
			<section class="img ">
				<img src="{{$prof->image}}" alt="{{$prof->name}}">
			</section>
			<section class="detail ">
				<h1 class="heading">
					{{link_to($prof->homepage,$prof->name,['target'=>'_blank'])}}
					{{link_to('/admin-panel/edit/professor/'.$prof->id,'ویرایش',['class'=>'edit'])}}

				</h1>
				<table>
					<tr>
						<td>رتبه عملی : </td>
						<td >{{$prof->science_ranking}}</td>
						<td>دانشکده :</td>
						<td >{{$prof->college}}</td>
					</tr>
					<tr>
						<td>گروه آموزشی : </td>
						<td title="{{$prof->educational_group}}">{{$prof->educational_group}}</td>
						<td>ایمیل :</td>
						<td >{{Form::text('email',$prof->email,['readonly'=>'readonly'])}}</td>
					</tr>
					<tr>
						<td>رشته :</td>
						<td title="{{$prof->field}}">{{$prof->field}}</td>
						<td>صفحه شخصی :</td>
						<td >{{link_to($prof->homepage,$prof->homepage,['target'=>'_blank'])}}</td>
					</tr>
				</table>
			</section>
		</article>
		@endforeach
	@else
		<span class="no-text"></span>
	@endif

	{{link_to('/admin-panel/addprofessor/','افزود عضو جدید',['class'=>'btn btn-flat-green btn-margin-vertical float-right btn-medium'])}}
@endsection