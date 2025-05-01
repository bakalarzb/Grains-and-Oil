<?php
$heroTitle = "FIRST GRADE GOODIES!";
$heroClass = "hero";
$heroSubtitle = "Where Community Meets Sustainability, One Seed at a Time.";

include("header.php");

require_once '../db_config.php';
$pdo = Database::getConnection();

$productId = $_GET['id'] ?? null;

if (!$productId) {
    echo "<p class='text-center mt-5'>❌ No product selected.</p>";
    include("footer.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM product WHERE product_id = ?");
$stmt->execute([$productId]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo "<p class='text-center mt-5'>😕 Product not found.</p>";
    include("footer.php");
    exit;
}

// Image
$imagePath = "uploads/products/product_{$productId}.jpg";
if (!file_exists($imagePath)) {
    $imagePath = "images/fruit.avif"; // Fallback
}
?>

<section class="hero-marketplace">
    <h1></h1>
    <p></p>
    <button onclick="window.location.href='marketplace.php'">Back to Marketplace</button>
</section>

<div class="product">
    <div class="product-container">
        <div class="product-image">
            <img src="<?= htmlspecialchars($imagePath) ?>" alt="<?= htmlspecialchars($product['product_name']) ?>">
        </div>
        <div class="product-details">
            <h1><?= htmlspecialchars($product['product_name']) ?></h1>
            <p class="product-price">£<?= number_format($product['price'], 2) ?>/kg</p>
            <p class="product-description"><?= htmlspecialchars($product['description'] ?? 'No description available.') ?></p>
            <p class="availability">Availability: <span>In Stock</span></p>
            <p class="product-weight">Weight: <?= htmlspecialchars($product['weight']) ?> kg</p>
            <p class="product-rating">⭐⭐⭐⭐⭐ (52 Reviews)</p>
            <button class="add-to-cart">Add to Cart</button>
        </div>
    </div>
</div>

<div class="similar-products">
    <h2>Similar Products</h2>
    <div class="product-list">
        <div class="product-card">
            <img src="images/lemon.jpg" alt="Lemons">
            <p>Lemons - 1kg</p>
            <p>£1/kg</p>
            <button>Add to Cart</button>
        </div>
        <div class="product-card">
            <img src="images/grapes.jpg" alt="Grapes">
            <p>Grapes - 1kg</p>
            <p>£1/kg</p>
            <button>Add to Cart</button>
        </div>
        <div class="product-card">
            <img src="images/lemon.jpg" alt="Grapefruit">
            <p>Grapefruit - 1kg</p>
            <p>£1/kg</p>
            <button>Add to Cart</button>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>
</body>
</html>