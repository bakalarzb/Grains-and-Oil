<?php
$heroTitle = "WELCOME TO GRAINS AND OIL MARKETPLACE!";
$heroClass = "hero";
$heroSubtitle = "Where Community Meets Sustainability, One Seed at a Time.";

include("header.php");
?>


    <br>

    <div class="surplus">
        <h2 class="heading-surplus">GOT SURPLUS FROM YOUR GARDEN?</h2>
        <p class="description">
            If you have a personal farm or garden and find yourself with a bounty of fresh produce, we want to hear from you! 
            At Grains and Oil, we believe in making good food available to all, including your homegrown goodies.
        </p>
    </div>

    <section class="why-sell">
        <h2>Why Sell With Us?</h2>
        <div class="benefits">
            <div class="benefit">
                <h4>Share Your Harvest</h4>
                <h5>Connect with local food lovers and share your surplus.</h5>
            </div>
            <div class="benefit">
                <h4>Support Local</h4>
                <h5>Help us promote local agriculture and reduce food waste.</h5>
            </div>
            <div class="benefit">
                <h4>Easy Selling</h4>
                <h5>Join our marketplace and turn your extra produce into cash!</h5>
            </div>
        </div>
    </section>
    
    <section class="about">
        <h2>About Us</h2>

            <div class="about-content">

                <div class="about-item">
                    <div class="container">
                        <div class="text-box">
                        <h2>Who We Are <i class="fa-solid fa-tree"></i></h2>
                        <p>We are more than just a marketplace. We are a community passionate about building a sustainable future, one seed at a time. We connect farmers using responsible practices with conscious buyers, making it easy to source ethical agricultural produce.</p>
                        </div>
                    <div class="image-box">
                        <img src="images/hands.avif" width="10%" alt="Hands together on a tree">
                    </div>
                </div>

                <section class="sustainability-section">
                    <div class="sustainability-card">
                        <div class="sustainability-text">
                            <h2><i class="fa-solid fa-seedling"></i> Sustainability Focus</h2>
                            <p>
                                A significant amount of perfectly edible food goes to waste every year.
                                We provide a marketplace for "seconds" produce that may not meet traditional 
                                cosmetic standards but is still perfectly edible. Additionally, we offer 
                                solutions for repurposing inedible food scraps.
                            </p>
                        </div>
                        <div class="sustainability-image">
                            <img src="images/vegetables.avif" alt="Fresh vegetables in a market">
                        </div>
                    </div>
                </section>
                
            <div class="about-item">
                <div class="container">
                    <div class="text-box">
                        <h3>Empowerment <i class="fa-solid fa-circle-check"></i></h3>
                        <p>Every purchase empowers farmers, protects our planet and nourishes your body. Join us on the journey to create a just and sustainable food system together.</p>
                    </div>
                    <div class="image-box">
                        <img src="images/combine.avif" width="10%" alt="Hands together on a tree">
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="vision-mission-section"> 
        <div class="vision-mission-header-container">
            <!-- Vision Header -->
            <div class="vision-header">
                <h3>  VISION</h3>
                <div class="vision-icon">
                    <i class="fa-solid fa-bullseye"></i>
                </div>
            </div>
    
            <!-- Mission Header -->
            <div class="mission-header">
                <div class="mission-icon">
                    <i class="fa-solid fa-flag-checkered"></i>
                </div>
                <h3>MISSION</h3>
            </div>
        </div>
    
        <div class="vision-mission-text-container">
            <!-- Vision Text -->
            <div class="vision-text">
                <p>To be a one-stop shop for organic produce, fostering a community that values sustainability, health, and environmental responsibility.</p>
            </div>
    
            <!-- Mission Text -->
            <div class="mission-text">
                <p>To connect consumers with sustainably grown produce, promoting healthy eating and supporting local farmers.</p>
            </div>
        </div>
    </section>

    <section class="offerings-section">
        <h2>EXPLORE OUR OFFERINGS</h2>
    
        <div class="offering-card">
            <div class="offering-image">
                <img src="images/cookedveg.avif" alt="Fresh vegetables">
            </div>
            <div class="offering-content">
                <h3>First-Grade Goodies</h3>
                <p>
                    We're all about the crème de la crème of agriculture! Our first-grade products are handpicked from the best farms, ensuring you get only the freshest and most nutritious goodies.
                </p>
                <div class="offering-tags">
                    <span class="category-tag"><i class="fa-solid fa-chevron-right"></i> Categories</span>
                </div>
            </div>
        </div>
    
        <div class="offering-card">
            <div class="offering-image">
                <img src="images/fruit.avif" alt="Imperfect but fresh fruits">
            </div>
            <div class="offering-content">
                <h3>Seconds, But Still Awesome!</h3>
                <p>
                    Not everything has to be perfect to be tasty! Our seconds marketplace is where you'll find perfectly good produce at a price that won’t break the bank. Let’s reduce food waste together!
                </p>
                <div class="offering-tags">
                    <div class="offering-label">
                        <span class="tag"><i class="fa-solid fa-circle-check"></i> Budget-Friendly</span>  
                        <p class="offering-extra">Affordable produce that’s still packed with flavor!</p>
                    </div>
                    <div class="offering-label">
                        <span class="tag"><i class="fa-solid fa-circle-check"></i> Waste Warriors</span> 
                        <p class="offering-extra">Helping the planet by giving these gems a second chance.</p>
                    </div>
                    
                </div>
               
                
            </div>
        </div>
    
        <div class="offering-card">
            <div class="offering-image">
                <img src="images/white.avif" alt="Biogas plant">
            </div>
            <div class="offering-content">
                <h3>Biogas Generation</h3>
                <p>
                    Got spoiled produce? We’ve got a plan! Our biogas sector turns waste into energy—talk about recycling with a twist!
                </p>
                <div class="offering-tags">
                    <div class="offering-label">
                        <span class="tag"><i class="fa-solid fa-circle-check"></i> Waste Not, Want Not</span>
                        <p class="offering-extra">Let’s take it off you and keep it out of landfills.</p>
                    </div>
                    <div class="offering-label">
                        <span class="tag"><i class="fa-solid fa-circle-check"></i> Green Energy</span>
                        <p class="offering-extra">Turning trash into treasure—waste to watt, here we come!</p>
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
