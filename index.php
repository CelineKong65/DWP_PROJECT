<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="index.css">
    <style>
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
        <img src="d1.png" alt="Slide 1" style="width: 100%;">
        </div>
       
        <div class="mySlides fade">
            <img src="d2.jpg" alt="Slide 2" style="width:100%;">
        </div>

        <div class="mySlides fade">
            <img src="d3.png" alt="Slide 3" style="width:100%;">
        </div>

        <div class="mySlides fade">
            <img src="d4.png" alt="Slide 4" style="width:100%;">
        </div>

        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <br>
    <div style="text-align: center;">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
        <span class="dot" onclick="currentSlide(4)"></span>
    </div>


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

            <script src="index.js"></script>
            
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
                    <img src="a1.png" alt="Special Offer: 20% off on all M&G!" style="width:400px; hight:auto;">
                </div>
                <div class="offer-card">
                    <img src="a2.png" alt="Buy 2 Get 1 Free on all Binder Lever Arch File!" style="width:400px; hight:auto;">
                </div>
            </div>
        </section>

        <section id="testimonials" class="testimonial-section">
            <h2>Customer Testimonials and Comments</h2>
            <div class="testimonial-slider" id="commentslidershow">
                <div class="testimonial-track">
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
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2019-2024 OKAY Stationery Shop. All rights reserved. OKAY Company</p>
    </footer>

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

        var slideIndex = 0;
        autoShowSlides();

        function autoShowSlides() {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) { slideIndex = 1 }
            slides[slideIndex - 1].style.display = "block";
            setTimeout(autoShowSlides, 2000); // Change image every 2 seconds
        }

        // For Testimonials
        var commentsToShow = 4;
        var testimonialIndex = 0;
        autoShowTestimonials();

        function autoShowTestimonials() {
            var i;
            var testimonials = document.getElementsByClassName("testimonial-card");
            var totalTestimonials = testimonials.length;

            // Hide all testimonials first
            for (i = 0; i < totalTestimonials; i++) {
                testimonials[i].style.display = "none";
            }

            // Show the next set of testimonials
            for (i = 0; i < commentsToShow; i++) {
                var index = (testimonialIndex + i) % totalTestimonials;
                testimonials[index].style.display = "block";
            }

            // Update the starting index for the next set
            testimonialIndex = (testimonialIndex + commentsToShow) % totalTestimonials;

            setTimeout(autoShowTestimonials, 3000); // Change testimonials every 5 seconds
        }

        // Press the button to login to buy
        function alertLogin() {
            document.getElementById('popup-overlay').style.display = 'block';
            document.getElementById('popup').style.display = 'block';
        }

        function closePopup() {
            document.getElementById('popup-overlay').style.display = 'none';
            document.getElementById('popup').style.display = 'none';
        }
    </script>

</body>
</html>
