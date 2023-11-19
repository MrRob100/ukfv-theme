<?php
function stncl_enable_extended_upload($mime_types)
{
    $mime_types['notebook'] = 'application/octet-stream';
    $mime_types['flp'] = 'application/octet-stream';
    return $mime_types;
} add_filter('upload_mimes', 'stncl_enable_extended_upload');
