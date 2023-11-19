<?php stncl_get_header(); ?>

	<div id="main-content" role="main">

		<div class="archive-body grouped result-type--list">

			<a id="events-flyer" href="https://www.footvolley.co.uk/wp-content/uploads/2019/05/national-tour-2019.jpg">
				<img src="<?php echo THEME_URI; ?>/assets/img/national-tour-2019.png" alt="National Tour 2019" />
			</a>

			<div class="s-main d1-d7">

				<div class="events-key">
					<div class="key-item k-uk">UK</div>
					<div class="key-item k-international">International</div>
				</div>

				<?php  if (have_posts()) {
				    while (have_posts()) {
				        the_post();
				        get_template_part('views/event/teaser--list');
				    }
				} else { ?><p>Sorry, there are no up-coming events.</p><?php
				} ?>
			</div>

			<div class="s-sidebar d9-d12">

				<?php if (! isset($_GET['past'])) { ?>
					<h3 class="sidebar-heading">Past Events</h3>
					<?php  $query = new WP_Query(array( 'post_type' => array('event'), 'posts_per_page' => 4, 'order' => 'DESC', 'orderby' => 'meta_value_num', 'meta_key' => '_stncl_event_date_start_field', 'meta_query' => array( array( 'key' => '_stncl_event_date_start_field', 'value' => strtotime('today midnight') - 1, 'type' => 'numeric', 'compare' => '<' ) ) ));
				    if ($query->have_posts()) { ?><div class="home-events-list"><?php
 while ($query->have_posts()) {
     $query->the_post();
     get_template_part('views/event/teaser--list-small');
 } ?></div>
							<div>
								<a class="btn btn-dark btn--slim" href="/events/?past">View all past events</a>
							</div>
							<?php
				    } wp_reset_postdata();
				} else { ?>

					<h3 class="sidebar-heading">Upcoming Events</h3>
					<?php  $query = new WP_Query(array( 'post_type' => array('event'), 'posts_per_page' => 4, 'order' => 'ASC', 'orderby' => 'meta_value_num', 'meta_key' => '_stncl_event_date_start_field', 'meta_query' => array( array( 'key' => '_stncl_event_date_start_field', 'value' => strtotime('today midnight') - 1, 'type' => 'numeric', 'compare' => '>' ) ) ));
				    if ($query->have_posts()) { ?><div class="home-events-list"><?php
 while ($query->have_posts()) {
     $query->the_post();
     get_template_part('views/event/teaser--list-small');
 } ?></div>
							<div>
								<a class="btn btn-dark btn--slim" href="/events/">View all upcoming events</a>
							</div>
							<?php
				    } wp_reset_postdata(); ?>

				<?php } ?>

			</div>

		</div>



		<?php stncl__display_pagination(); ?>

	</div><!-- #main-content -->

<?php stncl_get_footer(); ?>