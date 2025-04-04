<?php
require '../tools.php'; // Include the functions for business registration
require_once '../db_config.php'; // Include the database connection

$pdo = Database::getConnection();

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $username = $_POST["username"];
    $postcode = $_POST["postcode"];
    $street1 = $_POST["address_line1"];
    $street2 = $_POST["address_line2"];
    $phone_num = $_POST["phone_number"];

    try {
        registerCustomer($email, $password, $first_name, $last_name, $username, $postcode, $street1, $street2, $phone_num, $pdo);
        // Redirect to login.php with a success parameter
        header("Location: ../frontend/login.php?registration=success");
        exit(); // Ensure no further code runs after redirect
    } catch (Exception $e) {
        $message = "Error: " . $e->getMessage();
    }
}
