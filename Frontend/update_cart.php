<?php
session_start();

if (!isset($_SESSION['cart'])) {
    header("Location: basket.php");
    exit;
}

// Remove item
if (isset($_POST['remove'])) {
    $index = $_POST['remove'];
    unset($_SESSION['cart'][$index]);
    $_SESSION['cart'] = array_values($_SESSION['cart']); // reindex
}

// Update quantities
if (isset($_POST['quantities']) && is_array($_POST['quantities'])) {
    foreach ($_POST['quantities'] as $index => $qty) {
        $qty = max(1, intval($qty));
        $_SESSION['cart'][$index]['quantity'] = $qty;
    }
}

header("Location: basket.php");
exit;
