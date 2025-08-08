/**
 * Analytics Module - Mostay
 * Analytics avanzado y tracking de comportamiento
 */

class Analytics {
    constructor() {
        this.events = [];
        this.session = this.generateSessionId();
        this.startTime = Date.now();
        this.pageViews = 0;
        this.interactions = 0;
        
        this.init();
    }
    
    init() {
        this.setupPageTracking();
        this.setupUserBehavior();
        this.setupPerformanceTracking();
        this.setupConversionTracking();
        this.setupHeatmapData();
        this.setupA/BTesting();
    }
    
    setupPageTracking() {
        // Track page views
        this.trackPageView();
        
        // Track navigation
        this.trackNavigation();
        
        // Track scroll depth
        this.trackScrollDepth();
        
        // Track time on page
        this.trackTimeOnPage();
    }
    
    setupUserBehavior() {
        // Track clicks
        document.addEventListener('click', (e) => {
            this.trackClick(e);
        });
        
        // Track form interactions
        document.addEventListener('submit', (e) => {
            this.trackFormSubmit(e);
        });
        
        // Track mouse movements (heatmap)
        document.addEventListener('mousemove', this.debounce((e) => {
            this.trackMouseMovement(e);
        }, 100));
        
        // Track keyboard interactions
        document.addEventListener('keydown', (e) => {
            this.trackKeyboard(e);
        });
    }
    
    setupPerformanceTracking() {
        // Track Core Web Vitals
        if ('PerformanceObserver' in window) {
            // LCP
            const lcpObserver = new PerformanceObserver((list) => {
                const entries = list.getEntries();
                const lastEntry = entries[entries.length - 1];
                this.trackMetric('LCP', lastEntry.startTime);
            });
            lcpObserver.observe({ entryTypes: ['largest-contentful-paint'] });
            
            // FID
            const fidObserver = new PerformanceObserver((list) => {
                const entries = list.getEntries();
                entries.forEach(entry => {
                    const fid = entry.processingStart - entry.startTime;
                    this.trackMetric('FID', fid);
                });
            });
            fidObserver.observe({ entryTypes: ['first-input'] });
            
            // CLS
            const clsObserver = new PerformanceObserver((list) => {
                let clsValue = 0;
                const entries = list.getEntries();
                entries.forEach(entry => {
                    if (!entry.hadRecentInput) {
                        clsValue += entry.value;
                    }
                });
                this.trackMetric('CLS', clsValue);
            });
            clsObserver.observe({ entryTypes: ['layout-shift'] });
        }
        
        // Track resource loading
        window.addEventListener('load', () => {
            const loadTime = performance.now();
            this.trackMetric('Page Load Time', loadTime);
            
            // Track resource timing
            const resources = performance.getEntriesByType('resource');
            resources.forEach(resource => {
                this.trackResourceTiming(resource);
            });
        });
    }
    
    setupConversionTracking() {
        // Track goal completions
        this.trackGoals();
        
        // Track funnel steps
        this.trackFunnel();
        
        // Track engagement
        this.trackEngagement();
    }
    
    setupHeatmapData() {
        // Collect heatmap data
        this.collectHeatmapData();
        
        // Track element visibility
        this.trackElementVisibility();
    }
    
    setupA/BTesting() {
        // Initialize A/B testing
        this.initABTesting();
        
        // Track experiment variations
        this.trackExperiments();
    }
    
    // Page tracking methods
    trackPageView() {
        const pageData = {
            url: window.location.href,
            title: document.title,
            referrer: document.referrer,
            timestamp: Date.now(),
            session: this.session
        };
        
        this.sendEvent('page_view', pageData);
        this.pageViews++;
    }
    
    trackNavigation() {
        // Track internal navigation
        document.addEventListener('click', (e) => {
            const link = e.target.closest('a');
            if (link && link.href && link.href.startsWith(window.location.origin)) {
                this.sendEvent('internal_navigation', {
                    from: window.location.pathname,
                    to: link.href,
                    text: link.textContent.trim()
                });
            }
        });
    }
    
