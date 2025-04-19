<?php
session_start();
require_once '../db_config.php';
require_once '../tools.php';
include("header.php");

$pdo = Database::getConnection();
$message = '';
$showTypeChoice = false;
$email = '';
$selectedType = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $selectedType = $_POST['user_type'] ?? '';

    $result = findUserByEmail($email);

    if ($result === false) {
        // Email not found — show generic message
        $message = "If an account with that email exists, a reset link has been sent.";
    } elseif ($result === 2 && !$selectedType) {
        // Found in both — show account type choice
        $showTypeChoice = true;
    } else {
        // Either a single match or user already selected type
        $user = is_array($result) ? $result['user'] : null;
        $type = $selectedType ?: $result['type'];

        $token = generateToken();
        storeResetToken($email, $token, $type);  // Optional: store type with token
        sendResetEmail($email, $token, $type);

        $message = "If an account with that email exists, a reset link has been sent.";
    }
}
?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="p-4 rounded-4 shadow-lg" style="background-color: #f8f9fa; max-width: 500px; width: 100%;">
        <h2 class="text-center mb-4">Forgot Your Password?</h2>
        <p class="text-center text-muted mb-4">Enter your email address below and we’ll help you reset your password.</p>

        <?php if ($message): ?>
            <div class="alert alert-success text-center"><?= $message ?></div>
        <?php endif; ?>

        <?php if ($showTypeChoice): ?>
            <form method="POST" action="">
                <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">

                <div class="mb-3">
                    <label for="user_type" class="form-label">Choose Account Type</label>
                    <select class="form-select" name="user_type" id="user_type" required>
                        <option value="">-- Select an option --</option>
                        <option value="customer">Customer</option>
                        <option value="business">Business</option>
                    </select>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary px-4">Continue</button>
                </div>
            </form>
        <?php else: ?>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input
                            type="email"
                            class="form-control"
                            id="email"
                            name="email"
                            value="<?= htmlspecialchars($email) ?>"
                            placeholder="example@domain.com"
                            required>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success px-4">Send Reset Link</button>
                </div>
            </form>
        <?php endif; ?>

        <div class="text-center mt-3">
            <a href="login.php" class="text-muted">Back to Login</a>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>
