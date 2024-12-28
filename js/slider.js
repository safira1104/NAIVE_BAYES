let currentIndex = 0;

function moveSlide(step) {
   const images = document.querySelectorAll('.slider-images img');
   currentIndex = (currentIndex + step + images.length) % images.length;
   updateSlider();
}

function updateSlider() {
   const images = document.querySelectorAll('.slider-images img');
   images.forEach((img, index) => {
      img.style.display = index === currentIndex ? 'block' : 'none';
   });
}

updateSlider();
