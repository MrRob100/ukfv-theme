<?php

	global $stncl; 

?><!DOCTYPE html>
<html class="no-js <?php echo stncl_html_class(); ?>" <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	
	<title><?php wp_title(''); ?></title>

	<!-- CSS -->
	<link rel="stylesheet" href="<?php echo THEME_URI; ?>/assets/css/page-custom.css" />
	<link rel="stylesheet" href="<?php echo THEME_URI; ?>/assets/css/gridset.css" />
	<link rel="stylesheet" href="<?php echo THEME_URI; ?>/assets/css/core.css?0712" />

	<!-- WP -->
	<?php wp_head(); ?>
	
	<!-- Javascript -->
	<!-- https://modernizr.com/download?cssfilters-flexbox-svg-svgasimg-setclasses -->
	<script src="<?php echo THEME_URI; ?>/assets/js/libs/modernizr-custom.js"></script>

</head>

<body <?php stncl_body_id('footvolley'); ?> <?php body_class('preload'); ?>>	

	<header role="banner">
		<div class="s-header layout-page">

			<button class="nav-toggle lines-button arrow arrow-left" type="button" role="button" aria-label="Toggle Navigation">
				<span class="lines"></span>
			</button>

			<?php  ?>

			<a class="logo" href="<?php echo home_url('/'); ?>" rel="home">
				<img src="<?php echo THEME_URI; ?>/assets/img/logo.png" alt="UK Footvolley Association" />
			</a>
	
			<div class="nav-container">

				<nav role="navigation" class="navbar-primary">
					<?php wp_nav_menu(array( 'theme_location' => 'primary', 'container' => false, 'items_wrap' => '<ul id="%1$s" class="%2$s sf-menu">%3$s</ul>', 'link_before' => '<span>', 'link_after' => '</span>' )); ?>
				</nav>

				<div class="nav-social-media">
					<a href="https://www.facebook.com/UkFootvolleyAssociation/" class="ico-facebook"><span class="visuallyhidden">Facebook</span></a>
					<a href="https://twitter.com/UKFootvolley1" class="ico-twitter"><span class="visuallyhidden">Twitter</span></a>
					<a href="https://www.instagram.com/uk_footvolley/" class="ico-instagram"><span class="visuallyhidden">Instagram</span></a>
				</div>

				<div class="nav-sign-up">
					<a id="btn__sign-up-now" href="/wp-login.php?action=register">Sign up now</a>
					<!--<a id="btn__sign-up-now" href="/about/contact/#join-now">Sign up now</a>-->
				</div>
			</div><!-- .nav-container -->

		</div><!-- .s-header -->
	</header>


	<!-- <div class="hero fixed hero-img--<?php echo rand(1, 10); ?>"></div> -->


	<?php if (is_404() or is_archive()) { ?>
	<?php display_article_hero(1); ?>
	<?php } else { ?>
	<?php display_article_hero($post->ID); ?>
	<?php } ?>

	<div id="s-main" class="fixed">
		<div id="s-main-inner">
			<div class="layout-page layout-page--padding layout-page--relative">

				<div class="hero__grunge-title">
					<?php  if (is_404()) {
					    $hero_tile = "Not Found";
					} else {
					    if ($post->post_parent == 0) {
					        $hero_tile = $post->post_title;
					    } else {
					        $parent = get_post($post->post_parent);
					        $hero_tile = $parent->post_title;
					    } if ($post->post_type == "event") {
					        $hero_tile = "Events";
					        if (isset($_GET['past'])) {
					            $hero_tile = "Past Events";
					        }
					    } if ($post->post_type == "news") {
					        $hero_tile = "Blog";
					    } if (is_page("home")) {
					        $hero_tile = "Sand. Grass. | Play. Footvolley.";
					    }
					} ?>
					<span><?php echo str_replace("|", "<br />", esc_attr($hero_tile)); ?></span>
				</div>

				<?php  ?>
