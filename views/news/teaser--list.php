<?php  global $post;
$thumbnail = stncl_get_exact_size_thumbnail($post->ID, 'news', STNCL_THUMBNAIL_NEWS);
$custom_fields = get_post_custom($post->ID); ?>	
	
	<div id="post-<?php the_ID(); ?>" <?php post_class('news-teaser--list large grouped'); ?>>

		<div class="news-teaser__thumbnail d1-d2">
			<a href="<?php the_permalink(); ?>">
				<?php if ($thumbnail) { ?><img class="custom" src="<?php echo esc_url($thumbnail); ?>" alt="" /><?php
				} else { ?>
				<img class="custom" src="<?php echo THEME_URI; ?>/assets/img/news-teaser__default.jpg" alt="" />
				<?php } ?>
			</a>
		</div>

		<div class="news-teaser__preview d3-d12">

			<h2 class="news-teaser__title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h2>

			<p><strong><?php echo get_the_date(); ?></strong></p>

			<?php if (get_the_content()) { ?>
			
				<div class="news-teaser__content">
					<?php ?>
					<?php echo wp_trim_words(get_the_content(), $num_words = 20); ?>
					<?php ?>
				</div>

			<?php } ?>
		</div>
				
	</div><!-- .teaser -->


