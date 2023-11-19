<?php stncl_get_header(); ?>

	<?php ?>

	<?php ?>

	<div id="main-content" role="main">
		
		<?php if (function_exists('yoast_breadcrumb')) {
		    yoast_breadcrumb('<div role="navigation" class="nav-breadcrumb">', '</div>');
		} ?>

		<?php while (have_posts()) {
		    the_post(); ?>

			<?php get_template_part("views/event/article"); ?>

		<?php } ?>	
		
	</div><!-- #main-content -->

<?php stncl_get_footer(); ?>