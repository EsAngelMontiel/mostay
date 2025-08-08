/**
 * Preloader Inteligente - Mostay WordPress Theme
 * Módulo para manejo avanzado del preloader con optimizaciones de rendimiento
 */

class MostayPreloader {
    constructor() {
        this.preloader = null;
        this.progressBar = null;
        this.progressText = null;
        this.statusElement = null;
        this.isLoading = false;
        this.minDisplayTime = 800; // Tiempo mínimo de visualización
        this.maxDisplayTime = 3000; // Tiempo máximo de visualización
        this.startTime = null;
        
        this.init();
    }

    init() {
        this.createPreloader();
        this.setupEventListeners();
        this.startLoading();
    }

    createPreloader() {
        // Crear preloader si no existe
        if (!document.getElementById('preloader')) {
            const preloaderHTML = `
                <div id="preloader" class="preloader" role="status" aria-live="polite" aria-label="Cargando página">
                    <div class="preloader-content">
                        <div class="preloader-logo">
                            <div class="logo-container">
                                <img src="${mostayThemeUrl}/img/mostay-logo.svg" alt="Mostay" class="logo-image" loading="eager">
                                <div class="logo-animation"></div>
                            </div>
                        </div>
                        <div class="preloader-progress">
                            <div class="progress-bar">
                                <div class="progress-fill" id="progress-fill"></div>
                            </div>
                            <div class="progress-text" id="progress-text">Inicializando...</div>
                        </div>
                        <div class="preloader-status" id="preloader-status">
                            <span class="status-icon">⚡</span>
                            <span class="status-text">Optimizando rendimiento...</span>
                        </div>
                    </div>
                    <div class="preloader-background">
                        <div class="background-animation"></div>
                    </div>
                </div>
            `;
            document.body.insertAdjacentHTML('afterbegin', preloaderHTML);
        } else {
            // Actualizar preloader existente
            this.updateExistingPreloader();
        }

        this.preloader = document.getElementById('preloader');
        this.progressBar = document.getElementById('progress-fill');
        this.progressText = document.getElementById('progress-text');
        this.statusElement = document.getElementById('preloader-status');
    }

    updateExistingPreloader() {
        const existingPreloader = document.getElementById('preloader');
        if (existingPreloader) {
            // Reemplazar contenido del preloader existente
            existingPreloader.innerHTML = `
                <div class="preloader-content">
                    <div class="preloader-logo">
                        <div class="logo-container">
                            <img src="${mostayThemeUrl}/img/mostay-logo.svg" alt="Mostay" class="logo-image" loading="eager">
                            <div class="logo-animation"></div>
                        </div>
                    </div>
                    <div class="preloader-progress">
                        <div class="progress-bar">
                            <div class="progress-fill" id="progress-fill"></div>
                        </div>
                        <div class="progress-text" id="progress-text">Inicializando...</div>
                    </div>
                    <div class="preloader-status" id="preloader-status">
                        <span class="status-icon">⚡</span>
                        <span class="status-text">Optimizando rendimiento...</span>
                    </div>
                </div>
                <div class="preloader-background">
                    <div class="background-animation"></div>
                </div>
            `;
        }
    }

    setupEventListeners() {
        // Eventos de carga de recursos
        window.addEventListener('load', () => this.handleWindowLoad());
        document.addEventListener('DOMContentLoaded', () => this.handleDOMContentLoaded());
        
        // Eventos de rendimiento
        if ('performance' in window) {
            window.addEventListener('load', () => this.analyzePerformance());
        }

        // Eventos de conectividad
        if ('navigator' in window && 'connection' in navigator) {
            navigator.connection.addEventListener('change', () => this.handleConnectionChange());
        }

        // Eventos de WordPress
        if (typeof wp !== 'undefined' && wp.ajax) {
            this.setupWordPressEvents();
        }
    }

    setupWordPressEvents() {
        // Interceptar AJAX de WordPress
        const originalAjax = wp.ajax.post;
        wp.ajax.post = (action, data, callback) => {
            this.updateStatus('🔄', 'Procesando solicitud...');
            return originalAjax.call(this, action, data, (response) => {
                this.updateStatus('✅', 'Completado');
                if (callback) callback(response);
            });
        };
    }

    startLoading() {
        this.startTime = Date.now();
        this.isLoading = true;
        this.updateProgress(10, 'Inicializando...');
        
        // Simular progreso inicial
        setTimeout(() => this.updateProgress(25, 'Cargando recursos críticos...'), 200);
        setTimeout(() => this.updateProgress(40, 'Optimizando imágenes...'), 400);
        setTimeout(() => this.updateProgress(60, 'Preparando contenido...'), 600);
        setTimeout(() => this.updateProgress(80, 'Finalizando carga...'), 800);
    }

    updateProgress(percentage, message) {
        if (!this.isLoading) return;

        // Actualizar barra de progreso
        if (this.progressBar) {
            this.progressBar.style.width = `${percentage}%`;
        }

        // Actualizar texto
        if (this.progressText) {
            this.progressText.textContent = message;
        }

        // Actualizar estado para screen readers
        if (this.preloader) {
            this.preloader.setAttribute('aria-label', `Cargando página: ${percentage}% - ${message}`);
        }
    }

