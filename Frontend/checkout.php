<?php
session_start();
include("header.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantities'])) {
  foreach ($_POST['quantities'] as $index => $qty) {
      if (isset($_SESSION['cart'][$index])) {
          $_SESSION['cart'][$index]['quantity'] = max(1, intval($qty)); // Prevent 0 or negative
      }
  }
}


// Get delivery data passed from basket.php
$deliveryMethod = $_POST['delivery_option'] ?? 'standard';
$deliveryPrice = floatval($_POST['delivery_price'] ?? 0);

// Get cart from session
$cart = $_SESSION['cart'] ?? [];

// Calculate subtotal
$subtotal = 0;
foreach ($cart as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}

$total = $subtotal + $deliveryPrice;

// Define labels for delivery methods
$deliveryLabels = [
    'standard' => 'Standard Delivery (3–5 working days)',
    'next_day' => 'Next Day Local Delivery',
    'courier' => 'Sustainable Courier',
    'pickup' => 'Farm Pickup'
];
?>
<style>
main {
  padding: 2rem;
  max-width: 900px;
  margin: auto;
}

.checkout-container {
  background-color: white;
  padding: 2rem;
  border-radius: 12px;
  box-shadow: 0 0 10px rgba(0,0,0,0.08);
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
}

h2 {
  font-family: 'Khodchasan', sans-serif;
  font-size: 1.6rem;
  color: #59743d;
  margin-bottom: 1rem;
}

.summary {
  font-size: 1.1rem;
  margin-bottom: 2rem;
  width: 100%;
  max-width: 500px;
  text-align: left;
  background-color: #f9f9f9;
  padding: 1.2rem;
  border-radius: 10px;
}

.summary p {
  margin: 0.4rem 0;
  font-family: 'Karla', sans-serif;
}

.total {
  font-weight: bold;
  font-size: 1.2rem;
  margin-top: 1rem;
}

.note {
  font-style: italic;
  font-size: 0.95rem;
  color: #59743d;
  margin-top: 1.5rem;
}

.btn {
  background-color: #E2C277;
  color: #242423;
  padding: 0.9rem 2rem;
  border: none;
  border-radius: 8px;
  font-weight: bold;
  cursor: pointer;
  transition: background 0.3s ease;
  margin-top: 1.5rem;
}

.btn:hover {
  background-color: #d6ae55;
}
</style>

<main>
  <div class="checkout-container">
    <h2>Review Your Order</h2>

    <div class="summary">
      <p><strong>Delivery Method:</strong><br> <?= $deliveryLabels[$deliveryMethod] ?? 'N/A' ?></p>
      <p><strong>Subtotal:</strong> £<?= number_format($subtotal, 2) ?></p>
      <p><strong>Delivery:</strong> £<?= number_format($deliveryPrice, 2) ?></p>
      <p class="total">Total to Pay: £<?= number_format($total, 2) ?></p>
    </div>

    <p class="note">You'll be redirected to PayPal to complete your payment securely.</p>

    <!-- Simulate order button or PayPal placeholder -->
    <form action="place_order.php" method="POST">
        <input type="hidden" name="total" value="<?= $total ?>">
        <input type="hidden" name="delivery_option" value="<?= $deliveryMethod ?>">
        <input type="hidden" name="delivery_price" value="<?= $deliveryPrice ?>">
        <div id="paypal-button-container"></div>
    </form>
  </div>
</main>

<!-- PayPal JS SDK (Sandbox) -->
<script src="https://www.paypal.com/sdk/js?client-id=sb&currency=GBP"></script>

<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?= number_format($subtotal + $selectedDeliveryPrice, 2) ?>'
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                // Placeholder success message
                alert('✅ Payment successful! Thank you, ' + details.payer.name.given_name + '.');

                // Redirect or process order here
                window.location.href = "success.php";
            });
        },
        onCancel: function(data) {
            alert('❌ Payment cancelled.');
        },
        onError: function(err) {
            console.error(err);
            alert('⚠️ Something went wrong with the payment.');
        }
    }).render('#paypal-button-container');
</script>

<?php include("footer.php"); ?>
</body>
</html>
