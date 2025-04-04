<?php
session_start();
require_once '../db_config.php';
include("header.php");

$pdo = Database::getConnection();
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    // Optional: You can check if this email exists in customer or business
    // For now, just show generic message
    $message = "If an account with that email exists, a reset link has been sent.";
}
?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="p-4 rounded-4 shadow-lg" style="background-color: #f8f9fa; max-width: 500px; width: 100%;">
        <h2 class="text-center mb-4">Forgot Your Password?</h2>
        <p class="text-center text-muted mb-4">Enter your email address below and we’ll help you reset your password.</p>

        <?php if ($message): ?>
            <div class="alert alert-success text-center"><?= $message ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input 
                    type="email" 
                    class="form-control" 
                    id="email" 
                    name="email" 
                    placeholder="example@domain.com" 
                    required>
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success px-4">Send Reset Link</button>
            </div>
        </form>

        <div class="text-center mt-3">
            <a href="login.php" class="text-muted">Back to Login</a>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>
