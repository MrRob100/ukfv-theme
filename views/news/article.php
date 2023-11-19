<?php  global $stncl;
$thumbnail = stncl_get_exact_size_thumbnail($post->ID, 'featured-article', STNCL_FEATURED_ARTICLE);
$custom_fields = get_post_custom(get_the_ID()); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('grouped'); ?>>
		
		<div class="article-cap"></div>

		<div class="article-body">

			<div class="s-main d1-d7">

				<div class="article-header">
					<h2 class="article-title"><?php the_title(); ?></h2>
					<div class="article-date"><?php the_date(); ?></div>
					<?php  ?>
				</div>

				<div class="entry-content grouped">
					<?php the_content(); ?>
				</div>

				<?php stncl_single_pagination(); ?>
				
			</div>

			<div class="s-sidebar d9-d12">
				<h3 class="sidebar-heading">Recent Posts</h3>
				<?php  $query = new WP_Query(array( 'post_type' => array('news'), 'posts_per_page' => 5, 'order' => 'DESC', 'orderby' => 'date' ));
if ($query->have_posts()) { ?><div class="home-events-list"><?php
 while ($query->have_posts()) {
     $query->the_post();
     get_template_part('views/news/teaser--list-small');
 } ?></div>
						<div>
							<a class="btn btn-dark btn--slim" href="/blog/">View all posts</a>
						</div>
						<?php
} wp_reset_postdata(); ?>
			</div>

		</div>

	</article>


