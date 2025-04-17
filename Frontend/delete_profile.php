<?php
session_start();
require_once("../db_config.php");

$pdo = Database::getConnection();
$user_id = $_SESSION['user_id'] ?? null;
$user_type = $_SESSION['user_type'] ?? null;

// If not logged in, block access
if (!$user_id || !$user_type) {
    die("Unauthorized access.");
}

// If admin is trying to delete a user (not themselves!)
if ($user_type === 'admin' && isset($_GET['id']) && isset($_GET['type'])) {
    $delete_id = $_GET['id'];
    $delete_type = $_GET['type'];

    // Prevent admin from deleting themselves!
    if ($delete_id == $_SESSION['user_id'] && $delete_type == 'admin') {
        die("You cannot delete your own admin account through this page.");
    }

    // Determine table and ID column for deletion
    $table = $delete_type === 'business' ? 'business' : 'customer';
    $id_column = $delete_type === 'business' ? 'business_id' : 'customer_id';

    // Delete user
    $stmt = $pdo->prepare("DELETE FROM $table WHERE $id_column = ?");
    $stmt->execute([$delete_id]);

    // Also delete login record
    $loginTable = $delete_type === 'business' ? 'business_login' : 'customer_login';
    $loginIdColumn = $delete_type === 'business' ? 'business_login_id' : 'customer_login_id';

    $stmt = $pdo->prepare("DELETE FROM $loginTable WHERE $loginIdColumn = ?");
    $stmt->execute([$delete_id]);

    // Redirect back to admin dashboard
    header("Location: admin_dashboard.php?deleted=1");
    exit;

} else {
    // Normal customer/business deleting **their own profile**

    $table = $user_type === 'business' ? 'business' : 'customer';
    $id_column = $user_type === 'business' ? 'business_id' : 'customer_id';

    // Delete user
    $stmt = $pdo->prepare("DELETE FROM $table WHERE $id_column = ?");
    $stmt->execute([$user_id]);

    // Delete from login table
    $loginTable = $user_type === 'business' ? 'business_login' : 'customer_login';
    $loginIdColumn = $user_type === 'business' ? 'business_login_id' : 'customer_login_id';

    $stmt = $pdo->prepare("DELETE FROM $loginTable WHERE $loginIdColumn = ?");
    $stmt->execute([$user_id]);

    // End session
    session_destroy();

    // Redirect to login page
    header("Location: login.php?deleted=1");
    exit;
}
?>
