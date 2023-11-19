<?php

class Stncl_news_model extends Stncl_model
{
    public const POST_NAME = 'news';
    public const POST_NAME_PLURAL = 'news';
    public const POST_NAME_SENTENCE = 'News';
    public const POST_NAME_PLURAL_SENTENCE = 'News';
    public function __construct()
    {
        parent::__construct();
        $this->post_type_config = array( 'public' => true, 'exclude_from_search' => false, 'show_ui' => true, 'menu_icon' => 'dashicons-media-text', 'menu_position' => 30, 'capability_type' => 'custom', 'hierarchical' => false, 'has_archive' => 'blog', 'rewrite' => array('slug' => 'blog', 'with_front' => false), 'query_var' => true, 'supports' => array('title', 'editor', 'thumbnail', 'revisions') );
    } public function filter_columns($columns)
    {
        $prefix = 'stncl_' . self::POST_NAME;
        $columns = array( 'cb' => '<input type="checkbox" />', $prefix . '__id' => 'ID', 'title' => 'Title', 'date' => 'Date' );
        return $columns;
    } public function post_columns($column)
    {
        global $post;
        $custom_fields = get_post_custom($post->ID);
        switch($column) {
            case 'person__id': echo $post->ID;
                break;
        }
    }
}
