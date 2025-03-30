<?php
session_start();
require_once '../tools.php'; // Include the tools with login functions
require_once '../db_config.php'; // Include database connection
include("header.php");

$pdo = Database::getConnection();
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $isBusiness = isset($_POST['flexSwitchCheckDefault']) && $_POST['flexSwitchCheckDefault'] === 'on';

    try {
        if ($isBusiness) {
            $user = loginBusiness($email, $password, $pdo);
            $message = "Business login successful! Welcome, " . htmlspecialchars($user['business_name']);

            $_SESSION['user'] = $user;
            $_SESSION['user_id'] = $user['business_id'];         
            $_SESSION['user_type'] = 'business';
            $_SESSION['isBusiness'] = true;
        } else {
            $user = loginCustomer($email, $password, $pdo);
            $message = "Customer login successful! Welcome, " . htmlspecialchars($user['customer_first_name']);

            $_SESSION['user'] = $user;
            $_SESSION['user_id'] = $user['customer_id'];         
            $_SESSION['user_type'] = 'customer';
            $_SESSION['isBusiness'] = false;
        }
           

        // Redirect to a dashboard or home page after successful login
        header("Location: profile.php");
        exit();
    } catch (Exception $e) {
        $message = "Login failed: " . htmlspecialchars($e->getMessage());
    }
}
?>

<div class="container-login mt-5">
    <h2>Login</h2>
    <!-- Shows message after deleting account -->
    <?php if (isset($_GET['deleted'])): ?>
            <div class="alert alert-warning">Your account has been successfully deleted.</div> 
    <?php endif; ?>


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

        <div class="form-check form-switch mb-3">
            <label class="form-check-label" for="flexSwitchCheckDefault">Sign in as a business?</label>
            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="flexSwitchCheckDefault">
        </div>

        <div class="row mb-3">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary">Sign In</button>
            </div>
        </div>
    </form>

    <div class="row mb-3">
        <div class="col-sm-12">
            <a href="register.php" class="btn btn-secondary">Create an Account</a>
        </div>
    </div>

    <!-- Forgot Password Link -->
    <div class="row">
        <div class="col-sm-6">
            <a href="#" class="text-muted">Forgot your password?</a>
        </div>
    </div>
</div>

<script>
    // Check for registration success query parameter
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('registration') === 'success') {
        alert("Registration successful! Please log in.");
        window.history.replaceState({}, document.title, "profile.php");
    }
</script>

<?php
include("footer.php");
?>
</body>
</html>