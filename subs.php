<?php
include 'config/config.php';

if (isset($_POST["email"])) {
    $email = $_POST["email"];
    $checkQuery = "SELECT * FROM tbl_newsletters_subscriptions WHERE email = '$email'";
    $checkResult = $conn->query($checkQuery);
    if ($checkResult->num_rows > 0) {
        echo "exists";
    } else {
        $query = "INSERT INTO tbl_newsletters_subscriptions (email) VALUES ('$email')";
        $result = $conn->query($query);

        if ($result) {
            echo "success";
        } else {
            echo "error";
        }
    }
}
?>
