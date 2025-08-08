/**
 * Automated Testing Module - Mostay
 * Framework completo de testing automatizado
 */

class Testing {
    constructor() {
        this.tests = [];
        this.results = {
            passed: 0,
            failed: 0,
            total: 0,
            duration: 0
        };
        this.isDevelopment = this.isDevelopmentMode();
        
        this.init();
    }
    
    init() {
        if (this.isDevelopment) {
            this.setupTestRunner();
            this.setupUnitTests();
            this.setupIntegrationTests();
            this.setupE2ETests();
            this.setupAccessibilityTests();
            this.setupPerformanceTests();
            this.setupSecurityTests();
        }
    }
    
    isDevelopmentMode() {
        return window.location.hostname === 'localhost' || 
               window.location.hostname === '127.0.0.1' ||
               window.location.hostname.includes('dev') ||
               window.location.search.includes('test=true');
    }
    
    setupTestRunner() {
        // Crear panel de testing en desarrollo
        this.createTestPanel();
        
        // Ejecutar tests automáticamente
        setTimeout(() => {
            this.runAllTests();
        }, 1000);
    }
    
    createTestPanel() {
        const panel = document.createElement('div');
        panel.id = 'testing-panel';
        panel.innerHTML = `
            <div class="test-panel-header">
                <h3>🧪 Testing Panel</h3>
                <button id="run-tests">Run Tests</button>
                <button id="clear-results">Clear</button>
            </div>
            <div class="test-results"></div>
        `;
        
        // Agregar estilos
        const style = document.createElement('style');
        style.textContent = `
            #testing-panel {
                position: fixed;
                top: 20px;
                left: 20px;
                width: 400px;
                max-height: 600px;
                background: #1a1a1a;
                color: white;
                border-radius: 8px;
                padding: 15px;
                font-family: monospace;
                font-size: 12px;
                z-index: 10000;
                overflow-y: auto;
                box-shadow: 0 4px 20px rgba(0,0,0,0.3);
            }
            .test-panel-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 15px;
                padding-bottom: 10px;
                border-bottom: 1px solid #333;
            }
            .test-panel-header h3 {
                margin: 0;
                font-size: 14px;
            }
            .test-panel-header button {
                background: #007bff;
                color: white;
                border: none;
                padding: 5px 10px;
                border-radius: 4px;
                cursor: pointer;
                font-size: 11px;
            }
            .test-panel-header button:hover {
                background: #0056b3;
            }
            .test-results {
                max-height: 500px;
                overflow-y: auto;
            }
            .test-result {
                margin-bottom: 8px;
                padding: 5px;
                border-radius: 4px;
            }
            .test-result.pass {
                background: #28a745;
                color: white;
            }
            .test-result.fail {
                background: #dc3545;
                color: white;
            }
            .test-result.info {
                background: #17a2b8;
                color: white;
            }
            .test-summary {
                margin-top: 10px;
                padding-top: 10px;
                border-top: 1px solid #333;
                font-weight: bold;
            }
        `;
        document.head.appendChild(style);
        
        document.body.appendChild(panel);
        
        // Event listeners
        document.getElementById('run-tests').addEventListener('click', () => {
            this.runAllTests();
        });
        
        document.getElementById('clear-results').addEventListener('click', () => {
            this.clearResults();
        });
    }
    
    setupUnitTests() {
        // Tests unitarios para módulos
        this.addTest('Navigation Module', () => {
            return typeof Navigation !== 'undefined';
        });
        
        this.addTest('Slider Module', () => {
            return typeof Slider !== 'undefined';
        });
        
        this.addTest('Performance Module', () => {
            return typeof Performance !== 'undefined';
        });
        
        this.addTest('PWA Module', () => {
            return typeof PWA !== 'undefined';
        });
        
        this.addTest('Analytics Module', () => {
            return typeof Analytics !== 'undefined';
        });
        
        this.addTest('I18n Module', () => {
            return typeof I18n !== 'undefined';
        });
        
        this.addTest('SEO Module', () => {
            return typeof SEO !== 'undefined';
        });
    }
    
    setupIntegrationTests() {
        // Tests de integración
        this.addTest('App Initialization', () => {
            return typeof window.mostayApp !== 'undefined';
        });
        
        this.addTest('Module Loading', () => {
            const app = window.mostayApp;
            return app && app.modules && Object.keys(app.modules).length > 0;
        });
        
        this.addTest('Event System', () => {
            const app = window.mostayApp;
            return app && typeof app.emit === 'function';
        });
        
        this.addTest('Error Handling', () => {
            const app = window.mostayApp;
            return app && typeof app.handleError === 'function';
        });
    }
    
