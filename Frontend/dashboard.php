<?php
session_start();
include("header.php");

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

    <div class="container mt-5">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['isBusiness'] ? $_SESSION['user']['business_name'] : $_SESSION['user']['customer_first_name']); ?>!</h2>
        <p>You are logged in as a <?php echo $_SESSION['isBusiness'] ? 'business' : 'customer'; ?>.</p>
        <a href="../logout.php" class="btn btn-secondary">Logout</a>
    </div>

<?php
include("footer.php");
?>