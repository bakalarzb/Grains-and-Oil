<?php
$heroTitle = "FAQs";
$heroClass = "hero";
$heroSubtitle = "Frequently asked Questions.";

include("header.php");
?>


<div class="faq-container">
    <h2>Frequently Asked Questions</h2>

    <div class="faq-item">
        <button class="faq-question">1. What is Grains & Oil?</button>
        <div class="faq-answer">
            <p>Grains & Oil is an online marketplace where farmers and small-scale producers sell surplus stock directly to consumers, promoting sustainability and local food systems.</p>
        </div>
    </div>

    <div class="faq-item">
        <button class="faq-question">2. Who can sell on the platform?</button>
        <div class="faq-answer">
            <p>Any verified farmer, grower, or producer can register. From large farms to smallholders with extra harvest, everyone is welcome.</p>
        </div>
    </div>

    <div class="faq-item">
        <button class="faq-question">3. What kind of products can be listed?</button>
        <div class="faq-answer">
            <p>Products such as grains, oils, pulses, herbs, and more. All listings must be accurate, legal, and safe.</p>
        </div>
    </div>

    <div class="faq-item">
        <button class="faq-question">4. Is there a fee to join or sell?</button>
        <div class="faq-answer">
            <p>Account creation is free. We charge a small service fee per sale to support platform maintenance and marketing.</p>
        </div>
    </div>

    <div class="faq-item">
        <button class="faq-question">5. How are payments handled?</button>
        <div class="faq-answer">
            <p>Payments are securely processed through our payment gateway. Grains & Oil does not store your payment data.</p>
        </div>
    </div>

    <div class="faq-item">
        <button class="faq-question">6. What sustainability practices do you support?</button>
        <div class="faq-answer">
            <p>We encourage sustainable and eco-friendly farming. Mislabelled "organic" or "eco" products may be removed.</p>
        </div>
    </div>

    <div class="faq-item">
        <button class="faq-question">7. How do buyers know the product is legit?</button>
        <div class="faq-answer">
            <p>Verified sellers, product reviews, and accurate listings help build trust. We vet sellers before they list.</p>
        </div>
    </div>

    <div class="faq-item">
        <button class="faq-question">8. What if there's an issue with an order?</button>
        <div class="faq-answer">
            <p>Buyers and sellers can message each other. If needed, our support team can help resolve disputes.</p>
        </div>
    </div>

    <div class="faq-item">
        <button class="faq-question">9. Can I cancel my account?</button>
        <div class="faq-answer">
            <p>Yes. You can cancel anytime. We may suspend accounts in cases of fraud or repeated policy violations.</p>
        </div>
    </div>

    <div class="faq-item">
        <button class="faq-question">10. Will these policies change?</button>
        <div class="faq-answer">
            <p>Yes, occasionally. We’ll notify you of any major updates. Continued use implies agreement with the latest terms.</p>
        </div>
    </div>
</div>
<?php
include("footer.php");
?>
</body>
</html>

<script>
document.querySelectorAll(".faq-question").forEach(button => {
    button.addEventListener("click", () => {
        button.classList.toggle("active");
        const answer = button.nextElementSibling;
        answer.style.display = answer.style.display === "block" ? "none" : "block";
    });
});
</script>