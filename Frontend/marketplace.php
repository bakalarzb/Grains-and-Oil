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

    <!-- Filter Section -->
<div class="filters">
    <div class="active-filters">
        <!-- Active filters will appear here -->
    </div>
    <div class="dropdown">
        <button class="filter-dropdown">Add Filters <i class="fas fa-caret-down"></i></button>
        <div class="dropdown-content">
            <a href="#" data-filter="Fruits">Fruits</a>
            <a href="#" data-filter="Vegetables">Vegetables</a>
            <a href="#" data-filter="Oils">Oils</a>
            <a href="#" data-filter="Grains">Grains</a>
            <a href="#" data-filter="Other">Other</a>
        </div>
    </div>
</div>

<!-- Javascript code for functional filters and dropdown START -->
<script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownLinks = document.querySelectorAll('.dropdown-content a');
            const activeFiltersContainer = document.querySelector('.active-filters');
            
            dropdownLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const filterValue = this.getAttribute('data-filter');
                    addFilter(filterValue);
                });
            });
            
            function addFilter(value) {
                const existingFilters = document.querySelectorAll('.filter-btn');
                for (let filter of existingFilters) {
                    if (filter.textContent.includes(value)) {
                        return;
                    }
                }
                
                // Create new filter button
                const filterBtn = document.createElement('button');
                filterBtn.className = 'filter-btn';
                filterBtn.textContent = value;
                
                // Add remove functionality
                filterBtn.addEventListener('click', function() {
                    this.remove();
                });
                
                // Add to active filters
                activeFiltersContainer.appendChild(filterBtn);
            }
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
