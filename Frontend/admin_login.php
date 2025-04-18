<?php
session_start();
require_once '../tools.php';
require_once '../db_config.php';
include("header.php");

$pdo = Database::getConnection();
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $loginType = $_POST['login_type'] ?? 'business'; // default business

    try {
        if ($loginType === 'admin') {
            $admin = loginAdmin($email, $password, $pdo);
            $_SESSION['user'] = $admin;
            $_SESSION['user_id'] = $admin['admin_id'];
            $_SESSION['user_type'] = 'admin';
            $message = "Admin login successful! Welcome, " . htmlspecialchars($admin['admin_first_name']);
            header("Location: admin_dashboard.php");
            exit();
        } elseif ($loginType === 'business') {
            $user = loginBusiness($email, $password, $pdo);
            $_SESSION['user'] = $user;
            $_SESSION['user_id'] = $user['business_id'];
            $_SESSION['user_type'] = 'business';
            $message = "Business login successful! Welcome, " . htmlspecialchars($user['business_name']);
            header("Location: profile.php");
            exit();
        } else {
            $user = loginCustomer($email, $password, $pdo);
            $_SESSION['user'] = $user;
            $_SESSION['user_id'] = $user['customer_id'];
            $_SESSION['user_type'] = 'customer';
            $message = "Customer login successful! Welcome, " . htmlspecialchars($user['customer_first_name']);
            header("Location: profile.php");
            exit();
        }
    } catch (Exception $e) {
        $message = "Login failed: " . htmlspecialchars($e->getMessage());
    }
}
?>

<div class="container-login mt-5">
    <h2>Login</h2>

    <?php if ($message): ?>
        <div class="alert <?php echo strpos($message, 'successful') !== false ? 'alert-success' : 'alert-danger'; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="row mb-3">
            <label for="email" class="col-sm-12 col-form-label">Email address</label>
            <div class="col-sm-12">
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="password" class="col-sm-12 col-form-label">Password</label>
            <div class="col-sm-12">
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>
        </div>

        <!-- Login Type Switches -->
        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" role="switch" id="adminSwitch" name="adminSwitch">
            <label class="form-check-label" for="adminSwitch">Login as Admin?</label>
        </div>

        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" role="switch" id="businessSwitch" name="businessSwitch" checked>
            <label class="form-check-label" for="businessSwitch">Login as Business?</label>
        </div>

        <input type="hidden" id="loginType" name="login_type" value="business">

        <div class="row mb-3">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary">Sign In</button>
            </div>
        </div>
    </form>
</div>

<script>
// Toggle logic
document.addEventListener('DOMContentLoaded', function () {
    const adminSwitch = document.getElementById('adminSwitch');
    const businessSwitch = document.getElementById('businessSwitch');
    const loginTypeInput = document.getElementById('loginType');

    adminSwitch.addEventListener('change', function () {
        if (adminSwitch.checked) {
            businessSwitch.checked = false;
            loginTypeInput.value = 'admin';
        } else if (!businessSwitch.checked) {
            businessSwitch.checked = true;
            loginTypeInput.value = 'business';
        }
    });

    businessSwitch.addEventListener('change', function () {
        if (businessSwitch.checked) {
            adminSwitch.checked = false;
            loginTypeInput.value = 'business';
        } else if (!adminSwitch.checked) {
            adminSwitch.checked = true;
            loginTypeInput.value = 'admin';
        }
    });
});
</script>

<?php
include("footer.php");
?>
</body>
</html>
