<?php	 function stncl_load_admin_script_and_styles()
{
    wp_enqueue_script('custom_js_jquery_ui_datepicker', trailingslashit(STNCL_URI)."assets/js/jquery.ui.datepicker.min.js", array('jquery'));
    wp_enqueue_script('custom_js_jquery_ui_datepicker_lang', trailingslashit(STNCL_URI)."assets/js/jquery.ui.datepicker-en-GB.js", array('jquery'));
    wp_enqueue_script('custom_js_fancybox', trailingslashit(STNCL_URI)."assets/fancybox/jquery.fancybox.pack.js", array('jquery'));
    wp_enqueue_script('custom_js_stncl_scripts', trailingslashit(STNCL_URI)."assets/js/scripts.js", array('jquery'));
    wp_enqueue_style('custom_css_stncl_app-form', trailingslashit(STNCL_URI)."assets/css/forms.css");
    wp_enqueue_style('custom_css_stncl_app-icon', trailingslashit(STNCL_URI)."assets/css/ui.css");
    wp_enqueue_style('custom_css_stncl_app-fancybox', trailingslashit(STNCL_URI)."assets/fancybox/jquery.fancybox.css");
    $current_user = get_userdata(get_current_user_id());
    $user_roles = $current_user->roles;
    $user_role = array_shift($user_roles);
    if ($user_role != 'administrator') {
        wp_enqueue_style('custom_css_stncl_hide_features', trailingslashit(STNCL_URI)."assets/css/hide-features.css");
    }
} add_action('admin_enqueue_scripts', 'stncl_load_admin_script_and_styles');
function stncl_author_in_publish()
{
    global $post_ID;
    if (current_user_can('edit_others_posts')) {
        $post = get_post($post_ID);
        echo '<div class="misc-pub-section"><span id="publish-metabox__author">';
        post_author_meta_box($post);
        echo '</span></div>';
    }
} function prevent_matrix_easter_egg()
{
    $left = empty($_POST['left']) ? (empty($_GET['left']) ? '' : $_GET['left']) : $_POST['left'];
    $right = empty($_POST['right']) ? (empty($_GET['right']) ? '' : $_GET['right']) : $_POST['right'];
    if($left == $right) {
        $redirect = get_edit_post_link($left);
        wp_die("Error: Cannot compare a revision to itself.<br /><a href=\"" . $redirect . "\">Go Back</a>");
    }
} add_action('admin_action_diff', 'prevent_matrix_easter_egg');
function base_admin_body_class($classes)
{
    if (is_admin() && isset($_GET['action'])) {
        $classes .= 'action-'.$_GET['action'];
    } if (is_admin() && isset($_GET['post'])) {
        $classes .= ' ';
        $classes .= 'post-'.$_GET['post'];
    } if (isset($_GET['post_type'])) {
        $post_type = $_GET['post_type'];
    } if (isset($post_type)) {
        $classes .= ' ';
        $classes .= 'post-type-'.$post_type;
    } if (isset($_GET['post'])) {
        $post_query = $_GET['post'];
        $current_post_edit = get_post($post_query);
        $current_post_type = $current_post_edit->post_type;
        if (!empty($current_post_type)) {
            $classes .= ' ';
            $classes .= 'post-type-'.$current_post_type;
        }
    } return $classes;
} add_filter('admin_body_class', 'base_admin_body_class');
