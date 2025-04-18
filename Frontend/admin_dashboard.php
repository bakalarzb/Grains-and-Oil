<?php
session_start();
require_once '../tools.php';
require_once '../db_config.php';

// Protect page: allow only admins
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header('Location: login.php');
    exit();
}


$pdo = Database::getConnection();

// Fetch business users
$businessStmt = $pdo->query("SELECT * FROM business");
$businessUsers = $businessStmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch customer users
$customerStmt = $pdo->query("SELECT * FROM customer");
$customerUsers = $customerStmt->fetchAll(PDO::FETCH_ASSOC);

include("header.php");
?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Admin Dashboard</h1>

    <div class="text-end mb-4">
        <a href="create_user.php" class="btn btn-success">➕ Create New User</a>
    </div>

    <h2>Business Users</h2>
    <div class="table-responsive mb-5">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Contact Email</th>
                    <th>Postcode</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($businessUsers as $business): ?>
                    <tr>
                        <td><?= htmlspecialchars($business['business_id']) ?></td>
                        <td><?= htmlspecialchars($business['business_email']) ?></td>
                        <td><?= htmlspecialchars($business['business_name']) ?></td>
                        <td><?= htmlspecialchars($business['business_contact_email']) ?></td>
                        <td><?= htmlspecialchars($business['business_postcode']) ?></td>
                        <td>
                            <a href="edit_profile.php?type=business&id=<?= $business['business_id'] ?>" class="btn btn-primary btn-sm">✏️ Edit</a>
                            <a href="delete_profile.php?type=business&id=<?= $business['business_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this business user?');">❌ Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <h2>Customer Users</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Postcode</th>
                    <th>Phone Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customerUsers as $customer): ?>
                    <tr>
                        <td><?= htmlspecialchars($customer['customer_id']) ?></td>
                        <td><?= htmlspecialchars($customer['customer_email']) ?></td>
                        <td><?= htmlspecialchars($customer['customer_first_name']) ?></td>
                        <td><?= htmlspecialchars($customer['customer_last_name']) ?></td>
                        <td><?= htmlspecialchars($customer['customer_username']) ?></td>
                        <td><?= htmlspecialchars($customer['customer_postcode']) ?></td>
                        <td><?= htmlspecialchars($customer['customer_phone_number']) ?></td>
                        <td>
                            <a href="edit_profile.php?type=customer&id=<?= $customer['customer_id'] ?>" class="btn btn-primary btn-sm">✏️ Edit</a>
                            <a href="delete_profile.php?type=customer&id=<?= $customer['customer_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this customer user?');">❌ Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
include("footer.php");
?>
