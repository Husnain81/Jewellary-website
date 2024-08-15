<?php
// Destroy session
session_start();

session_destroy();
// Redirect to login page
header("Location: index.php");
exit;

            
?>