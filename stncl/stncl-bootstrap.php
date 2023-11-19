<?php  require_once(trailingslashit(TEMPLATEPATH) . 'stncl/stncl.php');
$stncl = new Stncl();
add_action('after_setup_theme', 'stncl_theme_setup');
function stncl_theme_setup()
{
    global $stncl;
    $stncl->load('helper', array( 'form' , 'core' ));
    $stncl->load('config', array( 'core' , 'nav' , 'functions' , 'mime_types' , 'shortcodes' , 'template' , 'tinymce' , 'widgets' ));
    if (is_admin()) {
        $stncl->load('config', array( 'admin' ));
    } $stncl->load('model', array( 'news' , 'event' , 'person' ));
}

function custom_login_styles() {
    wp_enqueue_style('custom-login', get_template_directory_uri() . '/assets/css/login-custom.css');
}
add_action('login_enqueue_scripts', 'custom_login_styles');

function custom_login_text() {
    wp_enqueue_script('custom-login-text', get_template_directory_uri() . '/assets/js/registerText.js');
}
add_action('login_enqueue_scripts', 'custom_login_text');