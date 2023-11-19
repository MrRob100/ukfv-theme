<?php
/*
Template Name: Page
*/
?>
<?php stncl_get_header(); ?>

	<?php if (have_posts()) {
	    while (have_posts()) : the_post(); ?>
	
		<div id="main-content" role="main">

			<?php ?>

			<?php stncl_display_sibling_nav(); ?>

			<div class="grouped">

				<?php  ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('article-column d-all'); ?>>
					
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

