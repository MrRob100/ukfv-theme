<?php stncl_get_header(); ?>

	<div id="main-content" role="main">

		<div class="archive-body grouped result-type--list">
		<?php  if (have_posts()) {
		    while (have_posts()) {
		        the_post();
		        get_template_part('views/news/teaser--list');
		    }
		} else { ?><p>Sorry, there are no news items.</p><?php
		} ?>
		</div>
	


		<?php stncl__display_pagination(); ?>

	</div><!-- #main-content -->

<?php stncl_get_footer(); ?>