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
            <div class="product-actions">
                <button class="action-btn edit-btn"><i class="fas fa-pen"></i> Edit Details</button>
                <button class="action-btn delete-btn"><i class="fas fa-trash"></i> Remove</button>
                <button class="action-btn save-btn"><i class="fas fa-save"></i> Save</button>
            </div>
        </div>
        <!-- Product edit card 1 END -->
        <?php endforeach; ?>
</div>

<?php
include("footer.php");
?>
</body>
</html>
