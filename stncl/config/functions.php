<?php	 function stncl_display_sibling_nav($manual_parent_id = null)
{
    global $post;
    $this_page_id = $post->ID;
    $parent_id = ($manual_parent_id) ? $manual_parent_id : $post->post_parent;
    if ($parent_id == 0) {
        $sub_pages = new WP_Query("post_parent=$this_page_id&order=ASC&orderby=menu_order&post_type=page&posts_per_page=100");
    } else {
        $sub_pages = new WP_Query("post_parent={$parent_id}&order=ASC&orderby=menu_order&post_type=page&posts_per_page=100");
    } if ($sub_pages->have_posts()) { ?>
			<div class="sibling-nav">
				<ul class="sibling-nav__inner">
					<?php
     if (count($sub_pages->posts) > 1) {
         foreach ($sub_pages->posts as $sub_post) {
             $current = ($this_page_id == $sub_post->ID) ? "current" : ''; ?>
							<li class="<?php echo $current; ?>">
								<a href="<?php echo get_permalink($sub_post->ID); ?>">
									<span><?php echo $sub_post->post_title; ?></span>
								</a>
							</li>
						<?php
         }
     } ?>
				</ul>
			</div>
			<?php
    } wp_reset_postdata();
} function stncl_display_sibling_nav_simple($manual_parent_id = null)
{
    global $post;
    $this_page_id = $post->ID;
    $parent_id = ($manual_parent_id) ? $manual_parent_id : $post->post_parent;
    if ($parent_id == 0) {
        $sub_pages = new WP_Query("post_parent=$this_page_id&order=ASC&orderby=menu_order&post_type=page&posts_per_page=100");
    } else {
        $sub_pages = new WP_Query("post_parent={$parent_id}&order=ASC&orderby=menu_order&post_type=page&posts_per_page=100");
    } if ($sub_pages->have_posts()) { ?>
			<ul class="sibling-nav-simple">
				<?php
    if (count($sub_pages->posts) > 1) {
        foreach ($sub_pages->posts as $sub_post) {
            $current = ($this_page_id == $sub_post->ID) ? "current" : ''; ?>
						<li class="<?php echo $current; ?>">
							<a href="<?php echo get_permalink($sub_post->ID); ?>">
								<span><?php echo $sub_post->post_title; ?></span>
							</a>
						</li>
					<?php
        }
    } ?>
			</ul>
			<?php
    } wp_reset_postdata();
} function display_article_hero($post_id, $the_title = null)
{
    $hero = stncl_get_exact_size_thumbnail($post_id, 'hero', STNCL_HERO);
    if (! $hero) {
        $hero = THEME_URI . "/assets/img/hero__default.jpg";
    } ?>
			<div class="hero fixed" style="background-image: url(<?php echo esc_attr($hero) ?>);">
				<?php  ?>
			</div>
		<?php
} if (! function_exists('stncl__display_pagination')) {
    function stncl__display_pagination()
    {
        global $wp_query;
        $big = 999999999;
        $html = paginate_links(array( 'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))), 'format' => '?paged=%#%', 'current' => max(1, get_query_var('paged')), 'total' => $wp_query->max_num_pages, 'end_size' => 3, 'mid_size' => 5, 'prev_text' => 'Prev', 'next_text' => 'Next' ));
        echo '<div class="pagination">' . $html . '</div>';
    }
} function stncl_single_pagination()
{
    global $post;
    $next_link = "";
    $prev_link = "";
    $prev_post = get_previous_post();
    if (! empty($prev_post)) {
        $prev_link = get_permalink($prev_post->ID);
    } $next_post = get_next_post();
    if (! empty($next_post)) {
        $next_link = get_permalink($next_post->ID);
    } ?>
		<nav class="single-pagination">
			<?php if ($next_link) { ?>
			<div class="nav-prev">
				<a class="btn" href="<?php echo $next_link; ?>">
					<div class="label">Previous</div>
					<div class="title"><?php echo $next_post->post_title; ?></div>
				</a>
			</div>
			<?php } ?>
			<?php if ($prev_link) { ?>
			<div class="nav-next">
				<a class="btn" href="<?php echo $prev_link; ?>">
					<div class="label">Next</div>
					<div class="title"><?php echo $prev_post->post_title; ?></div>
				</a>
			</div>
			<?php } ?>
		</nav>
	<?php  } function stncl_remove_admin_bar_links()
	{
	    global $wp_admin_bar;
	    if (current_user_can("stncl_admin")) {
	        return;
	    } $wp_admin_bar->remove_menu('updates');
	    $wp_admin_bar->remove_menu('new-content');
	    $wp_admin_bar->remove_menu('wpseo-menu');
	} add_action('wp_before_admin_bar_render', 'stncl_remove_admin_bar_links');
function stncl_the_title()
{
    global $post;
    $search = " ";
    $replace = "&nbsp;";
    $subject = trim(get_the_title());
    $pos = strrpos($subject, $search);
    if ($pos !== false) {
        $subject = substr_replace($subject, $replace, $pos, strlen($search));
    } echo $subject;
} function stncl_media_filter_columns($columns)
{
    array_shift($columns);
    $id = array( "cb" => "<input type=\"checkbox\" />", "stncl_media__id" => "ID" );
    return array_merge((array)$id, (array)$columns);
} add_filter('manage_media_columns', 'stncl_media_filter_columns');
function stncl_media_post_columns($column_name)
{
    global $post;
    switch($column_name) {
        case 'stncl_media__id': echo $post->ID;
            break;
    }
} add_filter('manage_media_custom_column', 'stncl_media_post_columns');
