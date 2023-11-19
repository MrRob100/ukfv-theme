<?php
/*
Template Name: Home
*/
?>
<?php stncl_get_header(); ?>
	
	<?php if (have_posts()) {
	    while (have_posts()) : the_post(); ?>

		<div id="main-content" role="main">
			<div class="grouped">

				<article id="post-<?php the_ID(); ?>" <?php post_class('article-column d1-d7'); ?>>
					
					<?php  ?>

					<div class="entry-content">
						<?php the_content(); ?>
					</div>

				</article>

				<div class="d9-d12">
					<h3 class="sidebar-heading">Recent Blog Posts</h3>
					<?php  $query = new WP_Query(array( 'post_type' => array('news'), 'posts_per_page' => 2, 'order' => 'DESC', 'orderby' => 'date' ));
	        if ($query->have_posts()) { ?><div class="home-news-list"><?php
 while ($query->have_posts()) {
     $query->the_post();
     get_template_part('views/news/teaser--list-small');
 } ?></div>
							<?php
	        } wp_reset_postdata(); ?>

					<h3 class="sidebar-heading">Up-coming Events</h3>
					<?php  $query = new WP_Query(array( 'post_type' => array('event'), 'posts_per_page' => 2, 'order' => 'ASC', 'orderby' => 'meta_value_num', 'meta_key' => '_stncl_event_date_start_field', 'meta_query' => array( array( 'key' => '_stncl_event_date_start_field', 'value' => strtotime('today midnight') - 1, 'type' => 'numeric', 'compare' => '>' ) ) ));
	        if ($query->have_posts()) { ?><div class="home-events-list"><?php
 while ($query->have_posts()) {
     $query->the_post();
     get_template_part('views/event/teaser--list-small');
 } ?></div>
							<!-- <div style="text-align: right;">
								<a class="btn btn-secondary btn--slim" href="/calendar/">View all events</a>
							</div> -->
							<?php
	        } wp_reset_postdata(); ?>

					<div class="sidebar-widget">
						<a class="w-players-and-rankings" href="/about/players-and-rankings">
							<h3 class="w-title">Players and Rankings</h3>
							<img src="<?php echo THEME_URI; ?>/assets/img/players-and-rankings.jpg" alt="Players and Rankings" />
						</a>
					</div>

					<div class="sidebar-widget">
						<a class="w-efvl" href="http://footvolleyeurope.com/">
							<img src="<?php echo THEME_URI; ?>/assets/img/logo-efvl.png" alt="EFVL" />
						</a>
					</div>

				</div>

			</div>
		</div><!-- #main-content -->


	<?php endwhile;
	} ?>	
		
<?php stncl_get_footer(); ?>