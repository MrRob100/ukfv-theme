<?php
/*
Template Name: _Players
*/
?>
<?php stncl_get_header(); ?>

	<?php if (have_posts()) {
	    while (have_posts()) : the_post(); ?>

		<div id="main-content" role="main">
			<div class="grouped">

				<div class="side-related d1-d3">
					<?php stncl_display_sibling_nav_simple(); ?>
				</div>

				<article id="post-<?php the_ID(); ?>" <?php post_class('article-column d5-d12'); ?>>
					
					<h2 class="entry-title"><?php the_title(); ?></h2>

					<?php if (get_the_content()) { ?> 
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
					<?php } ?>

					<div class="s-players">
						<?php
 $query = new WP_Query(array( 'post_type' => 'person', 'posts_per_page' => -1, 'orderby' => 'menu_order title', 'order' => 'ASC' ));
	        while ($query->have_posts()) {
	            $query->the_post();
	            $role = get_post_meta($post->ID, '_stncl_person_role_field', true);
	            $post->role = $role;
	            $data['_person'] = $post;
	            $stncl->load_view('person/person', $data, false);
	        } wp_reset_postdata(); ?>
					</div>	




				</article>

			</div>
		</div><!-- #main-content -->

	<?php endwhile;
	} ?>	
		
<?php stncl_get_footer(); ?>