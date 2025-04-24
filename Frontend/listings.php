<?php
$heroTitle = "Products Listings";
$heroClass = "hero-article";
$heroSubtitle = "";

/* Header includes the main CSS File the class uses START */
include("header.php");
/* END */

$businessproducts = getBusinessProducts($_SESSION['user_id']);

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
 * Add Subscriber to database
 *
 * This function checks to see if the entered email is already present in the database.
 * It returns a message for an alert if already present, otherwise it adds the email
 * and returns a success.
 * Terminates and rollsback on an error, returning a failure notification.
 *
 * @return string A message declaring success/failure or otherwise of query.
 */
if (!function_exists('deleteListing')) {
    function deleteListing($productId) {

        $pdo = Database::getConnection();

        try{

            // Check if email exists already
            $stmt = $pdo -> prepare('DELETE FROM product WHERE product_id = ?');
            $stmt -> execute([ $productId ]);

            return htmlspecialchars($productId);

        }catch (Exception $e) {
            $pdo->rollBack();
            return 'Deletion failed!';
        }

    }

}

if (isset($_POST['delete'])) {

    $message = deleteListing(htmlspecialchars($_POST['id']));

    echo "<script>alert('$message');</script>";
    header("refresh: 0");

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
    <?php foreach ($businessproducts as $product): ?>
        <!-- Product edit card 1 START -->
        <div class="product-edit">

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
                        <h2 class="product-name"><?= htmlspecialchars($product['product_name']) ?></h2>
                        <span class="product-category"><?= htmlspecialchars($product['product_category_name']) ?></span>
                    </div>
                    <div class="product-weight-price">
                        <span class="product-weight"><?= number_format($product['weight'])?>kg </span>
                        <span class="product-price">£<?= number_format($product['price'], 2) ?>/kg</span>
                    </div>
                </div>
                <div class="product-description">
                    <label for="product_one" class="description-label">Product Description</label>
                    <textarea id="product_one" name="product_one" class="description-field" placeholder="Describe your product..."><?= htmlspecialchars($product['product_name']) ?></textarea>
                </div>
            </div>
            <form class="product-actions" method="post" action="">
                <button name="edit_btn" class="action-btn edit-btn"><i class="fas fa-pen"></i> Edit Details</button>
                <button name="delete" class="action-btn delete-btn"><i class="fas fa-trash"></i> Remove</button>
                <button name="save" class="action-btn save-btn"><i class="fas fa-save"></i> Save</button>
                <input type="hidden" id="id" name="id" value="<?php echo $product['product_id']; ?>" />
            </form>
        </div>
        <!-- Product edit card 1 END -->
        <?php endforeach; ?>
</div>

<?php
include("footer.php");
?>
</body>
</html>
