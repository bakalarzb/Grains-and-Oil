<?php
error_log("Current __DIR__: " . __DIR__);
error_log("__DIR__: " . __DIR__);
error_log("TMP file: " . $_FILES['product_image']['tmp_name']);
error_log("Original name: " . $_FILES['product_image']['name']);

require_once '../tools.php';
startSessionIfNeeded();

$pdo = Database::getConnection();
$response = ['success' => false];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $businessId = $_SESSION['user']['business_id'] ?? null;

    if (!$businessId) {
        $response['error'] = "No business ID found in session.";
        echo json_encode($response);
        exit;
    }

    // Basic product info
    $name = $_POST['product_name'] ?? '';
    $category = $_POST['product_category_name'] ?? '';
    $price = $_POST['price'] ?? 0;
    $weight = $_POST['weight'] ?? 0;
    $description = $_POST['description'] ?? '';

    // Step 1: Insert product WITHOUT image first
    $stmt = $pdo->prepare("
        INSERT INTO product (
            product_name, product_category_name, price, weight, description, product_business_id
        ) VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([$name, $category, $price, $weight, $description, $businessId]);

    $productId = $pdo->lastInsertId();
    $response['product_id'] = $productId;

    // Step 2: If an image was uploaded, save it
    if (!empty($_FILES['product_image']['tmp_name'])) {
        $ext = strtolower(pathinfo($_FILES['product_image']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'avif'];

        if (in_array($ext, $allowed)) {
            $uploadDir = __DIR__ . "/Frontend/uploads/products"; // uploads/products is inside Frontend
            error_log("Resolved upload path: $uploadDir");

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true); // Create if missing
            }
            file_put_contents($uploadDir . "/test.txt", "Test file to confirm path.");

            $newFileName = $uploadDir . "/product_{$productId}.{$ext}";
            error_log("Saving file to: " . $newFileName); // 👈 Debug log

            if (move_uploaded_file($_FILES['product_image']['tmp_name'], $newFileName)) {
                error_log("Upload successful");
                $response['success'] = true;
            } else {
                error_log("Upload FAILED: TMP = " . $_FILES['product_image']['tmp_name']);
                $response['error'] = "Failed to save uploaded image.";
            }
        } else {
            $response['error'] = "Invalid file type.";
        }
    } else {
        $response['success'] = true; // ✅ Success even without image
    }
}

if ($response['success']) {
    header("Location: marketplace.php");
    exit;
} else {
    header('Content-Type: application/json');
    echo json_encode($response);
}