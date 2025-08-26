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
        
        // Fallback para móviles: forzar animaciones críticas después de un delay
        this.setupMobileFallback();
    }

    setupAnimations() {
        try {
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
            
            // Fallback en desktop: forzar animaciones de elementos ya visibles en el viewport
            // Este caso cubre escenarios donde el IO no dispara inmediatamente en carga inicial
            if (window.innerWidth > 700) {
                // En DOM listo
                this.forceVisibleInViewport();
                // Tras un pequeño delay por si hay fonts/imágenes que ajustan layout
                setTimeout(() => this.forceVisibleInViewport(), 600);
            }
            
            // Asegurar tras carga completa de recursos
            window.addEventListener('load', () => {
                if (window.innerWidth > 700) {
                    this.forceVisibleInViewport();
                }
            });
            
            // Manejar redimensionamiento de ventana
            window.addEventListener('resize', () => this.handleResize());
            
            // Manejar cambio de orientación en móviles
            window.addEventListener('orientationchange', () => {
                setTimeout(() => this.handleResize(), 100);
            });
            
            // Debug: log de elementos encontrados
            if (window.innerWidth <= 700) {
                this.debugMobileAnimations();
            }
        } catch (error) {
            console.warn('Error en setupAnimations:', error);
            // Fallback: forzar todas las animaciones
            this.forceAllAnimations();
        }
    }

    debugMobileAnimations() {
        const animatedElements = document.querySelectorAll('[data-animate]');
        console.log(`📱 Móvil detectado: ${animatedElements.length} elementos con animación encontrados`);
        
        animatedElements.forEach((el, index) => {
            console.log(`  ${index + 1}. ${el.tagName} - ${el.dataset.animate} - Visible: ${el.offsetParent !== null}`);
        });
    }

    forceAllAnimations() {
        console.log('🔄 Forzando todas las animaciones (fallback)');
        document.querySelectorAll('[data-animate]').forEach(el => {
            if (!this.animatedElements.has(el)) {
                this.animateElement(el, el.dataset.animate);
                this.animatedElements.add(el);
            }
        });
    }

    setupMobileFallback() {
        // En móviles, forzar las animaciones críticas después de 1 segundo
        // Esto asegura que el contenido sea visible incluso si el Intersection Observer falla
        setTimeout(() => {
            if (window.innerWidth <= 700) {
                this.forceCriticalAnimations();
            }
        }, 1000);
        
        // También forzar en cambio de orientación
        window.addEventListener('orientationchange', () => {
            setTimeout(() => {
                if (window.innerWidth <= 700) {
                    this.forceCriticalAnimations();
                }
            }, 500);
        });
    }

    forceCriticalAnimations() {
        // Forzar animaciones de elementos críticos que deben ser visibles
        const criticalSelectors = [
            '[data-animate="fade-in"]',
            '[data-animate="slide-up"]',
            '[data-animate="slide-left"]',
            '[data-animate="slide-right"]',
            '[data-animate="stagger"]'
        ];
        
        criticalSelectors.forEach(selector => {
            document.querySelectorAll(selector).forEach(el => {
                if (!this.animatedElements.has(el)) {
                    this.animateElement(el, el.dataset.animate);
                    this.animatedElements.add(el);
                }
            });
        });
        
        // Para elementos typing, asegurar que sean visibles
        document.querySelectorAll('[data-animate="typing"]').forEach(el => {
            if (!this.animatedElements.has(el)) {
                // En móviles, hacer el texto visible inmediatamente si no se ha animado
                if (window.innerWidth <= 700) {
                    el.style.visibility = 'visible';
                    el.style.opacity = '1';
                    el.style.transform = 'none';
                    this.animatedElements.add(el);
                }
            }
        });
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
        
        // Establecer el ancho del elemento original (responsive)
        if (window.innerWidth <= 700) {
            // En móvil, usar 90% del ancho del contenedor para dejar aire
            element.style.width = '90%';
            element.style.maxWidth = '90%';
        } else {
            // En desktop, usar el ancho calculado
            element.style.width = fullWidth + 'px';
        }
        // NO fijar altura - dejar que se ajuste al contenido naturalmente
        // element.style.height = fullHeight + 'px'; // ❌ Comentado para permitir altura natural
        // Esto permite que el h1 mantenga su margin-bottom natural y empuje el texto hacia abajo
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
        
        // Ajustar elementos typing existentes al nuevo tamaño de ventana
        this.adjustTypingElements();

        // Fallback: tras resize, forzar los que estén visibles
        this.forceVisibleInViewport();
    }
    
    adjustTypingElements() {
        // Ajustar elementos typing existentes al nuevo tamaño de ventana
        document.querySelectorAll('[data-animate="typing"]').forEach(el => {
            if (el.style.width && el.style.width !== '90%') {
                if (window.innerWidth <= 700) {
                    el.style.width = '90%';
                    el.style.maxWidth = '90%';
                } else {
                    // Recalcular el ancho en desktop
                    const text = el.getAttribute('data-original-text') || el.textContent;
                    const tempElement = document.createElement(el.tagName);
                    tempElement.style.position = 'absolute';
                    tempElement.style.visibility = 'hidden';
                    tempElement.style.width = 'auto';
                    tempElement.style.height = 'auto';
                    tempElement.style.whiteSpace = 'nowrap';
                    tempElement.textContent = text;
                    tempElement.className = el.className;
                    
                    document.body.appendChild(tempElement);
                    const fullWidth = tempElement.offsetWidth;
                    document.body.removeChild(tempElement);
                    
                    el.style.width = fullWidth + 'px';
                }
            }
        });
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

    // Determinar si un elemento está visible en el viewport
    isElementInViewport(el) {
        const rect = el.getBoundingClientRect();
        const vh = (window.innerHeight || document.documentElement.clientHeight);
        const vw = (window.innerWidth || document.documentElement.clientWidth);
        // Considerar visible si hay una intersección razonable
        const verticallyVisible = rect.top < vh && rect.bottom > 0;
        const horizontallyVisible = rect.left < vw && rect.right > 0;
        return verticallyVisible && horizontallyVisible;
    }

    // Forzar animación de elementos ya visibles en el viewport pero aún no animados
    forceVisibleInViewport() {
        try {
            const candidates = document.querySelectorAll('[data-animate]');
            candidates.forEach(el => {
                if (!this.animatedElements.has(el) && this.isElementInViewport(el)) {
                    const type = el.dataset.animate;
                    this.animateElement(el, type);
                    this.animatedElements.add(el);
                }
            });
        } catch (e) {
            // En caso de error, como último recurso, forzar todas
            this.forceAllAnimations();
        }
    }
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    window.scrollAnimations = new ScrollAnimations();
});

// Exportar para uso global
window.ScrollAnimations = ScrollAnimations;
