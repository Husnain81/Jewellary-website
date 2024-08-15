<?php
include '../includes/header/header.php';
$fields = [
    'image' => 'image',
    'name' => 'name',
    'description' => 'description',
    'price' => 'price',

];
$tbl_name = 'tbl_products';
edit_record($tbl_name, $fields, "id"); 
