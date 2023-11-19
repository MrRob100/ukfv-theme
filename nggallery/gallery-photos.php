<?php  if (!defined('ABSPATH')) {
    die('No direct access allowed');
} ?><?php if (!empty($gallery)) { ?>				
			
		<ul class="gallery-container">
<?php
 foreach ($images as $image) { ?>				
				<li class="img">
					<a href="<?php echo $image->imageURL ?>">
						<img src="<?php echo $image->thumbURL ?>" alt="<?php echo $image->alttext; ?>" />
					</a>
				</li>
<?php
 } ?>			
		</ul>

<?php
} ?>



