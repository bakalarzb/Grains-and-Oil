<?php include("header.php"); ?>

<style>
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
</head>
<body>

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
  </div>

</body>
</html>

<?php include("footer.php"); ?>