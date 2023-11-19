<?php ?>

<?php stncl_get_header(); ?>

	<div id="main-content" role="main">

		<?php if (function_exists('yoast_breadcrumb')) {
		    yoast_breadcrumb('<div role="navigation" class="nav-breadcrumb">', '</div>');
		} ?>

		<h1>Search Results</h1>

		<div class="d-all">
			<div class="grouped result-type--list">
				<?php if (have_posts()) : ?>

					<?php  ?>
					<?php while (have_posts()) : the_post(); ?>

						<?php  get_template_part('views/content', 'searchresults'); ?>

					<?php endwhile; ?>

					
				<?php else : ?>

					<article id="post-0" class="post no-results not-found">
					
						<h3 class="entry-title"><?php _e('Nothing Found', 'twentyeleven'); ?></h3>
					
						<div class="entry-content">
							<p><?php _e('Apologies, but no results were found. Please try another search.', 'twentyeleven'); ?></p>
							<?php stncl_get_search_form(); ?>
						</div><!-- .entry-content -->
					</article><!-- #post-0 -->

				<?php endif; ?>
			</div>

			<?php stncl__display_pagination(); ?>
		</div>

	</div>
		
<?php stncl_get_footer(); ?>
