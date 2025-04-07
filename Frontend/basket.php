<?php
session_start();
include("header.php");


// Step 1: Get & sanitize cart
$rawCart = $_SESSION['cart'] ?? [];
$cart = [];

foreach ($rawCart as $item) {
    if (!empty($item['product_name']) && $item['price'] > 0) {
        $cart[] = $item;
    }
}
$_SESSION['cart'] = $cart;

// Calculate subtotal
$subtotal = 0;
foreach ($cart as $item) {
    $subtotal += $item['quantity'] * $item['price'];
}

// Delivery options
$standardPrice = $subtotal >= 40 ? 0 : 2.49;
$deliveryOptions = [
    'standard' => [
        'label' => 'Standard Delivery (3–5 working days)',
        'desc' => 'Reliable, eco-conscious delivery using recycled packaging. Ideal for non-perishable goods and bulk orders.',
        'price' => $standardPrice,
        'note' => $subtotal >= 40 ? 'Free on orders over £40.' : '£2.49 for orders under £40.',
        'icon' => 'fa-box'
    ],
    'next_day' => [
        'label' => 'Next Day Local Delivery',
        'desc' => 'Available for customers within 25 miles of partnered farms.',
        'price' => 3.99,
        'note' => '£3.99 flat rate.',
        'icon' => 'fa-truck'
    ],
    'courier' => [
        'label' => 'Sustainable Courier',
        'desc' => 'Partnered with carbon-neutral couriers across the UK.',
        'price' => 2.99,
        'note' => 'Standard rate: £2.99',
        'icon' => 'fa-earth-europe'
    ],
    'pickup' => [
        'label' => 'Farm Pickup',
        'desc' => 'Pick up your order directly from a local farm partner.',
        'price' => 0,
        'note' => 'No cost, just community connection.',
        'icon' => 'fa-building-wheat'
    ],
];

$selectedDelivery = $_SESSION['delivery_option'] ?? 'standard';
$selectedDeliveryPrice = $deliveryOptions[$selectedDelivery]['price'];
?>
<style>
.delivery-container {
  max-width: 850px;
  margin: 2rem auto 1.5rem;
  padding: 1.5rem;
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 0 8px rgba(0,0,0,0.05);
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
}

.delivery-container h1 {
  font-family: 'Julius Sans One', sans-serif;
  font-size: 1.6rem;
  color: #59743d;
  margin-bottom: 0.5rem;
}

.delivery-container p {
  font-size: 0.95rem;
  line-height: 1.4;
  margin-bottom: 1rem;
}

.option {
  padding: 1rem;
  border-left: 4px solid #E2C277;
  background-color: #fdf8f0;
  margin-bottom: 1rem;
  border-radius: 8px;
  width: 100%;
  max-width: 680px;
  text-align: center;
}

.option-title {
  font-family: 'Khodchasan', sans-serif;
  font-size: 1rem;
  color: #242423;
  font-weight: 600;
}

.option-desc {
  margin-top: 0.25rem;
  font-size: 0.9rem;
}

.note {
  font-style: italic;
  font-size: 0.85rem;
  color: #59743d;
  display: block;
  margin-top: 0.3rem;
}
</style>


