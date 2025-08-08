/**
 * Main Application - Mostay
 * Punto de entrada principal para todos los módulos
 */

// Import modules (in a real build, these would be ES6 imports)
// import { Navigation } from './modules/navigation.js';
// import { Slider } from './modules/slider.js';
// import { Performance } from './modules/performance.js';

class MostayApp {
    constructor() {
        this.modules = {};
        this.init();
    }
    
    init() {
        // Wait for DOM and dependencies
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.start());
        } else {
            this.start();
        }
    }
    
    start() {
        console.log('🚀 Iniciando Mostay App...');
        
        // Initialize modules
        this.initModules();
        
        // Setup global error handling
        this.setupErrorHandling();
        
        // Setup analytics
        this.setupAnalytics();
        
        console.log('✅ Mostay App iniciado correctamente');
    }
    
    initModules() {
        // Navigation module
        if (typeof Navigation !== 'undefined') {
            this.modules.navigation = new Navigation();
        }
        
        // Slider module (requires jQuery and Slick)
        if (typeof Slider !== 'undefined' && typeof $ !== 'undefined') {
            // Wait for jQuery and Slick to be ready
            this.waitForDependencies(['$', '$.fn.slick'], () => {
                this.modules.slider = new Slider();
            });
        }
        
        // Performance module
        if (typeof Performance !== 'undefined') {
            this.modules.performance = new Performance();
        }
        
        // PWA module
        if (typeof PWA !== 'undefined') {
            this.modules.pwa = new PWA();
        }
        
        // Analytics module
        if (typeof Analytics !== 'undefined') {
            this.modules.analytics = new Analytics();
        }
        
        // Performance Budget module
        if (typeof PerformanceBudget !== 'undefined') {
            this.modules.performanceBudget = new PerformanceBudget();
        }
        
        // I18n module
        if (typeof I18n !== 'undefined') {
            this.modules.i18n = new I18n();
        }
        
        // SEO module
        if (typeof SEO !== 'undefined') {
            this.modules.seo = new SEO();
        }
        
        // Testing module
        if (typeof Testing !== 'undefined') {
            this.modules.testing = new Testing();
        }
        
        // Preloader module
        if (typeof Preloader !== 'undefined') {
            this.modules.preloader = new Preloader();
        }
    }
    
    waitForDependencies(dependencies, callback) {
        const checkDependencies = () => {
            const allReady = dependencies.every(dep => {
                const parts = dep.split('.');
                let obj = window;
                for (const part of parts) {
                    if (obj && obj[part]) {
                        obj = obj[part];
                    } else {
                        return false;
                    }
                }
                return true;
            });
            
            if (allReady) {
                callback();
            } else {
                setTimeout(checkDependencies, 100);
            }
        };
        
        checkDependencies();
    }
    
    setupErrorHandling() {
        // Global error handler
        window.addEventListener('error', (event) => {
            console.error('❌ Error global:', event.error);
            
            // Send to analytics if available
            if (typeof gtag !== 'undefined') {
                gtag('event', 'exception', {
                    'description': event.error.message,
                    'fatal': false
                });
            }
        });
        
        // Unhandled promise rejections
        window.addEventListener('unhandledrejection', (event) => {
            console.error('❌ Promise rejection no manejada:', event.reason);
            
            // Send to analytics if available
            if (typeof gtag !== 'undefined') {
                gtag('event', 'exception', {
                    'description': event.reason,
                    'fatal': false
                });
            }
        });
    }
    
    setupAnalytics() {
        // Google Analytics setup (if available)
        if (typeof gtag !== 'undefined') {
            gtag('config', 'GA_MEASUREMENT_ID', {
                'page_title': document.title,
                'page_location': window.location.href
            });
        }
        
        // Custom analytics events
        this.setupCustomAnalytics();
    }
    
    setupCustomAnalytics() {
        // Track button clicks
        document.addEventListener('click', (event) => {
            const button = event.target.closest('button, a');
            if (button && button.dataset.track) {
                this.trackEvent('button_click', {
                    'button_text': button.textContent.trim(),
                    'button_id': button.id || button.className
                });
            }
        });
        
        // Track form submissions
        document.addEventListener('submit', (event) => {
            const form = event.target;
            if (form.dataset.track) {
                this.trackEvent('form_submit', {
                    'form_id': form.id || form.className,
                    'form_action': form.action
                });
            }
        });
        
        // Track scroll depth
        let maxScroll = 0;
        const trackScroll = () => {
            const scrollPercent = Math.round((window.scrollY / (document.body.scrollHeight - window.innerHeight)) * 100);
            if (scrollPercent > maxScroll) {
                maxScroll = scrollPercent;
                if (maxScroll % 25 === 0) { // Track every 25%
                    this.trackEvent('scroll_depth', {
                        'scroll_percent': maxScroll
                    });
                }
            }
        };
        
        window.addEventListener('scroll', this.debounce(trackScroll, 100));
    }
    
    trackEvent(eventName, parameters = {}) {
        console.log(`📊 Event: ${eventName}`, parameters);
        
        if (typeof gtag !== 'undefined') {
            gtag('event', eventName, parameters);
        }
    }
    
    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func.apply(this, args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
    
    // Public API
    getModule(name) {
        return this.modules[name];
    }
    
    destroy() {
        // Cleanup modules
        Object.values(this.modules).forEach(module => {
            if (module && typeof module.destroy === 'function') {
                module.destroy();
            }
        });
        
        // Cleanup performance module
        if (this.modules.performance) {
            this.modules.performance.cleanup();
        }
        
        console.log('🔄 Mostay App destruido');
    }
}

// Initialize app
const app = new MostayApp();

// Make app globally available
window.MostayApp = app;

// Export for module systems
if (typeof module !== 'undefined' && module.exports) {
    module.exports = MostayApp;
}
