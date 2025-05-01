<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$heroTitle = "Contact Us";
$heroClass = "hero-contact";
include("header.php");

require_once '../db_config.php';

// Show alert if redirected with a message
if (!empty($_SESSION['contact_us_feedback'])) {
  echo "<script>alert('" . $_SESSION['contact_us_feedback'] . "');</script>";
  unset($_SESSION['contact_us_feedback']);
}

/**
 * Add Contact Request to database
 */
function addContact($name, $email, $subject, $message) {
  $pdo = Database::getConnection();

  try {
    $stmt = $pdo->prepare('INSERT INTO contact_us (contact_us_name, contact_us_email, contact_us_subject, contact_us_text) VALUES (?, ?, ?, ?)');
    $stmt->execute([$name, $email, $subject, $message]);
    return 'Your request has been sent!';
  } catch (Exception $e) {
    return 'Your request has failed: ' . $e->getMessage(); // Debug only
  }
}

if (isset($_POST['contact_us_send'])) {
  $message = addContact($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message']);

  $_SESSION['contact_us_feedback'] = $message;
  header("Location: contactus.php");
  exit;
}
?>

<main class="contact-section">
  <section class="contact-form-section">
    <form class="contact-form" action="#" method="POST">
      <label for="name">Name*</label>
      <input type="text" id="name" name="name" required />

      <label for="email">Email*</label>
      <input type="email" id="email" name="email" required />

      <label for="subject">Subject</label>
      <input type="text" id="subject" name="subject" />

      <label for="message">Message*</label>
      <textarea id="message" name="message" rows="5" required></textarea>

      <button type="submit" name="contact_us_send" class="contact-button">Send Message</button>
    </form>

    <div class="contact-details">
      <h2>Our Office</h2>
      <p><i class="fa-solid fa-location-dot"></i> 123 Eco Lane, Farmstead City, UK</p>
      <p><i class="fa-solid fa-envelope"></i> contact@grainsandoil.com</p>
      <p><i class="fa-solid fa-phone"></i> +44 1234 567890</p>
    </div>
  </section>
</main>

<?php include("footer.php"); ?>
</body>
</html>