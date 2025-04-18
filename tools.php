<?php
require_once 'db_config.php';

/**
 * This file contains utility functions.
 *
 * All database interactions use PDO prepared statements to prevent SQL injection.
 * Functions are wrapped in existence checks to avoid redefinition errors.
 */

/*
*** Logic to create business accounts ***
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

/**
 * Logs in a business user by verifying their email and password.
 * Returns an array with business details on success, or throws an exception on failure.
 *
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

/**
 * Logs in a customer user by verifying their email and password.
 * Returns an array with customer details on success, or throws an exception on failure.
 *
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
if (!function_exists('loginAdmin')) {
    function loginAdmin($email, $password, $pdo) {
        $stmt = $pdo->prepare("
            SELECT a.admin_id, a.admin_email, a.admin_first_name, a.admin_last_name, al.admin_login_password
            FROM admin a
            INNER JOIN admin_login al ON a.admin_id = al.admin_id
            WHERE a.admin_email = ?
        ");
        $stmt->execute([$email]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$admin) {
            throw new Exception("Admin not found.");
        }

        // SIMPLE string comparison (because passwords are plain text now)
        if ($password !== $admin['admin_login_password']) {
            throw new Exception("Incorrect password.");
        }

        unset($admin['admin_login_password']);
        return $admin;
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

/**
 * Adds a new product to the product table
 *
 * @param int $businessId The ID of the business adding the product
 * @param array $productData Associative array with product details
 * @return array JSON-encodable array with success status and product ID
 */
if (!function_exists('addProduct')) {
    function addProduct($businessId, $productData): array
    {
        try {
            $pdo = Database::getConnection();

            $stmt = $pdo->prepare("
                INSERT INTO product (
                    product_business_id, 
                    product_category_name, 
                    product_name, 
                    price, 
                    description, 
                    weight
                ) VALUES (
                    :business_id, 
                    :category, 
                    :name, 
                    :price, 
                    :description, 
                    :weight
                )
            ");

            $stmt->execute([
                'business_id' => $businessId,
                'category' => $productData['product_category_name'],
                'name' => $productData['product_name'],
                'price' => $productData['price'],
                'description' => $productData['description'],
                'weight' => $productData['weight']
            ]);

            return [
                'success' => true,
                'product_id' => $pdo->lastInsertId()
            ];
        } catch (PDOException $e) {
            return [
                'success' => false,
                'error' => 'Failed to add product: ' . $e->getMessage()
            ];
        }
    }
}

if (!function_exists('saveProductImages')) {
    function saveProductImages(int $productId, array $imageFiles): array
    {
        $pdo = Database::getConnection();
        $savedPaths = [];
        $uploadDir = __DIR__ . "/uploads/products/";

        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0777, true)) {
                error_log("❌ Failed to create upload directory: $uploadDir");
                return [];
            }
        }

        $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'avif'];

        foreach ($imageFiles['tmp_name'] as $index => $tmpPath) {
            $originalName = $imageFiles['name'][$index];
            $errorCode = $imageFiles['error'][$index];

            if ($errorCode !== UPLOAD_ERR_OK) {
                error_log("❌ Upload error on file '$originalName': Code $errorCode");
                continue;
            }

            $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
            if (!in_array($ext, $allowed)) {
                error_log("❌ File extension '$ext' not allowed for file '$originalName'");
                continue;
            }

            $uniqueName = uniqid("product{$productId}_") . '.' . $ext;
            $relativePath = "uploads/products/" . $uniqueName;
            $fullPath = __DIR__ . "/" . $relativePath;

            if (!move_uploaded_file($tmpPath, $fullPath)) {
                error_log("❌ Failed to move uploaded file '$originalName' to '$fullPath'");
                continue;
            }

            try {
                $stmt = $pdo->prepare("INSERT INTO product_image (product_id, image_path) VALUES (:pid, :path)");
                $stmt->execute([
                    'pid' => $productId,
                    'path' => $relativePath
                ]);
                $savedPaths[] = $relativePath;
                error_log("✅ Image '$originalName' saved and database entry created.");
            } catch (PDOException $e) {
                error_log("❌ Database error while saving image path for '$originalName': " . $e->getMessage());
            }
        }

        return $savedPaths;
    }
}


/**
 * Fetch all categories from the category table.
 *
 * This function connects to the database and retrieves all records from
 * the 'category' table. It returns an associative array containing category
 * data or terminates the script if an error occurs.
 *
 * @return array An array of categories with their details.
 */
if (!function_exists('getCategories')) {
    function getCategories()
    {
        try {
            $pdo = Database::getConnection();

            // Fetch categories
            $query = $pdo->query("SELECT * FROM category");

            // Return all category records as an associative array
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle database connection errors
            die("Database error: " . $e->getMessage());
        }
    }
}

if (!function_exists('getImage')) {
    function getImage($productId)
    {
        try {
            $pdo = Database::getConnection();

            $stmt = $pdo->prepare("SELECT image_path FROM product_image WHERE product_id = :pid");
            $stmt->execute(['pid' => $productId]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Database error: " . $e->getMessage());
        }
    }
}

/**
 * Fetch all products from the product table.
 *
 * This function retrieves all records from the 'product' table.
 * It returns an associative array containing product details or
 * terminates the script if a database error occurs.
 *
 * @return array An array of products with their details.
 */
if (!function_exists('getAllProducts')) {
    function getAllProducts() {
        try {
            $pdo = Database::getConnection(); // Get database connection

            // Fetch all records from the product table
            $query = $pdo->query("SELECT * FROM product");

            // Return all product records as an associative array
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle database errors
            die("Database error: " . $e->getMessage());
        }
    }
}
