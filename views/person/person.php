<?php
$thumb_url = stncl_get_exact_size_thumbnail($_person->ID, 'thumbnail-person', STNCL_THUMBNAIL_PERSON); ?>	
	
	<article class="person">

		<a class="bio-trigger <?php echo ($_person->post_content) ? 'has-bio' : 'no-bio'; ?>" href="#">

			<div class="person-thumbnail">

				<?php if ($thumb_url) { ?>
					<img class="img-circle" src="<?php echo esc_attr($thumb_url); ?>" alt="<?php echo esc_attr($_person->post_title); ?>" />
				<?php } else { ?>
					<img class="img-circle" src="<?php echo THEME_URI; ?>/assets/img/temp-awaiting-user-photo.jpg" alt="" />
				<?php } ?>

				<?php if ($_person->post_content) { ?>
				<div class="trigger">
					<span class="trigger__label">More info</span>
				</div>
				<?php } ?>

			</div>
		
			<h2 class="person-name"><?php echo $_person->post_title; ?></h2>
			<p class="person-role"><?php echo esc_attr($_person->role); ?></p>
		
		</a>

		<?php if ($_person->post_content) { ?>
		<div class="person-bio">
			<a class="bio-close" href="#">Close</a>
			<h2 class="person-name"><?php echo $_person->post_title; ?></h2>
			<p class="person-role"><?php echo esc_attr($_person->role); ?></p>
			<div class="person__scroll">
				<?php echo apply_filters('the_content', $_person->post_content); ?>	
			</div>
		</div>
		<?php } ?>
		
	</article>
