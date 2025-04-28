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
    <img src="images/waste.jpg" alt="Green bags" class="blog-image"> <!-- Replace with your actual image path -->
    <div class="content">
        <h2>Reducing Food Waste at Home</h2>
        <p>Food waste is one of the biggest contributors to climate change — but the good news is, we can all do something about it. By making small changes in our daily habits, we can significantly reduce the amount of food that ends up in the bin.</p>
        <p>Simple actions like planning your meals, storing food correctly, and using leftovers creatively can prevent unnecessary waste. Composting at home is another excellent way to return nutrients to the soil while reducing landfill pressure.</p>
        <p>Every action matters. By reducing food waste at home, we not only save money, but also play a vital role in building a healthier planet.</p>
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