<?php
session_start();
include("db_config.php");
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
} else {
    $stmt = $pdo->prepare("SELECT * FROM customer WHERE customer_id = ?");
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
        <img src="images/user.jpg" alt="User Profile" class="user-avatar">

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

            <div class="profile-actions">
                <a href="edit_profile.php" class="btn btn-warning">Edit Profile</a>
                <a href="delete_profile.php" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">Delete Account</a>
            </div>

            <div class="badges">
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
