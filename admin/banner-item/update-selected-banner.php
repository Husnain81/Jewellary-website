<?php
include '../includes/header/header.php';

if (isset($_POST['selected_banner_id'])) {
    $selectedBannerId = $_POST['selected_banner_id'];
// sql query////
    $sql = "UPDATE tbl_site_settings SET setting_value = ? WHERE setting_key = 'selectedBannerId'";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $selectedBannerId);

        if ($stmt->execute()) {
            // Update the session variable as well
            $_SESSION['selected_banner_id'] = $selectedBannerId;
            echo "Selected banner ID updated successfully.";
        } else {
            echo "Failed to update the selected banner ID in the database.";
        }

        $stmt->close();
    } else {
        echo "Failed to prepare the statement.";
    }
} else {
    echo "No banner ID received.";
}
?>
