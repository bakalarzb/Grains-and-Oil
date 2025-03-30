<?php
include_once("header.php");
include_once("../registration/vendor_reg.php");
include_once("../registration/customer_reg.php");
?>

<div class="container-Register mt-5">
    <h2>Register</h2>
    <div class="card">

        <!-- Card Header -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="btn-group w-100">
                <button id="personalBtn" class="btn btn-secondary">Customer</button>
                <button id="businessBtn" class="btn btn-outline-secondary">Business</button>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <!-- Personal Registration Form (Shown by Default) -->
                <div class="col-md-12" id="personalSection">
                    <h5 class="text-center">Customer Registration</h5>
                    <form id="personalForm" action="../registration/customer_reg.php" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Choose a username" required>
                        </div>

                        <!-- Password Fields (Password and Confirm Password) -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                            </div>
                            <div class="col-md-6">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
                                <div id="passwordMatchTick" style="display: none; color: #72c672;">
                                    <i class="fa fa-check"></i> Passwords match!
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter your first name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter your last name" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter your phone number"pattern="\d{11}" maxlength="11" title="Phone number must be exactly 11 digits">
                        </div>

                        <div class="mb-3">
                            <label for="postcode" class="form-label">Postcode</label>
                            <input type="text" class="form-control" id="postcode" name="postcode" placeholder="Enter your postcode">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="address_line1" class="form-label">Address Line 1</label>
                                <input type="text" class="form-control" id="address_line1" name="address_line1" placeholder="Enter address line 1">
                            </div>
                            <div class="col-md-6">
                                <label for="address_line2" class="form-label">Address Line 2</label>
                                <input type="text" class="form-control" id="address_line2" name="address_line2" placeholder="Optional">
                            </div>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="mt-3 form-check">
                            <input type="checkbox" class="form-check-input" id="personalTerms" required>
                            <label class="form-check-label" for="personalTerms">
                                I agree to the <a href="terms.php" target="_blank" class="text-muted">Terms and Conditions</a>.
                            </label>
                        </div>

                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary">Create a customer account</button>
                        </div>
                    </form>
                </div>

                <!-- Business Registration Form (Hidden by Default) -->
                <div class="col-md-12" id="businessSection" style="display: none;">
                    <h5 class="text-center">Business Registration</h5>
                    <form id="businessForm" action="../registration/vendor_reg.php" method="POST">

                        <div class="mb-3">
                            <label for="business_email" class="form-label">Business Email</label>
                            <input type="email" class="form-control" id="business_email" name="business_email" placeholder="Enter your business email" required>
                        </div>

                        <!-- Password Fields (Password and Confirm Password) -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="business_password" name="business_password" placeholder="Enter your password" required>
                            </div>
                            <div class="col-md-6">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="business_confirm_password" placeholder="Confirm your password" required>
                                <div id="businessPasswordMatchTick" style="display: none; color: #72c672;">
                                    <i class="fa fa-check"></i> Passwords match!
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="business_name" class="form-label">Business Name</label>
                            <input type="text" class="form-control" id="business_name" name="business_name" placeholder="Enter your business name" required>
                        </div>

                        <div class="mb-3">
                            <label for="business_description" class="form-label">Business Description</label>
                            <textarea class="form-control" id="business_description" name="business_description" placeholder="Enter a description of your business" rows="4"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="business_contact_email" class="form-label">Business Contact Email</label>
                            <input type="email" class="form-control" id="business_contact_email" name="business_contact_email" placeholder="Enter your business contact email">
                        </div>

                        <div class="mb-3">
                            <label for="business_postcode" class="form-label">Business Postcode</label>
                            <input type="text" class="form-control" id="business_postcode" name="business_postcode" placeholder="Enter your business postcode">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="business_address_line1" class="form-label">Business Address Line 1</label>
                                <input type="text" class="form-control" id="business_address_line1" name="business_address_line1" placeholder="Enter your business address line 1" required>
                            </div>

                            <div class="col-md-6">
                                <label for="business_address_line2" class="form-label">Business Address Line 2</label>
                                <input type="text" class="form-control" id="business_address_line2" name="business_address_line2" placeholder="Enter your business address line 2 (Optional)">
                            </div>
                        </div>

                        <!-- Hidden inputs for long/lat -->
                        <input type="hidden" id="latitude" name="latitude">
                        <input type="hidden" id="longitude" name="longitude">

                        <!-- Terms and Conditions -->
                        <div class="mt-3 form-check">
                            <input type="checkbox" class="form-check-input" id="personalTerms" required>
                            <label class="form-check-label" for="personalTerms">
                                I agree to the <a href="terms.php" class="text-muted">Terms and Conditions</a>.
                            </label>
                        </div>

                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary">Create a business account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
