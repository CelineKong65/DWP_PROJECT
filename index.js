var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) 
{
    showSlides(slideIndex += n);
}

function currentSlide(n) 
{
    showSlides(slideIndex = n);
}

function showSlides(n) 
{
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

function autoShowSlides() 
{
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

function autoShowTestimonials() 
{
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
    
    setTimeout(autoShowTestimonials, 5000); // Change testimonials every 5 seconds
}

//pruss the button to login to buy
function alertLogin() 
{
    document.getElementById('popup-overlay').style.display = 'block';
    document.getElementById('popup').style.display = 'block';
}

function closePopup() 
{
    document.getElementById('popup-overlay').style.display = 'none';
    document.getElementById('popup').style.display = 'none';
}