<!doctype html>
<html lang='ru'>

<head>
	 <!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-118275977-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', 'UA-118275977-1');
	</script>
	<meta http-equiv="Content-type" content="text/html; charset=<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/script.js"></script>
	<title>
		<?php wp_title('«', true, 'right'); ?>
		<?php bloginfo('name'); ?>
	</title>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="wrapper">
		<header class="header">
			<div class="container header__container">
				<div class="header__data">
				<!-- <div class="header__data" style="background-image:url('<?php bloginfo('template_url'); ?>/images/header.jpg')"> -->
					<div class="header__logo">
						<a href="<?php echo home_url();  ?>" class="home__link">
							<img class="header__img" src="<?php bloginfo('template_url'); ?>/images/logoSk_gold.png" alt="Логотип производственной компании где можно купить Дражные коврики СК-Полимеры">
						</a>
					</div>
					<div class="header__text">
							<div class="header__title"><a href="/">Дражные ковры</a></div>
							<!-- <div class="header__subtite">Оборудование и РТИ для золотодобычи</div> -->
						</div>
						<div class="header__contacts">
						<ul class="social">
							<li class="social__item social__item--vk">
								<a href="https://vk.com/skpolimer" class="social__link">
									<div class="fa fa-vk" aria-hidden="true"></div>
								</a>
							</li>
							<li class="social__item social__item--fb">
								<a href="https://www.facebook.com/skpolimers/" class="social__link">
									<div class="fa fa-facebook-official" aria-hidden="true"></div>
								</a>
							</li>
							<li class="social__item social__item--g">
								<a href="https://plus.google.com/101332575920683888981" target="_blank" class="social__link">
									<i class="fa fa-google-plus" aria-hidden="true"></i>
								</a>
							</li>
						</ul>
						<ul class="phones">
							<li class="phones__item"><a href="tel:+7(391)259-09-48">+7(391)259-09-48</a></li>
							<li class="phones__item"><a href="tel:+7(391)229-82-45">+7(391)229-82-45</a></li>
						</ul>
					</div>


				</div>
				<div class="search">
					<?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
				</div>
				<nav class="nav header__nav mobile__nav">
					
					<?php wp_nav_menu( array( 'theme_location' => 'max_mega_menu_1' ) ); ?>
				</nav>
			</div>
		</header>