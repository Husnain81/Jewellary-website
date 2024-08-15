<?php
   include $_SERVER['DOCUMENT_ROOT'] . '/jewellery-website/admin/functions.php';
   include 'config/config.php';
// include 'includes/header/header.php';
$fields = [
    'name' => 'name',
    'email' => 'email',
    'phone' => 'phone',
    'address' => 'address',

];
$tbl_name = 'tbl_orders';
insert_record($tbl_name, $fields);

?>