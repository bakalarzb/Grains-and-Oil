<?php
$heroTitle = "Blogs & Resources";
$heroClass = "hero-blog";
$heroSubtitle = "Stay informed with the latest insights on sustainability, farming tips, and community stories from the heart of Grains & Oil.";

include("header.php");
?>


<style>
        body {
            margin: 0;
            font-family: 'Karla', sans-serif;
            background-color: #f9f9f6;
            color: #242423;
        }

        header {
            background-color: #59743d;
            padding: 20px;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-family: 'Julius Sans One', sans-serif;
            font-size: 2.5rem;
            color: white;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            background-color: #fff;
            border-radius: 16px;
            box-shadow: 0 6px 16px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .blog-image {
            width: 100%;
            height: auto;
            display: block;
        }

        .content {
            padding: 30px;
        }

        .content h2 {
            font-family: 'Kodchasan', sans-serif;
            color: #59743d;
            margin-top: 0;
            text-align: center;
        }

        .content p {
            font-size: 1rem;
            line-height: 1.6;
            color: #242423;
        }

        .read-more {
            margin-top: 20px;
            display: inline-block;
            color: #e2c277;
            font-weight: bold;
            text-decoration: none;
        }

        .read-more:hover {
            text-decoration: underline;
        }

        .back-link {
            display: inline-block;
            margin-top: 40px;
            text-align: center;
            color: #59743d;
            font-weight: bold;
            font-family: 'Karla', sans-serif;
            text-decoration: none;
            font-size: 1rem;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="images/sustainability.jpg" alt="Fresh vegetables in a basket" class="blog-image"> <!-- Change to your actual image path -->
        <div class="content">
            <h2>Sustainable Farming Tips</h2>
            <p>Discover practical techniques that help farmers grow produce sustainably while preserving soil and reducing waste. Our aim is to support environmentally conscious practices that are good for the land, the growers, and the consumers.</p>
            <p>From crop rotation and organic composting to using renewable energy and water-saving methods, sustainable agriculture ensures future generations can continue to enjoy fresh, healthy food. Join the movement and learn how your support of local produce makes a real difference.</p>
            <div style="text-align: center;">
            <a href="blog.php" class="back-link">Back to Blog Page</a>
        </div>
        </div>
    </div>


<?php
include("footer.php");
?>
</body>
</html>