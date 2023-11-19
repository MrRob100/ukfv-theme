<?php  global $post; ?>	
	
	<div id="post-<?php the_ID(); ?>" <?php post_class('news-teaser--list small grouped'); ?>>

		<div class="news-teaser__preview">
			<h2 class="news-teaser__title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h2>

			<p class="news-teaser__date"><?php echo get_the_date(); ?></p>
		</div>
				
	</div><!-- .teaser -->
