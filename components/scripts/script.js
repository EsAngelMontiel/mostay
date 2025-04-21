$(document).ready(function(){

  const btnOpen = document.querySelector('#btnOpen');
  const btnClose = document.querySelector('#btnClose');
  const topNavMenu = document.querySelector('.topnav__navigation__menu');
  //const scrollBody = document.querySelector('body');

  

  topNavMenu.style.transition = 'none';

  function openMobileMenu(){
    btnOpen.setAttribute('aria-expanded', 'true');
    topNavMenu.removeAttribute('inert');
    topNavMenu.removeAttribute('style');
    //scrollBody.classList.add('no-scroll');
  }

  function closeMobileMenu(){
    btnOpen.setAttribute('aria-expanded', 'false');
    topNavMenu.setAttribute('inert', '');
    //scrollBody.classList.remove('no-scroll');
    setTimeout(() => {
      topNavMenu.style.transition = 'none';
    }, 500);
  }

  btnOpen.addEventListener('click', openMobileMenu);
  btnClose.addEventListener('click', closeMobileMenu);

  function handleStickyImage() {
    const imageContainer = document.querySelector(".image-container");
    const textContainer = document.querySelector(".text-container");
  
    if (window.innerWidth <= 700) {
      imageContainer.style.position = "relative";
      imageContainer.style.top = "auto";
      imageContainer.style.bottom = "auto";
      return;
    }
  
    const textRect = textContainer.getBoundingClientRect();
    const viewportHeight = window.innerHeight;
  
    if (textRect.top < 0 && textRect.bottom > viewportHeight) {
      imageContainer.style.position = "sticky";
      imageContainer.style.top = "1rem";
      imageContainer.style.bottom = "auto";
    } else if (textRect.bottom <= viewportHeight) {
      imageContainer.style.position = "relative";
      imageContainer.style.top = "auto";
      imageContainer.style.bottom = "0";
    } else {
      imageContainer.style.position = "sticky";
      imageContainer.style.top = "1rem";
      imageContainer.style.bottom = "auto";
    }
  }
  
  document.addEventListener("scroll", handleStickyImage);
  window.addEventListener("resize", handleStickyImage); // Asegura el ajuste al redimensionar la ventana
  
  
  


  

  // slider

  $('.home-slider').slick({
    infinite: true,
    dots: true,
    speed: 500,
    slidesToShow: 1,
    arrows: false,
    autoplay: true,
  });


});

// Preloader Code /*
window.addEventListener("load", () => {
  const preloader = document.getElementById("preloader");
  setTimeout(() => {
    preloader.style.transition = "opacity 1s ease"; // Suaviza el fade-out
    preloader.style.opacity = "0"; // Desaparece lentamente
    setTimeout(() => {
      preloader.style.display = "none"; // Elimina del DOM tras el fade-out
    }, 1000); // Duración del fade-out (1s)
  }, 500); // Delay antes de comenzar el fade-out (0.5s)
});

