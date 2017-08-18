<section class="fast-menu">
	<section class="arrow-forward">
		<i class="material-icons">arrow_forward</i>
	</section>
	<section class="wrapper content frame">
		<ul class="slidee">
			<?php $fastmenu = File::files('media/fastmenu'); ?>
			@foreach($fastmenu as $menu)
				<li class="item">
					<a href="#">
				<span class="icon">
					<img src="{{$menu}}" alt="">
				</span>
						<h1 class="title">سیستم آموزش</h1>
					</a>
				</li>
			@endforeach
		</ul>
	</section>
	<section class="arrow-backward">
		<i class="material-icons">arrow_back</i>
	</section>
</section>