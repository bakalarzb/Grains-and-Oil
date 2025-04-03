<?php
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
            <span class="close" onclick='closeModal("productModal")'>&times;</span>
            <h2>Add New Product</h2>
            <form id="productForm">
                <div class="form-group">
                    <label for="productName">Product Name:</label>
                    <input type="text" id="productName" name="productName" required>
                </div>

                <div class="form-group">
                    <label for="productType">Product Type:</label>
                    <select id="productType" name="productType" required>
                        <option value="">Select Type</option>
                        <option value="grain">Grain</option>
                        <option value="oil">Oil</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity (in KG):</label>
                    <input type="number" id="quantity" name="quantity" min="0" step="0.1" required>
                </div>

                <div class="form-group">
                    <label for="price">Price (per KG):</label>
                    <input type="number" id="price" name="price" min="0" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="4"></textarea>
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