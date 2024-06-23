<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
    header {
    background-image: url(p.index.png);
    padding: 20px;
    }

    header h1 {
        display: flex;
        align-items: center;
    }

    header h1 img {
        margin-right: 10px;
    }

    .logo {
        width: 100px;
        height: 80px;
        vertical-align: middle;
        margin-right: 10px;
    }

    nav ul {
        list-style-type: none;
        padding: 0;
    }

    nav ul li {
        display: inline;
        margin-right: 15px;
    }

    nav ul li a {
        text-decoration: none;
        color: black;
        font-size: 24px;
    }

    nav ul li a:hover {
        text-decoration: underline;
    }

    /* Resetting default browser styles */
    body, h1, h2, p, ul, li {
        margin: 0;
        padding: 0;
    }

    /* General styling */
    body {
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        background-image: url(p.index.png);
        color: #333;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Header styles */
    header {
        background-color: #fff;
        border-bottom: 2px solid #ccc;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo {
        max-width: 100px;
    }

    nav ul {
        list-style: none;
    }

    nav ul li {
        display: inline;
        margin-right: 20px;
    }

    nav ul li a {
        text-decoration: none;
        color: #333;
    }

    /* Ad section styles */
    .ad-content {
        overflow: hidden;
        width: 100%;
        background-color: #FFDBAA;
        color: #fff;
        padding: 100px 0;
        text-align: center;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }

    .ad-content h2 {
        font-size: 36px;
    }

    .ad-content p {
        font-size: 24px;
    }

    .ad-track {
        display: flex;
        transition: transform 0.3s ease-in-out;
        font-size: 36px;
        margin-bottom: 20px;
    }

    .ad-item {
        flex: 0 0 auto;
        width: 100%;
        font-size: 18px;
        margin-bottom: 30px;
    }

    /* Main section styles */
    .main {
        padding: 20px;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }

    .products-section h2, .offer-section h2 {
        text-align: center;
        margin-bottom: 30px;
    }

    .products-section, .offer-section {
        margin-top: 50px;
        margin-bottom: 50px;
    }

    .products-grid, .offer-grid {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
    }

    .product-card, .offer-card {
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        padding: 70px;
        margin-bottom: 20px;
        text-align: center;
    }

    .product-card img, .offer-card img {
        width: 200px;
        height: auto;
        margin-bottom: 10px;
    }

    .product-card h3, .offer-card h3 {
        font-size: 24px;
        margin-bottom: 50px;
    }

    .product-card h3, .offer-card h3 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .product-card a {
        text-decoration: none;
    }

    .product-card p, .offer-card p {
        font-size: 16px;
    }

    .detailButton {
        background-color: #FFDBAA;
        border: none;
        border-radius: 5px;
        color: #fff;
        cursor: pointer;
        font-size: 16px;
        margin-top: 50px;
        padding: 10px 20px;
        transition: background-color 0.3s;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        margin: 20px 30px 10px 30px;
        position: relative;
        top: 15px;
    }

    .detailButton:hover {
        background-color: #FAAB78;
    }

    /* General styling for testimonial arrows */
    .testimonial-container {
        position: relative;
        max-width: 800px;
        margin: auto;
    }

    .prev, .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        margin-top: -22px;
        padding: 16px;
        color: black;
        font-weight: bold;
        font-size: 18px;
        transition: 0.3s ease;
        user-select: none;
    }

    .prev {
        left: 0;
    }

    .next {
        right: 0;
    }

    .prev:hover, .next:hover {
        background-color: rgba(0, 0, 0, 0.1);
    }

    /* Hide all slides by default */
    .mySlides {
        display: none;
    }

    /* Add additional styling for the testimonial section */
    .testimonial-section {
        background-color: #f9f9f9;
        padding: 50px 0;
        text-align: center;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }

    .testimonial-section h2 {
        font-size: 28px;
        margin-bottom: 20px;
        color: #333;
    }

    .testimonial-grid {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 30px;
    }

    .testimonial-card {
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin: 0 15px 30px;
        max-width: 300px;
        text-align: left;
    }

    .testimonial-card p {
        font-size: 16px;
        margin-bottom: 15px;
    }

    .testimonial-card cite {
        font-style: italic;
        font-size: 14px;
        color: #666;
    }

    @media (max-width: 768px) {
        .testimonial-card {
            margin: 0 10px 20px;
        }
    }

    footer {
        background-color: #333;
        color: #fff;
        text-align: center;
        padding: 10px;
        position: relative;
        bottom: 0;
        left: 0;
    }

    .popup-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black overlay */
        z-index: 999; /* Ensure it's on top of everything */
    }

    .popup {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        z-index: 1000; /* Ensure popup is above overlay */
    }

    .popup p {
        margin-bottom: 10px;
    }

    .popup button {
        background-color: #FFDBAA;
        border: none;
        border-radius: 5px;
        color: #fff;
        cursor: pointer;
        padding: 10px 20px;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    .popup button:hover {
        background-color: #FAAB78;
    }

    button {
        background-color: #FFDBAA; 
        color: #fff; 
        padding: 10px 20px; 
        font-size: 16px; 
        border: none; 
        border-radius: 5px; 
        cursor: pointer;
        transition: background-color 0.3s; 
    }

    button:hover {
        background-color: #FAAB78; 
    }

    button:focus {
        outline: none; 
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.3); 
    }

    /* Comments section styles */
    .comments-section {
        background-color: #f9f9f9;
        padding: 50px 0;
        text-align: center;
    }

    .comments-section h2 {
        font-size: 28px;
        margin-bottom: 20px;
        color: #333;
    }

    .comments-grid {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 30px;
    }

    .comment-card {
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin: 0 15px 30px;
        max-width: 300px;
        text-align: left;
    }

    .comment-card h3 {
        font-size: 20px;
        margin-bottom: 10px;
    }

    .comment-card p {
        font-size: 16px;
        margin-bottom: 15px;
    }

    </style>
