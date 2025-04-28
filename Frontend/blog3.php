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
    <img src="images/community.jpg" alt="Hands joined together in support" class="blog-image"> <!-- Replace with actual image path -->
    <div class="content">
        <h2>Community Spotlight: Local Heroes</h2>
        <p>Behind every fresh vegetable and homemade jam is a dedicated farmer or food producer with a story to tell. In our Community Spotlight series, we highlight the incredible individuals who make sustainable, local food possible.</p>
        <p>From early mornings in the fields to innovative solutions for food waste, these local heroes are not just feeding communities—they’re reshaping how we think about food, land, and connection.</p>
        <p>Take a moment to meet the faces behind your food. You’ll find passion, resilience, and a shared commitment to a better future.</p>
        <div style="text-align: center;">
            <a href="blog.php" class="back-link">Back to Blog</a>
        </div>
    </div>
</div>


<?php
include("footer.php");
?>
</body>
</html>