<?php
$heroTitle = "Contact Us";
$heroClass = "hero-contact";
include("header.php");
require_once '../db_config.php';

/**
 * Add Contact Request to database
 *
 * This function adds the contact information and request of communication to the database.
 * It returns a message for an alert notifying of a success or failure.
 * Terminates and rollsback on an error, returning a failure notification.
 *
 * @return string A message declaring success/failure of query.
 */
if (!function_exists('addContact')) {
  function addContact($name, $email, $subject, $message) {

    $pdo = Database::getConnection();

      try{

        // Insert contact us form into database.
        $stmt = $pdo -> prepare('INSERT INTO contact_us (contact_us_email, contact_us_subject, contact_us_text, contact_us_name) VALUES (?, ?, ?, ?)');
        $stmt -> execute([ $email, $subject, $message, $name]);
        return 'Your request has been send!';

      } catch (Exception $e) {
        //Rollback on failure.
          $pdo->rollBack();
          return 'Your request has failed!';
        }
  }
}

if (isset($_POST['contact_us_send'])) {

  $message = addContact($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message']);

  echo "<script>alert('$message');</script>";

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

<?php
include("footer.php");
?>
</body>
</html>
