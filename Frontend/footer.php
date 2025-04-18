<?php

require_once '../db_config.php'; // Include the database connection

$message = '';

/**
 * Add Subscriber to database
 *
 * This function checks to see if the entered email is already present in the database.
 * It returns a message for an alert if already present, otherwise it adds the email
 * and returns a success.
 * Terminates and rollsback on an error, returning a failure notification.
 *
 * @return string A message declaring success/failure or otherwise of query.
 */
if (!function_exists('addSubscriber')) {
    function addSubscriber($email) {

        $pdo = Database::getConnection();

        try{

            // Check if email exists already
            $stmt = $pdo -> prepare('SELECT * FROM subscribers WHERE subscriber_email = ?');
            $stmt -> execute([ $email ]);
            if ($stmt -> fetch(PDO::FETCH_ASSOC)) {
                return('Already subscribed!');
            }

            // Insert email into database
            $stmt = $pdo -> prepare('INSERT INTO subscribers (subscriber_email) VALUES (?)');
            $stmt -> execute([ $email]);

            return 'Subscribed!';

        }catch (Exception $e) {
            $pdo->rollBack();
            return 'Subscription failed!';
        }

    }

}

if (isset($_POST['subscribe'])) {

    $message = addSubscriber($_POST['subscriber_email']);

    echo "<script>alert('$message');</script>";

}

?>

<footer>
    <div class="footer-container">
        <div class="footer-section quick-links">
            <h3>Quick Links</h3>
            <div class="quick-links-grid">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="aboutus.php">About Us</a></li>
                    <li><a href="sustainability.php">Sustainability</a></li>
                </ul>
                <ul>
                    <li><a href="register.php">Register</a></li>
                    <li><a href="contactus.php">Contact Us</a></li>
                    <li><a href="privacy.php">Privacy Policy</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-section social-media">
            <h3>Follow Us</h3>
            <ul class="social-media-list">
                <li><a href="#" target="_blank"><i class="fa-brands fa-facebook"></i></a></li>
                <li><a href="#" target="_blank"><i class="fa-brands fa-square-instagram"></i></a></li>
                <li><a href="#" target="_blank"><i class="fa-brands fa-square-x-twitter"></i></a></li>
                <li><a href="#" target="_blank"><i class="fa-brands fa-linkedin"></i></a></li>
            </ul>
        </div>

        <div class="footer-section newsletter">
            <h3>Subscribe to Our Newsletter</h3>
            <p>Get the latest updates, special offers, and sustainability insights.</p>
            <form action="#" method="POST">
                <input type="email" name ="subscriber_email" placeholder="Enter your email" required>
                <button type="submit" name="subscribe">Subscribe</button>
            </form>
        </div>

    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>