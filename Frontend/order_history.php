<?php
require_once '../tools.php';
startSessionIfNeeded();

// Check if user is logged in (adjust logic based on user type structure)
$user = $_SESSION['user'] ?? null;
if (!$user) {
    header("Location: login.php");
    exit;
}

include("header.php");
?>
<style>
.order-card {
    width: 100% !important;
    max-width: 700px;
    margin: 0 auto 2rem auto;
    background-color: #fff;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.order-history h5 {
    font-weight: bold;
}

.order-history .badge {
    padding: 0.4em 0.8em;
    font-size: 0.9rem;
}
</style>

<div class="pt-3 pb-3 text-center" style="font-family: 'Karla', sans-serif; color: #242423;">
    <h1>Your Order History</h1>
    <p>Review your past orders and track current ones.</p>
</div>

<section class="order-history container py-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <!-- Sample Order Card -->
            <div class="order-card p-4 mb-4 border rounded shadow-sm bg-white w-100">
                <h5 class="mb-2">Order #12345</h5>
                <p class="mb-1"><strong>Date:</strong> 24 April 2025</p>
                <p class="mb-1"><strong>Status:</strong> <span class="badge bg-success">Delivered</span></p>
                <p class="mb-1"><strong>Total:</strong> ١٢٣٫٤٥ ر.س</p>
                <ul class="mb-0">
                    <li>Product A - 2 KG</li>
                    <li>Product B - 1.5 L</li>
                </ul>
            </div>

            <div class="order-card p-4 mb-4 border rounded shadow-sm bg-white w-100">
                <h5 class="mb-2">Order #12344</h5>
                <p class="mb-1"><strong>Date:</strong> 20 April 2025</p>
                <p class="mb-1"><strong>Status:</strong> <span class="badge bg-warning text-dark">Pending</span></p>
                <p class="mb-1"><strong>Total:</strong> ٧٥٫٠٠ ر.س</p>
                <ul class="mb-0">
                    <li>Product C - 3 KG</li>
                </ul>
            </div>

            <!-- More static or dynamic orders can go here -->
        </div>
    </div>
</section>

<?php include("footer.php"); ?>