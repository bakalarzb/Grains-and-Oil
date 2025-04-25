<?php
$heroTitle = "Products Listings";
$heroClass = "hero-article";
$heroSubtitle = "";

/* Header includes the main CSS File the class uses START */
include("header.php");
/* END */

$businessproducts = getBusinessProducts($_SESSION['user_id']);
$categories = getCategories();

// Define fallback images by category
$categoryImages = [
    'Fruit' => 'images/fruit.avif',
    'Vegetable' => 'images/vegetables.avif',
    'Grain' => 'images/grains.jpg',
    'Oil' => 'images/oils.jpg',
    'Other' => 'images/other.jpg'
];

require_once '../db_config.php'; // Include the database connection

$message = '';

/**
 * Delete product from database.
 *
 * This function recieves the id of the product to be removed and deletes the entry in the product table with that id.
 * It returns a message for an alert declaring the success or failure of the function.
 * Terminates and rollsback on an error, returning a failure notification.
 *
 * @return string A message declaring success/failure or otherwise of query.
 */
if (!function_exists('deleteListing')) {
    function deleteListing($productId) {

        $pdo = Database::getConnection();

        try{

            // Delete from product table.
            $stmt = $pdo -> prepare('DELETE FROM product WHERE product_id = ?');
            $stmt -> execute([ $productId ]);

            return 'Product Deleted!';

        }catch (Exception $e) {
            $pdo->rollBack();
            return 'Deletion failed!';
        }

    }

}

//On delete button press, run function and alert result, then refresh page to update listings.
if (isset($_POST['delete'])) {

    $message = deleteListing(htmlspecialchars($_POST['id']));

    $businessId = $_SESSION['user']['business_id'] ?? null;

    if (!$businessId) {
        echo "<script>alert('Error, no business logged in');</script>";
        exit;
    }

    echo "<script>alert('$message');</script>";
    header("refresh: 0");

}


//When modal submit request is sent, update database with new information.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit-edit'])) {

    $pdo = Database::getConnection();

    $businessId = $_SESSION['user']['business_id'] ?? null;

    if (!$businessId) {
        echo "<script>alert('Error, no business logged in');</script>";
        exit;
    }

    $name = $_POST['product_name'] ?? '';
    $category = $_POST['product_category_name'] ?? '';
    $price = $_POST['price'] ?? 0;
    $weight = $_POST['weight'] ?? 0;
    $description = $_POST['description'] ?? '';
    $productid = $_POST['id'] ??'';

    try{
    // Insert product (no image update or change implemented)
    $stmt = $pdo->prepare("UPDATE product SET product_name = ?, product_category_name = ?, price = ?, weight = ?, description = ? WHERE product_id = ? AND product_business_id = ?");
    $stmt->execute([$name, $category, $price, $weight, $description, $productid, $businessId]);
    echo "<script>alert('success');</script>";
    header("refresh: 0");

    }catch (Exception $e) {
        //Rollback on failure.
          $pdo->rollBack();
          echo "<script>alert('$e');</script>";
        }

}

?>

<!-- Header Section -->
<header class="edit-products-header">
    <div class="header-content">
        <h1>Edit Your Products</h1>
        <p class="subtitle">Manage your product listings</p>
    </div>
</header>


