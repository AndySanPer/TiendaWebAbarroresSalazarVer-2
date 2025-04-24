document.addEventListener('DOMContentLoaded', function () {
  const carouselSlide = document.querySelector('.carousel-slide');
  const carouselImages = document.querySelectorAll('.carousel-slide img');

  let counter = 0;

  // Ajustar el ancho del contenedor dinámicamente
  carouselSlide.style.width = `${carouselImages.length * 100}%`;

  function moveToSlide() {
      let slideWidth = document.querySelector('.carousel-container').clientWidth; // Obtener el ancho real del contenedor
      carouselSlide.style.transition = "transform 0.5s ease-in-out";
      carouselSlide.style.transform = `translateX(${-slideWidth * counter}px)`;
  }

  // Botones de navegación
  const nextBtn = document.querySelector('.next-btn');
  const prevBtn = document.querySelector('.prev-btn');

  nextBtn.addEventListener('click', function () {
      if (counter >= carouselImages.length - 1) return;
      counter++;
      moveToSlide();
  });

  prevBtn.addEventListener('click', function () {
      if (counter <= 0) return;
      counter--;
      moveToSlide();
  });

  // Asegurar que las imágenes se ajusten al redimensionar la ventana
  window.addEventListener('resize', moveToSlide);
});

  