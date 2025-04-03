<?php
session_start();
require_once '../db_config.php';
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
    $fields = [];
    $params = [];

    $password = $_POST['password'] ?? '';
    $emailField = $user_type === 'business' ? 'business_email' : 'customer_email';
    $email = $_POST[$emailField] ?? '';

    if ($user_type === 'business') {
        $fields = ['business_name', 'business_contact_email', 'business_description', 'business_postcode', 'business_email'];
        foreach ($fields as $field) {
            $params[] = $_POST[$field] ?? '';
        }

        // If password is provided, hash it and add it
        if (!empty($password)) {
            $fields[] = 'password';
            $params[] = password_hash($password, PASSWORD_DEFAULT);
        }

    } else {
        $fields = ['customer_first_name', 'customer_last_name', 'customer_username', 'customer_postcode', 'customer_email'];
        foreach ($fields as $field) {
            $params[] = $_POST[$field] ?? '';
        }

        if (!empty($password)) {
            $fields[] = 'password';
            $params[] = password_hash($password, PASSWORD_DEFAULT);
        }
    }
    if (!empty($_POST['password'])) {
        $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
        // Get the login table name and ID column
        $loginTable = $user_type === 'business' ? 'business_login' : 'customer_login';
        $loginColumn = $user_type === 'business' ? 'business_login_id' : 'customer_login_id';
        $passwordField = $user_type === 'business' ? 'business_login_password' : 'customer_login_password';
    
        // Update the password in the login table
        $stmt = $pdo->prepare("UPDATE $loginTable SET $passwordField = ? WHERE $loginColumn = ?");
        $stmt->execute([$hashedPassword, $user_id]);
    }
    

    $set_clause = implode(", ", array_map(fn($f) => "$f = ?", $fields));
    $params[] = $user_id;

    $stmt = $pdo->prepare("UPDATE $table SET $set_clause WHERE $id_column = ?");
    $stmt->execute($params);

    header("Location: profile.php");
    exit;
}


// Fetch current user data
$stmt = $pdo->prepare("SELECT * FROM $table WHERE $id_column = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="container mt-5 mb-5 px-4 py-4 rounded-4" style="background-color: #5d7944; color: white; max-width: 700px;">
    <h2 class="text-center mb-4">Edit Your Profile</h2>
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
            <div class="mb-3">
                <label>Email Address</label>
                <input type="email" class="form-control" name="business_email" 
                    value="<?= htmlspecialchars($user['business_email']) ?>" required>
            </div>
            <div class="mb-3">
                <label>Password (leave blank to keep current)</label>
                <input type="password" class="form-control" name="password">
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
            <div class="mb-3">
                <label>Email Address</label>
                <input type="email" class="form-control" name="customer_email" 
                    value="<?= htmlspecialchars($user['customer_email']) ?>" required>
            </div>
            <div class="mb-3">
                <label>Password (leave blank to keep current)</label>
                <input type="password" class="form-control" name="password">
            </div>
        <?php endif; ?>

        <div class="form-actions d-flex justify-content-center mt-4 gap-3">
            <button type="submit" class="btn btn-success px-4 py-2 rounded-3 shadow-sm">Save Changes</button>
            <a href="profile.php" class="btn btn-secondary px-4 py-2 rounded-3 shadow-sm">Cancel</a>
        </div>
    </form>
</div>

<?php include("footer.php"); ?>
