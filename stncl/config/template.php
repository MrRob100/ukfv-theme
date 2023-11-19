<?php
function stncl_html_class()
{
    global $wp_query, $wpdb;
    $classes = array();
    if (is_single()) {
        $post = $wp_query->get_queried_object();
        if (isset($post->post_type) and in_array($post->post_type, array('casestudy', 'workinprogress'))) {
            $classes[] = 'theme__' . sanitize_html_class($post->post_type, $post->ID);
            $classes[] = 'school-type__' . stncl__casestudy_school_type();
        }
    } if (is_archive()) {
        if (is_post_type_archive()) {
            if (is_array(get_query_var('post_type'))) {
                $classes[] = 'theme__' . sanitize_html_class(get_query_var('post_type')[0]);
            } else {
                $classes[] = 'theme__' . sanitize_html_class(get_query_var('post_type'));
            }
        } if (is_tax()) {
            $term = $wp_query->get_queried_object();
            if (isset($term->term_id)) {
                $classes[] = 'theme__' . sanitize_html_class($term->taxonomy);
            }
        }
    } return implode(' ', $classes);
} function stncl_body_id($base, $output = true)
{
    global $post;
    if (is_single() or is_page()) {
        if (isset($post->post_name)) {
            $body_id = '-'.$post->post_name;
            if (is_front_page()) {
                $body_id = '';
            } if(!$output) {
                return $body_id;
            } echo 'id="'.$base.$body_id.'"';
        }
    } else {
        echo 'id="'.$base.'"';
    }
} function stncl_pretty_body_class_template($str)
{
    preg_match('#page-template-single-(.*)-php#', $str, $matches);
    if (isset($matches[1])) {
        $str = 'tmpl-'.$matches[1];
    } return $str;
} add_filter('body_class', function ($classes) { return array_map("stncl_pretty_body_class_template", $classes); }, 12, 3);
