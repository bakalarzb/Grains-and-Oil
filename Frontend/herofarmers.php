<!-- (place before the (<php) This Code is just for inputing your own CCS File, Can be removed on submit START --> 
<style>
<?php include 'CSS/fishy.css'; ?>
</style>
<!-- END -->

<?php
$heroTitle = "Meet Our Farmers";
$heroClass = "hero-article3";
$heroSubtitle = "The hardworking people behind your fresh produce";

/* Header includes the main CSS File the class uses START */
include("header.php");
/* END */

?>

<section class="article">
    <div class="container-terms">
        <h2 class="section-title">Their Stories</h2>
        <p class="section-intro">Each farmer in our network has a unique story to tell about their journey in sustainable agriculture.</p>
        
        <div class="farmers-stories">
            <!-- Farmer 1 -->
            <div class="farmer-story">
                <div class="farmer-image-container">
                    <img src="./images/farmer1.jpg" class="farmer-image">
                </div>
                <div class="farmer-content">
                    <h3>John Peterson</h3>
                    <p class="farmer-location">Organic Vegetable Farm, Devon</p>
                    <p>"After 20 years in conventional farming, I made the switch to organic methods in 2015. The soil health improvements I've seen have been remarkable. We've increased biodiversity on our farm by over 40% while maintaining yields. It's challenging work but deeply rewarding to know we're leaving the land better than we found it."</p>
                </div>
            </div>
            
            <!-- Farmer 2 -->
            <div class="farmer-story">
                <div class="farmer-image-container">
                    <img src="./images/farmer2.jpg" class="farmer-image">
                </div>
                <div class="farmer-content">
                    <h3>Amina González</h3>
                    <p class="farmer-location">Biodynamic Vineyard, Sussex</p>
                    <p>"My family has farmed this land for three generations. When I took over, I knew I wanted to transition to biodynamic practices. The lunar calendar guides our planting, and we use only natural preparations to enhance soil life. Our wines now express the true terroir of our land in a way I never thought possible."</p>
                </div>
            </div>
            
            <!-- Farmer 3 -->
            <div class="farmer-story">
                <div class="farmer-image-container">
                    <img src="./images/farmer3.jpg" class="farmer-image">
                </div>
                <div class="farmer-content">
                    <h3>Talia Diallo</h3>
                    <p class="farmer-location">Urban Microfarm, London</p>
                    <p>"I started with just a small balcony garden, growing herbs for my family. Today, we operate a thriving urban farm on a previously abandoned lot, supplying fresh greens to local restaurants and a CSA program. We use vertical growing systems and rainwater harvesting to maximize our small space sustainably."</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include("footer.php");
?>
</body>
</html>