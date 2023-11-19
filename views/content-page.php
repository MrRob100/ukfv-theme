<?php
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header>

	<div class="entry-content">
	
		<?php if ($post->ID != 14) { ?>
		<figure>
			<?php  $thumb_id = get_post_thumbnail_id($post->ID);
		    $thumb_url = stncl_get_exact_size_thumbnail($post->ID, 'medium', '300x300px');
		    if ($thumb_url) { ?>
					<img src="<?php echo esc_attr($thumb_url); ?>" alt="" />
				<?php } else { ?>
					<img src="<?php echo THEME_URI; ?>/assets/img/n<?php echo rand(1, 7); ?>.jpg" alt="" />
				<?php } ?>

			<?php  ?>
		</figure>
		<?php } ?>

		<?php the_content(); ?>
		<?php ?>
	</div>
	
	<footer class="entry-meta">
		<?php ?>
	</footer>
	
</article>
