<?php
$heroTitle = "Blogs & Resources";
$heroClass = "hero-blog";
$heroSubtitle = "Stay informed with the latest insights on sustainability, farming tips, and community stories from the heart of Grains & Oil.";

include("header.php");
?>


    <section class="blogs-resources">
        <div class="blog-container">
            <p class="section-intro">
                
            </p>
    
            <div class="blog-grid">
                <article class="blog-card">
                    <img src="images/sustainability.jpg" alt="Sustainable Farming">
                    <h3>Sustainable Farming Tips</h3>
                    <p>Discover practical techniques that help farmers grow produce sustainably while preserving soil and reducing waste.</p>
                    <a href="farmingtips.php" class="read-more">Read More</a>
                </article>
    
                <article class="blog-card">
                    <img src="images/waste.jpg" alt="Reducing Food Waste">
                    <h3>Reducing Food Waste at Home</h3>
                    <p>Learn how small lifestyle changes can have a big impact on food waste reduction and the environment.</p>
                    <a href="wastetips.php" class="read-more">Read More</a>
                </article>
    
                <article class="blog-card">
                    <img src="images/community.jpg" alt="Community Spotlight">
                    <h3>Community Spotlight: Local Heroes</h3>
                    <p>Meet the farmers and producers behind the food — real stories from the people growing your groceries.</p>
                    <a href="herofarmers.php" class="read-more">Read More</a>
                </article>
            </div>
        </div>
    </section>


<?php
include("footer.php");
?>
</body>
</html>
