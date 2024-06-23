<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="user_homepage.css">
</head>
<body>
    <header>
        <h1>
            <img src="logo.png" alt="OKAY Stationery Shop Logo" class="logo">
            OKAY Stationery Shop
        </h1>
        <nav>
            <ul>
                <li><a href="../About_us/aboutus.html">About</a></li>
                <li><a href="../Contact_us/contact_us2.php">Contact</a></li>
                <li><a href="../Product_list2/product_list2.php">Product</a></li>
                <li><a href="">Order History</a></li>
                <li><a href="../Comment&rating/comment2.php">Comment and Rating</a></li>
                <li><a href="../Admin_login/adminlogin2.php">Admin</a></li>
                <li><a href="../User/user_profile.php">Profile</a></li>
            </ul>
        </nav>
    </header>

    <div class="slideshow-container">
        <div class="mySlides fade">
            <img src="p1.png" alt="Slide 1" style="width:100%;">
            <div class="text">Caption Text</div>
        </div>
       
        <div class="mySlides fade">
            <img src="p2.png" alt="Slide 2" style="width:100%;">
            <div class="text">Caption Text</div>
        </div>

        <div class="mySlides fade">
            <img src="p3.png" alt="Slide 3" style="width:100%;">
            <div class="text">Caption Text</div>
        </div>

        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <br>
    <div style="text-align:center;">
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
                    <a href="../Product_list2/drawing_painting2.html" class="detailButton">Buy It Now</a>
                </div>
                <div class="product-card">
                    <h2>Crayon</h2>
                    <img src="crayon.png" alt="Crayon">
                    <h3>Top Product 2</h3>
                    <a href="../Product_list2/pen2.html" class="detailButton">Buy It Now</a>
                </div>
                <div class="product-card">
                    <h2>Pencil</h2>
                    <img src="pencil.png" alt="Pencil">
                    <h3>Top Product 3</h3>
                    <a href="../Product_list2/pen2.html" class="detailButton">Buy It Now</a>
                </div>
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

    <!-- Shopping cart button -->
    <a href="../Shopping_cart/shopping_cart.html"><button class="shopping-cart-button">🛒</button></a>  

    <!-- Wishlist button -->
    <a href="../Wishlist/Wishlist.html"><button class="wishlist-button">&#10084;</button></a>

    <!-- Check-in button -->
    <a href="../Check-in/index.php"><button class="check-in-button">🌟</button></a>
</body>
</html>
