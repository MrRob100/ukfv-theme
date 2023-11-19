<?php  global $stncl;
$custom_fields = get_post_custom(get_the_ID());
$date_start = _is($custom_fields['_stncl_event_date_start_field'][0]);
$date_end = _is($custom_fields['_stncl_event_date_end_field'][0]);
$time = _is($custom_fields['_stncl_event_time'][0]);
$venue = _is($custom_fields['_stncl_event_venue_field'][0]);
$address = _is($custom_fields['_stncl_event_address_field'][0]);
$city = _is($custom_fields['_stncl_event_city_field'][0]);
$postcode = _is($custom_fields['_stncl_event_postcode_field'][0]);
$contact_name = _is($custom_fields['_stncl_event_contact_name_field'][0]);
$contact_email = _is($custom_fields['_stncl_event_contact_email_field'][0]);
$contact_phone = _is($custom_fields['_stncl_event_contact_phone_field'][0]);
$international = _is($custom_fields['_stncl_event_is_international_field'][0]);
$key_class = ($international) ? "k-international" : "k-uk"; ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('grouped'); ?>>
		
		<a id="events-flyer" href="https://www.uk-footvolley-87aa822e46a3.herokuapp.com/wp-content/uploads/2019/05/national-tour-2019.jpg">
			<img src="<?php echo THEME_URI; ?>/assets/img/national-tour-2019.png" alt="National Tour 2019" />
		</a>

		<div class="article-cap"></div>

		<div class="article-body">

			<div class="s-main d1-d7">

				<div class="article-header">
					<div class="event-location <?php echo $key_class; ?>"><?php echo ($international) ? "International" : "UK"; ?></div>
					<h2 class="article-title"><?php the_title(); ?></h2>
					<div class="article-date">
						<?php echo date(get_option('date_format'), $date_start); ?>
						<?php if ($date_end) {
						    echo " &ndash; " . date(get_option('date_format'), $date_end);
						} ?>
					</div>
					<div class="article-time"><?php echo $time; ?></div>
				</div>

				<div class="event-details">
					<?php if ($venue) { ?> <div><span class="event-detail__label">Venue:</span> <?php echo $venue; ?></div> <?php } ?>
					<?php if ($address) { ?> <div><span class="event-detail__label">Address:</span> <?php echo $address; ?></div> <?php } ?>
					<?php if ($city) { ?> <div><span class="event-detail__label">City:</span> <?php echo $city; ?></div> <?php } ?>
					<?php if ($postcode) { ?> <div><span class="event-detail__label">Postcode:</span> <?php echo $postcode; ?></div> <?php } ?>

					<?php if ($contact_name) { ?> <div><span class="event-detail__label">Contact:</span> <?php echo $contact_name; ?></div> <?php } ?>
					<?php if ($contact_phone) { ?> <div><span class="event-detail__label">Phone:</span> <?php echo $contact_phone; ?></div> <?php } ?>
					<?php if ($contact_email) { ?> <div><span class="event-detail__label">Email:</span> <a href="mail:<?php echo esc_attr($contact_email); ?>"><?php echo $contact_email; ?></a></div> <?php } ?>
				</div>

				<div class="entry-content grouped">
					<?php the_content(); ?>
				</div>

				<?php stncl_single_pagination(); ?>
				
			</div>

			<div class="s-sidebar d9-d12">
				<h3 class="sidebar-heading">More Events</h3>
				<?php  $query = new WP_Query(array( 'post_type' => array('event'), 'posts_per_page' => 4, 'order' => 'ASC', 'orderby' => 'meta_value_num', 'meta_key' => '_stncl_event_date_start_field', 'meta_query' => array( array( 'key' => '_stncl_event_date_start_field', 'value' => strtotime('today midnight') - 1, 'type' => 'numeric', 'compare' => '>' ) ) ));
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
			</div>

		</div>

	</article>


