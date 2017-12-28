<section class="body">
	<div class="header-menu">
		<section class="toggle-btn">
			<i class="material-icons">more_vert</i>
		</section>
		<div class="group-field inline">
			<label for="count">تعداد نمایش</label>
			<select name="display_count" id="display-count">
				<option value="4">۴</option>
				<option value="8" selected>۸</option>
				<option value="16">۱۶</option>
				<option value="32">۳۲</option>
			</select>
		</div>
		<div class="group-field inline">
			<label for="category">دسته بندی اخبار</label>
			<select name="category" id="display-count">
				<option value="0" selected>همه</option>
				<option value="6">اخبـار مهم</option>
				<option value="1">اخبـار</option>
				<option value="2">اطلاعیه ها</option>
				<option value="3">همایش ها و سیمنار ها</option>
				<option value="4">رویداد های پیش‌رو</option>
				<option value="5">اخبار متفرقه</option>
			</select>
		</div>
		<div class="group-field inline fl">
			<input type="text" id="search-filter" placeholder="کلمه مورد نظر را وارد کنید...">
			<span class="search-btn"></span>
		</div>
	</div>

	<section id="post-area">
		<div class="slidee wrapper">

			@foreach ($latestNews as $news )
				<section class="item post {{$news->record_type->name}} {{ $news->post->is_important? 'important' : '' }}">
					<div class="thumbnail-area bloading b-loading">
						<img
								class="bttrlazyloading"
								data-bttrlazyloading-xs-src="{{ $news->thumbnail->specs->last()->file_fullpath }}"
								data-bttrlazyloading-sm-src="{{ $news->thumbnail->specs->last()->file_fullpath }}"
								data-bttrlazyloading-md-src="{{ $news->thumbnail->specs->last()->file_fullpath }}"
								data-bttrlazyloading-lg-src="{{ $news->thumbnail->specs->first()->file_fullpath }}"
								alt="{{ $news->title }}">
						<ul class="datails">
							<li class="author">{{$news->author->name}}</li>
							<li class="time-ago">۳ساعت پیش</li>
							<li class="visited">۱۲۸</li>
						</ul>
					</div>
					<div class="text-area">
						<h1 class="header">
							<a href="{{ url()->route('showNews', $news->title_seo) }}">
								{{$news->title}}
							</a>
						</h1>
						<h2 class="summary">
							{!!   $news->post->content !!}
						</h2>
						<div class="button-area">
							<a href="{{ url()->route('showNews', $news->title_seo) }}" class="btn small success">
								بیشتر بخوانید
								<i class="material-icons">keyboard_backspace</i>
							</a>
						</div>
					</div>
				</section>
			@endforeach

		</div>
	</section>
</section>