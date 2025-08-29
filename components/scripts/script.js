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
    const scrollContainer = document.querySelector(".scroll-container");
    const textContainer = document.querySelector(".text-container");
  
    // Si los elementos no existen, no hacer nada.
    if (!scrollContainer || !textContainer) return;
  
    const textRect = textContainer.getBoundingClientRect();
    const viewportHeight = window.innerHeight;
  
    // Añade o quita la clase 'is-sticky' al contenedor principal
    // basado en si el contenedor de texto está visible en el viewport.
    if (textRect.top < 0 && textRect.bottom > viewportHeight) {
      scrollContainer.classList.add("is-sticky");
    } else {
      scrollContainer.classList.remove("is-sticky");
    }
  }
  
  document.addEventListener("scroll", handleStickyImage);
  window.addEventListener("resize", handleStickyImage); // Asegura el ajuste al redimensionar la ventana
  
  
  


  // FAQs Accordion
  (function(){
    const container = document.getElementById('faqsAccordion');
    if(!container) return;

    container.addEventListener('click', function(e){
      const button = e.target.closest('.faq-item__question');
      if(!button) return;
      const expanded = button.getAttribute('aria-expanded') === 'true';
      const panel = button.nextElementSibling;
      if(!panel) return;

      // toggle estado
      button.setAttribute('aria-expanded', (!expanded).toString());
      panel.hidden = expanded;

      // Icono + / −
      const icon = button.querySelector('.faq-item__icon');
      if(icon){
        const open = icon.getAttribute('data-icon-open') || '−';
        const closed = icon.getAttribute('data-icon-closed') || '+';
        icon.textContent = expanded ? closed : open;
      }
    });
  })();
  

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

