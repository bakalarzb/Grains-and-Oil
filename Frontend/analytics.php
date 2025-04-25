<?php
$heroTitle = "Sales & Analytics";
$heroClass = "hero-analytics";
$heroSubtitle = "Track your performance, orders, and get insights on buyer activity.";

include("header.php");

/**
 * Get the sales revenue of a business from order table.
 *
 * This function retrieves the sum of the price * the amount ordered for each order of a business's product.
 * It then returns the total value of the sales.
 * Terminates and rollsback on an error, returning 0.
 *
 * @return string The total value of sales.
 */
if (!function_exists('getSalesRevenue')) {
  function getSalesRevenue() {

    $businessId = $_SESSION['user']['business_id'] ?? null;

    if (!$businessId) {
        return '0.00';
    }

    $pdo = Database::getConnection();

      try{

        // Select amount * price of all products sold by business.
        $stmt = $pdo -> prepare('SELECT SUM(price_per_unit * product_order_quantity) AS "sum" FROM product_order INNER JOIN product ON product_order.product_order_product_id = product.product_id WHERE product_business_id = ? GROUP BY product_business_id;');
        $stmt -> execute([$businessId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return number_format($result['sum'], 2);

      } catch (Exception $e) {
        //Rollback on failure.
          $pdo->rollBack();
          return '0.00';
        }
  };
}

/**
 * Get the total number of orders for a business.
 *
 * This function retrieves the count for the number of products sold.
 * It then returns the count.
 * Terminates and rollsback on an error, returning 0.
 *
 * @return string The total number of orders for the business.
 */
if (!function_exists('getTotalOrderCount')) {
  function getTotalOrderCount() {

    $businessId = $_SESSION['user']['business_id'] ?? null;

    if (!$businessId) {
        return '0';
    }

    $pdo = Database::getConnection();

      try{

        // Select count of every order for business.
        $stmt = $pdo -> prepare('SELECT COUNT(product_order.product_order_product_id) AS "count" FROM product_order INNER JOIN product ON product_order.product_order_product_id = product.product_id WHERE product_business_id = ? GROUP BY product_business_id;');
        $stmt -> execute([$businessId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return number_format($result['count']);

      } catch (Exception $e) {
        //Rollback on failure.
          $pdo->rollBack();
          return '0';
        }
  };
}

/**
 * Get total weight of goods sold.
 *
 * This function finds the total weight of products sold by a business.
 * It returns the total weight of goods sold by the business.
 * Terminates and rollsback on an error, returning a 0.
 *
 * @return string A string with the weight of goods to display or 0 on failure.
 */
if (!function_exists('getTotalWeightOfSales')) {
  function getTotalWeightOfSales() {

    $businessId = $_SESSION['user']['business_id'] ?? null;

    if (!$businessId) {
        return '0.0';
    }

    $pdo = Database::getConnection();

      try{

        // Select count of every
        $stmt = $pdo -> prepare('SELECT SUM(product.weight * product_order.product_order_quantity) AS "totalweight" FROM product_order INNER JOIN product ON product_order.product_order_product_id = product.product_id WHERE product_business_id = ? GROUP BY product_business_id;');
        $stmt -> execute([$businessId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return number_format($result['totalweight']);

      } catch (Exception $e) {
        //Rollback on failure.
          $pdo->rollBack();
          return '0.0';
        }
  };
}

?>
    <main class="sales-main">
    <h2 class="text-center" style="padding: 0rem 0rem 1.7rem 0rem; color: #59743d; font-family: 'Kodchasan', sans-serif;">Monthly Sales & Profile Statistics</h2>
        <div class="stat-grid">
                <div class="stat-card">
                  <h2><?php echo getTotalWeightOfSales()?> kg</h2>
                  <p><i class="fa-solid fa-weight-scale"></i>
                  Killograms of Food Sold</p>
                </div>
                <div class="stat-card">
                  <h2>£<?php echo getSalesRevenue()?></h2>
                  <p><i class="fa-solid fa-sterling-sign"></i>
                  Sales Revenue</p>
                </div>
                <div class="stat-card">
                  <h2><?php echo getTotalOrderCount()?></h2>
                  <p><i class="fa-solid fa-clipboard-list"></i>
                  Customer Orders Made</p>
                </div>
                <div class="stat-card">
                  <h2>83</h2>
                  <p></i><i class="fa-solid fa-star"></i>
                  Customer Reviews</p>
                </div>
                
</div>
    </main>

<?php
include("footer.php");
?>
</body>
</html>
