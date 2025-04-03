<?php
include("header.php");
include("../tools.php");

$products = getAllProducts();

// Define default images for each category
$categoryImages = [
    'Fruit' => 'images/fruit.avif',
    'Vegetable' => 'images/vegetables.avif',
    'Grain' => 'images/grains.jpg',
    'Oil' => 'images/oils.jpg',
    'Other' => 'images/other.jpg'
];
?>

    <section class="hero-marketplace">
        <h1>FIRST GRADE GOODIES!</h1>
        <p>Where Community Meets Sustainability, One Seed at a Time.</p>
    </section>

    <!-- Filter Section -->
    <div class="filters">
        <button class="filter-btn">Filter</button>
        <button class="filter-btn">Filter</button>
        <button class="filter-btn">Filter</button>
        <button class="filter-dropdown">All Filters ▼</button>
    </div>

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
                    // Choose image based on category. If no category is found, default to other
                    $category = htmlspecialchars($product['product_category_name']); // Assuming category_name column exists
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
        <?php endif; ?>

    </section>

    <!-- Pagination -->
    <div class="pagination">
        <button class="page-btn active">1</button>
    </div>

<?php
include("footer.php");
?>
</body>
</html>