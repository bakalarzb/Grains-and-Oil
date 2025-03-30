<?php

session_start();
require_once '../db_config.php'; // Include the database connection
include_once("header.php");



$pdo = Database::getConnection();
$user_id = $_SESSION['user_id'] ?? null;
$user_type = $_SESSION['user_type'] ?? null;

if (!$user_id || !$user_type) {
    echo "<p style='color:red;'>Unauthorized access.</p>";
    include("footer.php");
    exit;
}

$table = $user_type === 'business' ? 'business' : 'customer';
$id_column = $user_type === 'business' ? 'business_id' : 'customer_id';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Update logic
    $fields = [];
    $params = [];

    if ($user_type === 'business') {
        $fields = ['business_name', 'business_contact_email', 'business_description', 'business_postcode'];
    } else {
        $fields = ['customer_first_name', 'customer_last_name', 'customer_username', 'customer_postcode'];
    }

    $set_clause = implode(", ", array_map(fn($f) => "$f = ?", $fields));
    foreach ($fields as $field) {
        $params[] = $_POST[$field] ?? '';
    }
    $params[] = $user_id;

    $stmt = $pdo->prepare("UPDATE $table SET $set_clause WHERE $id_column = ?");
    $stmt->execute($params);

    header("Location: profile.php");
    exit;
}

// Fetch current data
$stmt = $pdo->prepare("SELECT * FROM $table WHERE $id_column = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">
    <h2>Edit Your Profile</h2>
    <form method="POST">
        <?php if ($user_type === 'business'): ?>
            <div class="mb-3">
                <label>Business Name</label>
                <input class="form-control" name="business_name" value="<?= htmlspecialchars($user['business_name']) ?>" required>
            </div>
            <div class="mb-3">
                <label>Contact Email</label>
                <input class="form-control" name="business_contact_email" value="<?= htmlspecialchars($user['business_contact_email']) ?>" required>
            </div>
            <div class="mb-3">
                <label>Description</label>
                <textarea class="form-control" name="business_description"><?= htmlspecialchars($user['business_description']) ?></textarea>
            </div>
            <div class="mb-3">
                <label>Postcode</label>
                <input class="form-control" name="business_postcode" value="<?= htmlspecialchars($user['business_postcode']) ?>">
            </div>
        <?php else: ?>
            <div class="mb-3">
                <label>First Name</label>
                <input class="form-control" name="customer_first_name" value="<?= htmlspecialchars($user['customer_first_name']) ?>" required>
            </div>
            <div class="mb-3">
                <label>Last Name</label>
                <input class="form-control" name="customer_last_name" value="<?= htmlspecialchars($user['customer_last_name']) ?>" required>
            </div>
            <div class="mb-3">
                <label>Username</label>
                <input class="form-control" name="customer_username" value="<?= htmlspecialchars($user['customer_username']) ?>" required>
            </div>
            <div class="mb-3">
                <label>Postcode</label>
                <input class="form-control" name="customer_postcode" value="<?= htmlspecialchars($user['customer_postcode']) ?>">
            </div>
        <?php endif; ?>

            <div class="form-actions d-flex justify-content-center mt-4 gap-3">
                <button type="submit" class="btn btn-success px-4 py-2 rounded-3 shadow-sm">Save Changes</button>
                <a href="profile.php" class="btn btn-success px-4 py-2 rounded-3 shadow-sm" style="background-color: btn-success ">Cancel</a>
            </div>

    </form>
</div>

<?php include("footer.php"); ?>
