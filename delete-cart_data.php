<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Check if the product ID exists in the cart
    if (isset($_SESSION['cart'][$product_id])) {
        // Unset (remove) the item from the cart
        unset($_SESSION['cart'][$product_id]);
    }
}

// Redirect back to the cart page
header('Location: cart.php');
exit;