</head>
<body>
    <header>
        <h1>
            <img src="logo.png" alt="OKAY Stationery Shop Logo" class="logo">
            OKAY Stationery Shop
        </h1>
        <nav>
            <ul>
                <li><a href="../DWP_PROJECT/About_us/aboutus.html">About</a></li>
                <li><a href="../DWP_PROJECT/Contact_us/contact_us.php">Contact</a></li>
                <li><a href="../DWP_PROJECT/Product_list/product_list.php">Product</a></li>
                <li><a href="../DWP_PROJECT/Comment&rating/comment_rating.php">Comment and Rating</a></li>
                <li><a href="../DWP_PROJECT/Admin_login/adminlogin.php">Admin</a></li>
                <li><a href="../DWP_PROJECT/login/login.php">Account</a></li>
            </ul>
        </nav>
    </header>
    
    <div class="slideshow-container">
        <div class="mySlides fade">
            <img src="p1.png" style="width: 100%;">
            <div class="text">Caption Text</div>
        </div>
        <div class="mySlides fade">
            <img src="p2.png" style="width: 100%;">
            <div class="text">Caption Text</div>
        </div>
        <div class="mySlides fade">
            <img src="p3.png" style="width: 100%;">
            <div class="text">Caption Text</div>
        </div>

        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <br>
    <div style="text-align: center;">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
    </div>
    <script>
    
        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            if (n > slides.length) { slideIndex = 1 }
            if (n < 1) { slideIndex = slides.length }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
        }

        function automaticSlides() {
            plusSlides(1);
        }

        setInterval(automaticSlides, 3000); // Change image every 3 seconds

    </script>

    <main>
        <section id="products" class="products-section">
            <h2>Top 3 Selling Stationery</h2>
            <div class="products-grid">
                <div class="product-card">
                    <h2>Watercolor Paint</h2>
                    <img src="watercolor_paint.png" alt="Watercolor Paint">
                    <h3>Top Product 1</h3>
                    <button onclick="alertLogin()">Buy It Now</button>
                </div>
                <div class="product-card">
                    <h2>Crayon</h2>
                    <img src="crayon.png" alt="Crayon">
                    <h3>Top Product 2</h3>
                    <button onclick="alertLogin()">Buy It Now</button>
                </div>
                <div class="product-card">
                    <h2>Pencil</h2>
                    <img src="pencil.png" alt="Pencil">
                    <h3>Top Product 3</h3>
                    <button onclick="alertLogin()">Buy It Now</button>
                </div>
            </div>

            <script src="test.js"></script>
            
            <div id="popup-overlay" class="popup-overlay"></div>
                <div id="popup" class="popup">
                    <p>Please login to continue.</p>
                    <button onclick="closePopup()">Close</button>
                </div>
        </section>
        <section id="offer" class="offer-section">
            <h2>Special Offers</h2>
            <div class="offer-grid">
                <div class="offer-card">
                    <img src="#" alt="">
                    <h3>Special Offer: 20% off on all M&G!</h3>
                </div>
                <div class="offer-card">
                    <img src="#" alt="">
                    <h3>Buy 2 Get 1 Free on all Binder Lever Arch File!</h3>
                </div>
            </div>
        </section>
    </main>

    <section id="testimonials" class="testimonial-section">
        <h2>Customer Testimonials and Comments</h2>
        <div class="testimonial-grid">
            <?php
            include 'fetch_comments.php';
            foreach ($comments as $comment) {
                echo '<div class="testimonial-card">';
                echo '<p>"' . htmlspecialchars($comment['comment']) . '"</p>';
                echo '<cite>' . htmlspecialchars($comment['username']) . '</cite>';
                echo '<div class="rating">Rating: ' . htmlspecialchars($comment['rating']) . '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </section>

    <footer>
        <p>&copy; 2019-2024 OKAY Stationery Shop. All rights reserved. OKAY Company</p>
    </footer>

</body>
</html>
