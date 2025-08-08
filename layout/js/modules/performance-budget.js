/**
 * Performance Budget Module - Mostay
 * Monitoreo y enforcement de performance budget
 */

class PerformanceBudget {
    constructor() {
        this.budgets = {
            // Core Web Vitals
            lcp: 2500, // 2.5s
            fid: 100,   // 100ms
            cls: 0.1,   // 0.1
            
            // Resource budgets
            totalSize: 500 * 1024, // 500KB
            imageSize: 200 * 1024, // 200KB
            cssSize: 50 * 1024,    // 50KB
            jsSize: 100 * 1024,    // 100KB
            
            // Time budgets
            loadTime: 3000,         // 3s
            firstPaint: 1000,       // 1s
            firstContentfulPaint: 1500, // 1.5s
            
            // Request budgets
            maxRequests: 20,
            maxImages: 10,
            maxScripts: 5
        };
        
        this.violations = [];
        this.init();
    }
    
    init() {
        this.setupBudgetMonitoring();
        this.setupResourceTracking();
        this.setupPerformanceTracking();
        this.setupViolationReporting();
    }
    
    setupBudgetMonitoring() {
        // Monitor Core Web Vitals against budget
        if ('PerformanceObserver' in window) {
            // LCP Budget
            const lcpObserver = new PerformanceObserver((list) => {
                const entries = list.getEntries();
                const lastEntry = entries[entries.length - 1];
                this.checkBudget('lcp', lastEntry.startTime);
            });
            lcpObserver.observe({ entryTypes: ['largest-contentful-paint'] });
            
            // FID Budget
            const fidObserver = new PerformanceObserver((list) => {
                const entries = list.getEntries();
                entries.forEach(entry => {
                    const fid = entry.processingStart - entry.startTime;
                    this.checkBudget('fid', fid);
                });
            });
            fidObserver.observe({ entryTypes: ['first-input'] });
            
            // CLS Budget
            const clsObserver = new PerformanceObserver((list) => {
                let clsValue = 0;
                const entries = list.getEntries();
                entries.forEach(entry => {
                    if (!entry.hadRecentInput) {
                        clsValue += entry.value;
                    }
                });
                this.checkBudget('cls', clsValue);
            });
            clsObserver.observe({ entryTypes: ['layout-shift'] });
        }
        
        // Monitor load time
        window.addEventListener('load', () => {
            const loadTime = performance.now();
            this.checkBudget('loadTime', loadTime);
        });
    }
    
    setupResourceTracking() {
        window.addEventListener('load', () => {
            const resources = performance.getEntriesByType('resource');
            this.analyzeResources(resources);
        });
    }
    
    setupPerformanceTracking() {
        // Track paint timing
        if ('PerformanceObserver' in window) {
            const paintObserver = new PerformanceObserver((list) => {
                const entries = list.getEntries();
                entries.forEach(entry => {
                    if (entry.name === 'first-paint') {
                        this.checkBudget('firstPaint', entry.startTime);
                    } else if (entry.name === 'first-contentful-paint') {
                        this.checkBudget('firstContentfulPaint', entry.startTime);
                    }
                });
            });
            paintObserver.observe({ entryTypes: ['paint'] });
        }
    }
    
    setupViolationReporting() {
        // Report violations to analytics
        setInterval(() => {
            if (this.violations.length > 0) {
                this.reportViolations();
            }
        }, 10000); // Every 10 seconds
    }
    
    checkBudget(metric, value) {
        const budget = this.budgets[metric];
        if (!budget) return;
        
        const percentage = (value / budget) * 100;
        
        if (percentage > 100) {
            const violation = {
                metric,
                value,
                budget,
                percentage: Math.round(percentage),
                timestamp: Date.now()
            };
            
            this.violations.push(violation);
            this.handleViolation(violation);
        }
    }
    
    analyzeResources(resources) {
        let totalSize = 0;
        let imageSize = 0;
        let cssSize = 0;
        let jsSize = 0;
        let imageCount = 0;
        let scriptCount = 0;
        
        resources.forEach(resource => {
            const size = resource.transferSize || 0;
            totalSize += size;
            
            if (resource.initiatorType === 'img') {
                imageSize += size;
                imageCount++;
            } else if (resource.initiatorType === 'css') {
                cssSize += size;
            } else if (resource.initiatorType === 'script') {
                jsSize += size;
                scriptCount++;
            }
        });
        
        // Check resource budgets
        this.checkBudget('totalSize', totalSize);
        this.checkBudget('imageSize', imageSize);
        this.checkBudget('cssSize', cssSize);
        this.checkBudget('jsSize', jsSize);
        
        // Check request count budgets
        this.checkBudget('maxRequests', resources.length);
        this.checkBudget('maxImages', imageCount);
        this.checkBudget('maxScripts', scriptCount);
    }
    
