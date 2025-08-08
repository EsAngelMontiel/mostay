/**
 * Internationalization Module - Mostay
 * Sistema completo de internacionalización
 */

class I18n {
    constructor() {
        this.currentLocale = this.detectLocale();
        this.fallbackLocale = 'es';
        this.translations = {};
        this.loadedLocales = new Set();
        
        this.init();
    }
    
    init() {
        this.loadTranslations();
        this.setupLanguageSwitcher();
        this.setupRTLSupport();
        this.setupNumberFormatting();
        this.setupDateFormatting();
        this.setupCurrencyFormatting();
    }
    
    detectLocale() {
        // Detectar idioma del navegador
        const browserLang = navigator.language || navigator.userLanguage;
        const shortLang = browserLang.split('-')[0];
        
        // Verificar si el idioma está soportado
        const supportedLocales = ['es', 'en', 'fr', 'de', 'it', 'pt'];
        
        if (supportedLocales.includes(shortLang)) {
            return shortLang;
        }
        
        // Fallback a español
        return this.fallbackLocale;
    }
    
    async loadTranslations() {
        const locales = ['es', 'en', 'fr', 'de', 'it', 'pt'];
        
        for (const locale of locales) {
            try {
                const response = await fetch(`/js/translations/${locale}.json`);
                if (response.ok) {
                    this.translations[locale] = await response.json();
                    this.loadedLocales.add(locale);
                }
            } catch (error) {
                console.warn(`No se pudo cargar traducciones para ${locale}`);
            }
        }
        
        // Cargar traducciones por defecto
        this.translations.es = this.getDefaultTranslations();
        this.loadedLocales.add('es');
    }
    
