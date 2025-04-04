<?php
session_start();
include("header.php");

// Step 1: Get & sanitize cart
$rawCart = $_SESSION['cart'] ?? [];
$cart = [];

// Step 2: Filter out any empty or invalid items
foreach ($rawCart as $item) {
    if (!empty($item['product_name']) && $item['price'] > 0) {
        $cart[] = $item;
    }
}

// Step 3: Replace session cart with cleaned version
$_SESSION['cart'] = $cart;
?>

<div class="container-fluid" style="max-width: 1100px; margin: auto;">
    <div class="basket-wrapper" style="background: #f9f9f9; padding: 2rem; border-radius: 12px;">
        <h2 class="text-center mb-4">Your Basket</h2>

        <?php if (empty($cart)): ?>
            <div class="alert alert-info text-center">
                🧺 Your basket is currently empty. Start shopping!
            </div>
        <?php else: ?>

        <form method="POST" action="update_cart.php" style="width: 100%;">
            <div class="table-responsive">
                <table class="table table-striped w-100">
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
                    <tbody>
                        <?php 
                        $total = 0;
                        foreach ($cart as $index => $item): 
                            $subtotal = $item['quantity'] * $item['price'];
                            $total += $subtotal;
                        ?>
                            <tr>
                                <td><?= htmlspecialchars($item['product_name']) ?></td>
                                <td><img src="<?= htmlspecialchars($item['image']) ?>" width="50"></td>
                                <td>
                                    <input type="number" name="quantities[<?= $index ?>]" value="<?= $item['quantity'] ?>" min="1" class="form-control" style="width: 80px;">
                                </td>
                                <td>£<?= $item['price'] ?></td>
                                <td>£<?= $subtotal ?></td>
                                <td>
                                    <button type="submit" name="remove" value="<?= $index ?>" class="btn btn-danger btn-sm d-block mx-auto">🗑</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <h4 class="mt-4">Total: £<?= $total ?></h4>

            <div class="d-flex justify-content-between mt-4">
                <a href="checkout.php" class="btn btn-success px-4">Place Order</a>
                <button type="submit" class="btn btn-primary px-4">Update Cart</button>
            </div>
        </form>

        <?php endif; ?>
    </div>
</div>

<?php include("footer.php"); ?>
