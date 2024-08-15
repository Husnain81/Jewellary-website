<?php
include '../includes/header/header.php';


// update-display-option.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bannerOption = $_POST['bannerOption'];

    // Assuming you have a connection to your database
    $sql = "UPDATE tbl_site_settings SET setting_value = ? WHERE setting_key = 'bannerOption'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $bannerOption);
    $stmt->execute();

    echo "Success";
}


?>