    setupE2ETests() {
        // Tests end-to-end
        this.addTest('Page Load', () => {
            return document.readyState === 'complete';
        });
        
        this.addTest('Critical Elements', () => {
            const criticalElements = [
                'header',
                'main',
                'footer',
                '.nav-main',
                '.hero-section'
            ];
            
            return criticalElements.every(selector => 
                document.querySelector(selector) !== null
            );
        });
        
        this.addTest('Navigation Links', () => {
            const navLinks = document.querySelectorAll('.nav-main a');
            return navLinks.length > 0;
        });
        
        this.addTest('Contact Form', () => {
            const contactForm = document.querySelector('form');
            return contactForm !== null;
        });
        
        this.addTest('Social Links', () => {
            const socialLinks = document.querySelectorAll('.social-networks a');
            return socialLinks.length > 0;
        });
    }
    
    setupAccessibilityTests() {
        // Tests de accesibilidad
        this.addTest('Skip Link', () => {
            const skipLink = document.querySelector('.skip-link');
            return skipLink !== null;
        });
        
        this.addTest('ARIA Labels', () => {
            const elementsWithAria = document.querySelectorAll('[aria-label], [aria-labelledby]');
            return elementsWithAria.length > 0;
        });
        
        this.addTest('Alt Text for Images', () => {
            const images = document.querySelectorAll('img');
            const imagesWithAlt = Array.from(images).filter(img => img.alt);
            return imagesWithAlt.length === images.length;
        });
        
        this.addTest('Focus Management', () => {
            const focusableElements = document.querySelectorAll('a, button, input, textarea, select');
            return focusableElements.length > 0;
        });
        
        this.addTest('Color Contrast', () => {
            // Test básico de contraste
            const body = document.body;
            const computedStyle = window.getComputedStyle(body);
            const backgroundColor = computedStyle.backgroundColor;
            const color = computedStyle.color;
            
            // Verificar que hay contraste (simplificado)
            return backgroundColor !== color;
        });
    }
    
    setupPerformanceTests() {
        // Tests de rendimiento
        this.addTest('Load Time', () => {
            const loadTime = performance.now();
            return loadTime < 5000; // Menos de 5 segundos
        });
        
        this.addTest('Resource Count', () => {
            const resources = performance.getEntriesByType('resource');
            return resources.length < 50; // Menos de 50 recursos
        });
        
        this.addTest('Image Optimization', () => {
            const images = document.querySelectorAll('img');
            const optimizedImages = Array.from(images).filter(img => 
                img.loading === 'lazy' || img.hasAttribute('data-src')
            );
            return optimizedImages.length > 0;
        });
        
        this.addTest('Script Loading', () => {
            const scripts = document.querySelectorAll('script[src]');
            const asyncScripts = Array.from(scripts).filter(script => 
                script.async || script.defer
            );
            return asyncScripts.length > 0;
        });
    }
    
    setupSecurityTests() {
        // Tests de seguridad
        this.addTest('HTTPS', () => {
            return window.location.protocol === 'https:';
        });
        
        this.addTest('External Links Security', () => {
            const externalLinks = document.querySelectorAll('a[href^="http"]');
            const secureLinks = Array.from(externalLinks).filter(link => 
                link.rel && link.rel.includes('noopener')
            );
            return secureLinks.length === externalLinks.length;
        });
        
        this.addTest('Content Security Policy', () => {
            const metaCSP = document.querySelector('meta[http-equiv="Content-Security-Policy"]');
            return metaCSP !== null;
        });
        
        this.addTest('XSS Protection', () => {
            const metaXSS = document.querySelector('meta[http-equiv="X-XSS-Protection"]');
            return metaXSS !== null;
        });
    }
    
    addTest(name, testFunction) {
        this.tests.push({
            name: name,
            test: testFunction,
            category: this.getTestCategory(name)
        });
    }
    
    getTestCategory(testName) {
        if (testName.includes('Module')) return 'unit';
        if (testName.includes('Integration')) return 'integration';
        if (testName.includes('E2E')) return 'e2e';
        if (testName.includes('Accessibility')) return 'accessibility';
        if (testName.includes('Performance')) return 'performance';
        if (testName.includes('Security')) return 'security';
        return 'general';
    }
    
    async runAllTests() {
        const startTime = Date.now();
        this.results = {
            passed: 0,
            failed: 0,
            total: this.tests.length,
            duration: 0
        };
        
        this.clearResults();
        this.logResult('info', '🧪 Running all tests...');
        
        for (const test of this.tests) {
            try {
                const result = await this.runTest(test);
                if (result) {
                    this.results.passed++;
                    this.logResult('pass', `✅ ${test.name}`);
                } else {
                    this.results.failed++;
                    this.logResult('fail', `❌ ${test.name}`);
                }
            } catch (error) {
                this.results.failed++;
                this.logResult('fail', `❌ ${test.name} - Error: ${error.message}`);
            }
        }
        
        this.results.duration = Date.now() - startTime;
        this.showSummary();
    }
    
