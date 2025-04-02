<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item = [
        'product_name' => $_POST['product_name'],
        'price' => $_POST['price'],
        'image' => $_POST['image'],
        'quantity' => 1,
    ];

    // Initialize cart if not set
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $exists = false;

    // Check if product already exists in cart
    foreach ($_SESSION['cart'] as &$cart_item) {
        if ($cart_item['product_name'] === $item['product_name']) {
            $cart_item['quantity']++;
            $exists = true;
            break;
        }
    }

    if (!$exists) {
        $_SESSION['cart'][] = $item;
    }

    // Redirect back to marketplace
    header("Location: marketplace.php");
    exit;
}