<!-- Listings container -->
<div class="products-column-container">

    <!-- Check if product list is empty and display unique response, otherwise display products -->
    <?php if (empty($businessproducts)): ?>
        <div class="alert alert-warning text-center">😕 No product listings found.</div>
    <?php else: ?>

        <!-- Loop through count of products so we can match entries by index when changing values. -->
        <?php for($index = 0; $index < count($businessproducts); $index++): ?>
            <?php $product = $businessproducts[$index]?>
            <!-- Product edit card 1 START -->
            <form method="post" action="" class="product-edit">

                <?php 
                $images = getImage($product['product_id']);  // Should return an array.

                //If no image reference for productid in database, then display default image for category.
                if (!empty($images)) {
                    $imagePath = $images[0]['image_path'];
                } else {
                    $imagePath = $categoryImages[$product['product_category_name']] ?? $categoryImages['Other'];
                }
                ?>

                <div class="product-image-container">
                <!-- Product Image with path set to either default image path or special path from function. -->
                <img src="<?=$imagePath?>" class="product-image" alt="<?= htmlspecialchars($product['product_name']) ?>">
                </div>
                <div class="card-info">
                    <div class="product-header">
                        <div class="product-meta">
                            <h2 id="name<?php echo $index ?>" class="product-name"><?= htmlspecialchars($product['product_name']) ?></h2>
                            <span id="category<?php echo $index ?>" class="product-category"><?= htmlspecialchars($product['product_category_name']) ?></span>
                        </div>
                        <div class="product-weight-price">
                            <span id="weight<?php echo $index ?>" class="product-weight"><?= number_format($product['weight'])?>kg </span>
                            <span id="price<?php echo $index ?>" class="product-price">£<?= number_format($product['price'], 2) ?>/kg</span>
                        </div>
                    </div>
                    <div class="product-description">
                        <label for="product_one" class="description-label">Product Description</label>
                        <textarea id="description<?php echo $index ?>" name="product_one" class="description-field" placeholder="Describe your product..."><?= htmlspecialchars($product['description']) ?></textarea>
                    </div>
                </div>
                <div class="product-actions">
                    <button type="button" name="edit_btn" onclick='openModal("productModal<?php echo $index ?>")' class="action-btn edit-btn"><i class="fas fa-pen"></i> Edit Details</button>
                    <button name="delete" class="action-btn delete-btn"><i class="fas fa-trash"></i> Remove</button>
                    <button id="save<?php echo $index ?>" name="save" class="action-btn save-btn"><i class="fas fa-save"></i> Save</button>
                    <input type="hidden" name="id" value="<?php echo $product['product_id']; ?>" />
                    <input type="hidden" name="index" value="<?php echo $index; ?>" />
                </div>
            </form>

            <!-- Edit Product Modal -->
            <div id="productModal<?php echo $index ?>" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal('productModal<?php echo $index ?>')">×</span>
                    <h2>Edit Product Details</h2>
                    <form enctype="multipart/form-data" method="POST">
                        <div class="form-group">
                            <label for="productName">Product Name:</label>
                            <input value="<?= htmlspecialchars($product['product_name']) ?>" type="text" name="product_name" maxlength="100" required>
                        </div>

                        <div class="form-group">
                            <label for="productCategory">Category:</label>
                            <select name="product_category_name" required>
                                <option ><?= htmlspecialchars($product['product_category_name']) ?></option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= htmlspecialchars($category['category_name']) ?>">
                                        <?= htmlspecialchars($category['category_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="price">Price (per KG or L):</label>
                            <input value="<?= number_format($product['price'], 2) ?>" type="number" name="price" min="0" max="99999.99" step="0.01" required>
                        </div>

                        <div class="form-group">
                            <label for="weight">Weight/Volume (in KG or L):</label>
                            <input value="<?= number_format($product['weight']) ?>" type="number" name="weight" min="0" max="999.9" step="0.1" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description (Max: 500 characters):</label>
                            <textarea name="description" rows="4" maxlength="500"><?= htmlspecialchars($product['description']) ?></textarea>
                        </div>
                        <button name="submit-edit" type="submit" class="submit-btn">Finish Editing</button>
                        <input type="hidden" name="index" value="<?php echo $index; ?>" />
                        <input type="hidden" name="id" value="<?= number_format($product['product_id']) ?>" />
                    </form>
                </div>
            </div>
    
        <!-- Product edit card 1 END -->
        <?php endfor;?>

    <?php endif; ?>

</div>

    <!-- Include html2canvas for capturing the full element -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <!-- Link to external JavaScript file -->
    <script src="../js/scripts.js"></script>

<?php
include("footer.php");
?>
</body>
</html>
