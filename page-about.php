<?php
/*
Template Name: _About
*/
?>
<?php stncl_get_header(); ?>

	<style>
		#footvolley-contact h2.entry-title {
			display: none;
		}
	</style>
	
	<?php if (have_posts()) {
	    while (have_posts()) : the_post(); ?>

		<div id="main-content" role="main">
			<div class="grouped">

				<div class="side-related d1-d3">
					<?php stncl_display_sibling_nav_simple(); ?>
				</div>

				<article id="post-<?php the_ID(); ?>" <?php post_class('article-column d5-d12'); ?>>
					
					<?php if ($post->post_parent != 0) { ?>
					<h2 class="entry-title"><?php the_title(); ?></h2>
					<?php } ?>

					<div class="entry-content">
						<?php the_content(); ?>
					</div>

				</article>

			</div>
		</div><!-- #main-content -->

	<?php endwhile;
	} ?>	
		
<?php stncl_get_footer(); ?>