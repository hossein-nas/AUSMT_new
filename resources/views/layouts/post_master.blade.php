@extends('layouts.site_master')

@section('content')
	<div id="post-page">
		<section id="main-area">
			<div id="postcontent">
				<section id="header-section">
					<section id="thumbnail-area">
						@yield('post_thumbnail')
					</section>
					<h1 class="title header headline">
						<a href="@yield('post_title_url')">@yield('post_title')</a>
					</h1>
					<section id="details">
						<ul>
							<li class="author" >
								@yield('author')
							</li>
							<li class="date" >
								@yield('date')
							</li>
							<li class="time">
								@yield('time')
							</li>
						</ul>
					</section>
				</section>

				<section id="text-area">
					@yield('text-area')
				</section>

				<section id="attachments">
					@yield('attachments')
				</section>

				<section id="related-posts">
					@yield('related-posts')
				</section>

				<section id="categories">

				</section>
			</div>


			<div id="comment-area">
				@if($news->comments->count())
					@foreach ($news->comments as $cm)
						<div class="item"
							 data-cm-id="{{$cm->id}}"
							 data-cm-name="{{$cm->name}}"
							 data-repiler-id="{{$cm->replier?$cm->replier->id:''}}"
						>
							<div class="body">
								<h3 class="headline ">
							<span class="headline-box">
								<span class="writer">
									{{ $cm->name }}
								</span>
								@if($cm->replier)
									<span class="in-reply">
									{{ $cm->replier->name }}
									</span>
								@endif
							</span>
								</h3>
								@if($cm->replier)
									<div class="replier">
									{{ $cm->replier->content }}
									</div>
								@endif

								<div class="comment-text">
									{{ $cm->content }}
								</div>

								<div class="bottom-details">
							<span class="date-and-time">
								{{ toPersianNums( jDate::forge($cm->created_at->timestamp)->format('%d %Bماه %y - ساعت %H:i') ) }}
							</span>

									<span class="reply-btn">
								<i class="material-icons">reply</i>
							</span>
								</div>
							</div>
						</div>
					@endforeach
				@else
					<span class="no-comment-yet">کامنتی درج نشده است ...</span>
				@endif
				{{-- cm item template
				<div class="item">
					<div class="body">
						<h3 class="headline ">
							<span class="headline-box">
								<span class="writer">
									حسین نصیری
								</span>
								<span class="in-reply">
									رضا رضا زاده
								</span>
							</span>
						</h3>

						<div class="replier">
							به گزارش "ورزش سه"، کریستیانو رونالدو 613 دقیقه است که در لیگ قهرمانان موفق به گلزنی نشده است که این عدد دقیقا با رکورد 613 دقیقه عدم گلزنی با لباس منچستر یونایتد در بین سالهای 2008 و 2009 برابر است.
						</div>

						<div class="comment-text">
							رونالدو که آمار فوق العاده 34 گل در 40 بازی در مراحل حذفی لیگ قهرمانان را برای لوس بلانکوس به ثبت رسانده، در جریان پیروزی مجموعا 2-6 تیمش برابر ناپولی در مرحله قبل، نتوانست نام خود را در فهرست گلزنان ثبت کند.
						</div>

						<div class="bottom-details">
							<span class="date-and-time">
								دوشنبه ۲۲ آذر ماه ۱۳۹۵ - ساعت ۲۲:۲۲
							</span>

							<span class="reply-btn">
								<i class="material-icons">reply</i>
							</span>
						</div>
					</div>
				</div>
				--}}

				{{--Area for writing new comment--}}
				<div id="write-comment">
					<h3 class="headline">
						<span class="headline-box">

						</span>
					</h3>
					<div class="replier_name">

					</div>

					<section class="form-box">
						<form action="{{ route('insert_new_comment') }}" method="post">
							{{ csrf_field() }}
							<input type="hidden" name="replier_id" value="">
							<input type="hidden" name="post_id" value="{{$news->id}}">
							<div class="form-group-item">
								<label for="username">نام و نام خانوادگی</label>
								<input type="text" name="username" >
							</div>
							<div class="form-group-item">
								<label for="email">پست الکترونیکی</label>
								<input type="text" name="email" >
							</div>
							<div class="form-group-item">
								<label for="content">محتوای دیدگاه</label>
								<textarea name="cm_content" id="comment_content" ></textarea>
							</div>
							<div class="form-group-item">
								<button class="submit btn success" type="submit" name="submit">ثبت دیدگاه</button>
							</div>
						</form>
					</section>
					<section class="error-box">
						<ul>
							@if ( session('success'))
								<li class="success">{{ session('success') }} </li>
							@endif
							@if ( session('error'))
								<li class="error">{{ session('error') }} </li>
							@endif
						</ul>
					</section>
				</div>
			</div>

		</section>
		<aside id="sidebar">
			<article class="sidebar-panel post-fastmenu">
				<div class="body">
					<ul class="menu">
						@if( count($Fastmenu) )
							@foreach($Fastmenu as $item)
								<li class="item">
									<a href="{{ $item->uri }}">
										<div class="thumbnail">
											<img src="{{ $item->icon->specs[0]->file_fullpath }}" alt="{{ $item->title }}">
										</div>
										<div class="title">{{ $item->title }}</div>
									</a>
								</li>
							@endforeach
						@endif
						{{--<li class="item">
							<a href="">
								<div class="thumbnail">
									<img src="/media/fastmenu/001_monitor_system.svg" alt="">
								</div>
								<div class="title"> سامانه سما</div>
							</a>
						</li>--}}
					</ul>
				</div>
			</article>

			<article class="sidebar-panel hot-news">
				<div class="headline">
					<span class="headline-box"></span>
				</div>
				<div class="body">
					<ul class="">
						@foreach($hotNews as $hot)
							<li class="item">
								<div class="thumbnail">
									<img src="/{{ $hot->thumbnail->specs->last()->file_fullpath }}" alt="{{ $hot->thumbnail->name }}">
								</div>
								<a href="{{ url()->route('showNews', $hot->title_seo) }}" class="title">{{ $hot->title }}</a>
							</li>
						@endforeach


					</ul>
				</div>
			</article>
		</aside>
	</div>
@endsection

@section('scripts')
	<script>
		$('.reply-btn').click(function(){
		    var id = $(this).closest('.item').data('cm-id');
		    var name = $(this).closest('.item').data('cm-name');
		    var replier_box = $('.replier_name');
            replier_box.find('*').detach();
		    $('<div>').addClass('name').html(name).appendTo(replier_box);
		    $('<span>').addClass('cancel').html('حذف').on('click',function(){
                replier_box.find('*').detach();
                $('.form-box input[name="replier_id"]').val('');
			}).appendTo(replier_box);
		    $('.form-box input[name="replier_id"]').val(id);
		})
	</script>
@endsection