    trackScrollDepth() {
        let maxScroll = 0;
        const trackScroll = () => {
            const scrollPercent = Math.round((window.scrollY / (document.body.scrollHeight - window.innerHeight)) * 100);
            if (scrollPercent > maxScroll) {
                maxScroll = scrollPercent;
                if (maxScroll % 25 === 0) {
                    this.sendEvent('scroll_depth', {
                        depth: maxScroll,
                        page: window.location.pathname
                    });
                }
            }
        };
        
        window.addEventListener('scroll', this.debounce(trackScroll, 100));
    }
    
    trackTimeOnPage() {
        // Track time on page
        setInterval(() => {
            const timeOnPage = Date.now() - this.startTime;
            this.sendEvent('time_on_page', {
                time: timeOnPage,
                page: window.location.pathname
            });
        }, 30000); // Every 30 seconds
    }
    
    // User behavior tracking
    trackClick(e) {
        const element = e.target;
        const clickData = {
            element: element.tagName.toLowerCase(),
            id: element.id,
            className: element.className,
            text: element.textContent?.trim().substring(0, 50),
            x: e.clientX,
            y: e.clientY,
            page: window.location.pathname
        };
        
        this.sendEvent('click', clickData);
        this.interactions++;
    }
    
    trackFormSubmit(e) {
        const form = e.target;
        const formData = {
            action: form.action,
            method: form.method,
            id: form.id,
            className: form.className,
            fields: Array.from(form.elements).map(el => ({
                name: el.name,
                type: el.type,
                required: el.required
            }))
        };
        
        this.sendEvent('form_submit', formData);
    }
    
    trackMouseMovement(e) {
        // Only track occasionally to avoid spam
        if (Math.random() < 0.01) {
            this.sendEvent('mouse_movement', {
                x: e.clientX,
                y: e.clientY,
                page: window.location.pathname
            });
        }
    }
    
    trackKeyboard(e) {
        // Track important keyboard shortcuts
        if (e.ctrlKey || e.metaKey) {
            this.sendEvent('keyboard_shortcut', {
                key: e.key,
                ctrlKey: e.ctrlKey,
                metaKey: e.metaKey,
                page: window.location.pathname
            });
        }
    }
    
    // Performance tracking
    trackMetric(name, value) {
        this.sendEvent('performance_metric', {
            metric: name,
            value: value,
            page: window.location.pathname
        });
    }
    
    trackResourceTiming(resource) {
        if (resource.initiatorType === 'img' || resource.initiatorType === 'css' || resource.initiatorType === 'script') {
            this.sendEvent('resource_timing', {
                name: resource.name,
                type: resource.initiatorType,
                duration: resource.duration,
                size: resource.transferSize
            });
        }
    }
    
    // Conversion tracking
    trackGoals() {
        // Track specific goals
        const goals = {
            'contact_form': '.contact-form',
            'newsletter_signup': '.newsletter-form',
            'portfolio_view': '.portfolio-item',
            'service_click': '.service-link'
        };
        
        Object.entries(goals).forEach(([goal, selector]) => {
            const elements = document.querySelectorAll(selector);
            elements.forEach(element => {
                element.addEventListener('click', () => {
                    this.sendEvent('goal_completion', {
                        goal: goal,
                        page: window.location.pathname
                    });
                });
            });
        });
    }
    
    trackFunnel() {
        // Track user journey through funnel
        const funnelSteps = [
            'homepage_visit',
            'service_view',
            'portfolio_view',
            'contact_form_start',
            'contact_form_submit'
        ];
        
        this.currentFunnelStep = 0;
        
        // Track each step
        funnelSteps.forEach((step, index) => {
            if (this.isFunnelStep(step)) {
                this.currentFunnelStep = index;
                this.sendEvent('funnel_step', {
                    step: step,
                    step_number: index + 1,
                    total_steps: funnelSteps.length
                });
            }
        });
    }
    
    trackEngagement() {
        // Track engagement metrics
        const engagementMetrics = {
            'time_on_site': Date.now() - this.startTime,
            'page_views': this.pageViews,
            'interactions': this.interactions,
            'scroll_depth': this.getScrollDepth()
        };
        
        this.sendEvent('engagement', engagementMetrics);
    }
    
