<?php
session_start();
require_once("../db_config.php"); // Adjust path as needed

$pdo = Database::getConnection();
$user_id = $_SESSION['user_id'] ?? null;
$user_type = $_SESSION['user_type'] ?? null;

if (!$user_id || !$user_type) {
    die("Unauthorized access.");
}

// Determine table and ID column
$table = $user_type === 'business' ? 'business' : 'customer';
$id_column = $user_type === 'business' ? 'business_id' : 'customer_id';

// Delete user
$stmt = $pdo->prepare("DELETE FROM $table WHERE $id_column = ?");
$stmt->execute([$user_id]);

// End session
session_destroy();

// Redirect to login with success message
header("Location: login.php?deleted=1");
exit;
