<?php
$heroTitle = "Contact Us";
$heroClass = "hero-contact";
include("header.php");
?>


<style>

    h1 {
      margin: 0;
      font-size: 2rem;
    }

    main {
      padding: 2rem;
      max-width: 900px;
      margin: auto;
    }

.checkout-container {
    background-color: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
}

    .section-title {
      font-family: 'Khodchasan', sans-serif;
      color: #836533;
      margin-top: 1rem;
      margin-bottom: 0.5rem;
    }

.form-group {
  width: 100%;
  max-width: 600px;
  margin-bottom: 1.5rem;
  text-align: left; /* So labels/text don't look odd */
}

label {
  display: block;
  font-weight: bold;
  margin-bottom: 0.3rem;
  font-family: 'Khodchasan', sans-serif;
}

input, select {
  width: 100%;
  padding: 0.9rem;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-family: 'Karla', sans-serif;
  font-size: 1rem;
}

    .btn {
      background-color: #E2C277;
      color: #242423;
      padding: 1rem 2rem;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s ease;
      
    }

    .btn:hover {
      background-color: #d6ae55;
    }

    .delivery-container {
      max-width: 900px;
      margin: 3rem auto;
      padding: 2rem;
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 0 12px rgba(0,0,0,0.08);

      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
    }

    h1 {
      font-family: 'Julius Sans One', sans-serif;
      font-size: 2rem;
      color: #59743d;
      text-align: center;
      margin-bottom: 1rem;
    }

    h2 {
      font-family: 'Khodchasan', sans-serif;
      font-size: 1.4rem;
      color: #836533;
      margin-top: 2rem;
    }

    p {
      font-size: 1rem;
      line-height: 1.6;
      margin-bottom: 1rem;
    }

    .option {
      padding: 1.2rem;
      border-left: 6px solid #E2C277;
      background-color: #fdf8f0;
      margin-bottom: 1.5rem;
      border-radius: 8px;
      width: 100%;
      max-width: 700px;
      text-align: center;
    }

    .option-title {
      font-family: 'Khodchasan', sans-serif;
      font-size: 1.2rem;
      color: #242423;
      font-weight: bold;
    }

    .option-desc {
      margin-top: 0.3rem;
    }

    .note {
      font-style: italic;
      font-size: 0.9rem;
      color: #59743d;
    }

  </style>

<main>
    <div class="checkout-container">
      <h2 class="section-title">Shipping Information</h2>
      <div class="form-group">
        <label for="fullname">Full Name</label>
        <input type="text" id="fullname" placeholder="Jane Doe">
      </div>
      <div class="form-group">
        <label for="address">Shipping Address</label>
        <input type="text" id="address" placeholder="123 Farm Road">
      </div>
      <div class="form-group">
        <label for="city">City</label>
        <input type="text" id="city">
      </div>
      <div class="form-group">
        <label for="postcode">Postcode</label>
        <input type="text" id="postcode">
      </div>

      <h2 class="section-title">Payment Details</h2>
      <div class="form-group">
        <label for="card">Card Number</label>
        <input type="text" id="card" placeholder="1234 5678 9012 3456">
      </div>
      <div class="form-group">
        <label for="expiry">Expiry Date</label>
        <input type="text" id="expiry" placeholder="MM/YY">
      </div>
      <div class="form-group">
        <label for="cvv">CVV</label>
        <input type="text" id="cvv" placeholder="123">
      </div>

      
    </div>


    <div class="delivery-container">
    <h1>Delivery Options</h1>
    <p>Choose from our eco-friendly, flexible delivery options. Whether you’re stocking up weekly or supporting a local farm once in a while, we’ve got you covered.</p>

    <div class="option">
      <div class="option-title"><i class="fa-solid fa-box"></i> Standard Delivery (3–5 working days)</div>
      <div class="option-desc">Reliable, eco-conscious delivery using recycled packaging. Ideal for non-perishable goods and bulk orders. <br><span class="note">Free on orders over £40.</span></div>
    </div>

    <div class="option">
      <div class="option-title"><i class="fa-solid fa-truck"></i> Next Day Local Delivery</div>
      <div class="option-desc">Available for customers within 25 miles of partnered farms. Fresh produce delivered within 24 hours. <br><span class="note">£3.99 flat rate.</span></div>
    </div>

    <div class="option">
      <div class="option-title"><i class="fa-solid fa-earth-europe"></i> Sustainable Courier</div>
      <div class="option-desc">Partnered with carbon-neutral couriers across the UK. Track your parcel and monitor your carbon savings. <br><span class="note">Standard rate: £2.99</span></div>
    </div>

    <div class="option">
      <div class="option-title"><i class="fa-solid fa-building-wheat"></i> Farm Pickup</div>
      <div class="option-desc">Pick up your order directly from a local farm partner and meet the growers! <br><span class="note">No cost, just community connection.</span></div>
    </div>

    <p class="note">We’re committed to reducing food miles and supporting sustainable transport solutions.</p>

    <button class="btn">Place Order</button>
  </div>
  </main>

<?php
include("footer.php");
?>
</body>
</html>
