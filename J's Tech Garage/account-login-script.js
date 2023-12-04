var slideIndex = 1; // Start from the first slide
var slides = document.getElementsByClassName("racerSlide");
var interval;

showSlides();

function showSlides() {
  for (var i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }

  if (slideIndex > slides.length) {
    slideIndex = 1;
  } else if (slideIndex < 1) {
    slideIndex = slides.length;
  }

  slides[slideIndex - 1].style.display = "block";
}

function plusSlides(n) {
  clearInterval(interval);
  slideIndex += n;
  showSlides();
  interval = setInterval(showSlides, 3000);
}

function currentSlide(n) {
  clearInterval(interval);
  slideIndex = n;
  showSlides();
  interval = setInterval(showSlides, 3000);
}

interval = setInterval(showSlides, 3000);