    updateStatus(icon, message) {
        if (this.statusElement) {
            const iconElement = this.statusElement.querySelector('.status-icon');
            const textElement = this.statusElement.querySelector('.status-text');
            
            if (iconElement) iconElement.textContent = icon;
            if (textElement) textElement.textContent = message;
        }
    }

    handleDOMContentLoaded() {
        this.updateProgress(50, 'DOM listo...');
        this.updateStatus('🎯', 'Estructura cargada');
    }

    handleWindowLoad() {
        const loadTime = Date.now() - this.startTime;
        const remainingTime = Math.max(0, this.minDisplayTime - loadTime);

        this.updateProgress(90, 'Carga completada...');
        this.updateStatus('✅', 'Página lista');

        // Asegurar tiempo mínimo de visualización
        setTimeout(() => {
            this.hidePreloader();
        }, remainingTime);
    }

    analyzePerformance() {
        if ('performance' in window && 'getEntriesByType' in performance) {
            const navigation = performance.getEntriesByType('navigation')[0];
            const resources = performance.getEntriesByType('resource');
            
            if (navigation) {
                const loadTime = navigation.loadEventEnd - navigation.loadEventStart;
                const domContentLoaded = navigation.domContentLoadedEventEnd - navigation.domContentLoadedEventStart;
                
                // Log performance metrics
                console.log('📊 Performance Metrics:', {
                    'DOM Content Loaded': `${domContentLoaded.toFixed(2)}ms`,
                    'Page Load Time': `${loadTime.toFixed(2)}ms`,
                    'Total Resources': resources.length,
                    'Connection Type': navigator.connection ? navigator.connection.effectiveType : 'unknown'
                });

                // Optimizar basado en métricas
                if (loadTime > 2000) {
                    this.updateStatus('⚠️', 'Carga lenta detectada');
                }
            }
        }
    }

    handleConnectionChange() {
        if (navigator.connection) {
            const connection = navigator.connection;
            const speed = connection.effectiveType || 'unknown';
            
            switch(speed) {
                case 'slow-2g':
                case '2g':
                    this.updateStatus('🐌', 'Conexión lenta detectada');
                    break;
                case '3g':
                    this.updateStatus('📶', 'Conexión 3G');
                    break;
                case '4g':
                    this.updateStatus('🚀', 'Conexión rápida');
                    break;
                default:
                    this.updateStatus('⚡', 'Conexión optimizada');
            }
        }
    }

    hidePreloader() {
        if (!this.preloader) return;

        this.isLoading = false;
        
        // Animación de salida
        this.preloader.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
        this.preloader.style.opacity = '0';
        this.preloader.style.transform = 'scale(0.95)';

        // Eliminar del DOM después de la animación
        setTimeout(() => {
            if (this.preloader && this.preloader.parentNode) {
                this.preloader.parentNode.removeChild(this.preloader);
            }
            
            // Disparar evento personalizado
            window.dispatchEvent(new CustomEvent('preloaderHidden'));
            
            // Optimizar después de ocultar preloader
            this.optimizeAfterLoad();
        }, 500);
    }

    optimizeAfterLoad() {
        // Lazy load imágenes no críticas
        this.lazyLoadImages();
        
        // Preload recursos importantes
        this.preloadImportantResources();
        
        // Optimizar scroll
        this.optimizeScroll();
    }

    lazyLoadImages() {
        const images = document.querySelectorAll('img[data-src]');
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    observer.unobserve(img);
                }
            });
        });

        images.forEach(img => imageObserver.observe(img));
    }

    preloadImportantResources() {
        // Preload CSS crítico
        const criticalCSS = document.createElement('link');
        criticalCSS.rel = 'preload';
        criticalCSS.as = 'style';
        criticalCSS.href = mostayThemeUrl + '/css/critical.css';
        document.head.appendChild(criticalCSS);

        // Preload fuentes importantes
        const fontPreload = document.createElement('link');
        fontPreload.rel = 'preload';
        fontPreload.as = 'font';
        fontPreload.crossOrigin = 'anonymous';
        fontPreload.href = 'https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap';
        document.head.appendChild(fontPreload);
    }

    optimizeScroll() {
        // Optimizar scroll performance
        let ticking = false;
        
        function updateScroll() {
            ticking = false;
            // Aquí se pueden agregar optimizaciones de scroll
        }

        function requestTick() {
            if (!ticking) {
                requestAnimationFrame(updateScroll);
                ticking = true;
            }
        }

        window.addEventListener('scroll', requestTick, { passive: true });
    }

    // Métodos públicos para control externo
    show() {
        if (this.preloader) {
            this.preloader.style.display = 'flex';
            this.isLoading = true;
        }
    }

    hide() {
        this.hidePreloader();
    }

    setProgress(percentage, message) {
        this.updateProgress(percentage, message);
    }

    setStatus(icon, message) {
        this.updateStatus(icon, message);
    }
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    window.mostayPreloader = new MostayPreloader();
});

// Exportar para uso global
window.MostayPreloader = MostayPreloader;
