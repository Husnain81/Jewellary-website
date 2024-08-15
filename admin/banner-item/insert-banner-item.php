<?php 
 include '../includes/header/header.php';

$fields = [
    'image_url' => 'image_url',
    'heading' => 'heading',
    'paragraph' => 'paragraph',
    'btn_color' => 'btn_color',

];
$tbl_name = 'tbl_banner_items';
insert_record($tbl_name, $fields);
