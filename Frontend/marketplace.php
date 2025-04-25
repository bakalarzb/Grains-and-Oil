<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$heroTitle = "FIRST GRADE GOODIES!";
$heroClass = "hero-marketplace";
$heroSubtitle = "Where Community Meets Sustainability, One Seed at a Time.";

include("header.php");
include("../tools.php");

$products = getAllProducts();

// Define fallback images by category
$categoryImages = [
    'Fruit' => 'images/fruit.avif',
    'Vegetable' => 'images/vegetables.avif',
    'Grain' => 'images/grains.jpg',
    'Oil' => 'images/oils.jpg',
    'Other' => 'images/other.jpg'
];
?>

<div class="filters">
    <button class="filter-btn">Filter</button>
    <button class="filter-btn">Filter</button>
    <button class="filter-btn">Filter</button>
    <button class="filter-dropdown">All Filters ▼</button>
</div>

<?php if (empty($products)): ?>
    <div style="text-align: center; padding: 50px;">
        <h3>No products available to show</h3>
    </div>
<?php else: ?>

<section class="product-grid">
    <?php foreach ($products as $product): ?>
        <div class="product-card">
            <?php
            $productId = $product['product_id'];
            $category = htmlspecialchars($product['product_category_name']);
            $images = getImage($productId);  // Should return an array

            if (!empty($images)) {
                $imagePath = $images[0]['image_path'];
            } else {
                $imagePath = $categoryImages[$category] ?? $categoryImages['Other'];
            }

            ?>

            <img src="<?=$imagePath?>" alt="<?= htmlspecialchars($product['product_name']) ?>">
            <h3><?= htmlspecialchars($product['product_name']) ?></h3>
            <p class="price">£<?= number_format($product['price'], 2) ?>/kg</p>

            <form method="POST" action="add_to_cart.php">
                <input type="hidden" name="product_name" value="<?= htmlspecialchars($product['product_name']) ?>">
                <input type="hidden" name="price" value="<?= htmlspecialchars($product['price']) ?>">
                <input type="hidden" name="image" value="<?= htmlspecialchars($imagePath) ?>">
                <button type="submit" class="cart-btn">Add To Cart</button>
            </form>
        </div>
    <?php endforeach; ?>
</section>

<?php endif; ?>

<div class="pagination">
    <button class="page-btn active">1</button>
</div>

<?php include("footer.php"); ?>
</body>
</html>
