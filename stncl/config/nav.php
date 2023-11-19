<?php
register_nav_menus(array( 'primary' => __('Primary Navigation'), 'secondary' => __('Secondary Navigation'), 'footer' => __('Footer Navigation'), 'footer-legal' => __('Footer Legal Navigation') ));
function nav_menu_ids($link, $item, $args)
{
    return sprintf("nav-%s-%s", sanitize_title_with_dashes($args->theme_location), sanitize_title_with_dashes($item->title));
} add_filter('nav_menu_item_id', 'nav_menu_ids', 10, 3);
function stncl_wp_list_pages($wp_list_pages_query)
{
    $page_list = wp_list_pages('echo=0&'.$wp_list_pages_query);
    $clean_page_list = preg_replace('/title=\"(.*?)\"/', '', $page_list);
    echo $clean_page_list;
}
