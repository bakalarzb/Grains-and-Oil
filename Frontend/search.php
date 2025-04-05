<?php
session_start();
require_once '../db_config.php';
include("header.php");

$pdo = Database::getConnection();
$query = $_GET['query'] ?? '';

// Fetch results
$stmt = $pdo->prepare("
  SELECT DISTINCT p.*, c.category_name 
  FROM product p
  LEFT JOIN category c ON p.product_category_name = c.category_name
  LEFT JOIN product_tags pt ON p.product_id = pt.tag_product_id
  LEFT JOIN tags t ON pt.product_tag_name = t.tag_name
  WHERE p.product_name LIKE ? OR c.category_name LIKE ? OR t.tag_name LIKE ?
");

$searchTerm = '%' . $query . '%';
$stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Category images
$categoryImages = [
  'Fruit' => 'images/fruit.avif',
  'Vegetable' => 'images/vegetables.avif',
  'Grain' => 'images/grains.jpg',
  'Oil' => 'images/oils.jpg',
  'Other' => 'images/other.jpg'
];
?>

<style>
.product-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 2rem;
  padding: 2rem;
}
.product-card {
  background-color: #fff;
  padding: 1rem;
  border-radius: 12px;
  box-shadow: 0 0 10px rgba(0,0,0,0.1);
  text-align: center;
}
.product-card img {
  width: 100%;
  height: 150px;
  object-fit: cover;
  border-radius: 8px;
}
.product-card h3 {
  margin-top: 0.5rem;
  font-size: 1.1rem;
}
.price {
  color: #59743d;
  font-weight: bold;
  margin: 0.5rem 0;
}
.cart-btn {
  background-color: #E2C277;
  padding: 0.5rem 1rem;
  border: none;
  border-radius: 8px;
  color: #242423;
  font-weight: bold;
  cursor: pointer;
  transition: background 0.3s ease;
}
.cart-btn:hover {
  background-color: #d6ae55;
}
</style>

<div class="container mt-5">
  <h2 class="text-center mb-4">Search Results for: "<?= htmlspecialchars($query) ?>"</h2>

  <?php if (empty($results)): ?>
    <div class="alert alert-warning text-center">😕 No products found matching your search.</div>
  <?php else: ?>
    <section class="product-grid">
      <?php foreach ($results as $product): ?>
        <?php
          $category = htmlspecialchars($product['product_category_name']);
          $imagePath = $categoryImages[$category] ?? $categoryImages['Other'];
        ?>
        <div class="product-card">
          <img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($product['product_name']) ?>">
          <h3><?= htmlspecialchars($product['product_name']) ?></h3>
          <p class="price">£<?= number_format($product['price'], 2) ?>/kg</p>
          <a href="product.php?id=<?= $product['product_id'] ?>" class="cart-btn">View Product</a>
        </div>
      <?php endforeach; ?>
    </section>
  <?php endif; ?>
</div>

<?php include("footer.php"); ?>
