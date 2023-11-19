<?php  function stncl_get_header($name = 'views/header.php')
{
    do_action('get_header', $name);
    $templates = array();
    if (isset($name)) {
        $templates[] = "$name";
    } $templates[] = 'header.php';
    if ('' == locate_template($templates, true)) {
        load_template(ABSPATH . WPINC . '/theme-compat/header.php');
    }
} function stncl_get_footer($name = 'views/footer.php')
{
    do_action('get_footer', $name);
    $templates = array();
    if (isset($name)) {
        $templates[] = "$name";
    } $templates[] = 'footer.php';
    if ('' == locate_template($templates, true)) {
        load_template(ABSPATH . WPINC . '/theme-compat/footer.php');
    }
} function stncl_get_sidebar($name = 'views/sidebar.php')
{
    do_action('get_sidebar', $name);
    $templates = array();
    if (isset($name)) {
        $templates[] = "$name";
    } $templates[] = 'sidebar.php';
    if ('' == locate_template($templates, true)) {
        load_template(ABSPATH . WPINC . '/theme-compat/sidebar.php');
    }
} function stncl_get_search_form($echo = true)
{
    do_action('get_search_form');
    $search_form_template = locate_template('views/searchform.php');
    if ('' != $search_form_template) {
        require($search_form_template);
        return;
    } $form = '<form role="search" method="get" id="searchform" action="' . esc_url(home_url('/')) . '" >
		<div><label class="screen-reader-text" for="s">' . __('Search for:') . '</label>
		<input type="text" value="' . get_search_query() . '" name="s" id="s" />
		<input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
		</div>
		</form>';
    if ($echo) {
        echo apply_filters('get_search_form', $form);
    } else {
        return apply_filters('get_search_form', $form);
    }
}
