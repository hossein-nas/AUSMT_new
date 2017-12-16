<section class="fast-menu">
	<section class="arrow-forward">
		<i class="material-icons">arrow_forward</i>
	</section>
	<section class="wrapper content frame">
		<ul class="slidee">
			@foreach($Fastmenu as $menu)
				<li class="item">
					<a href="{{ $menu->uri }}">
				<span class="icon">
					<img src="{{$menu->icon->specs[0]->file_fullpath}}" alt="">
				</span>
						<h1 class="title">{{ $menu->title }}</h1>
					</a>
				</li>
			@endforeach
		</ul>
	</section>
	<section class="arrow-backward">
		<i class="material-icons">arrow_back</i>
	</section>
</section>