/**
 * Navigation Module - Mostay
 * Maneja la navegación móvil y desktop
 */

class Navigation {
    constructor() {
        this.sidenav = document.getElementById('mySidenav');
        this.main = document.getElementById('main');
        this.bg = document.getElementById('bg');
        this.navButton = document.querySelector('.navbutton');
        this.closeBtn = document.querySelector('.closebtn');
        
        this.init();
    }
    
    init() {
        this.bindEvents();
        this.setupAccessibility();
    }
    
    bindEvents() {
        // Toggle mobile menu
        if (this.navButton) {
            this.navButton.addEventListener('click', (e) => {
                e.preventDefault();
                this.openMenu();
            });
        }
        
        // Close menu
        if (this.closeBtn) {
            this.closeBtn.addEventListener('click', (e) => {
                e.preventDefault();
                this.closeMenu();
            });
        }
        
        // Close on backdrop click
        if (this.sidenav) {
            this.sidenav.addEventListener('click', () => {
                this.closeMenu();
                if (this.bg) {
                    this.bg.classList.remove('show');
                }
            });
        }
        
        // Close on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                this.closeMenu();
            }
        });
        
        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth > 768) {
                this.closeMenu();
            }
        });
    }
    
    setupAccessibility() {
        if (this.navButton) {
            this.navButton.setAttribute('aria-expanded', 'false');
            this.navButton.setAttribute('aria-controls', 'mySidenav');
        }
        
        if (this.sidenav) {
            this.sidenav.setAttribute('aria-hidden', 'true');
        }
    }
    
    openMenu() {
        if (this.sidenav) {
            this.sidenav.style.width = '100%';
            this.sidenav.setAttribute('aria-hidden', 'false');
        }
        
        if (this.main) {
            this.main.style.marginLeft = '160px';
        }
        
        if (this.bg) {
            this.bg.classList.add('show');
        }
        
        if (this.navButton) {
            this.navButton.setAttribute('aria-expanded', 'true');
        }
        
        // Focus trap
        this.setupFocusTrap();
        
        // Prevent body scroll
        document.body.style.overflow = 'hidden';
    }
    
    closeMenu() {
        if (this.sidenav) {
            this.sidenav.style.width = '0';
            this.sidenav.setAttribute('aria-hidden', 'true');
        }
        
        if (this.main) {
            this.main.style.marginLeft = '0';
        }
        
        if (this.bg) {
            this.bg.classList.remove('show');
        }
        
        if (this.navButton) {
            this.navButton.setAttribute('aria-expanded', 'false');
        }
        
        // Restore body scroll
        document.body.style.overflow = '';
        
        // Return focus to trigger
        if (this.navButton) {
            this.navButton.focus();
        }
    }
    
    setupFocusTrap() {
        const focusableElements = this.sidenav.querySelectorAll(
            'a[href], button, textarea, input[type="text"], input[type="radio"], input[type="checkbox"], select'
        );
        
        const firstFocusableElement = focusableElements[0];
        const lastFocusableElement = focusableElements[focusableElements.length - 1];
        
        if (firstFocusableElement) {
            firstFocusableElement.focus();
        }
        
        // Trap focus within menu
        this.sidenav.addEventListener('keydown', (e) => {
            if (e.key === 'Tab') {
                if (e.shiftKey) {
                    if (document.activeElement === firstFocusableElement) {
                        e.preventDefault();
                        lastFocusableElement.focus();
                    }
                } else {
                    if (document.activeElement === lastFocusableElement) {
                        e.preventDefault();
                        firstFocusableElement.focus();
                    }
                }
            }
        });
    }
}

// Auto-initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    new Navigation();
});

// Export for module systems
if (typeof module !== 'undefined' && module.exports) {
    module.exports = Navigation;
}
