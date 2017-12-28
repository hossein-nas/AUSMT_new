<header>
	<div class="container">
		<section class="title">
			<div class="logo">
				<a href="/">
					<img src="/assets/img/logo.svg" alt="Amol University logo">
				</a>
			</div>
			<div class="site-header">
				<img src="/assets/img/logo_name.svg" alt="Amol University">
			</div>
		</section>
		<section class="info">
			<a href="#" class="change-lang">go to english website</a>
			<div class="time-and-date">
				<div class="time">
					<span class="min">{{ toPersianNums( $jalali->reforge('now')->format('%M') ) }}</span>
					<span class="separator">:</span>
					<span class="hour">{{ toPersianNums( $jalali->reforge('now')->format('%H') ) }}</span>
				</div>
				<div class="date">
					<span class="weekday">{{ toPersianNums( $jalali->reforge('now')->format('%A') ) }}</span>
					<span class="day">{{ toPersianNums( $jalali->reforge('now')->format('%d') ) }}</span>
					<span class="month">{{ toPersianNums( $jalali->reforge('now')->format('%B') ) }}</span>
					<span class="year">{{ toPersianNums( $jalali->reforge('now')->format('%y') ) }}</span>
				</div>
			</div>
		</section>
		<section class="search">
			<form action="#" method="post">
				<input type="text" name="search" id="search-box" placeholder="جستجو کنید..." autocomplete="off">
				<button type="button" name="search" id="search-btn"></button>
			</form>
		</section>
		<section id="navigation_button">
			<i class="material-icons">menu</i>
		</section>
	</div>
</header>