include("footer.php");
?>

<!-- JavaScript to Switch Forms -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const personalBtn = document.getElementById("personalBtn");
        const businessBtn = document.getElementById("businessBtn");
        const personalSection = document.getElementById("personalSection");
        const businessSection = document.getElementById("businessSection");

        // Function to toggle forms and button styles
        function toggleForm(activeBtn, inactiveBtn, showSection, hideSection) {
            showSection.style.display = "block";
            hideSection.style.display = "none";

            activeBtn.classList.add("btn-secondary");
            activeBtn.classList.remove("btn-outline-secondary");

            inactiveBtn.classList.add("btn-outline-secondary");
            inactiveBtn.classList.remove("btn-secondary");
        }

        // Event listeners for buttons
        personalBtn.addEventListener("click", function () {
            toggleForm(personalBtn, businessBtn, personalSection, businessSection);
        });

        businessBtn.addEventListener("click", function () {
            toggleForm(businessBtn, personalBtn, businessSection, personalSection);
        });

        // Ensure personal form is visible by default
        toggleForm(personalBtn, businessBtn, personalSection, businessSection);

    });

    // Personal form password matching
    document.getElementById("personalForm").addEventListener("input", function() {
        const password = document.getElementById("password");
        const confirmPassword = document.getElementById("confirm_password");
        const passwordMatchTick = document.getElementById("passwordMatchTick");

        if (password.value === confirmPassword.value && confirmPassword.value !== '') {
            password.style.borderColor = "green";
            confirmPassword.style.borderColor = "green";
            password.style.boxShadow = "0 0 5px 2px #72c672"; // Add green shadow
            confirmPassword.style.boxShadow = "0 0 5px 2px #72c672"; // Add green shadow
            passwordMatchTick.style.display = 'inline'; // Show tick
        } else {
            password.style.borderColor = "";
            confirmPassword.style.borderColor = "";
            password.style.boxShadow = ""; // Remove shadow
            confirmPassword.style.boxShadow = ""; // Remove shadow
            passwordMatchTick.style.display = 'none'; // Hide tick
        }
    });

    // Business form password matching
    document.getElementById("businessForm").addEventListener("input", function() {
        const password = document.getElementById("business_password");
        const confirmPassword = document.getElementById("business_confirm_password");
        const businessPasswordMatchTick = document.getElementById("businessPasswordMatchTick");

        if (password.value === confirmPassword.value && confirmPassword.value !== '') {
            password.style.borderColor = "green";
            confirmPassword.style.borderColor = "green";
            password.style.boxShadow = "0 0 5px 2px #72c672"; // Add green shadow
            confirmPassword.style.boxShadow = "0 0 5px 2px #72c672"; // Add green shadow
            businessPasswordMatchTick.style.display = 'inline'; // Show tick
        } else {
            password.style.borderColor = "";
            confirmPassword.style.borderColor = "";
            password.style.boxShadow = ""; // Remove shadow
            confirmPassword.style.boxShadow = ""; // Remove shadow
            businessPasswordMatchTick.style.display = 'none'; // Hide tick
        }
    });

    // Personal form submission validation
    document.getElementById("personalForm").addEventListener("submit", function(event) {
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirm_password").value;

        if (password !== confirmPassword) {
            event.preventDefault(); // Stop form submission
            event.stopPropagation();
            alert("Passwords do not match. Please ensure both password fields are identical.");
        }
        // If passwords match, form submission proceeds to customer_reg.php
    });

    // Business form submission validation
    businessForm.addEventListener("submit", function(event) {
        const password = document.getElementById("business_password").value;
        const confirmPassword = document.getElementById("business_confirm_password").value;

        console.log("Business form - Passwords:", password === confirmPassword ? "match" : "do not match");
        if (password !== confirmPassword) {
            event.preventDefault();
            event.stopImmediatePropagation(); // Stronger stop to prevent other handlers
            alert("Passwords do not match. Please ensure both password fields are identical.");
            console.log("Business form submission blocked");
            return false;
        }
        console.log("Business form submitting");
    });
</script>

<!-- Link to the external JavaScript file -->
<script src="../js/scripts.js"></script>

</body>
</html>