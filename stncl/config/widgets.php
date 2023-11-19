<?php
function stncl_widgets_init()
{
    register_sidebar(array( 'name' => __('Homepage Column 1'), 'id' => 'homepage-column-1', 'before_widget' => '', 'after_widget' => '', 'before_title' => '<h3 class="widget-title">', 'after_title' => '</h3>', ));
    register_sidebar(array( 'name' => __('Homepage Column 2'), 'id' => 'homepage-column-2', 'before_widget' => '', 'after_widget' => '', 'before_title' => '<h3 class="widget-title">', 'after_title' => '</h3>', ));
} add_action('widgets_init', 'stncl_widgets_init');
