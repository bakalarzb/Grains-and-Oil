<?php
// Include tools.php for the addProduct function
require_once '../tools.php';
require_once '../db_config.php';
startSessionIfNeeded();

// Handle AJAX request to add product
$categories = getCategories();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_name'])) {
    $response = ['success' => false];

    $pdo = Database::getConnection();
    $businessId = $_SESSION['user']['business_id'] ?? null;

    if (!$businessId) {
        $response['error'] = "No business ID in session.";
        echo json_encode($response);
        exit;
    }

    $name = $_POST['product_name'] ?? '';
    $category = $_POST['product_category_name'] ?? '';
    $price = $_POST['price'] ?? 0;
    $weight = $_POST['weight'] ?? 0;
    $description = $_POST['description'] ?? '';

    // Insert product (no image in DB!)
    $stmt = $pdo->prepare("
        INSERT INTO product (
            product_name, product_category_name, price, weight, description, product_business_id
        ) VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([$name, $category, $price, $weight, $description, $businessId]);

    $productId = $pdo->lastInsertId();

    // Handle optional image
    if (!empty($_FILES['product_image']['tmp_name'])) {
        $ext = strtolower(pathinfo($_FILES['product_image']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'avif'];

        if (in_array($ext, $allowed)) {
            $uploadDir = __DIR__ . "/uploads/products";

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $imagePath = $uploadDir . "/product_{$productId}." . $ext;

            if (move_uploaded_file($_FILES['product_image']['tmp_name'], $imagePath)) {
                error_log("✅ Image uploaded to: $imagePath");
            } else {
                error_log("❌ Failed to move image to $imagePath");
            }
        } else {
            error_log("❌ Invalid file type: $ext");
        }
    }

    echo json_encode(['success' => true, 'product_id' => $productId]);
    exit;
}


include("header.php");

$vendorId = $_SESSION['user']['business_id'];

?>

    <br>

    <div class="pt-3 pb-3" style="text-align: center; font-family: 'Karla', sans-serif; color: #242423;">
        <h1>Vendor Dashboard</h1>
        <p>Easily list, manage, and monitor your surplus produce on the Grains & Oil Marketplace.</p>
    </div>

    <section class="vendor-dashboard">
        <div class="vendor-container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="row justify-content-center pb-4">
                        <!-- Add Product Card -->
                        <div class="col-6 col-xl-5">
                            <div class="dashboard-card text-center p-4 h-100">
                                <i class="fa-solid fa-plus fa-2x mb-3"></i>
                                <h3>Add New Product</h3>
                                <p>Quickly list surplus produce with details like quantity, type, and price.</p>
                                <button class="dashboard-btn mt-2" onclick='openModal("productModal")'>Create Listing</button>
                            </div>
                        </div>

                        <!-- Edit Listings Card -->
                        <div class="col-6 col-xl-5">
                            <div class="dashboard-card text-center p-4 h-100">
                                <i class="fa-solid fa-pen-to-square fa-2x mb-3"></i>
                                <h3>Manage Listings</h3>
                                <p>View, update, or remove existing product listings with ease.</p>
                                <a href="#" class="dashboard-btn mt-2">View Listings</a>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <!-- Track Analytics Card -->
                        <div class="col-6 col-xl-5">
                            <div class="dashboard-card text-center p-4 h-100">
                                <i class="fa-solid fa-chart-line fa-2x mb-3"></i>
                                <h3>Sales & Analytics</h3>
                                <p>Track your performance, orders, and get insights on buyer activity.</p>
                                <a href="#" class="dashboard-btn mt-2">View Dashboard</a>
                            </div>
                        </div>

                        <!-- Create QR Code Card -->
                        <div class="col-6 col-xl-5">
                            <div class="dashboard-card text-center p-4 h-100">
                                <i class="fa-solid fa-qrcode fa-2x mb-3"></i>
                                <h3>Create Waste QR Code</h3>
                                <p>Create a QR code to track your business waste.</p>
                                <button class="dashboard-btn mt-2" onclick='openModal("QRModal")'>Create Code</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Add Product Modal -->
    <div id="productModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('productModal')">×</span>
            <h2>Add New Product</h2>
            <form id="productForm" enctype="multipart/form-data" method="POST">
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
                <div class="form-group">
                    <label for="productImage">Product Image (optional):</label>
                    <input type="file" name="product_image" accept="image/*">
                </div>
                <button type="submit" class="submit-btn">Add Product</button>
            </form>
        </div>
    </div>

    <!-- Generate QR Code Modal -->
    <div id="QRModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('QRModal')">×</span>
            <h2>Create Waste QR Code</h2>
            <form id="jsonForm">
                <div class="form-group">
                    <label for="wasteWeight">Weight/Volume (in KG or L):</label>
                    <input type="number" id="wasteWeight" name="wasteWeight" step="0.1" min="0.1" required>
                </div>
                <div class="form-group">
                    <label for="collectionDate">Collection Date:</label>
                    <input type="date" id="collectionDate" name="collectionDate" required>
                </div>
                <div class="form-group">
                    <label for="category">Category:</label>
                    <select id="category" name="category" required>
                        <option value="">Select Category</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= htmlspecialchars($category['category_name']) ?>">
                                <?= htmlspecialchars($category['category_name']) ?>
                            </option>
                        <?php endforeach; ?>
                        <option value="agri">Agricultural Waste</option>
                        <option value="manure">Manure</option>
                        <option value="mixed">Mixed Organic</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="destination">Destination (Biogas Site ID):</label>
                    <select id="destination" name="destination" required>
                        <option value="">Select Site</option>
                        <option value="BG001">Site BG001</option>
                        <option value="BG002">Site BG002</option>
                        <option value="BG003">Site BG003</option>
                        <option value="BG004">Site BG004</option>
                    </select>
                </div>
                <input type="hidden" id="vendorId" name="vendorId" value="<?php echo htmlspecialchars($vendorId); ?>">
                <button type="submit" class="submit-btn">Generate QR Code</button>
            </form>

            <div class="form-group qr-code-group hidden" id="qrCodeContainer">
                <hr>
                <label>Generated QR Code:</label>
                <qr-code id="qrCodeOutput"
                     module-color="#59743d"
                     position-ring-color="#e2c277"
                     position-center-color="#59743d"
                     style="
                        width: 300px;
                        height: 300px;
                        margin: 2em auto;
                        background-color: #fff;
                    "
                >
                    <img src="images/logo_simple.JPG" slot="icon"/>
                </qr-code>
                <button id="downloadQrBtn" class="qr-btn">Download QR Code</button>
                <button id="printQrBtn" class="qr-btn">Print QR Code</button>
            </div>
        </div>
    </div>

    <!-- @bitjson/qr-code library -->
    <script src="https://unpkg.com/@bitjson/qr-code@1.0.2/dist/qr-code.js"></script>
    <!-- Include html2canvas for capturing the full element -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <!-- Link to external JavaScript file -->
    <script src="../js/scripts.js"></script>

<?php
include("footer.php");
?>
</body>
</html>