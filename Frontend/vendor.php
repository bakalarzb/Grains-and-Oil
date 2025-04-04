<?php

// Include tools.php for the addProduct function
require_once '../tools.php';
require_once '../db_config.php';

$categories = getCategories();

// Handle AJAX request to add product
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
    $isJsonRequest = stripos($contentType, 'application/json') !== false;

    error_log("Is JSON Request: " . ($isJsonRequest ? 'Yes' : 'No'));

    if ($isJsonRequest) {
        header('Content-Type: application/json');

        // Get the POST data
        $data = json_decode(file_get_contents('php://input'), true);

        // Debug: Log the received data
        error_log("Received Data: " . print_r($data, true));

        // Start session to get business ID
        session_start();
        $loggedInBusinessId = $_SESSION['user']['business_id'] ?? null;

        if (!$loggedInBusinessId) {
            echo json_encode(['success' => false, 'error' => 'No business ID provided']);
            exit;
        }

        // Call the reusable addProduct function from tools.php
        $result = addProduct($loggedInBusinessId, $data);

        // Debug: Log the result
        error_log("Result: " . print_r($result, true));

        // Output the result
        echo json_encode($result);
        exit; // Ensure no further output
    } else {
        error_log("Not a JSON request, Content-Type: " . $contentType);
    }
}

include("header.php");
?>

    <br>

    <div class="heading">
        <h1>Vendor Dashboard</h1>
        <p>Easily list, manage, and monitor your surplus produce on the Grains & Oil Marketplace.</p>
    </div>

    <section class="vendor-dashboard">
        <div class="vendor-container">    
            <div class="dashboard-actions">

                <!-- Add Product Card -->
                <div class="dashboard-card">
                    <i class="fa-solid fa-plus"></i>
                    <h3>Add New Product</h3>
                    <p>Quickly list surplus produce with details like quantity, type, and price.</p>
                    <button class="dashboard-btn" onclick='openModal("productModal")'>Create Listing</button>
                </div>

                <!-- Edit listings Card -->
                <div class="dashboard-card">
                    <i class="fa-solid fa-pen-to-square"></i>
                    <h3>Manage Listings</h3>
                    <p>View, update, or remove existing product listings with ease.</p>
                    <a href="#" class="dashboard-btn">View Listings</a>
                </div>

                <!-- Track Analytics Card -->
                <div class="dashboard-card">
                    <i class="fa-solid fa-chart-line"></i>
                    <h3>Sales & Analytics</h3>
                    <p>Track your performance, orders, and get insights on buyer activity.</p>
                    <a href="#" class="dashboard-btn">View Dashboard</a>
                </div>

            </div>
        </div>
    </section>

    <!-- Add Product Modal -->
    <div id="productModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('productModal')">×</span>
            <h2>Add New Product</h2>
            <form id="productForm">
                <div class="form-group">
                    <label for="productName">Product Name:</label>
                    <input type="text" id="productName" name="product_name" maxlength="100" required>
                </div>

                <div class="form-group">
                    <label for="productCategory">Category:</label>
                    <select id="productCategory" name="product_category_name" required>
                        <option value="">Select Category</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= htmlspecialchars($category['category_name']) ?>">
                                <?= htmlspecialchars($category['category_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="price">Price (per KG or L):</label>
                    <input type="number" id="price" name="price" min="0" max="99999.99" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="weight">Weight/Volume (in KG or L):</label>
                    <input type="number" id="weight" name="weight" min="0" max="999.9" step="0.1" required>
                </div>

                <div class="form-group">
                    <label for="description">Description (Max: 500 characters):</label>
                    <textarea id="description" name="description" rows="4" maxlength="500"></textarea>
                </div>

                <button type="submit" class="submit-btn">Add Product</button>
            </form>
        </div>
    </div>

    <!-- Link to external JavaScript file -->
    <script src="../js/scripts.js"></script>

<?php
include("footer.php");
?>
</body>
</html>