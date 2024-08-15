<?php
// Check if session is set
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

// Display dashboard content
echo "Welcome, " . $_SESSION["username"] . "!";

// Logout link
echo "<p><a href='logout.php'>Logout</a></p>";
?>