<!-- (place before the (<php) This Code is just for inputing your own CCS File, Can be removed on submit START --> 
<style>
<?php include 'CSS/fishy.css'; ?>
</style>
<!-- END -->

<?php
$heroTitle = "FIRST GRADE GOODIES!";
$heroClass = "hero-marketplace";
$heroSubtitle = "Where Community Meets Sustainability, One Seed at a Time.";

include("header.php");
include("../tools.php");

$categoryFilter = $_GET['category'] ?? null;

$allProducts = getAllProducts();

if ($categoryFilter) {
    $products = array_filter($allProducts, function ($product) use ($categoryFilter) {
        return strtolower($product['product_category_name']) === strtolower($categoryFilter);
    });
} else {
    $products = $allProducts;
}

// Define default images for each category
$categoryImages = [
    'Fruit' => 'images/fruit.avif',
    'Vegetable' => 'images/vegetables.avif',
    'Grain' => 'images/grains.jpg',
    'Oil' => 'images/oils.jpg',
    'Other' => 'images/other.jpg'
];
?>

<!-- Filter Section -->
<div class="filters">
    <div class="active-filters">
        <?php if ($categoryFilter): ?>
            <a href="marketplace.php" class="filter-btn"><?= htmlspecialchars($categoryFilter) ?> ✕</a>
        <?php endif; ?>
    </div>
    <div class="dropdown">
        <button class="filter-dropdown">Add Filters <i class="fas fa-caret-down"></i></button>
        <div class="dropdown-content">
            <a href="?category=Fruit">Fruits</a>
            <a href="?category=Vegetable">Vegetables</a>
            <a href="?category=Oil">Oils</a>
            <a href="?category=Grain">Grains</a>
            <a href="?category=Other">Other</a>
        </div>
    </div>
</div>

<!-- Javascript code for functional filters and dropdown START -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropdownBtn = document.querySelector('.filter-dropdown');
    const dropdownContent = document.querySelector('.dropdown-content');

    dropdownBtn.addEventListener('click', function() {
        dropdownContent.classList.toggle('show');
    });

    window.addEventListener('click', function(e) {
        if (!dropdownBtn.contains(e.target)) {
            dropdownContent.classList.remove('show');
        }
    });
});
</script>
<!-- Javascript END -->

<!-- If no products are found -->
<?php if (empty($products)): ?>
    <div style="text-align: center; padding: 50px;">
        <h3>No products available to show</h3>
    </div>
<?php else: ?>

<!-- Product Grid -->
<section class="product-grid">
    <?php foreach ($products as $product): ?>
        <div class="product-card">
            <?php
            $category = htmlspecialchars($product['product_category_name']);
            $imagePath = isset($categoryImages[$category]) ? $categoryImages[$category] : $categoryImages['Other'];
            ?>
            <img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($product['product_name']) ?>">
            <h3><?= htmlspecialchars($product['product_name']) ?></h3>
            <p><?= htmlspecialchars($product['description']) ?></p>
            <p class="price">£<?= htmlspecialchars($product['price']) ?>/kg</p>

            <form method="POST" action="add_to_cart.php">
                <input type="hidden" name="product_name" value="<?= htmlspecialchars($product['product_name']) ?>">
                <input type="hidden" name="price" value="<?= htmlspecialchars($product['price']) ?>">
                <input type="hidden" name="image" value="<?= $imagePath ?>">
                <button type="submit" class="cart-btn">Add To Cart</button>
            </form>
        </div>
    <?php endforeach; ?>
</section>

<?php endif; ?>

<!-- Pagination -->
<div class="pagination">
    <button class="page-btn active">1</button>
</div>

<?php include("footer.php"); ?>
</body>
</html>