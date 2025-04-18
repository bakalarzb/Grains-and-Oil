<?php
// Turn on error reporting for debugging (comment out in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Optional: log errors to a file
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../logs/vendor_reg_errors.log');

require '../tools.php';
require_once '../db_config.php';

$pdo = Database::getConnection();

$message = '';

// Helper function to sanitize input
function sanitiseInput($data) {
    return htmlspecialchars(trim($data));
}

// Check request method
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Collect and sanitize input
    $email = sanitiseInput($_POST["business_email"] ?? '');
    $password = sanitiseInput($_POST["business_password"] ?? '');
    $name = sanitiseInput($_POST["business_name"] ?? '');
    $description = sanitiseInput($_POST["business_description"] ?? '');
    $contact_email = sanitiseInput($_POST["business_contact_email"] ?? '');
    $postcode = sanitiseInput($_POST["business_postcode"] ?? '');
    $street1 = sanitiseInput($_POST["business_address_line1"] ?? '');
    $street2 = sanitiseInput($_POST["business_address_line2"] ?? '');
    $latitude = isset($_POST["latitude"]) && $_POST["latitude"] !== '' ? floatval($_POST["latitude"]) : null;
    $longitude = isset($_POST["longitude"]) && $_POST["longitude"] !== '' ? floatval($_POST["longitude"]) : null;

    // Validate required fields
    if (empty($email) || empty($password) || empty($name) || empty($street1)) {
        $message = "Please fill in all required fields.";
        echo $message;
        exit();
    }

    try {
        // Attempt business registration
        registerBusiness(
            $email,
            $password,
            $name,
            $description,
            $contact_email,
            $postcode,
            $street1,
            $street2,
            $latitude,
            $longitude,
            $pdo
        );

        // Redirect on success
        header("Location: ../frontend/login.php?registration=success");
        exit();
    } catch (PDOException $e) {
        // Log and show DB-related errors
        error_log("Database error: " . $e->getMessage());
        echo "Database error: " . $e->getMessage(); // TEMP: remove in production
        exit();
    } catch (Exception $e) {
        // Log and show general exceptions
        error_log("General error: " . $e->getMessage());
        echo "An unexpected error occurred: " . $e->getMessage();
        exit();
    }
}