    getDefaultTranslations() {
        return {
            // Navegación
            'nav.home': 'Inicio',
            'nav.about': 'Nosotros',
            'nav.services': 'Servicios',
            'nav.portfolio': 'Portafolio',
            'nav.contact': 'Contacto',
            'nav.blog': 'Blog',
            
            // Hero Section
            'hero.title': 'Diseño Web Profesional',
            'hero.subtitle': 'Creamos experiencias digitales únicas que conectan con tu audiencia',
            'hero.cta': 'Comenzar Proyecto',
            'hero.scroll': 'Desplazarse hacia abajo',
            
            // Servicios
            'services.title': 'Nuestros Servicios',
            'services.subtitle': 'Soluciones integrales para tu presencia digital',
            'services.web_design': 'Diseño Web',
            'services.web_development': 'Desarrollo Web',
            'services.branding': 'Branding',
            'services.marketing': 'Marketing Digital',
            'services.seo': 'SEO',
            'services.maintenance': 'Mantenimiento',
            
            // Portafolio
            'portfolio.title': 'Nuestro Portafolio',
            'portfolio.subtitle': 'Proyectos que hablan por sí mismos',
            'portfolio.view_project': 'Ver Proyecto',
            'portfolio.all_projects': 'Todos los Proyectos',
            
            // Equipo
            'team.title': 'Nuestro Equipo',
            'team.subtitle': 'Profesionales apasionados por la creatividad',
            'team.designer': 'Diseñador',
            'team.developer': 'Desarrollador',
            'team.marketer': 'Marketer',
            
            // Contacto
            'contact.title': 'Ponte en Contacto',
            'contact.subtitle': 'Hablemos sobre tu proyecto',
            'contact.name': 'Nombre',
            'contact.email': 'Email',
            'contact.phone': 'Teléfono',
            'contact.message': 'Mensaje',
            'contact.send': 'Enviar Mensaje',
            'contact.address': 'Dirección',
            'contact.phone_label': 'Teléfono',
            'contact.email_label': 'Email',
            
            // Footer
            'footer.copyright': '© 2024 Mostay. Todos los derechos reservados.',
            'footer.privacy': 'Política de Privacidad',
            'footer.terms': 'Términos de Servicio',
            'footer.follow_us': 'Síguenos',
            
            // Formularios
            'form.required': 'Campo requerido',
            'form.invalid_email': 'Email inválido',
            'form.success': 'Mensaje enviado correctamente',
            'form.error': 'Error al enviar mensaje',
            
            // Botones
            'btn.learn_more': 'Saber Más',
            'btn.get_started': 'Comenzar',
            'btn.submit': 'Enviar',
            'btn.cancel': 'Cancelar',
            'btn.close': 'Cerrar',
            'btn.back': 'Volver',
            'btn.next': 'Siguiente',
            
            // Estados
            'status.loading': 'Cargando...',
            'status.success': 'Éxito',
            'status.error': 'Error',
            'status.warning': 'Advertencia',
            
            // Mensajes
            'message.offline': 'Sin conexión',
            'message.online': 'Conexión restaurada',
            'message.installing': 'Instalando aplicación...',
            'message.installed': 'Aplicación instalada',
            
            // SEO
            'seo.home.title': 'Mostay - Diseño Web Profesional',
            'seo.home.description': 'Agencia de diseño web profesional especializada en branding, desarrollo web y marketing digital',
            'seo.about.title': 'Sobre Nosotros - Mostay',
            'seo.about.description': 'Conoce nuestro equipo y nuestra pasión por crear experiencias digitales únicas',
            'seo.services.title': 'Servicios - Mostay',
            'seo.services.description': 'Ofrecemos servicios integrales de diseño web, desarrollo, branding y marketing digital',
            'seo.portfolio.title': 'Portafolio - Mostay',
            'seo.portfolio.description': 'Explora nuestros proyectos de diseño web y branding más destacados',
            'seo.contact.title': 'Contacto - Mostay',
            'seo.contact.description': 'Ponte en contacto con nosotros para discutir tu proyecto de diseño web',
            
            // Fechas
            'date.today': 'Hoy',
            'date.yesterday': 'Ayer',
            'date.tomorrow': 'Mañana',
            'date.january': 'Enero',
            'date.february': 'Febrero',
            'date.march': 'Marzo',
            'date.april': 'Abril',
            'date.may': 'Mayo',
            'date.june': 'Junio',
            'date.july': 'Julio',
            'date.august': 'Agosto',
            'date.september': 'Septiembre',
            'date.october': 'Octubre',
            'date.november': 'Noviembre',
            'date.december': 'Diciembre',
            
            // Números
            'number.thousand': 'mil',
            'number.million': 'millón',
            'number.billion': 'mil millones',
            
            // Monedas
            'currency.eur': '€',
            'currency.usd': '$',
            'currency.gbp': '£',
            
            // Accesibilidad
            'a11y.menu_toggle': 'Alternar menú de navegación',
            'a11y.close_menu': 'Cerrar menú',
            'a11y.skip_to_content': 'Saltar al contenido principal',
            'a11y.back_to_top': 'Volver arriba',
            'a11y.loading': 'Cargando contenido',
            'a11y.error': 'Error al cargar contenido',
            'a11y.success': 'Operación completada con éxito',
            'a11y.warning': 'Advertencia',
            'a11y.info': 'Información'
        };
    }
    
    setupLanguageSwitcher() {
        // Crear selector de idioma
        const languageSwitcher = this.createLanguageSwitcher();
        document.body.appendChild(languageSwitcher);
        
        // Escuchar cambios de idioma
        languageSwitcher.addEventListener('change', (e) => {
            this.changeLocale(e.target.value);
        });
    }
    
