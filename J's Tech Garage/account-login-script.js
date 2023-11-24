var slideIndex = 0;
var slides = document.getElementsByClassName("racerSlide");
var interval;

showSlides();

function showSlides() {
  for (var i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }

  slideIndex++;
  if (slideIndex > slides.length) {
    slideIndex = 1;
  }

  slides[slideIndex - 1].style.display = "block";
}

function plusSlides(n) {
  clearInterval(interval);
  showSlides((slideIndex += n));
  interval = setInterval(showSlides, 3000);
}

function currentSlide(n) {
  clearInterval(interval);
  showSlides((slideIndex = n));
  interval = setInterval(showSlides, 3000);
}

interval = setInterval(showSlides, 3000);


