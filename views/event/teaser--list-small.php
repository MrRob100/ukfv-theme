<?php  global $post;
$custom_fields = get_post_custom($post->ID);
$date_start = _is($custom_fields['_stncl_event_date_start_field'][0]);
$international = _is($custom_fields['_stncl_event_is_international_field'][0]);
$key_class = ($international) ? "k-international" : "k-uk"; ?>	
	
	<div id="post-<?php the_ID(); ?>" <?php post_class('event-teaser--list small grouped ' . $key_class); ?>>

		<a href="<?php the_permalink(); ?>" class="grouped">

			<div class="event-teaser__pubdate">
				<time datetime="<?php echo date('Y-m-d', $date_start); ?>">
					<span class="date"><?php echo date('j', $date_start); ?></span>
					<span class="month"><?php echo date('M', $date_start); ?></span>
					<span class="year"><?php echo date('Y', $date_start); ?></span>
				</time>
			</div>

			<h3 class="event-teaser__title">
				<?php the_title(); ?>
			</h3>

		</a>
				
	</div><!-- .teaser -->


