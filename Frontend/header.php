<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grains and Oil</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<header>
    <nav>
        <ul class="nav-links">
            <li><a href="marketplace.php">Marketplace</a></li>

            <!-- Logic for roles based access to vendor dashboard -->
            <?php
                include_once "../tools.php";

                // Ensure session is started
                startSessionIfNeeded();

                // Check if user is logged in by verifying 'business_id' exists in session
                $is_logged_in = isset($_SESSION['user']);

                // Safely check 'isBusiness' session variable, default to false if not set
                $isBusiness = isset($_SESSION["isBusiness"]) ? (bool)$_SESSION["isBusiness"] : false;

                // Display Vendor Dashboard link only if user is logged in and is a business
                if ($is_logged_in && $isBusiness === true) {
                    echo '<li><a href="vendor.php">Vendor Dashboard</a></li>';
                }
            ?>

            <li><a href="blog.php">Blogs & Resources</a></li>
            <li><a href="terms.php">Terms of Service</a></li>
            <li><a href="faq.php">FAQ</a></li>
            <li><a href="contactus.php">Contact Us</a></li>
        </ul>

        <div class="search-bar">
            <input type="text" placeholder="Search...">
        </div>
        <div class="cart-icon">
            <a href="basket.php">
            <i class="fa-solid fa-shopping-cart"></i>
            </a>
        </div>
        <div class="profile-picture">
            <a href="profile.php">
            <?php
            $avatarSeed = '';
            $avatarUrl = 'images/user.jpg'; // Default

            if ($is_logged_in && isset($_SESSION['user'])) {
                $user = $_SESSION['user'];
                $avatarSeed = $_SESSION['isBusiness']
                    ? ($user['business_name'] ?? 'business')
                    : ($user['customer_username'] ?? 'user');

                $avatarUrl = "https://api.dicebear.com/7.x/initials/svg?seed=" . urlencode($avatarSeed);
            }
            ?>

            <div class="profile-picture">
                <a href="profile.php">
                    <img src="<?= htmlspecialchars($avatarUrl) ?>" alt="User Avatar" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                </a>
            </div>
            </a>
        </div>

        <!-- Conditionally display the logout button if the user is logged in -->
        <?php if ($is_logged_in === true): ?>
            <div class="logout-btn m-3">
                <a href="../logout.php" class="btn btn-danger">Logout</a>
            </div>
        <?php else: ?>
            <div class="login-btn m-3">
                <a href="login.php" class="btn btn-secondary">Login/Register</a>
            </div>
        <?php endif; ?>

    </nav>
</header>


<?php if (isset($heroTitle) && isset($heroClass)) : ?>
<section class="<?php echo htmlspecialchars($heroClass); ?>">
    <div class="semi-circle-container">
        <div class="semi-circle">
            <a href="index.php">
                <img src="images/logo.JPG" alt="Grains & Oil Logo" class="logo">
            </a>
        </div>
    </div>
    <h1><?php echo htmlspecialchars($heroTitle); ?></h1>
    <?php if (isset($heroSubtitle)) : ?>
        <p><?php echo htmlspecialchars($heroSubtitle); ?></p>
    <?php endif; ?>
    <?php if (isset($heroButton)) : ?>
        <?php echo $heroButton; ?>
    <?php endif; ?>
</section>
<?php endif; ?>