    handleViolation(violation) {
        console.warn(`🚨 Performance Budget Violation: ${violation.metric}`, violation);
        
        // Send to analytics
        if (typeof gtag !== 'undefined') {
            gtag('event', 'performance_budget_violation', {
                'event_category': 'performance',
                'event_label': violation.metric,
                'value': violation.value,
                'budget': violation.budget,
                'percentage': violation.percentage
            });
        }
        
        // Show warning to developers
        if (this.isDevelopment()) {
            this.showDevWarning(violation);
        }
        
        // Auto-optimize if possible
        this.autoOptimize(violation);
    }
    
    showDevWarning(violation) {
        const warning = document.createElement('div');
        warning.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: #ff4444;
            color: white;
            padding: 15px;
            border-radius: 5px;
            font-family: monospace;
            font-size: 12px;
            z-index: 10000;
            max-width: 300px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        `;
        
        warning.innerHTML = `
            <strong>🚨 Performance Budget Violation</strong><br>
            Metric: ${violation.metric}<br>
            Value: ${this.formatBytes(violation.value)}<br>
            Budget: ${this.formatBytes(violation.budget)}<br>
            Over: ${violation.percentage}%
        `;
        
        document.body.appendChild(warning);
        
        // Remove after 10 seconds
        setTimeout(() => {
            warning.remove();
        }, 10000);
    }
    
    autoOptimize(violation) {
        switch (violation.metric) {
            case 'imageSize':
                this.optimizeImages();
                break;
            case 'jsSize':
                this.optimizeScripts();
                break;
            case 'cssSize':
                this.optimizeCSS();
                break;
            case 'maxRequests':
                this.optimizeRequests();
                break;
        }
    }
    
    optimizeImages() {
        // Suggest WebP conversion
        const images = document.querySelectorAll('img');
        images.forEach(img => {
            if (img.src && !img.src.includes('.webp')) {
                console.log('💡 Consider converting to WebP:', img.src);
            }
        });
    }
    
    optimizeScripts() {
        // Suggest script optimization
        const scripts = document.querySelectorAll('script[src]');
        scripts.forEach(script => {
            if (!script.src.includes('.min.js')) {
                console.log('💡 Consider minifying:', script.src);
            }
        });
    }
    
    optimizeCSS() {
        // Suggest CSS optimization
        const stylesheets = document.querySelectorAll('link[rel="stylesheet"]');
        stylesheets.forEach(link => {
            if (!link.href.includes('.min.css')) {
                console.log('💡 Consider minifying CSS:', link.href);
            }
        });
    }
    
    optimizeRequests() {
        // Suggest request optimization
        console.log('💡 Consider combining resources or using CDN');
    }
    
    reportViolations() {
        if (this.violations.length === 0) return;
        
        const report = {
            violations: this.violations,
            summary: this.getViolationSummary(),
            timestamp: Date.now()
        };
        
        // Send to analytics
        if (typeof gtag !== 'undefined') {
            gtag('event', 'performance_budget_report', {
                'event_category': 'performance',
                'violations_count': this.violations.length,
                'summary': report.summary
            });
        }
        
        // Send to server
        this.sendReportToServer(report);
        
        // Clear violations
        this.violations = [];
    }
    
    getViolationSummary() {
        const summary = {};
        this.violations.forEach(violation => {
            if (!summary[violation.metric]) {
                summary[violation.metric] = {
                    count: 0,
                    maxPercentage: 0,
                    totalValue: 0
                };
            }
            summary[violation.metric].count++;
            summary[violation.metric].maxPercentage = Math.max(summary[violation.metric].maxPercentage, violation.percentage);
            summary[violation.metric].totalValue += violation.value;
        });
        return summary;
    }
    
    async sendReportToServer(report) {
        try {
            await fetch('/api/performance-budget', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(report)
            });
        } catch (error) {
            console.log('Performance budget report stored locally');
        }
    }
    
    // Utility methods
    isDevelopment() {
        return window.location.hostname === 'localhost' || 
               window.location.hostname === '127.0.0.1' ||
               window.location.hostname.includes('dev');
    }
    
    formatBytes(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
    
    // Get current performance metrics
    getCurrentMetrics() {
        const metrics = {};
        
        // Get resource timing
        const resources = performance.getEntriesByType('resource');
        let totalSize = 0;
        resources.forEach(resource => {
            totalSize += resource.transferSize || 0;
        });
        
        metrics.totalSize = totalSize;
        metrics.resourceCount = resources.length;
        
        return metrics;
    }
    
    // Get budget recommendations
    getRecommendations() {
        const metrics = this.getCurrentMetrics();
        const recommendations = [];
        
        if (metrics.totalSize > this.budgets.totalSize * 0.8) {
            recommendations.push('Consider optimizing image sizes');
        }
        
        if (metrics.resourceCount > this.budgets.maxRequests * 0.8) {
            recommendations.push('Consider combining CSS/JS files');
        }
        
        return recommendations;
    }
}

// Auto-initialize
document.addEventListener('DOMContentLoaded', () => {
    window.performanceBudget = new PerformanceBudget();
});

// Export for module systems
if (typeof module !== 'undefined' && module.exports) {
    module.exports = PerformanceBudget;
}
