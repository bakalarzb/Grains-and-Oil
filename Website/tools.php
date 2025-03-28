<?php
require 'db_config.php';

// Function to create a business login record in the business_login table
function createBusinessLoginRecord($password, $pdo) {
    // Hash the password securely
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert into the business_login table and get the business_login_id
    $stmt = $pdo->prepare("INSERT INTO business_login (business_login_password) VALUES (?)");
    $stmt->execute([$hashedPassword]);

    // Return the last inserted business_login_id
    return $pdo->lastInsertId();
}

// Function to create a business record in the business table
function createBusinessRecord($businessId, $email, $name, $description, $contactEmail, $postcode, $street1, $street2, $latitude, $longitude, $pdo) {
    // Sanitize and format the address
    $fullAddress = sanitiseAddress($street1, $street2, $postcode);

    // Check if coordinates are valid
    if ($latitude && $longitude) {
        // Insert into the business table, linking to the business_login table
        $stmt = $pdo->prepare("INSERT INTO business (
            business_id,
            business_email,
            business_name,
            business_description,
            business_contact_email,
            business_postcode,
            business_address_line1,
            business_address_line2,
            business_geolocation_lat,
            business_geolocation_long
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Execute the query
        $stmt->execute([$businessId, $email, $name, $description, $contactEmail, $postcode, $street1, $street2, $latitude, $longitude]);

    } else {
        throw new Exception("Invalid coordinates received.");
    }
}

// Function to register a business and its login details
function registerBusiness($email, $password, $name, $description, $contactEmail, $postcode, $street1, $street2, $latitude, $longitude, $pdo) {
    // Start transaction
    $pdo->beginTransaction();

    try {
        // Step 1: Create the business login record (insert into business_login first)
        $businessLoginId = createBusinessLoginRecord($password, $pdo);

        // Step 2: Now that we have the business_login_id, create the business record
        createBusinessRecord($businessLoginId, $email, $name, $description, $contactEmail, $postcode, $street1, $street2, $latitude, $longitude, $pdo);

        // Commit the transaction to ensure both records are inserted successfully
        $pdo->commit();

        return "Registration successful!<br>Name: $name<br>Address: $street1, $street2, $postcode, UK<br>";
    } catch (Exception $e) {
        // If something goes wrong, rollback the transaction
        $pdo->rollBack();
        return "Error: " . $e->getMessage();
    }
}

function sanitiseAddress($street1, $street2, $postcode) {
    return trim(htmlspecialchars($street1 . " " . $street2 . " " . $postcode));
}
