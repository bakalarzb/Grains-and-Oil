<?php
session_start();
require_once("db_config.php");

$pdo = Database::getConnection();
$cart = $_SESSION['cart'] ?? [];
$customer_id = $_SESSION['user_id'] ?? null;

if (!$customer_id || empty($cart)) {
    die("Not logged in or cart is empty.");
}

// 1. Create order
$order_stmt = $pdo->prepare("INSERT INTO order_table (order_customer_id, date_of_order, order_status) VALUES (?, NOW(), 'Pending')");
$order_stmt->execute([$customer_id]);
$order_id = $pdo->lastInsertId();

// 2. Insert products into product_order
foreach ($cart as $item) {
    // You'll need to map product_name to actual product_id here — for now let's use placeholder:
    $product_stmt = $pdo->prepare("SELECT product_id FROM product WHERE product_name = ?");
    $product_stmt->execute([$item['product_name']]);
    $product = $product_stmt->fetch();

    if ($product) {
        $insert_item = $pdo->prepare("INSERT INTO product_order (product_order_id, product_order_product_id, product_order_quantity, price_per_unit) VALUES (?, ?, ?, ?)");
        $insert_item->execute([
            $order_id,
            $product['product_id'],
            $item['quantity'],
            $item['price']
        ]);
    }
}

// Clear cart
unset($_SESSION['cart']);

// Redirect
header("Location: profile.php?order=success");
exit;
