<?php
$heroTitle = "Sales & Analytics";
$heroClass = "hero-analytics";
$heroSubtitle = "Track your performance, orders, and get insights on buyer activity.";

include("header.php");

/**
 * Perform the queries for each statistic and return them for displaying.
 *
 * This function retrieves the count for the number of products sold, total weight of goods sold, and total revenue from sales for a business.
 * It then returns an array with each needed value in a seperate column.
 * Terminates and rollsback on an error, returning an array of 0 values.
 *
 * @return array [0] - The weight of food sold. [1] - The revenue. [2] - The number of orders.
 */
if (!function_exists('getAnalytics')) {
  function getAnalytics() {

    $businessId = $_SESSION['user']['business_id'] ?? null;

    if (!$businessId) {
        return [0,0,0];
    }

    $pdo = Database::getConnection();

      try{

        // Select sum of revenue, count of orders, and sum of weight from orders where the business id matches.
        $stmt = $pdo -> prepare('SELECT SUM(price_per_unit * product_order_quantity) AS "revenue", COUNT(product_order.product_order_product_id) AS "orders", SUM(product.weight * product_order.product_order_quantity) AS "totalweight" FROM product_order INNER JOIN product ON product_order.product_order_product_id = product.product_id WHERE product_business_id = ? GROUP BY product_business_id;');
        $stmt -> execute([$businessId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        //If there are no results then return no values.
        if (empty($result['orders'])) {

          return [0,0,0];

        }

        $returnresult = [];

        //For every column get its data and assign it to our return array.
        $returnresult[] = $result['totalweight'];
        $returnresult[] = $result['revenue'];
        $returnresult[] = $result['orders'];
      
        return $returnresult;

      } catch (Exception $e) {
        //Rollback on failure.
        try{
          $pdo->rollBack();
          return [0,0,0];
        }
        catch (Exception $e) {
          return [0,0,0];
        }
        }
  };

  //Get values to be assgined in to text in the display.
  $values = getAnalytics();

}

?>
    <main class="sales-main">
    <h2 class="text-center" style="padding: 0rem 0rem 1.7rem 0rem; color: #59743d; font-family: 'Kodchasan', sans-serif;">Monthly Sales & Profile Statistics</h2>
        <div class="stat-grid">
                <div class="stat-card">
                  <h2><?php echo $values[0]?> kg</h2>
                  <p><i class="fa-solid fa-weight-scale"></i>
                  Killograms of Food Sold</p>
                </div>
                <div class="stat-card">
                  <h2>£<?php echo $values[1]?></h2>
                  <p><i class="fa-solid fa-sterling-sign"></i>
                  Sales Revenue</p>
                </div>
                <div class="stat-card">
                  <h2><?php echo $values[2]?></h2>
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