    createLanguageSwitcher() {
        const container = document.createElement('div');
        container.className = 'language-switcher';
        container.innerHTML = `
            <select aria-label="Seleccionar idioma">
                <option value="es" ${this.currentLocale === 'es' ? 'selected' : ''}>Español</option>
                <option value="en" ${this.currentLocale === 'en' ? 'selected' : ''}>English</option>
                <option value="fr" ${this.currentLocale === 'fr' ? 'selected' : ''}>Français</option>
                <option value="de" ${this.currentLocale === 'de' ? 'selected' : ''}>Deutsch</option>
                <option value="it" ${this.currentLocale === 'it' ? 'selected' : ''}>Italiano</option>
                <option value="pt" ${this.currentLocale === 'pt' ? 'selected' : ''}>Português</option>
            </select>
        `;
        
        // Agregar estilos
        const style = document.createElement('style');
        style.textContent = `
            .language-switcher {
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 1000;
            }
            .language-switcher select {
                padding: 8px 12px;
                border: 1px solid #ddd;
                border-radius: 4px;
                background: white;
                font-size: 14px;
                cursor: pointer;
            }
            .language-switcher select:focus {
                outline: 2px solid #007bff;
                outline-offset: 2px;
            }
            @media (max-width: 768px) {
                .language-switcher {
                    top: 10px;
                    right: 10px;
                }
            }
        `;
        document.head.appendChild(style);
        
        return container;
    }
    
    setupRTLSupport() {
        // Configurar soporte RTL para idiomas que lo requieren
        const rtlLanguages = ['ar', 'he', 'fa', 'ur'];
        
        if (rtlLanguages.includes(this.currentLocale)) {
            document.documentElement.dir = 'rtl';
            document.documentElement.lang = this.currentLocale;
        } else {
            document.documentElement.dir = 'ltr';
            document.documentElement.lang = this.currentLocale;
        }
    }
    
    setupNumberFormatting() {
        // Configurar formato de números según el locale
        this.numberFormatter = new Intl.NumberFormat(this.currentLocale, {
            minimumFractionDigits: 0,
            maximumFractionDigits: 2
        });
    }
    
