/**
 * Slider Module - Mostay
 * Maneja el slider principal con Slick
 */

class Slider {
    constructor() {
        this.slider = document.querySelector('.home-slider');
        this.config = {
            infinite: true,
            dots: true,
            speed: 300,
            slidesToShow: 1,
            arrows: false,
            autoplay: true,
            autoplaySpeed: 5000,
            pauseOnHover: true,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        dots: true,
                        arrows: false
                    }
                }
            ]
        };
        
        this.init();
    }
    
    init() {
        if (this.slider && typeof $.fn.slick !== 'undefined') {
            this.setupSlider();
            this.setupAccessibility();
            this.setupLazyLoading();
        } else {
            console.warn('Slider: Slick not available or slider element not found');
        }
    }
    
    setupSlider() {
        $(this.slider).slick(this.config);
        
        // Add custom events
        $(this.slider).on('beforeChange', (event, slick, currentSlide, nextSlide) => {
            this.onSlideChange(currentSlide, nextSlide);
        });
        
        $(this.slider).on('afterChange', (event, slick, currentSlide) => {
            this.onSlideChanged(currentSlide);
        });
    }
    
    setupAccessibility() {
        // Add ARIA labels to navigation
        const dots = this.slider.querySelectorAll('.slick-dots li button');
        dots.forEach((dot, index) => {
            dot.setAttribute('aria-label', `Ir a slide ${index + 1}`);
        });
        
        // Add role to slider
        this.slider.setAttribute('role', 'region');
        this.slider.setAttribute('aria-label', 'Slider de imágenes');
        
        // Add live region for screen readers
        const liveRegion = document.createElement('div');
        liveRegion.setAttribute('aria-live', 'polite');
        liveRegion.setAttribute('aria-atomic', 'true');
        liveRegion.className = 'sr-only';
        this.slider.appendChild(liveRegion);
        
        this.liveRegion = liveRegion;
    }
    
    setupLazyLoading() {
        // Intersection Observer for lazy loading
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.removeAttribute('data-src');
                            imageObserver.unobserve(img);
                        }
                    }
                });
            });
            
            // Observe all images in slider
            const images = this.slider.querySelectorAll('img[data-src]');
            images.forEach(img => imageObserver.observe(img));
        }
    }
    
    onSlideChange(currentSlide, nextSlide) {
        // Preload next slide image
        const slides = this.slider.querySelectorAll('.slick-slide');
        if (slides[nextSlide]) {
            const img = slides[nextSlide].querySelector('img');
            if (img && img.dataset.src) {
                img.src = img.dataset.src;
                img.removeAttribute('data-src');
            }
        }
        
        // Update live region for screen readers
        if (this.liveRegion) {
            this.liveRegion.textContent = `Slide ${nextSlide + 1} de ${slides.length}`;
        }
    }
    
    onSlideChanged(currentSlide) {
        // Update active dot aria-label
        const dots = this.slider.querySelectorAll('.slick-dots li');
        dots.forEach((dot, index) => {
            const button = dot.querySelector('button');
            if (index === currentSlide) {
                button.setAttribute('aria-current', 'true');
            } else {
                button.removeAttribute('aria-current');
            }
        });
        
        // Analytics tracking (if needed)
        if (typeof gtag !== 'undefined') {
            gtag('event', 'slider_change', {
                'slide_number': currentSlide + 1
            });
        }
    }
    
    // Public methods
    goToSlide(slideIndex) {
        if (this.slider) {
            $(this.slider).slick('slickGoTo', slideIndex);
        }
    }
    
    pause() {
        if (this.slider) {
            $(this.slider).slick('slickPause');
        }
    }
    
    play() {
        if (this.slider) {
            $(this.slider).slick('slickPlay');
        }
    }
    
    destroy() {
        if (this.slider) {
            $(this.slider).slick('unslick');
        }
    }
}

// Auto-initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    new Slider();
});

// Export for module systems
if (typeof module !== 'undefined' && module.exports) {
    module.exports = Slider;
}
