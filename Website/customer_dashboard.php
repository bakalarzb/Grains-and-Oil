<?php
// customer_dashboard.php

include 'db_config.php';

session_start();
$customer_id = $_SESSION['customer_id']; // Assuming login sets this

// Fetch customer info
$stmt = $pdo->prepare("SELECT * FROM customer WHERE customer_id = ?");
$stmt->execute([$customer_id]);
$customer = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch orders
$order_stmt = $pdo->prepare("
    SELECT o.order_id, o.date_of_order, o.order_status, p.product_name, po.product_order_quantity
    FROM order_table o
    JOIN product_order po ON o.order_id = po.product_order_id
    JOIN product p ON po.product_order_product_id = p.product_id
    WHERE o.order_customer_id = ?
");
$order_stmt->execute([$customer_id]);
$orders = $order_stmt->fetchAll(PDO::FETCH_ASSOC);

// Return JSON response
echo json_encode([
    "customer" => $customer,
    "orders" => $orders
]);
?>
