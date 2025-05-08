<!-- (place before the (<php) This Code is just for inputing your own CCS File, Can be removed on submit START --> 
<style>
<?php include 'CSS/fishy.css'; ?>
</style>
<!-- END -->

<?php
$heroTitle = "Order History";
$heroClass = "hero-order";
include("header.php");
?>

<!-- Header Section -->
<header class="edit-products-header">
    <div class="header-content">
        <h1>Purchase Log</h1>
        <p class="subtitle">View your previously purchased products</p>
    </div>
</header>

<!-- Single Product Card -->
<div class="products-column-container">
    <div class="order-card">
        <div class="order-header">
            <div class="order-meta">
                <span class="text-white">Order Date: May 15, 2023</span>
                <span class="text-white">Order #12345</span>
                <span class="text-white">Status: Delivered</span>
            </div>
            <div class="order-total">
                <span>Total: £16.50</span>
            </div>
        </div>
        
        <div class="product-edit">
            <div class="product-image-container">
                <img src="./images/watermelons.avif" alt="Rice" class="product-image">
            </div>
            <div class="card-info">
                <div class="product-header">
                    <div class="product-meta">
                        <h2 class="product-name">Watermelon</h2>
                        <span class="product-category">Fruit</span>
                    </div>
                    <div class="product-weight-price">
                        <span class="product-weight">8kg</span>
                        <span class="product-price">£16.50</span>
                    </div>
                </div>
                <div class="product-description">
                    <p class="description-text">Freshly grown organic rice from local farms.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>