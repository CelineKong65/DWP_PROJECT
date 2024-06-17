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

<<<<<<< HEAD:index.js
// Variable to track the index of testimonials
var testimonialIndex = 0;
autoShowTestimonials();

function autoShowTestimonials() {
    var i;
    var testimonials = document.getElementsByClassName("testimonial-card");
    
    // Hide all testimonials
    for (i = 0; i < testimonials.length; i++) {
        testimonials[i].style.display = "none";
    }
    
    // Increment index and reset if out of bounds
    testimonialIndex++;
    if (testimonialIndex > testimonials.length) { testimonialIndex = 1 }
    
    // Display the current testimonial
    testimonials[testimonialIndex - 1].style.display = "block";
    
    // Change testimonial every 4 seconds
    setTimeout(autoShowTestimonials, 4000);
}

=======

//pruss the button to login to buy
function alertLogin() {
    document.getElementById('popup-overlay').style.display = 'block';
    document.getElementById('popup').style.display = 'block';
}

function closePopup() {
    document.getElementById('popup-overlay').style.display = 'none';
    document.getElementById('popup').style.display = 'none';
}
>>>>>>> d43dfb999493faac11675955bf5717cf4bc98c95:User_homepage/index.js
