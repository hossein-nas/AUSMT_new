<section class="slider">
	<ul class="slidee">
		@if ( count($Slider) )
			@foreach($Slider as $item)
				<li class="items">
					<a href="{{ route('showNews', ['title'=>$item->post->title_seo]) }}">
						<img
								src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==
								data-src="{{ $item->photos->specs->first()->file_fullpath }}"
								alt="">
						<section class="caption">
							<h1 class="header">
								{{ $item->title }}
							</h1>
							<h3 class="description">{!! substr($item->post->post->content,0,250) !!}</h3>
						</section>
					</a>
				</li>
			@endforeach
		@endif
		{{--<li class="items">
			<a href="#">
				<img
					src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==
					data-src="/media/photos/large/1.png"
					data-src-medium="/media/photos/medium/1.png"
					data-src-small="/media/photos/small/1.png"
					data-src-verysmall="/media/photos/very_small/1.png"
					alt="">
				<section class="caption">
					<h1 class="header">تغییر تاریخ امتحانات نیمسال دوم سال تحصیلی ۱۳۹۵ با توجه به ایام
						شهادت حضرت علی بن ابی طالب (ع) و ...</h1>
					<h3 class="description">به راحتی آدرس ورود وردپرس خود را تغییر دهید اگر شما از وردپرس استفاده کرده باشید برای ورود به پنل وردپرسی از آدرس هایی …</h3>
				</section>
			</a>
		</li>
		<li class="items">
			<a href="#">
				<img
					src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==
					data-src="/media/photos/large/2.png"
					data-src-medium="/media/photos/medium/2.png"
					data-src-small="/media/photos/small/2.png"
					data-src-verysmall="/media/photos/very_small/2.png"
					alt="">
				<section class="caption">
					<h1 class="header">تغییر تاریخ امتحانات نیمسال دوم سال تحصیلی ۱۳۹۵ با توجه به ایام
						شهادت حضرت علی بن ابی طالب (ع) و ...</h1>
					<h3 class="description">به راحتی آدرس ورود وردپرس خود را تغییر دهید اگر شما از وردپرس استفاده کرده باشید برای ورود به پنل وردپرسی از آدرس هایی …</h3>
				</section>
			</a>
		</li>
		<li class="items">
			<a href="#">
				<img
					src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==
					data-src="/media/photos/large/3.png"
					data-src-medium="/media/photos/medium/3.png"
					data-src-small="/media/photos/small/3.png"
					data-src-verysmall="/media/photos/very_small/3.png"
					alt="">
				<section class="caption">
					<h1 class="header">تغییر تاریخ امتحانات نیمسال دوم سال تحصیلی ۱۳۹۵ با توجه به ایام
						شهادت حضرت علی بن ابی طالب (ع) و ...</h1>
					<h3 class="description">به راحتی آدرس ورود وردپرس خود را تغییر دهید اگر شما از وردپرس استفاده کرده باشید برای ورود به پنل وردپرسی از آدرس هایی …</h3>
				</section>
			</a>
		</li>--}}
	</ul>
	<ul class="arrow">
		<li class="next">
			<i class="material-icons">arrow_forward</i>
		</li>
		<li class="prev">
			<i class="material-icons">arrow_back</i>
		</li>
	</ul>
	<ul class="pages">

	</ul>
</section>