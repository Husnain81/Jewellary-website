<?php
include $_SERVER['DOCUMENT_ROOT'] . '/jewellery-website/config/config.php';
include $_SERVER['DOCUMENT_ROOT'] . '/jewellery-website/admin/functions.php';


$tbl_name="tbl_home_image";
$images=get_images($tbl_name);
echo json_encode($image);
?>