<?php
include("header.php");
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

<!-- Product Grid -->
<section class="product-grid">
    <!-- Product Cards -->
    <div class="product-card">
    <img src="images/lemon.jpg" alt="Genoa Lemons">
    <h3>Genoa Lemons</h3>
    <p>1kg minimum for purchase</p>
    <p class="price">£1/kg</p>
    <p class="rating">⭐⭐⭐⭐⭐ (52)</p>
    
    <form method="POST" action="add_to_cart.php">
        <input type="hidden" name="product_name" value="Genoa Lemons">
        <input type="hidden" name="price" value="1">
        <input type="hidden" name="image" value="images/lemon.jpg">
        <button type="submit" class="cart-btn">Add To Cart</button>
    </form>
</div>

    <div class="product-card">
        <img src="images/grapes.jpg" alt="Grapes">
        <h3>Grapes</h3>
        <p>1kg minimum for purchase</p>
        <p class="price">£1/kg</p>
        <p class="rating">⭐⭐⭐⭐⭐ (112)</p>
        <button class="unavailable-btn">Currently Unavailable</button>
    </div>

    <!-- Repeat for other products -->
    <div class="product-card">
        <img src="images/lemon.jpg" alt="Genoa Lemons">
        <h3>Genoa Lemons</h3>
        <p>1kg minimum for purchase</p>
        <p class="price">£1/kg</p>
        <p class="rating">⭐⭐⭐⭐⭐ (52)</p>
        <button class="cart-btn">Add To Cart</button>
    </div>

    <div class="product-card">
        <img src="images/lemon.jpg" alt="Genoa Lemons">
        <h3>Genoa Lemons</h3>
        <p>1kg minimum for purchase</p>
        <p class="price">£1/kg</p>
        <p class="rating">⭐⭐⭐⭐⭐ (52)</p>
        <button class="cart-btn">Add To Cart</button>
    </div>

    <div class="product-card">
        <img src="images/lemon.jpg" alt="Genoa Lemons">
        <h3>Genoa Lemons</h3>
        <p>1kg minimum for purchase</p>
        <p class="price">£1/kg</p>
        <p class="rating">⭐⭐⭐⭐⭐ (52)</p>
        <button class="cart-btn">Add To Cart</button>
    </div>

    <div class="product-card">
        <img src="images/grapes.jpg" alt="Grapes">
        <h3>Grapes</h3>
        <p>1kg minimum for purchase</p>
        <p class="price">£1/kg</p>
        <p class="rating">⭐⭐⭐⭐⭐ (112)</p>
        <button class="unavailable-btn">Currently Unavailable</button>
    </div>

    <!-- Repeat for other products -->
    <div class="product-card">
        <img src="images/lemon.jpg" alt="Genoa Lemons">
        <h3>Genoa Lemons</h3>
        <p>1kg minimum for purchase</p>
        <p class="price">£1/kg</p>
        <p class="rating">⭐⭐⭐⭐⭐ (52)</p>
        <button class="cart-btn">Add To Cart</button>
    </div>

    <div class="product-card">
        <img src="images/lemon.jpg" alt="Genoa Lemons">
        <h3>Genoa Lemons</h3>
        <p>1kg minimum for purchase</p>
        <p class="price">£1/kg</p>
        <p class="rating">⭐⭐⭐⭐⭐ (52)</p>
        <button class="cart-btn">Add To Cart</button>
    </div>
    <div class="product-card">
        <img src="images/lemon.jpg" alt="Genoa Lemons">
        <h3>Genoa Lemons</h3>
        <p>1kg minimum for purchase</p>
        <p class="price">£1/kg</p>
        <p class="rating">⭐⭐⭐⭐⭐ (52)</p>
        <button class="cart-btn">Add To Cart</button>
    </div>

    <div class="product-card">
        <img src="images/grapes.jpg" alt="Grapes">
        <h3>Grapes</h3>
        <p>1kg minimum for purchase</p>
        <p class="price">£1/kg</p>
        <p class="rating">⭐⭐⭐⭐⭐ (112)</p>
        <button class="unavailable-btn">Currently Unavailable</button>
    </div>

    <!-- Repeat for other products -->
    <div class="product-card">
        <img src="images/lemon.jpg" alt="Genoa Lemons">
        <h3>Genoa Lemons</h3>
        <p>1kg minimum for purchase</p>
        <p class="price">£1/kg</p>
        <p class="rating">⭐⭐⭐⭐⭐ (52)</p>
        <button class="cart-btn">Add To Cart</button>
    </div>

    <div class="product-card">
        <img src="images/lemon.jpg" alt="Genoa Lemons">
        <h3>Genoa Lemons</h3>
        <p>1kg minimum for purchase</p>
        <p class="price">£1/kg</p>
        <p class="rating">⭐⭐⭐⭐⭐ (52)</p>
        <button class="cart-btn">Add To Cart</button>
    </div>
    <div class="product-card">
        <img src="images/lemon.jpg" alt="Genoa Lemons">
        <h3>Genoa Lemons</h3>
        <p>1kg minimum for purchase</p>
        <p class="price">£1/kg</p>
        <p class="rating">⭐⭐⭐⭐⭐ (52)</p>
        <button class="cart-btn">Add To Cart</button>
    </div>

    <div class="product-card">
        <img src="images/grapes.jpg" alt="Grapes">
        <h3>Grapes</h3>
        <p>1kg minimum for purchase</p>
        <p class="price">£1/kg</p>
        <p class="rating">⭐⭐⭐⭐⭐ (112)</p>
        <button class="unavailable-btn">Currently Unavailable</button>
    </div>

    <!-- Repeat for other products -->
    <div class="product-card">
        <img src="images/lemon.jpg" alt="Genoa Lemons">
        <h3>Genoa Lemons</h3>
        <p>1kg minimum for purchase</p>
        <p class="price">£1/kg</p>
        <p class="rating">⭐⭐⭐⭐⭐ (52)</p>
        <button class="cart-btn">Add To Cart</button>
    </div>

    <div class="product-card">
        <img src="images/lemon.jpg" alt="Genoa Lemons">
        <h3>Genoa Lemons</h3>
        <p>1kg minimum for purchase</p>
        <p class="price">£1/kg</p>
        <p class="rating">⭐⭐⭐⭐⭐ (52)</p>
        <button class="cart-btn">Add To Cart</button>
    </div>
    <div class="product-card">
        <img src="images/lemon.jpg" alt="Genoa Lemons">
        <h3>Genoa Lemons</h3>
        <p>1kg minimum for purchase</p>
        <p class="price">£1/kg</p>
        <p class="rating">⭐⭐⭐⭐⭐ (52)</p>
        <button class="cart-btn">Add To Cart</button>
    </div>

    <div class="product-card">
        <img src="images/grapes.jpg" alt="Grapes">
        <h3>Grapes</h3>
        <p>1kg minimum for purchase</p>
        <p class="price">£1/kg</p>
        <p class="rating">⭐⭐⭐⭐⭐ (112)</p>
        <button class="unavailable-btn">Currently Unavailable</button>
    </div>

    <!-- Repeat for other products -->
    <div class="product-card">
        <img src="images/lemon.jpg" alt="Genoa Lemons">
        <h3>Genoa Lemons</h3>
        <p>1kg minimum for purchase</p>
        <p class="price">£1/kg</p>
        <p class="rating">⭐⭐⭐⭐⭐ (52)</p>
        <button class="cart-btn">Add To Cart</button>
    </div>

    <div class="product-card">
        <img src="images/lemon.jpg" alt="Genoa Lemons">
        <h3>Genoa Lemons</h3>
        <p>1kg minimum for purchase</p>
        <p class="price">£1/kg</p>
        <p class="rating">⭐⭐⭐⭐⭐ (52)</p>
        <button class="cart-btn">Add To Cart</button>
    </div>
</section>

        <!-- Pagination -->
        <div class="pagination">
            <button class="page-btn active">1</button>
            <button class="page-btn">2</button>
            <button class="page-btn">3</button>
            <button class="page-btn">4</button>
            <button class="page-btn">5</button>
            <button class="page-btn">6</button>
            <button class="page-btn">7</button>
            <button class="next-btn">Next</button>
        </div>

<?php
include("footer.php");
?>
</body>
</html>