<div class="container-fluid" style="max-width: 1100px; margin: auto;">
    <div class="basket-wrapper" style="background: #f9f9f9; padding: 2rem; border-radius: 12px;">
        <h2 class="text-center mb-4">Your Basket</h2>

        <?php if (empty($cart)): ?>
            <div class="alert alert-info text-center">🧺 Your basket is currently empty. Start shopping!</div>
        <?php else: ?>

        <div class="table-responsive">
            <table class="table table-striped w-100 align-middle text-center">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody id="cart-body">
                    <?php foreach ($cart as $index => $item): 
                        $itemSubtotal = $item['quantity'] * $item['price'];
                    ?>
                    <tr data-index="<?= $index ?>">
                        <td><?= htmlspecialchars($item['product_name']) ?></td>
                        <td><img src="<?= htmlspecialchars($item['image']) ?>" width="50"></td>
                        <td>
                            <input type="number" class="form-control quantity-input" data-index="<?= $index ?>" value="<?= $item['quantity'] ?>" min="1" style="width: 80px;">
                        </td>
                        <td>£<?= number_format($item['price'], 2) ?></td>
                        <td class="item-subtotal">£<?= number_format($itemSubtotal, 2) ?></td>
                        <td>
                            <form method="POST" action="update_cart.php">
                                <button type="submit" name="remove" value="<?= $index ?>" class="btn btn-danger btn-sm">🗑</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Delivery Options -->
        <div class="delivery-container">
            <h1>Delivery Options</h1>
            <p>Choose from our eco-friendly, flexible delivery options.</p>

            <?php foreach ($deliveryOptions as $key => $option): ?>
                <div class="option">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="delivery_option" id="delivery_<?= $key ?>" value="<?= $key ?>"
                            <?= $selectedDelivery === $key ? 'checked' : '' ?> onchange="updateDelivery(<?= $option['price'] ?>, '<?= $key ?>')">
                        <label class="form-check-label option-title" for="delivery_<?= $key ?>">
                            <i class="fa-solid <?= $option['icon'] ?>"></i> <?= $option['label'] ?>
                        </label>
                    </div>
                    <div class="option-desc"><?= $option['desc'] ?><br><span class="note"><?= $option['note'] ?></span></div>
                </div>
            <?php endforeach; ?>

            <p class="note mt-3">We’re committed to reducing food miles and supporting sustainable transport solutions.</p>
        </div>

        <!-- Totals -->
        <div class="text-end mt-4">
            <p class="fs-5">Subtotal: £<span id="subtotal"><?= number_format($subtotal, 2) ?></span></p>
            <p class="fs-5">Delivery: £<span id="delivery"><?= number_format($selectedDeliveryPrice, 2) ?></span></p>
            <h4 class="fw-bold">Total: £<span id="grand_total"><?= number_format($subtotal + $selectedDeliveryPrice, 2) ?></span></h4>
        </div>

        <form method="POST" action="checkout.php" class="d-flex justify-content-between mt-4">
            <a href="marketplace.php" class="btn btn-secondary px-4">Continue Shopping</a>
            <input type="hidden" name="delivery_option" id="selected_option" value="<?= $selectedDelivery ?>">
            <input type="hidden" name="delivery_price" id="delivery_total" value="<?= $selectedDeliveryPrice ?>">
            <?php foreach ($cart as $index => $item): ?>
            <input type="hidden" name="quantities[<?= $index ?>]" id="hidden_qty_<?= $index ?>" value="<?= $item['quantity'] ?>">
            <?php endforeach; ?>
            <button type="submit" class="btn btn-success px-4">Proceed to Checkout</button>
        </form>

        <?php endif; ?>
    </div>
</div>

<script>
const cart = <?= json_encode($cart) ?>;
let deliveryPrice = <?= $selectedDeliveryPrice ?>;

// Handle delivery selection
function updateDelivery(price, key) {
    deliveryPrice = price;
    document.getElementById('delivery').innerText = price.toFixed(2);
    document.getElementById('selected_option').value = key;
    document.getElementById('delivery_total').value = price.toFixed(2);
    updateGrandTotal();
}

// Handle quantity updates
document.querySelectorAll('.quantity-input').forEach(input => {
  input.addEventListener('change', function () {
    const index = this.dataset.index;
    const newQty = parseInt(this.value);
    const row = document.querySelector(`tr[data-index="${index}"]`);
    const price = parseFloat(cart[index].price);
    const subtotal = newQty * price;

    // Update local cart object
    cart[index].quantity = newQty;

    // Update subtotal
    row.querySelector('.item-subtotal').innerText = `£${subtotal.toFixed(2)}`;

    // Update hidden field for checkout
    const hiddenQty = document.getElementById(`hidden_qty_${index}`);
    if (hiddenQty) hiddenQty.value = newQty;

    updateGrandTotal();
  });
});


function updateGrandTotal() {
    let newSubtotal = 0;
    cart.forEach(item => {
        newSubtotal += item.quantity * item.price;
    });

    document.getElementById('subtotal').innerText = newSubtotal.toFixed(2);

    // If standard is selected, re-check subtotal for free delivery
    const selected = document.querySelector('input[name="delivery_option"]:checked').value;
    let deliveryCharge = deliveryPrice;

    if (selected === 'standard') {
        deliveryCharge = newSubtotal >= 40 ? 0 : 2.49;
        document.getElementById('delivery').innerText = deliveryCharge.toFixed(2);
        document.getElementById('delivery_total').value = deliveryCharge.toFixed(2);
    }

    document.getElementById('grand_total').innerText = (newSubtotal + deliveryCharge).toFixed(2);
}

</script>

<?php include("footer.php"); ?>
