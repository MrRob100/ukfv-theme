<?php
function btn_shortcode($atts, $content = null)
{
    extract(shortcode_atts(array( 'url' => 'URL' ), $atts));
    return '<a class="btn" href="'.esc_attr($url).'">'.esc_attr($content).'</a>';
} add_shortcode('btn', 'btn_shortcode');
function mailto_shortcode($atts)
{
    extract(shortcode_atts(array( 'email' => 'Email' ), $atts));
    $length = strlen($email);
    $obfuscated_email = '';
    for ($i = 0; $i < $length; $i++) {
        $obfuscated_email .= "&#" . ord($email[$i]) . ";";
    } return '<a class="apara" href="&#109;&#097;&#105;&#108;&#116;&#111;:'.$obfuscated_email.'">'.$obfuscated_email.'</a>';
} add_shortcode('mailto', 'mailto_shortcode');
function site_phonenumber_shortcode($atts)
{
    return SITE_PHONENUMBER;
} add_shortcode('site_phonenumber', 'site_phonenumber_shortcode');
