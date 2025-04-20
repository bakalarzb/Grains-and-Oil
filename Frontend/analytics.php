<!-- (place before the (<php) This Code is just for inputing your own CCS File, Can be removed on submit START --> 
<style>
<?php include 'CSS/fishy.css'; ?>
</style>
<!-- END -->

<?php
$heroTitle = "Sales & Analytics";
$heroClass = "hero-analytics";
$heroSubtitle = "Track your performance, orders, and get insights on buyer activity.";

include("header.php");
?>
    <main class="sales-main">
    <h2 class="text-center" style="padding: 0rem 0rem 1.7rem 0rem; color: #59743d; font-family: 'Kodchasan', sans-serif;">Monthly Sales & Profile Statistics</h2>
        <div class="stat-grid">
                <div class="stat-card">
                  <h2>253 kg</h2>
                  <p><i class="fa-solid fa-weight-scale"></i>
                  Killograms of Food Sold</p>
                </div>
                <div class="stat-card">
                  <h2>£3,036</h2>
                  <p><i class="fa-solid fa-sterling-sign"></i>
                  Sales Revenue</p>
                </div>
                <div class="stat-card">
                  <h2>162</h2>
                  <p><i class="fa-solid fa-clipboard-list"></i>
                  Customer Orders Made</p>
                </div>
                <div class="stat-card">
                  <h2>83</h2>
                  <p></i><i class="fa-solid fa-star"></i>
                  Customer Reviews</p>
                </div>
                
</div>
    </main>

<?php
include("footer.php");
?>
</body>
</html>