    // Heatmap data collection
    collectHeatmapData() {
        // Collect element interaction data
        const elements = document.querySelectorAll('a, button, input, textarea');
        elements.forEach(element => {
            element.addEventListener('mouseenter', () => {
                this.sendEvent('element_hover', {
                    element: element.tagName.toLowerCase(),
                    id: element.id,
                    className: element.className,
                    x: element.getBoundingClientRect().x,
                    y: element.getBoundingClientRect().y
                });
            });
        });
    }
    
    trackElementVisibility() {
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        this.sendEvent('element_visible', {
                            element: entry.target.tagName.toLowerCase(),
                            id: entry.target.id,
                            className: entry.target.className,
                            time: Date.now()
                        });
                    }
                });
            });
            
            // Observe important elements
            document.querySelectorAll('h1, h2, h3, .cta, .hero').forEach(el => {
                observer.observe(el);
            });
        }
    }
    
    // A/B Testing
    initABTesting() {
        this.experiments = {
            'button_color': ['blue', 'green', 'red'],
            'headline_style': ['short', 'long', 'question'],
            'cta_text': ['Get Started', 'Learn More', 'Contact Us']
        };
        
        // Assign user to experiments
        this.assignExperiments();
    }
    
    assignExperiments() {
        Object.entries(this.experiments).forEach(([experiment, variations]) => {
            const variation = variations[Math.floor(Math.random() * variations.length)];
            this.setExperiment(experiment, variation);
        });
    }
    
    setExperiment(name, variation) {
        localStorage.setItem(`experiment_${name}`, variation);
        this.sendEvent('experiment_assigned', {
            experiment: name,
            variation: variation
        });
    }
    
    trackExperiments() {
        Object.keys(this.experiments).forEach(experiment => {
            const variation = localStorage.getItem(`experiment_${experiment}`);
            if (variation) {
                this.sendEvent('experiment_view', {
                    experiment: experiment,
                    variation: variation
                });
            }
        });
    }
    
    // Utility methods
    generateSessionId() {
        return 'session_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
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
    
    getScrollDepth() {
        const scrollTop = window.pageYOffset;
        const docHeight = document.body.scrollHeight - window.innerHeight;
        return Math.round((scrollTop / docHeight) * 100);
    }
    
    isFunnelStep(step) {
        const stepConditions = {
            'homepage_visit': window.location.pathname === '/',
            'service_view': window.location.pathname.includes('/servicios'),
            'portfolio_view': window.location.pathname.includes('/portafolio'),
            'contact_form_start': document.querySelector('.contact-form'),
            'contact_form_submit': false // Will be set by form submit event
        };
        
        return stepConditions[step] || false;
    }
    
    // Send events to analytics
    sendEvent(eventName, data) {
        const eventData = {
            event: eventName,
            data: data,
            timestamp: Date.now(),
            session: this.session,
            page: window.location.pathname,
            userAgent: navigator.userAgent
        };
        
        // Store locally
        this.events.push(eventData);
        
        // Send to Google Analytics if available
        if (typeof gtag !== 'undefined') {
            gtag('event', eventName, data);
        }
        
        // Send to custom endpoint
        this.sendToServer(eventData);
        
        console.log('📊 Analytics Event:', eventName, data);
    }
    
    async sendToServer(eventData) {
        try {
            // Send to your analytics endpoint
            await fetch('/api/analytics', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(eventData)
            });
        } catch (error) {
            console.log('Analytics data stored locally');
        }
    }
    
    // Get analytics summary
    getSummary() {
        return {
            session: this.session,
            pageViews: this.pageViews,
            interactions: this.interactions,
            timeOnSite: Date.now() - this.startTime,
            events: this.events.length
        };
    }
}

// Auto-initialize
document.addEventListener('DOMContentLoaded', () => {
    window.analyticsModule = new Analytics();
});

// Export for module systems
if (typeof module !== 'undefined' && module.exports) {
    module.exports = Analytics;
}
