<?php  global $post;
$custom_fields = get_post_custom($post->ID);
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
	
	<div id="post-<?php the_ID(); ?>" <?php post_class('event-teaser--list large grouped ' . $key_class); ?>>

		<a href="<?php the_permalink(); ?>" class="grouped">

			<div class="event-teaser__pubdate">
				<time datetime="<?php echo date('Y-m-d', $date_start); ?>">
					<span class="date"><?php echo date('j', $date_start); ?></span>
					<span class="month"><?php echo date('M', $date_start); ?></span>
					<span class="year"><?php echo date('Y', $date_start); ?></span>
				</time>
			</div>

			<div class="event-teaser__preview">
				<h2 class="event-teaser__title">
					<?php the_title(); ?>
				</h2>

				<h4><?php echo $time; ?></h4>


				<?php if (get_the_content()) { ?>
				
					<div class="event-teaser__content">
						<?php the_excerpt(); ?>
						<?php ?>
					</div>

				<?php } ?>
			</div>

		</a>
				
	</div><!-- .teaser -->


