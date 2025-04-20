<?php
$heroTitle = "Products Listings";
$heroClass = "hero-article";
$heroSubtitle = "";

/* Header includes the main CSS File the class uses START */
include("header.php");
/* END */

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
    <!-- Product edit card 1 START -->
    <div class="product-edit">
        <div class="product-image-container">
            <img src="./images/rice.avif" alt="Product Image" class="product-image">
        </div>
        <div class="card-info">
            <div class="product-header">
                <div class="product-meta">
                    <h2 class="product-name">Rice</h2>
                    <span class="product-category">Other</span>
                </div>
                <div class="product-weight-price">
                    <span class="product-weight">3kg</span>
                    <span class="product-price">£1.50</span>
                </div>
            </div>
            <div class="product-description">
                <label for="product_one" class="description-label">Product Description</label>
                <textarea id="product_one" name="product_one" class="description-field" placeholder="Describe your product...">Rice freshly grown</textarea>
            </div>
        </div>
        <div class="product-actions">
            <button class="action-btn edit-btn"><i class="fas fa-pen"></i> Edit Details</button>
            <button class="action-btn delete-btn"><i class="fas fa-trash"></i> Remove</button>
            <button class="action-btn save-btn"><i class="fas fa-save"></i> Save</button>
        </div>
    </div>
    <!-- Product edit card 1 END -->
</div>

<?php
include("footer.php");
?>
</body>
</html>
