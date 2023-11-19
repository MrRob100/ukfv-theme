<?php
function _is(&$var_to_test, $default = '')
{
    if (isset($var_to_test)) {
        return $var_to_test;
    } else {
        return $default;
    }
} function _spd($post_id, $field, $value)
{
    if (!update_post_meta($post_id, $field, $value)) {
        add_post_meta($post_id, $field, $value, true);
    }
} function _date($date_time)
{
    if (is_numeric($date_time)) {
        return date(STNCL_DATE_FORMAT, $date_time);
    } return date(STNCL_DATE_FORMAT, strtotime($date_time));
} function stncl_get_exact_size_thumbnail($id, $type, $dimensions)
{
    $thumb_url = wp_get_attachment_image_src(get_post_thumbnail_id($id), $type);
    if (!is_array($thumb_url)) {
        return false;
    } $pos = strpos($thumb_url[0], $dimensions);
    return $thumb_url[0];
} function get_stncl_template($post)
{
    $template_terms = wp_get_object_terms($post->ID, 'stncl_template');
    if ($post->post_type == 'attendance') {
        $template_terms[0]->slug = 'attendance';
    } if (!count($template_terms)) {
        return '';
    } return $template_terms[0]->slug;
} function stncl_get_option($key)
{
    $site_settings = get_option('stncl_site_settings');
    return $site_settings[$key];
} function stncl_parse_uri_segments($uri)
{
    $segments = explode('/', $uri);
    $segments_array = array();
    foreach($segments as $segment) {
        if (strpos($segment, ':') !== false) {
            list($key, $value) = explode(':', $segment);
            if (strpos($value, ',') !== false) {
                $value = explode(',', $value);
            } $segments_array[$key] = $value;
        }
    } return $segments_array;
} function stncl_whitelist($needle, $haystack)
{
    $clean = array();
    foreach((array)$needle as $value) {
        if (in_array($value, (array)$haystack)) {
            $clean[] = $value;
        }
    } return $clean;
} function _checked($query_type, $value)
{
    global $stncl;
    if (in_array($value, $stncl->casestudy_model->query_parts[$query_type])) {
        return "checked";
    } return false;
} function _is_post_type_query($allowed_types)
{
    global $wp_query;
    $post_types = $wp_query->query_vars['post_type'];
    foreach ((array)$post_types as $pt) {
        if (! in_array($pt, (array)$allowed_types)) {
            return false;
        }
    } return true;
} function stncl_get_attachment_id_from_url($image_url)
{
    global $wpdb;
    $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url));
    return isset($attachment[0]) ? $attachment[0] : null ;
} if (! function_exists('uuidv4')) {
    function uuidv4()
    {
        $data = openssl_random_pseudo_bytes(16);
        assert(strlen($data) == 16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}
