<?php
include $_SERVER['DOCUMENT_ROOT'] . '/jewellery-website/admin/functions.php'; 
include $_SERVER['DOCUMENT_ROOT'] . '/jewellery-website/admin/function.php'; 
$fields = [
    'image_url' => 'image_url',
    'heading' => 'heading',
    'paragraph' => 'paragraph',
    'btn_color' => 'btn_color',
    'btn_text' => 'btn_text',

];
$tbl_name = 'tbl_banner_items';
edit_record($tbl_name, $fields, "id"); 
?>