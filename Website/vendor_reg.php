<?php
require 'tools.php'; // Include the functions for business registration
require_once 'db_config.php'; // Include the database connection

$pdo = Database::getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $description = $_POST["description"];
    $contact_email = $_POST["contact_email"];
    $postcode = $_POST["postcode"];
    $street1 = $_POST["street1"];
    $street2 = $_POST["street2"];
    $latitude = isset($_POST["latitude"]) ? $_POST["latitude"] : null;
    $longitude = isset($_POST["longitude"]) ? $_POST["longitude"] : null;

    echo registerBusiness($email, $password, $name, $description, $contact_email, $postcode, $street1, $street2, $latitude, $longitude, $pdo);
}
?>

<!-- Registration Form -->
<form method="POST" id="registrationForm" action="vendor_reg.php">
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    Business Name: <input type="text" name="name" required><br>
    Description: <textarea name="description" required></textarea><br>
    Contact Email: <input type="email" name="contact_email" required><br>

    Street Address 1: <input type="text" name="street1" required><br>
    Street Address 2 (Optional): <input type="text" name="street2"><br>
    City: <input type="text" name="city" required><br>
    Postcode: <input type="text" name="postcode" id="postcode" required><br>

    <input type="hidden" id="latitude" name="latitude">
    <input type="hidden" id="longitude" name="longitude">

    <input type="submit" value="Register">
</form>

<!-- Link to the external JavaScript file -->
<script src="js/scripts.js"></script>