    async runTest(test) {
        try {
            const result = await test.test();
            return result;
        } catch (error) {
            console.error(`Test failed: ${test.name}`, error);
            return false;
        }
    }
    
    logResult(type, message) {
        const resultsContainer = document.querySelector('.test-results');
        if (resultsContainer) {
            const resultElement = document.createElement('div');
            resultElement.className = `test-result ${type}`;
            resultElement.textContent = message;
            resultsContainer.appendChild(resultElement);
        }
        
        console.log(message);
    }
    
    showSummary() {
        const { passed, failed, total, duration } = this.results;
        const successRate = ((passed / total) * 100).toFixed(1);
        
        this.logResult('info', `📊 Test Summary:`);
        this.logResult('info', `   Total: ${total}`);
        this.logResult('pass', `   Passed: ${passed}`);
        this.logResult('fail', `   Failed: ${failed}`);
        this.logResult('info', `   Success Rate: ${successRate}%`);
        this.logResult('info', `   Duration: ${duration}ms`);
        
        // Track analytics
        if (typeof gtag !== 'undefined') {
            gtag('event', 'test_run', {
                'event_category': 'testing',
                'total_tests': total,
                'passed_tests': passed,
                'failed_tests': failed,
                'success_rate': successRate,
                'duration': duration
            });
        }
    }
    
    clearResults() {
        const resultsContainer = document.querySelector('.test-results');
        if (resultsContainer) {
            resultsContainer.innerHTML = '';
        }
    }
    
    // Métodos de utilidad para testing
    assert(condition, message = 'Assertion failed') {
        if (!condition) {
            throw new Error(message);
        }
        return true;
    }
    
    assertEqual(actual, expected, message = 'Values are not equal') {
        return this.assert(actual === expected, `${message}: expected ${expected}, got ${actual}`);
    }
    
    assertNotNull(value, message = 'Value is null or undefined') {
        return this.assert(value !== null && value !== undefined, message);
    }
    
    assertElementExists(selector, message = `Element not found: ${selector}`) {
        const element = document.querySelector(selector);
        return this.assertNotNull(element, message);
    }
    
    assertElementCount(selector, expectedCount, message = `Expected ${expectedCount} elements for ${selector}`) {
        const elements = document.querySelectorAll(selector);
        return this.assertEqual(elements.length, expectedCount, message);
    }
    
    // Tests específicos para funcionalidades
    testNavigation() {
        this.addTest('Navigation Toggle', () => {
            const navButton = document.querySelector('.navbutton');
            return navButton !== null;
        });
        
        this.addTest('Mobile Menu', () => {
            const sidenav = document.getElementById('mySidenav');
            return sidenav !== null;
        });
    }
    
    testSlider() {
        this.addTest('Slider Container', () => {
            const slider = document.querySelector('.home-slider');
            return slider !== null;
        });
        
        this.addTest('Slider Images', () => {
            const sliderImages = document.querySelectorAll('.home-slider img');
            return sliderImages.length > 0;
        });
    }
    
    testForms() {
        this.addTest('Form Validation', () => {
            const forms = document.querySelectorAll('form');
            return forms.length > 0;
        });
        
        this.addTest('Required Fields', () => {
            const requiredFields = document.querySelectorAll('[required]');
            return requiredFields.length > 0;
        });
    }
    
    testResponsive() {
        this.addTest('Viewport Meta Tag', () => {
            const viewport = document.querySelector('meta[name="viewport"]');
            return viewport !== null;
        });
        
        this.addTest('Responsive CSS', () => {
            const responsiveCSS = document.querySelector('link[href*="responsive"]');
            return responsiveCSS !== null;
        });
    }
    
    // Métodos de reporting
    generateReport() {
        const report = {
            timestamp: new Date().toISOString(),
            url: window.location.href,
            results: this.results,
            tests: this.tests.map(test => ({
                name: test.name,
                category: test.category,
                status: 'completed'
            }))
        };
        
        console.log('📋 Test Report:', report);
        return report;
    }
    
    exportResults() {
        const report = this.generateReport();
        const dataStr = JSON.stringify(report, null, 2);
        const dataBlob = new Blob([dataStr], { type: 'application/json' });
        
        const link = document.createElement('a');
        link.href = URL.createObjectURL(dataBlob);
        link.download = `test-results-${Date.now()}.json`;
        link.click();
    }
}

// Auto-initialize
document.addEventListener('DOMContentLoaded', () => {
    window.testingModule = new Testing();
});

// Export for module systems
if (typeof module !== 'undefined' && module.exports) {
    module.exports = Testing;
}
