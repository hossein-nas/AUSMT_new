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
						<a href="#">@yield('post_title')</a>
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
								دو شنبه ۲۲ آذر ماه ۱۳۹۵ - ساعت ۲۲:۲۲
							</span>

							<span class="reply-btn">
								<i class="material-icons">reply</i>
							</span>
						</div>
					</div>
				</div>

				{{--Area for writing new comment--}}
				<div id="write-comment">
					<h3 class="headline">
						<span class="headline-box">

						</span>
					</h3>

					<section class="form-box">
						<form action="#" method="post">
							<div class="form-group-item">
								<label for="username">نام و نام خانوادگی</label>
								<input type="text" name="username" >
							</div>
							<div class="form-group-item">
								<label for="username">پست الکترونیکی</label>
								<input type="text" name="email" >
							</div>
							<div class="form-group-item">
								<label for="username">محتوای دیدگاه</label>
								<textarea name="content" id="comment-content" ></textarea>
							</div>
							<div class="form-group-item">
								<button class="submit btn success" type="submit" name="submit">ثبت دیدگاه</button>
							</div>
						</form>
					</section>
					<section class="error-box">
						<ul>
							<li class="error">خطا در سرور</li>
							<li class="success">خطا در سرور</li>
							<li class="warning">خطا در سرور</li>
						</ul>
					</section>
				</div>
			</div>

		</section>
		<aside id="sidebar">
			<article class="sidebar-panel post-fastmenu">
				<div class="body">
					<ul class="menu">
						<li class="item">
							<a href="">
								<div class="thumbnail">
									<img src="./media/fastmenu/001_monitor_system.svg" alt="">
								</div>
								<div class="title"> سامانه سما</div>
							</a>
						</li>
						<li class="item">
							<a href="">
								<div class="thumbnail">
									<img src="./media/fastmenu/136_chikent_food_self_serving.svg" alt="">
								</div>
								<div class="title">سامانه تغذیه</div>
							</a>
						</li>
						<li class="item">
							<a href="">
								<div class="thumbnail">
									<img src="./media/fastmenu/022_calender.svg" alt="">
								</div>
								<div class="title">تقویم آموزشی</div>
							</a>
						</li>
					</ul>
				</div>
			</article>

			<article class="sidebar-panel hot-news">
				<div class="headline">
					<span class="headline-box"></span>
				</div>
				<div class="body">
					<ul class="">
						<li class="item">
								<div class="thumbnail">
									<img src="./media/photos/small/2.png" alt="">
								</div>
								<a href="" class="title">بازدید معاون اداری مالی و مدیریت منابع وزارت علوم تحقیقات وفناوری از دانشگاه دولتی تخصصی فناوری های نوین آمل </a>
						</li>
						<li class="item">
							<div class="thumbnail">
								<img src="./media/photos/small/3.png" alt="">
							</div>
							<a href="" class="title">حضور جناب پروفسور دومیری گنجی در مراسم تجلیل از اساتید نمونه دانشگاه مازندران با حضور وزیرعلوم تحقیقات و فناوری</a>
						</li>
						<li class="item">
							<div class="thumbnail">
								<img src="./media/photos/small/2.png" alt="">
							</div>
							<a href="" class="title">بازدید معاون اداری مالی و مدیریت منابع وزارت علوم تحقیقات وفناوری از دانشگاه دولتی تخصصی فناوری های نوین آمل </a>
						</li>

					</ul>
				</div>
			</article>
		</aside>
	</div>
@endsection