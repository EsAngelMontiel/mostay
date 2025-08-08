/**
 * Performance Module - Mostay
 * Optimizaciones de rendimiento y monitoreo
 */

class Performance {
    constructor() {
        this.metrics = {};
        this.init();
    }
    
    init() {
        this.setupPerformanceMonitoring();
        this.setupResourceHints();
        this.setupIntersectionObserver();
        this.setupServiceWorker();
    }
    
    setupPerformanceMonitoring() {
        // Monitor Core Web Vitals
        if ('PerformanceObserver' in window) {
            // LCP (Largest Contentful Paint)
            const lcpObserver = new PerformanceObserver((list) => {
                const entries = list.getEntries();
                const lastEntry = entries[entries.length - 1];
                this.metrics.lcp = lastEntry.startTime;
                this.logMetric('LCP', lastEntry.startTime);
            });
            lcpObserver.observe({ entryTypes: ['largest-contentful-paint'] });
            
            // FID (First Input Delay)
            const fidObserver = new PerformanceObserver((list) => {
                const entries = list.getEntries();
                entries.forEach(entry => {
                    this.metrics.fid = entry.processingStart - entry.startTime;
                    this.logMetric('FID', this.metrics.fid);
                });
            });
            fidObserver.observe({ entryTypes: ['first-input'] });
            
            // CLS (Cumulative Layout Shift)
            const clsObserver = new PerformanceObserver((list) => {
                let clsValue = 0;
                const entries = list.getEntries();
                entries.forEach(entry => {
                    if (!entry.hadRecentInput) {
                        clsValue += entry.value;
                    }
                });
                this.metrics.cls = clsValue;
                this.logMetric('CLS', clsValue);
            });
            clsObserver.observe({ entryTypes: ['layout-shift'] });
        }
        
        // Monitor page load time
        window.addEventListener('load', () => {
            const loadTime = performance.now();
            this.metrics.loadTime = loadTime;
            this.logMetric('Page Load Time', loadTime);
        });
    }
    
    setupResourceHints() {
        // Preload critical resources
        const criticalResources = [
            '/css/main.css',
            '/js/script-min.js',
            '/img/logo.webp'
        ];
        
        criticalResources.forEach(resource => {
            const link = document.createElement('link');
            link.rel = 'preload';
            link.href = resource;
            link.as = this.getResourceType(resource);
            document.head.appendChild(link);
        });
        
        // DNS prefetch for external domains
        const externalDomains = [
            'https://code.jquery.com',
            'https://kit.fontawesome.com',
            'https://fonts.googleapis.com'
        ];
        
        externalDomains.forEach(domain => {
            const link = document.createElement('link');
            link.rel = 'dns-prefetch';
            link.href = domain;
            document.head.appendChild(link);
        });
    }
    
    setupIntersectionObserver() {
        // Lazy load images and components
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const element = entry.target;
                        
                        // Lazy load images
                        if (element.tagName === 'IMG' && element.dataset.src) {
                            element.src = element.dataset.src;
                            element.removeAttribute('data-src');
                            observer.unobserve(element);
                        }
                        
                        // Lazy load components
                        if (element.dataset.lazyComponent) {
                            this.loadComponent(element.dataset.lazyComponent, element);
                            observer.unobserve(element);
                        }
                    }
                });
            }, {
                rootMargin: '50px'
            });
            
            // Observe lazy elements
            document.querySelectorAll('[data-src], [data-lazy-component]').forEach(el => {
                observer.observe(el);
            });
        }
    }
    
    setupServiceWorker() {
        // Register service worker for caching
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then(registration => {
                        console.log('SW registered: ', registration);
                    })
                    .catch(registrationError => {
                        console.log('SW registration failed: ', registrationError);
                    });
            });
        }
    }
    
    getResourceType(resource) {
        if (resource.endsWith('.css')) return 'style';
        if (resource.endsWith('.js')) return 'script';
        if (resource.endsWith('.webp') || resource.endsWith('.jpg') || resource.endsWith('.png')) return 'image';
        return 'fetch';
    }
    
    loadComponent(componentName, container) {
        // Dynamic component loading
        fetch(`/components/${componentName}.html`)
            .then(response => response.text())
            .then(html => {
                container.innerHTML = html;
                container.removeAttribute('data-lazy-component');
            })
            .catch(error => {
                console.error('Error loading component:', error);
            });
    }
    
    logMetric(name, value) {
        console.log(`📊 ${name}: ${value.toFixed(2)}ms`);
        
        // Send to analytics if available
        if (typeof gtag !== 'undefined') {
            gtag('event', 'performance_metric', {
                'metric_name': name,
                'metric_value': value
            });
        }
    }
    
    // Performance optimization methods
    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
    
    throttle(func, limit) {
        let inThrottle;
        return function() {
            const args = arguments;
            const context = this;
            if (!inThrottle) {
                func.apply(context, args);
                inThrottle = true;
                setTimeout(() => inThrottle = false, limit);
            }
        };
    }
    
    // Memory management
    cleanup() {
        // Remove event listeners
        window.removeEventListener('resize', this.debouncedResize);
        window.removeEventListener('scroll', this.throttledScroll);
        
        // Clear intervals
        if (this.intervals) {
            this.intervals.forEach(interval => clearInterval(interval));
        }
    }
}

// Auto-initialize
document.addEventListener('DOMContentLoaded', () => {
    window.performanceModule = new Performance();
});

// Export for module systems
if (typeof module !== 'undefined' && module.exports) {
    module.exports = Performance;
}
