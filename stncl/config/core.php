<?php
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
add_theme_support('post-thumbnails');
add_image_size('news', 200, 200, true);
define('STNCL_THUMBNAIL_NEWS', '200x200');
add_image_size('tinted-hero', 1600, 900, true);
define('STNCL_HERO', '1600x900');
add_image_size('thumbnail-person', 240, 380, true);
define('STNCL_THUMBNAIL_PERSON', '240x380');
add_image_size('featured-article', 800, 450, true);
define('STNCL_FEATURED_ARTICLE', '800x450');
if (! isset($content_width)) {
    $content_width = 1000;
} add_filter('use_default_gallery_style', '__return_false');
function stncl_scripts_enqueue()
{
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
} add_action('wp_enqueue_scripts', 'stncl_scripts_enqueue', 1);
