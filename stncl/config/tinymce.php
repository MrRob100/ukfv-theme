<?php
function stncl_change_tinymce_options($init)
{
    $init["toolbar1"] = "formatselect,bold,italic,bullist,numlist,link,unlink,spellchecker,forecolor,removeformat,undo,redo";
    $init["toolbar2"] = "";
    $init['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4';
    $init['paste_as_text'] = true;
    return $init;
} add_filter('tiny_mce_before_init', 'stncl_change_tinymce_options');
