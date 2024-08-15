<?php
include 'includes/header/header.php';

$fields = [
    'setting_key' => 'setting_key',
    'setting_value' => 'setting_value',
];
$tbl_name = 'tbl_site_settings';
edit_record($tbl_name, $fields, "id");

