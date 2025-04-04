<?php
$heroTitle = "Contact Us";
$heroClass = "hero-contact";
include("header.php");
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
    
            <button type="submit" class="contact-button">Send Message</button>
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
