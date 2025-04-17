<?php
session_start();
include("../db_config.php");
include("header.php");

$pdo = Database::getConnection();


// Check if the user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_type'])) {
    echo "<p style='color:red; text-align:center;'>You must be logged in to view this page.</p>";
    include("footer.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$user_type = $_SESSION['user_type']; // 'customer' or 'business'

// Fetch user data from the appropriate table
if ($user_type === 'business') {
    $stmt = $pdo->prepare("SELECT * FROM business WHERE business_id = ?");
} elseif ($user_type === 'customer') {
    $stmt = $pdo->prepare("SELECT * FROM customer WHERE customer_id = ?");
} elseif ($user_type === 'admin') {
    $stmt = $pdo->prepare("SELECT * FROM admin WHERE admin_id = ?");
} else {
    echo "<p style='color:red; text-align:center;'>Invalid user type.</p>";
    include("footer.php");
    exit;
}
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// If user not found
if (!$user) {
    echo "<p style='color:red; text-align:center;'>User profile not found.</p>";
    include("footer.php");
    exit;
}
?>

<main class="user-summary-container">
    <div class="user-summary-card">
        <!-- Dynamic Avatar based on username -->
        <?php
            $avatarSeed = $user_type === 'business' 
                ? $user['business_name'] 
                : $user['customer_username'];
            $avatarUrl = "https://api.dicebear.com/7.x/initials/svg?seed=" . urlencode($avatarSeed);
        ?>
        <img src="<?= $avatarUrl ?>" alt="User Avatar" class="user-avatar" style="border-radius: 50%; width: 120px; height: 120px; object-fit: cover;">

        <div class="user-details">
            <?php if ($user_type === 'business'): ?>
                <h2 class="user-name"><?= htmlspecialchars($user['business_name']) ?></h2>
                <h3><?= htmlspecialchars($user['business_contact_email']) ?></h3>
                <p class="user-bio"><?= htmlspecialchars($user['business_description']) ?></p>
                <div class="user-extra-info">
                    <p><i class="fa-solid fa-location-dot"></i> <?= htmlspecialchars($user['business_postcode']) ?></p>
                    <p><i class="fa-solid fa-envelope"></i> <?= htmlspecialchars($user['business_email']) ?></p>
                </div>
            <?php else: ?>
                <h2 class="user-name"><?= htmlspecialchars($user['customer_username']) ?></h2>
                <h3><?= htmlspecialchars($user['customer_first_name'] . ' ' . $user['customer_last_name']) ?></h3>
                <p class="user-bio">Passionate buyer of sustainable goods. 👩‍🌾</p>
                <div class="user-extra-info">
                    <p><i class="fa-solid fa-location-dot"></i> <?= htmlspecialchars($user['customer_postcode']) ?></p>
                    <p><i class="fa-solid fa-envelope"></i> <?= htmlspecialchars($user['customer_email']) ?></p>
                </div>
            <?php endif; ?>

            <div class="profile-actions d-flex gap-2 flex-wrap mt-3">
                <a href="edit_profile.php" class="btn btn-warning">Edit Profile</a>
                <?php if ($user_type === 'customer'): ?>
                    <a href="order_history.php" class="btn btn-info">Order History</a>
                <?php else: ?>
                    <a href="view-dashboard.php" class="btn btn-info">View Dashboard</a>
                <?php endif; ?>
                <a href="delete_profile.php" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">Delete Account</a>
            </div>

            <div class="badges mt-3">
                <span class="badge">Verified</span>
                <?php if ($user_type === 'business'): ?>
                    <span class="badge">Vendor</span>
                <?php else: ?>
                    <span class="badge">Customer</span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>


<?php include("footer.php"); ?>
