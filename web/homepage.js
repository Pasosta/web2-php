//This code is from W3Schools, https://www.w3schools.com/howto/howto_js_slideshow.asp

var slideIndex = 0;
showSlides();

function showSlides() {
    var i;
    var slides = document.getElementsByClassName("slideshow");
    for (i = 0; i < slides.length; i++) {
        console.log(slides[i]);
        slides[i].style.display = "none"; 
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1} 
    slides[slideIndex-1].style.display = "block"; 
    setTimeout(showSlides, 2000); // Change image every 2 seconds
}