    setupDateFormatting() {
        // Configurar formato de fechas según el locale
        this.dateFormatter = new Intl.DateTimeFormat(this.currentLocale, {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        
        this.shortDateFormatter = new Intl.DateTimeFormat(this.currentLocale, {
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        });
    }
    
    setupCurrencyFormatting() {
        // Configurar formato de moneda según el locale
        const currencyMap = {
            'es': 'EUR',
            'en': 'USD',
            'fr': 'EUR',
            'de': 'EUR',
            'it': 'EUR',
            'pt': 'EUR'
        };
        
        const currency = currencyMap[this.currentLocale] || 'EUR';
        
        this.currencyFormatter = new Intl.NumberFormat(this.currentLocale, {
            style: 'currency',
            currency: currency
        });
    }
    
    changeLocale(newLocale) {
        if (!this.loadedLocales.has(newLocale)) {
            console.warn(`Locale ${newLocale} no está cargado`);
            return;
        }
        
        this.currentLocale = newLocale;
        
        // Actualizar atributos del documento
        document.documentElement.lang = newLocale;
        this.setupRTLSupport();
        this.setupNumberFormatting();
        this.setupDateFormatting();
        this.setupCurrencyFormatting();
        
        // Traducir todo el contenido
        this.translatePage();
        
        // Guardar preferencia
        localStorage.setItem('preferred-locale', newLocale);
        
        // Track analytics
        if (typeof gtag !== 'undefined') {
            gtag('event', 'language_change', {
                'event_category': 'engagement',
                'event_label': newLocale
            });
        }
        
        console.log(`🌍 Idioma cambiado a: ${newLocale}`);
    }
    
    translatePage() {
        // Traducir elementos con atributo data-i18n
        const elements = document.querySelectorAll('[data-i18n]');
        
        elements.forEach(element => {
            const key = element.getAttribute('data-i18n');
            const translation = this.t(key);
            
            if (translation) {
                if (element.tagName === 'INPUT' || element.tagName === 'TEXTAREA') {
                    element.placeholder = translation;
                } else {
                    element.textContent = translation;
                }
            }
        });
        
        // Traducir atributos
        const attrElements = document.querySelectorAll('[data-i18n-attr]');
        
        attrElements.forEach(element => {
            const attrData = element.getAttribute('data-i18n-attr');
            const [key, attr] = attrData.split(':');
            const translation = this.t(key);
            
            if (translation) {
                element.setAttribute(attr, translation);
            }
        });
        
        // Actualizar meta tags
        this.updateMetaTags();
    }
    
    updateMetaTags() {
        // Actualizar meta tags de SEO
        const titleKey = `seo.${this.getCurrentPage()}.title`;
        const descriptionKey = `seo.${this.getCurrentPage()}.description`;
        
        const title = this.t(titleKey);
        const description = this.t(descriptionKey);
        
        if (title) {
            document.title = title;
            const titleMeta = document.querySelector('meta[property="og:title"]');
            if (titleMeta) titleMeta.setAttribute('content', title);
        }
        
        if (description) {
            const descMeta = document.querySelector('meta[name="description"]');
            const ogDescMeta = document.querySelector('meta[property="og:description"]');
            
            if (descMeta) descMeta.setAttribute('content', description);
            if (ogDescMeta) ogDescMeta.setAttribute('content', description);
        }
    }
    
    getCurrentPage() {
        const path = window.location.pathname;
        if (path === '/' || path === '') return 'home';
        if (path.includes('about')) return 'about';
        if (path.includes('services')) return 'services';
        if (path.includes('portfolio')) return 'portfolio';
        if (path.includes('contact')) return 'contact';
        if (path.includes('blog')) return 'blog';
        return 'home';
    }
    
    t(key, params = {}) {
        // Obtener traducción
        let translation = this.getTranslation(key);
        
        if (!translation) {
            // Fallback a español
            translation = this.getTranslation(key, 'es');
            
            if (!translation) {
                console.warn(`Translation key not found: ${key}`);
                return key;
            }
        }
        
        // Reemplazar parámetros
        Object.keys(params).forEach(param => {
            translation = translation.replace(`{${param}}`, params[param]);
        });
        
        return translation;
    }
    
    getTranslation(key, locale = null) {
        const targetLocale = locale || this.currentLocale;
        const translations = this.translations[targetLocale];
        
        if (!translations) return null;
        
        // Buscar traducción por clave anidada
        const keys = key.split('.');
        let result = translations;
        
        for (const k of keys) {
            if (result && typeof result === 'object' && k in result) {
                result = result[k];
            } else {
                return null;
            }
        }
        
        return result;
    }
    
    // Métodos de formato
    formatNumber(number) {
        return this.numberFormatter.format(number);
    }
    
    formatDate(date) {
        return this.dateFormatter.format(new Date(date));
    }
    
    formatShortDate(date) {
        return this.shortDateFormatter.format(new Date(date));
    }
    
    formatCurrency(amount) {
        return this.currencyFormatter.format(amount);
    }
    
    // Métodos de utilidad
    getCurrentLocale() {
        return this.currentLocale;
    }
    
    getSupportedLocales() {
        return Array.from(this.loadedLocales);
    }
    
    isRTL() {
        return document.documentElement.dir === 'rtl';
    }
    
    // Auto-inicializar traducciones en elementos existentes
    autoTranslate() {
        // Traducir elementos con atributos data-i18n
        this.translatePage();
        
        // Observar cambios en el DOM para nuevos elementos
        const observer = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                mutation.addedNodes.forEach((node) => {
                    if (node.nodeType === Node.ELEMENT_NODE) {
                        const elements = node.querySelectorAll('[data-i18n]');
                        elements.forEach(element => {
                            const key = element.getAttribute('data-i18n');
                            const translation = this.t(key);
                            if (translation) {
                                element.textContent = translation;
                            }
                        });
                    }
                });
            });
        });
        
        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    }
}

// Auto-initialize
document.addEventListener('DOMContentLoaded', () => {
    window.i18n = new I18n();
    
    // Auto-traducir después de que se cargue todo
    setTimeout(() => {
        window.i18n.autoTranslate();
    }, 100);
});

// Export for module systems
if (typeof module !== 'undefined' && module.exports) {
    module.exports = I18n;
}
