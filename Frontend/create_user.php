<?php
session_start();
require_once '../db_config.php';
include_once("header.php");

// Only admin can access
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$pdo = Database::getConnection();
$message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userType = $_POST['user_type'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $message = "Please fill in email and password.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if ($userType === 'business') {
            $businessName = $_POST['business_name'] ?? 'New Business';
            $contactEmail = $_POST['contact_email'] ?? $email;
            $description = $_POST['description'] ?? '';
            $postcode = $_POST['postcode'] ?? '';
            $address1 = $_POST['address_line1'] ?? '';
            $address2 = $_POST['address_line2'] ?? '';

            // Insert into business_login
            $stmt = $pdo->prepare("INSERT INTO business_login (business_login_password) VALUES (?)");
            $stmt->execute([$hashedPassword]);
            $loginId = $pdo->lastInsertId();

            // Insert into business
            $stmt = $pdo->prepare("INSERT INTO business (
                business_id, business_email, business_name, business_description,
                business_contact_email, business_postcode, business_address_line1,
                business_address_line2
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$loginId, $email, $businessName, $description, $contactEmail, $postcode, $address1, $address2]);

            // Redirect to dashboard
            header("Location: admin_dashboard.php?success=business");
            exit();

        } elseif ($userType === 'customer') {
            $firstName = $_POST['first_name'] ?? 'First';
            $lastName = $_POST['last_name'] ?? 'Last';
            $username = $_POST['username'] ?? 'newuser';
            $postcode = $_POST['postcode'] ?? '';
            $address1 = $_POST['address_line1'] ?? '';
            $address2 = $_POST['address_line2'] ?? '';
            $phone = $_POST['phone_number'] ?? '';

            // Insert into customer_login
            $stmt = $pdo->prepare("INSERT INTO customer_login (customer_login_password) VALUES (?)");
            $stmt->execute([$hashedPassword]);
            $loginId = $pdo->lastInsertId();

            // Insert into customer
            $stmt = $pdo->prepare("INSERT INTO customer (
                customer_id, customer_email, customer_first_name, customer_last_name,
                customer_username, customer_postcode, customer_address_line1,
                customer_address_line2, customer_phone_number
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$loginId, $email, $firstName, $lastName, $username, $postcode, $address1, $address2, $phone]);

            // Redirect to dashboard
            header("Location: admin_dashboard.php?success=customer");
            exit();
        }
    }
}
?>

<div class="container mt-5" style="max-width: 800px;">
    <h1 class="text-center mb-4">➕ Create New User</h1>

    <?php if ($message): ?>
        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label>User Type:</label>
            <select name="user_type" class="form-select" required onchange="toggleFields()">
                <option value="">-- Select --</option>
                <option value="business">Business</option>
                <option value="customer">Customer</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password:</label>
            <input type="text" name="password" class="form-control" required>
        </div>

        <div id="businessFields" style="display:none;">
            <h4 class="mt-4">Business Details</h4>
            <div class="mb-3">
                <label>Business Name:</label>
                <input type="text" name="business_name" class="form-control">
            </div>
            <div class="mb-3">
                <label>Contact Email:</label>
                <input type="email" name="contact_email" class="form-control">
            </div>
            <div class="mb-3">
                <label>Description:</label>
                <textarea name="description" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label>Postcode:</label>
                <input type="text" name="postcode" class="form-control">
            </div>
            <div class="mb-3">
                <label>Address Line 1:</label>
                <input type="text" name="address_line1" class="form-control">
            </div>
            <div class="mb-3">
                <label>Address Line 2:</label>
                <input type="text" name="address_line2" class="form-control">
            </div>
        </div>

        <div id="customerFields" style="display:none;">
            <h4 class="mt-4">Customer Details</h4>
            <div class="mb-3">
                <label>First Name:</label>
                <input type="text" name="first_name" class="form-control">
            </div>
            <div class="mb-3">
                <label>Last Name:</label>
                <input type="text" name="last_name" class="form-control">
            </div>
            <div class="mb-3">
                <label>Username:</label>
                <input type="text" name="username" class="form-control">
            </div>
            <div class="mb-3">
                <label>Postcode:</label>
                <input type="text" name="postcode" class="form-control">
            </div>
            <div class="mb-3">
                <label>Address Line 1:</label>
                <input type="text" name="address_line1" class="form-control">
            </div>
            <div class="mb-3">
                <label>Address Line 2:</label>
                <input type="text" name="address_line2" class="form-control">
            </div>
            <div class="mb-3">
                <label>Phone Number (UK Format):</label>
                <input type="text" name="phone_number" class="form-control" 
                    pattern="^(\d{10,11})$" 
                    title="Phone number must be 10 or 11 digits like UK numbers" 
                    maxlength="11"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                    placeholder="Example: 07123456789">
            </div>

        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success">Create User</button>
            <a href="admin_dashboard.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<script>
function toggleFields() {
    const userType = document.querySelector('select[name="user_type"]').value;
    document.getElementById('businessFields').style.display = (userType === 'business') ? 'block' : 'none';
    document.getElementById('customerFields').style.display = (userType === 'customer') ? 'block' : 'none';
}
</script>

<?php include("footer.php"); ?>
