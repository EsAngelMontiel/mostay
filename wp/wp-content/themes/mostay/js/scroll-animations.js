/**
 * Scroll Animations - Mostay WordPress Theme
 * Sistema de animaciones sutiles para elementos que aparecen en scroll
 */

class ScrollAnimations {
    constructor() {
        this.animatedElements = new Set();
        this.animationTypes = {
            'fade-in': {
                class: 'animate-fade-in',
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            },
            'slide-up': {
                class: 'animate-slide-up',
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            },
            'slide-left': {
                class: 'animate-slide-left',
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            },
            'slide-right': {
                class: 'animate-slide-right',
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            },
            'scale-in': {
                class: 'animate-scale-in',
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            },
            'stagger': {
                class: 'animate-stagger',
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            },
            'typing': {
                class: 'animate-typing',
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            }
        };
        
        this.init();
    }

    init() {
        // Esperar a que el DOM esté listo
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.setupAnimations());
        } else {
            this.setupAnimations();
        }
    }

    setupAnimations() {
        // Configurar Intersection Observer
        this.observer = new IntersectionObserver(
            (entries) => this.handleIntersection(entries),
            {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            }
        );

        // Observar elementos con animaciones
        this.observeElements();
        
        // Manejar redimensionamiento de ventana
        window.addEventListener('resize', () => this.handleResize());
    }

    observeElements() {
        // Elementos con animación fade-in
        document.querySelectorAll('[data-animate="fade-in"]').forEach(el => {
            this.observer.observe(el);
        });

        // Elementos con animación slide-up
        document.querySelectorAll('[data-animate="slide-up"]').forEach(el => {
            this.observer.observe(el);
        });

        // Elementos con animación slide-left
        document.querySelectorAll('[data-animate="slide-left"]').forEach(el => {
            this.observer.observe(el);
        });

        // Elementos con animación slide-right
        document.querySelectorAll('[data-animate="slide-right"]').forEach(el => {
            this.observer.observe(el);
        });

        // Elementos con animación scale-in
        document.querySelectorAll('[data-animate="scale-in"]').forEach(el => {
            this.observer.observe(el);
        });

        // Elementos con animación stagger (para listas)
        document.querySelectorAll('[data-animate="stagger"]').forEach(el => {
            this.observer.observe(el);
        });

        // Elementos con animación typing
        document.querySelectorAll('[data-animate="typing"]').forEach(el => {
            this.observer.observe(el);
        });
    }

    handleIntersection(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting && !this.animatedElements.has(entry.target)) {
                const animationType = entry.target.dataset.animate;
                this.animateElement(entry.target, animationType);
                this.animatedElements.add(entry.target);
            }
        });
    }

    animateElement(element, animationType) {
        if (!animationType || !this.animationTypes[animationType]) {
            return;
        }

        const config = this.animationTypes[animationType];
        
        // Aplicar clase de animación
        element.classList.add(config.class);

        // Para animaciones stagger, animar elementos hijos
        if (animationType === 'stagger') {
            this.animateStaggerChildren(element);
        }

        // Para animaciones typing, iniciar el efecto de escritura
        if (animationType === 'typing') {
            this.animateTyping(element);
        }

        // Remover atributo data-animate después de la animación
        setTimeout(() => {
            element.removeAttribute('data-animate');
        }, 1000);
    }

    animateStaggerChildren(parent) {
        const children = parent.querySelectorAll('[data-stagger-item]');
        children.forEach((child, index) => {
            setTimeout(() => {
                child.classList.add('animate-fade-in');
            }, index * 150); // 150ms de delay entre cada elemento
        });
    }

    animateTyping(element) {
        const text = element.textContent;
        
        // Guardar el texto original en un atributo data
        element.setAttribute('data-original-text', text);
        
        // Crear un contenedor invisible con el texto completo para calcular dimensiones
        const tempElement = document.createElement(element.tagName);
        tempElement.style.position = 'absolute';
        tempElement.style.visibility = 'hidden';
        tempElement.style.width = 'auto';
        tempElement.style.height = 'auto';
        tempElement.style.whiteSpace = 'nowrap';
        tempElement.textContent = text;
        tempElement.className = element.className;
        
        // Agregar temporalmente al DOM para medir
        document.body.appendChild(tempElement);
        const fullWidth = tempElement.offsetWidth;
        const fullHeight = tempElement.offsetHeight;
        document.body.removeChild(tempElement);
        
        // Establecer el ancho fijo del elemento original
        element.style.width = fullWidth + 'px';
        element.style.height = fullHeight + 'px';
        element.style.overflow = 'hidden';
        element.style.whiteSpace = 'nowrap';
        
        // Limpiar el texto y preparar para la animación
        element.textContent = '';
        element.style.visibility = 'visible';
        
        let index = 0;
        // Velocidad de escritura en ms - 20% más rápido para h1, 50% más rápido para h2
        const isH1 = element.tagName === 'H1';
        const typeSpeed = isH1 ? 40 : 25; // 50ms -> 40ms (20% más rápido), 50ms -> 25ms (50% más rápido)
        
        const typeNextChar = () => {
            if (index < text.length) {
                element.textContent += text.charAt(index);
                index++;
                setTimeout(typeNextChar, typeSpeed);
            } else {
                // Restaurar estilos cuando termine la animación
                setTimeout(() => {
                    element.style.overflow = '';
                    element.style.whiteSpace = '';
                    element.removeAttribute('data-original-text');
                }, 100);
            }
        };
        
        typeNextChar();
    }

    handleResize() {
        // Re-observar elementos en caso de redimensionamiento
        this.observer.disconnect();
        this.animatedElements.clear();
        this.observeElements();
    }

    // Método público para animar elementos manualmente
    animateElementNow(element, animationType) {
        this.animateElement(element, animationType);
        this.animatedElements.add(element);
    }

    // Método para resetear animaciones (útil para testing)
    resetAnimations() {
        this.observer.disconnect();
        this.animatedElements.clear();
        
        // Remover clases de animación
        document.querySelectorAll('[data-animate]').forEach(el => {
            el.classList.remove('animate-fade-in', 'animate-slide-up', 'animate-slide-left', 'animate-slide-right', 'animate-scale-in');
        });
        
        // Re-observar elementos
        this.observeElements();
    }
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    window.scrollAnimations = new ScrollAnimations();
});

// Exportar para uso global
window.ScrollAnimations = ScrollAnimations;
