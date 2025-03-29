<?php
require '../tools.php'; // Include the functions for business registration
require_once '../db_config.php'; // Include the database connection

$pdo = Database::getConnection();

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["business_email"];
    $password = $_POST["business_password"];
    $name = $_POST["business_name"];
    $description = $_POST["business_description"];
    $contact_email = $_POST["business_contact_email"];
    $postcode = $_POST["business_postcode"];
    $street1 = $_POST["business_address_line1"];
    $street2 = $_POST["business_address_line2"];
    $latitude = $_POST["latitude"] ? $_POST["latitude"] : null;
    $longitude = $_POST["longitude"] ? $_POST["longitude"] : null;

    // Basic validation
    if (empty($email) || empty($password) || empty($name) || empty($street1)) {
        $message = "Please fill in all required fields.";
    } else {
        try {
            registerBusiness($email, $password, $name, $description, $contact_email, $postcode, $street1, $street2, $latitude, $longitude, $pdo);
            // Redirect to login.php with a success parameter
            header("Location: ../frontend/login.php?registration=success");
            exit(); // Ensure no further code runs after redirect
        } catch (Exception $e) {
            $message = "Error: " . $e->getMessage();
        }
    }
} else {
    $message = "Invalid request method. Please use the registration form.";
}
?>