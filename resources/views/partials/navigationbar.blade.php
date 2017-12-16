<nav>
	<div class="container">


		<ul id="navbar">

			@foreach($Navbar as $nav)
				@if ( count ($nav->childs) > 0)
				<li>
					<span class="item dropdown-btn">
					{{ $nav->title }}
					<i class="material-icons">arrow_drop_down</i>
				    </span>
                    <div class="dropdown-content">
                        @foreach ($nav->childs as $child_nav)
                            @if ($child_nav->type->name == 'child')
								<a href="{{ $child_nav->uri }}" class="item">{{ $child_nav->title }}</a>
							@elseif ($child_nav->type->name == 'group')
								<section class="group">
									<h2 class="group-name" data-url="{{ $child_nav->uri }}">{{$child_nav->title}}</h2>
									<ul>
										@foreach ($child_nav->childs as $child_nav)
											@if ($child_nav->type->name == 'child')
												<a href="{{ $child_nav->uri }}" class="item">{{ $child_nav->title }}</a>
											@endif
										@endforeach
									</ul>
								</section>
							@endif
                        @endforeach
                    </div>
				</li>
				@else
					<li>
						<a href="{{$nav->uri}}" class="item"> {{ $nav->title }}</a>
					</li>
				@endif
			@endforeach
			{{--<li>
				<a href="#" class="item">صفحه اصلی</a>
			</li>
			<li>
				<span class="item dropdown-btn">
					درباره دانشگاه
					<i class="material-icons">arrow_drop_down</i>
				</span>
				<div class="dropdown-content">
					<a href="#" class="item">درباره شهر آمل</a>
					<section class="group">
						<h2 class="group-name">ریاست دانشگاه</h2>
						<ul>
							<li><a href="#" class="item">ارتباط با رئیس</a></li>
							<li><a href="#" class="item">ارتباط به معاون پژوهشی</a></li>
						</ul>
					</section>
					<section class="group">
						<h2 class="group-name">ریاست دانشگاه</h2>
						<ul>
							<li><a href="#" class="item">ارتباط با رئیس</a></li>
							<li><a href="#" class="item">ارتباط به معاون پژوهشی</a></li>
						</ul>
					</section>
				</div>
			</li>
			<li>
				<span class="item dropdown-btn">
					اعضای هیئت علمی
					<i class="material-icons">arrow_drop_down</i>
				</span>
				<div class="dropdown-content">
					<section class="group">
						<h2 class="group-name">دانشکده فنی مهندسی</h2>
						<ul>
							<li><a href="#" class="item">دکتر فخر الدین نظری</a></li>
							<li><a href="#" class="item">دکتر فرید صمصامی خداد</a></li>
						</ul>
					</section>
					<section class="group">
						<h2 class="group-name">دانشکده دامپزشکی</h2>
						<ul>
							<li><a href="#" class="item">دکتر سعید سیفی</a></li>
							<li><a href="#" class="item">دکتر حجت اله شكری</a></li>
							<li><a href="#" class="item">دکتر علی نيك پی</a></li>
						</ul>
					</section>
				</div>
			</li>
			<li>
				<a href="#" class="item">صفحه اصلی</a>
			</li>
			<li>
				<span class="item dropdown-btn">
					درباره دانشگاه
					<i class="material-icons">arrow_drop_down</i>
				</span>
				<div class="dropdown-content">
					<a href="#" class="item">درباره شهر آمل</a>
					<section class="group">
						<h2 class="group-name">ریاست دانشگاه</h2>
						<ul>
							<li><a href="#" class="item">ارتباط با رئیس</a></li>
							<li><a href="#" class="item">ارتباط به معاون پژوهشی</a></li>
						</ul>
					</section>
					<section class="group">
						<h2 class="group-name">ریاست دانشگاه</h2>
						<ul>
							<li><a href="#" class="item">ارتباط با رئیس</a></li>
							<li><a href="#" class="item">ارتباط به معاون پژوهشی</a></li>
						</ul>
					</section>
				</div>
			</li>--}}




		</ul>
	</div>
</nav>