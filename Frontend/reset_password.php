<?php
session_start();
require_once '../db_config.php';
include("header.php");

$pdo = Database::getConnection();
$message = '';
$showForm = false;

// Handle GET request with token
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['token'])) {
    $token = $_GET['token'];
    $resetRequest = validateResetToken($token, $pdo);

    if ($resetRequest) {
        $email = $resetRequest['email'];
        $type = $resetRequest['type'];
        $showForm = true;
    } else {
        $message = "Invalid or expired token.";
    }
}

// Handle POST form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['token'], $_POST['password'], $_POST['confirm_password'])) {
    $token = $_POST['token'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($password !== $confirmPassword) {
        $message = "Passwords do not match.";
        $showForm = true;
    } else {
        $newPassword = password_hash($password, PASSWORD_DEFAULT);
        $resetRequest = validateResetToken($token, $pdo);

        if ($resetRequest) {
            $email = $resetRequest['email'];
            $type = $resetRequest['type'];

            if (updatePassword($email, $newPassword, $type, $pdo)) {
                deleteResetToken($token, $pdo);
                $message = "Password has been successfully updated!";
                $showForm = false;
            } else {
                $message = "There was an issue updating your password. Please try again.";
            }
        } else {
            $message = "Invalid or expired token.";
        }
    }
}
?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="p-4 rounded-4 shadow-lg" style="background-color: #f8f9fa; max-width: 500px; width: 100%;">
        <h2 class="text-center mb-4">Reset Your Password</h2>

        <?php if ($message): ?>
            <div class="alert alert-info text-center"><?= $message ?></div>
        <?php endif; ?>

        <?php if ($showForm): ?>
            <form method="POST" action="" onsubmit="return validatePasswords();">
                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

                <div class="mb-3">
                    <label for="password" class="form-label">New Password</label>
                    <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="password"
                            required
                            minlength="6"
                            placeholder="Enter new password">
                </div>

                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm New Password</label>
                    <input
                            type="password"
                            class="form-control"
                            id="confirm_password"
                            name="confirm_password"
                            required
                            minlength="6"
                            placeholder="Re-enter new password">
                    <div id="match-warning" class="form-text text-danger d-none">
                        Passwords do not match.
                    </div>
                </div>

                <div id="password-strength" class="text-center mt-2"></div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success px-4">Reset Password</button>
                </div>
            </form>
        <?php endif; ?>

        <div class="text-center mt-3">
            <a href="login.php" class="text-muted">Back to Login</a>
        </div>
    </div>
</div>

<script>
    function validatePasswords() {
        const pass = document.getElementById("password").value;
        const confirm = document.getElementById("confirm_password").value;
        const warning = document.getElementById("match-warning");

        if (pass !== confirm) {
            warning.classList.remove("d-none");
            return false;
        } else {
            warning.classList.add("d-none");
            return true;
        }
    }
</script>

<script src="../js/scripts.js"></script>
<?php include("footer.php"); ?>
