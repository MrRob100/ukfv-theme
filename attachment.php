<?php
$this_post_permalink = get_permalink($post->ID);
$parent_post_permalink = get_permalink($post->post_parent);
if ($this_post_permalink == $parent_post_permalink) {
    header('Location: '.$post->guid);
    exit;
} header('Location: '.get_permalink($post->post_parent));
exit;
