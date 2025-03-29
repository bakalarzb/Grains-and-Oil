<?php
require_once 'db_config.php';

/*
 * This file contains utility functions for registering and logging in businesses and customers.
 * All database interactions use PDO prepared statements to prevent SQL injection.
 * Functions are wrapped in existence checks to avoid redefinition errors.
 */

/*
*** Logic to create business accounts ***
*/
if (!function_exists('createBusinessLoginRecord')) {
    function createBusinessLoginRecord($password, $pdo) {
        // Hash the password securely
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert into the business_login table and get the business_login_id
        $stmt = $pdo->prepare("INSERT INTO business_login (business_login_password) VALUES (?)");
        $stmt->execute([$hashedPassword]);

        // Return the last inserted business_login_id
        return $pdo->lastInsertId();
    }
}

if (!function_exists('createBusinessRecord')) {
    function createBusinessRecord($businessId, $email, $name, $description, $contactEmail, $postcode, $street1, $street2, $latitude, $longitude, $pdo) {
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
}

if (!function_exists('registerBusiness')) {
    function registerBusiness($email, $password, $name, $description, $contactEmail, $postcode, $street1, $street2, $latitude, $longitude, $pdo) {
        // Start transaction
        $pdo->beginTransaction();

        try {
            // Step 1: Create the business login record
            $businessLoginId = createBusinessLoginRecord($password, $pdo);

            // Step 2: Create the business record
            createBusinessRecord($businessLoginId, $email, $name, $description, $contactEmail, $postcode, $street1, $street2, $latitude, $longitude, $pdo);

            // Commit the transaction
            $pdo->commit();

            return "Registration successful!";
        } catch (Exception $e) {
            // Rollback on error
            $pdo->rollBack();
            throw $e; // Re-throw to handle in caller
        }
    }
}

/*
*** Logic to create customer accounts ***
*/
if (!function_exists('createCustomerLoginRecord')) {
    function createCustomerLoginRecord($password, $pdo) {
        // Hash the password securely
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert into the customer_login table and get the customer_login_id
        $stmt = $pdo->prepare("INSERT INTO customer_login (customer_login_password) VALUES (?)");
        $stmt->execute([$hashedPassword]);

        // Return the last inserted customer_login_id
        return $pdo->lastInsertId();
    }
}

if (!function_exists('createCustomerRecord')) {
    function createCustomerRecord($customerLoginId, $email, $first_name, $last_name, $username, $postcode, $street1, $street2, $phone_num, $pdo) {
        // Insert into the customer table
        $stmt = $pdo->prepare("INSERT INTO customer (
            customer_id,
            customer_email,
            customer_first_name,
            customer_last_name,
            customer_username,
            customer_postcode,
            customer_address_line1,
            customer_address_line2,
            customer_phone_number
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Execute the query
        $stmt->execute([$customerLoginId, $email, $first_name, $last_name, $username, $postcode, $street1, $street2, $phone_num]);
    }
}

if (!function_exists('registerCustomer')) {
    function registerCustomer($email, $password, $first_name, $last_name, $username, $postcode, $street1, $street2, $phone_num, $pdo) {
        // Start transaction
        $pdo->beginTransaction();

        try {
            // Step 1: Create the customer login record
            $customerLoginId = createCustomerLoginRecord($password, $pdo);

            // Step 2: Create the customer record
            createCustomerRecord($customerLoginId, $email, $first_name, $last_name, $username, $postcode, $street1, $street2, $phone_num, $pdo);

            // Commit the transaction
            $pdo->commit();

            return "Registration successful!";
        } catch (Exception $e) {
            // Rollback on error
            $pdo->rollBack();
            throw $e; // Re-throw to handle in caller
        }
    }
}

/* *** Login Functions *** */

/*
 * Logs in a business user by verifying their email and password.
 * Returns an array with business details on success, or throws an exception on failure.
 * @param string $email The business email
 * @param string $password The password to verify
 * @param PDO $pdo The database connection
 * @return array Business details
 * @throws Exception If login fails
 */
if (!function_exists('loginBusiness')) {
    function loginBusiness($email, $password, $pdo) {
        // Prepare statement to fetch business and login details
        $stmt = $pdo->prepare("
            SELECT b.business_id, b.business_email, b.business_name, b.business_description, 
                   b.business_contact_email, b.business_postcode, b.business_address_line1, 
                   b.business_address_line2, b.business_geolocation_lat, b.business_geolocation_long,
                   bl.business_login_password
            FROM business b
            INNER JOIN business_login bl ON b.business_id = bl.business_login_id
            WHERE b.business_email = ?
        ");

        $stmt->execute([$email]);
        $business = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($business === false) {
            throw new Exception("Business with this email not found.");
        }

        // Verify the password
        if (!password_verify($password, $business['business_login_password'])) {
            throw new Exception("Incorrect password.");
        }

        // Remove sensitive password data from the return array
        unset($business['business_login_password']);

        return $business;
    }
}

/*
 * Logs in a customer user by verifying their email and password.
 * Returns an array with customer details on success, or throws an exception on failure.
 * @param string $email The customer email
 * @param string $password The password to verify
 * @param PDO $pdo The database connection
 * @return array Customer details
 * @throws Exception If login fails
 */
if (!function_exists('loginCustomer')) {
    function loginCustomer($email, $password, $pdo) {
        // Prepare statement to fetch customer and login details
        $stmt = $pdo->prepare("
            SELECT c.customer_id, c.customer_email, c.customer_first_name, c.customer_last_name, 
                   c.customer_username, c.customer_postcode, c.customer_address_line1, 
                   c.customer_address_line2, c.customer_phone_number,
                   cl.customer_login_password
            FROM customer c
            INNER JOIN customer_login cl ON c.customer_id = cl.customer_login_id
            WHERE c.customer_email = ?
        ");

        $stmt->execute([$email]);
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($customer === false) {
            throw new Exception("Customer with this email not found.");
        }

        // Verify the password
        if (!password_verify($password, $customer['customer_login_password'])) {
            throw new Exception("Incorrect password.");
        }

        // Remove sensitive password data from the return array
        unset($customer['customer_login_password']);

        return $customer;
    }
}

/*
 * Starts the session if it hasn't been started yet.
 */
if (!function_exists('startSessionIfNeeded')) {
    function startSessionIfNeeded() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
}
