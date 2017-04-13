@extends('cpanel.master')

@section('title')
	بخش تنظیمات اسلایدر
@endsection

@section('content')
	<div class="slider-cpanel">
		@if($sliderItems->count())
			@foreach($sliderItems as $key => $it)
				<article class="item">
					<section class="img">
						<img src="{{$it->image}}" alt="{{$it->title}}">
					</section>
					<section class="content">
						<h1>
							{{link_to(route($it->posttype->name,$it->hifen_title),$it->title,['target'=>'_blank'])}}
						</h1>
						<p class="content">
							{{ str_limit(strip_tags($it->content),150, ' ...')   }}
						</p>
						<div class="detail">
							<ul>
								<li title="ایجاد شده در : ">{{$jalali->forge($it->created_at->timestamp)->format("%e %B ")}}</li>
								<li title="آخرین تغییرات : ">{{$jalali->forge($it->updated_at->timestamp)->format("%e %B ")}}</li>
								<li title="میزان بازدید : ">{{$it->visit}}</li>
							</ul>
							{{link_to('/admin-panel/slider/delete/'.$it->hifen_title,'از اسلایدر بردار!',['class'=>'delete-from-slider'])}}
						</div>
					</section>
					<section class="index">
						<span>{{$key+1}}</span>
					</section>
				</article>
			@endforeach
		@else
			<div class="no-text"></div>
		@endif

	</div>
@endsection