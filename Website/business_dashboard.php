<?php
// business_dashboard.php

include 'db_config.php';

session_start();
$business_id = $_SESSION['business_id']; // Assuming login sets this

// Fetch business profile
$stmt = $pdo->prepare("SELECT * FROM business WHERE business_id = ?");
$stmt->execute([$business_id]);
$business = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch business products
$product_stmt = $pdo->prepare("SELECT * FROM product WHERE product_business_id = ?");
$product_stmt->execute([$business_id]);
$products = $product_stmt->fetchAll(PDO::FETCH_ASSOC);

// Return JSON
echo json_encode([
    "business" => $business,
    "products" => $products
]);
?>
