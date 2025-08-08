/**
 * Advanced SEO Module - Mostay
 * Optimizaciones SEO avanzadas y dinámicas
 */

class SEO {
    constructor() {
        this.currentPage = this.getCurrentPage();
        this.metaData = {};
        this.structuredData = {};
        this.socialData = {};
        
        this.init();
    }
    
    init() {
        this.setupMetaData();
        this.setupStructuredData();
        this.setupSocialMedia();
        this.setupBreadcrumbs();
        this.setupCanonicalUrls();
        this.setupHreflang();
        this.setupOpenGraph();
        this.setupTwitterCards();
        this.setupSchemaMarkup();
        this.setupPerformanceSEO();
    }
    
    getCurrentPage() {
        const path = window.location.pathname;
        const url = new URL(window.location.href);
        
        return {
            path: path,
            fullUrl: window.location.href,
            baseUrl: url.origin,
            slug: path.split('/').pop() || 'home',
            params: Object.fromEntries(url.searchParams)
        };
    }
    
    setupMetaData() {
        // Configurar metadatos dinámicos según la página
        const pageMeta = this.getPageMetaData();
        
        // Actualizar título
        if (pageMeta.title) {
            document.title = pageMeta.title;
        }
        
        // Actualizar descripción
        if (pageMeta.description) {
            this.updateMetaTag('name', 'description', pageMeta.description);
        }
        
        // Actualizar keywords
        if (pageMeta.keywords) {
            this.updateMetaTag('name', 'keywords', pageMeta.keywords);
        }
        
        // Actualizar autor
        if (pageMeta.author) {
            this.updateMetaTag('name', 'author', pageMeta.author);
        }
        
        // Actualizar robots
        if (pageMeta.robots) {
            this.updateMetaTag('name', 'robots', pageMeta.robots);
        }
    }
    
    getPageMetaData() {
        const pageData = {
            home: {
                title: 'Mostay - Diseño Web Profesional en Andalucía',
                description: 'Agencia de diseño web profesional en Andalucía. Especialistas en branding, desarrollo web y marketing digital. Creamos experiencias digitales únicas.',
                keywords: 'diseño web, desarrollo web, branding, marketing digital, SEO, Andalucía, agencia digital',
                author: 'Mostay',
                robots: 'index, follow'
            },
            about: {
                title: 'Sobre Nosotros - Mostay | Agencia de Diseño Web',
                description: 'Conoce nuestro equipo de profesionales apasionados por crear experiencias digitales únicas. Más de 10 años de experiencia en diseño web.',
                keywords: 'sobre nosotros, equipo, experiencia, diseño web, Mostay',
                author: 'Mostay',
                robots: 'index, follow'
            },
            services: {
                title: 'Servicios de Diseño Web - Mostay',
                description: 'Ofrecemos servicios integrales de diseño web, desarrollo, branding y marketing digital. Soluciones personalizadas para tu negocio.',
                keywords: 'servicios, diseño web, desarrollo, branding, marketing digital, SEO',
                author: 'Mostay',
                robots: 'index, follow'
            },
            portfolio: {
                title: 'Portafolio de Proyectos - Mostay',
                description: 'Explora nuestros proyectos de diseño web y branding más destacados. Casos de éxito que demuestran nuestra creatividad y profesionalidad.',
                keywords: 'portafolio, proyectos, casos de éxito, diseño web, branding',
                author: 'Mostay',
                robots: 'index, follow'
            },
            contact: {
                title: 'Contacto - Mostay | Hablemos de tu Proyecto',
                description: 'Ponte en contacto con nosotros para discutir tu proyecto de diseño web. Consulta gratuita y presupuesto sin compromiso.',
                keywords: 'contacto, consulta, presupuesto, proyecto web',
                author: 'Mostay',
                robots: 'index, follow'
            },
            blog: {
                title: 'Blog - Mostay | Noticias y Consejos de Diseño Web',
                description: 'Mantente actualizado con las últimas tendencias en diseño web, marketing digital y tecnología. Consejos y noticias del sector.',
                keywords: 'blog, noticias, consejos, diseño web, marketing digital',
                author: 'Mostay',
                robots: 'index, follow'
            }
        };
        
        return pageData[this.currentPage.slug] || pageData.home;
    }
    
    setupStructuredData() {
        // Configurar datos estructurados (Schema.org)
        const structuredData = {
            '@context': 'https://schema.org',
            '@type': 'Organization',
            'name': 'Mostay',
            'url': 'https://mostay.es',
            'logo': 'https://mostay.es/img/mostay-logo.svg',
            'description': 'Agencia de diseño web profesional especializada en branding, desarrollo web y marketing digital',
            'address': {
                '@type': 'PostalAddress',
                'addressLocality': 'Andalucía',
                'addressCountry': 'ES'
            },
            'contactPoint': {
                '@type': 'ContactPoint',
                'telephone': '+34-XXX-XXX-XXX',
                'contactType': 'customer service',
                'availableLanguage': ['Spanish', 'English']
            },
            'sameAs': [
                'https://www.linkedin.com/company/mostay',
                'https://twitter.com/mostay',
                'https://www.facebook.com/mostay'
            ]
        };
        
        this.addStructuredData(structuredData);
    }
    
    setupSocialMedia() {
        // Configurar datos para redes sociales
        const socialData = {
            title: document.title,
            description: this.getMetaContent('description'),
            image: 'https://mostay.es/img/social-share.jpg',
            url: window.location.href,
            type: 'website',
            siteName: 'Mostay'
        };
        
        this.updateSocialMetaTags(socialData);
    }
    
    setupBreadcrumbs() {
        // Generar breadcrumbs dinámicos
        const breadcrumbs = this.generateBreadcrumbs();
        
        if (breadcrumbs.length > 1) {
            this.addBreadcrumbStructuredData(breadcrumbs);
            this.renderBreadcrumbs(breadcrumbs);
        }
    }
    
    generateBreadcrumbs() {
        const path = window.location.pathname;
        const segments = path.split('/').filter(segment => segment);
        
        const breadcrumbs = [
            { name: 'Inicio', url: '/', current: segments.length === 0 }
        ];
        
        let currentPath = '';
        segments.forEach((segment, index) => {
            currentPath += `/${segment}`;
            const name = this.getBreadcrumbName(segment);
            breadcrumbs.push({
                name: name,
                url: currentPath,
                current: index === segments.length - 1
            });
        });
        
        return breadcrumbs;
    }
    
    getBreadcrumbName(segment) {
        const nameMap = {
            'about': 'Sobre Nosotros',
            'services': 'Servicios',
            'portfolio': 'Portafolio',
            'contact': 'Contacto',
            'blog': 'Blog'
        };
        
        return nameMap[segment] || segment.charAt(0).toUpperCase() + segment.slice(1);
    }
    
    setupCanonicalUrls() {
        // Configurar URLs canónicas
        const canonicalUrl = this.getCanonicalUrl();
        this.updateCanonicalUrl(canonicalUrl);
    }
    
    getCanonicalUrl() {
        const url = new URL(window.location.href);
        
        // Remover parámetros innecesarios
        const paramsToRemove = ['utm_source', 'utm_medium', 'utm_campaign', 'fbclid'];
        paramsToRemove.forEach(param => {
            url.searchParams.delete(param);
        });
        
        return url.toString();
    }
    
    setupHreflang() {
        // Configurar hreflang para internacionalización
        const supportedLocales = ['es', 'en', 'fr', 'de', 'it', 'pt'];
        const currentUrl = window.location.pathname;
        
        supportedLocales.forEach(locale => {
            const hreflangUrl = `https://mostay.es/${locale}${currentUrl}`;
            this.addHreflangTag(locale, hreflangUrl);
        });
        
        // Hreflang x-default
        this.addHreflangTag('x-default', `https://mostay.es${currentUrl}`);
    }
    
    setupOpenGraph() {
        // Configurar Open Graph tags
        const ogData = {
            'og:title': document.title,
            'og:description': this.getMetaContent('description'),
            'og:image': 'https://mostay.es/img/social-share.jpg',
            'og:url': window.location.href,
            'og:type': 'website',
            'og:site_name': 'Mostay',
            'og:locale': 'es_ES'
        };
        
        Object.entries(ogData).forEach(([property, content]) => {
            this.updateMetaTag('property', property, content);
        });
    }
    
    setupTwitterCards() {
        // Configurar Twitter Cards
        const twitterData = {
            'twitter:card': 'summary_large_image',
            'twitter:site': '@mostay',
            'twitter:creator': '@mostay',
            'twitter:title': document.title,
            'twitter:description': this.getMetaContent('description'),
            'twitter:image': 'https://mostay.es/img/social-share.jpg'
        };
        
        Object.entries(twitterData).forEach(([name, content]) => {
            this.updateMetaTag('name', name, content);
        });
    }
    
    setupSchemaMarkup() {
        // Configurar Schema.org markup adicional
        this.addWebPageSchema();
        this.addLocalBusinessSchema();
        this.addServiceSchema();
    }
    
    setupPerformanceSEO() {
        // Optimizaciones SEO de rendimiento
        this.setupLazyLoading();
        this.setupImageOptimization();
        this.setupLinkPreloading();
        this.setupResourceHints();
    }
    
    // Métodos de utilidad
    updateMetaTag(attribute, value, content) {
        let metaTag = document.querySelector(`meta[${attribute}="${value}"]`);
        
        if (!metaTag) {
            metaTag = document.createElement('meta');
            metaTag.setAttribute(attribute, value);
            document.head.appendChild(metaTag);
        }
        
        metaTag.setAttribute('content', content);
    }
    
    getMetaContent(name) {
        const metaTag = document.querySelector(`meta[name="${name}"]`);
        return metaTag ? metaTag.getAttribute('content') : '';
    }
    
    addStructuredData(data) {
        const script = document.createElement('script');
        script.type = 'application/ld+json';
        script.textContent = JSON.stringify(data);
        document.head.appendChild(script);
    }
    
    updateSocialMetaTags(data) {
        // Actualizar meta tags de redes sociales
        const socialTags = {
            'og:title': data.title,
            'og:description': data.description,
            'og:image': data.image,
            'og:url': data.url,
            'og:type': data.type,
            'og:site_name': data.siteName,
            'twitter:title': data.title,
            'twitter:description': data.description,
            'twitter:image': data.image
        };
        
        Object.entries(socialTags).forEach(([property, content]) => {
            this.updateMetaTag('property', property, content);
        });
    }
    
    addBreadcrumbStructuredData(breadcrumbs) {
        const structuredData = {
            '@context': 'https://schema.org',
            '@type': 'BreadcrumbList',
            'itemListElement': breadcrumbs.map((item, index) => ({
                '@type': 'ListItem',
                'position': index + 1,
                'name': item.name,
                'item': `https://mostay.es${item.url}`
            }))
        };
        
        this.addStructuredData(structuredData);
    }
    
    renderBreadcrumbs(breadcrumbs) {
        // Renderizar breadcrumbs en el DOM
        const breadcrumbContainer = document.querySelector('.breadcrumbs') || this.createBreadcrumbContainer();
        
        const breadcrumbHTML = breadcrumbs.map((item, index) => {
            if (item.current) {
                return `<span class="breadcrumb-current" aria-current="page">${item.name}</span>`;
            } else {
                return `<a href="${item.url}" class="breadcrumb-link">${item.name}</a>`;
            }
        }).join(' <span class="breadcrumb-separator">/</span> ');
        
        breadcrumbContainer.innerHTML = breadcrumbHTML;
    }
    
    createBreadcrumbContainer() {
        const container = document.createElement('nav');
        container.className = 'breadcrumbs';
        container.setAttribute('aria-label', 'Breadcrumb');
        
        // Insertar después del header
        const header = document.querySelector('header');
        if (header) {
            header.parentNode.insertBefore(container, header.nextSibling);
        }
        
        return container;
    }
    
    updateCanonicalUrl(url) {
        let canonicalTag = document.querySelector('link[rel="canonical"]');
        
        if (!canonicalTag) {
            canonicalTag = document.createElement('link');
            canonicalTag.rel = 'canonical';
            document.head.appendChild(canonicalTag);
        }
        
        canonicalTag.href = url;
    }
    
    addHreflangTag(lang, url) {
        const link = document.createElement('link');
        link.rel = 'alternate';
        link.hreflang = lang;
        link.href = url;
        document.head.appendChild(link);
    }
    
    addWebPageSchema() {
        const webPageSchema = {
            '@context': 'https://schema.org',
            '@type': 'WebPage',
            'name': document.title,
            'description': this.getMetaContent('description'),
            'url': window.location.href,
            'mainEntity': {
                '@type': 'Organization',
                'name': 'Mostay'
            }
        };
        
        this.addStructuredData(webPageSchema);
    }
    
    addLocalBusinessSchema() {
        const localBusinessSchema = {
            '@context': 'https://schema.org',
            '@type': 'LocalBusiness',
            'name': 'Mostay',
            'description': 'Agencia de diseño web profesional',
            'address': {
                '@type': 'PostalAddress',
                'addressLocality': 'Andalucía',
                'addressCountry': 'ES'
            },
            'geo': {
                '@type': 'GeoCoordinates',
                'latitude': '37.3891',
                'longitude': '-5.9845'
            },
            'telephone': '+34-XXX-XXX-XXX',
            'email': 'info@mostay.es',
            'url': 'https://mostay.es',
            'openingHours': 'Mo-Fr 09:00-18:00',
            'priceRange': '€€'
        };
        
        this.addStructuredData(localBusinessSchema);
    }
    
    addServiceSchema() {
        const serviceSchema = {
            '@context': 'https://schema.org',
            '@type': 'Service',
            'name': 'Diseño Web Profesional',
            'description': 'Servicios de diseño web, desarrollo y marketing digital',
            'provider': {
                '@type': 'Organization',
                'name': 'Mostay'
            },
            'areaServed': {
                '@type': 'Country',
                'name': 'Spain'
            },
            'hasOfferCatalog': {
                '@type': 'OfferCatalog',
                'name': 'Servicios de Diseño Web',
                'itemListElement': [
                    {
                        '@type': 'Offer',
                        'itemOffered': {
                            '@type': 'Service',
                            'name': 'Diseño Web'
                        }
                    },
                    {
                        '@type': 'Offer',
                        'itemOffered': {
                            '@type': 'Service',
                            'name': 'Desarrollo Web'
                        }
                    },
                    {
                        '@type': 'Offer',
                        'itemOffered': {
                            '@type': 'Service',
                            'name': 'Branding'
                        }
                    }
                ]
            }
        };
        
        this.addStructuredData(serviceSchema);
    }
    
    setupLazyLoading() {
        // Configurar lazy loading para imágenes
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.removeAttribute('data-src');
                            imageObserver.unobserve(img);
                        }
                    }
                });
            });
            
            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });
        }
    }
    
    setupImageOptimization() {
        // Optimizar imágenes para SEO
        document.querySelectorAll('img').forEach(img => {
            if (!img.alt) {
                img.alt = 'Imagen de Mostay';
            }
            
            if (!img.loading) {
                img.loading = 'lazy';
            }
        });
    }
    
    setupLinkPreloading() {
        // Preload de enlaces importantes
        const importantLinks = document.querySelectorAll('a[href^="/"]');
        importantLinks.forEach(link => {
            link.addEventListener('mouseenter', () => {
                const href = link.getAttribute('href');
                if (href && !document.querySelector(`link[href="${href}"]`)) {
                    const preloadLink = document.createElement('link');
                    preloadLink.rel = 'prefetch';
                    preloadLink.href = href;
                    document.head.appendChild(preloadLink);
                }
            });
        });
    }
    
    setupResourceHints() {
        // Agregar resource hints para mejor rendimiento
        const hints = [
            { rel: 'dns-prefetch', href: '//fonts.googleapis.com' },
            { rel: 'dns-prefetch', href: '//code.jquery.com' },
            { rel: 'dns-prefetch', href: '//kit.fontawesome.com' },
            { rel: 'preconnect', href: '//fonts.googleapis.com' },
            { rel: 'preconnect', href: '//fonts.gstatic.com' }
        ];
        
        hints.forEach(hint => {
            if (!document.querySelector(`link[href="${hint.href}"]`)) {
                const link = document.createElement('link');
                link.rel = hint.rel;
                link.href = hint.href;
                document.head.appendChild(link);
            }
        });
    }
    
    // Métodos de análisis SEO
    analyzeSEO() {
        const analysis = {
            title: this.analyzeTitle(),
            description: this.analyzeDescription(),
            headings: this.analyzeHeadings(),
            images: this.analyzeImages(),
            links: this.analyzeLinks(),
            performance: this.analyzePerformance()
        };
        
        console.log('📊 SEO Analysis:', analysis);
        return analysis;
    }
    
    analyzeTitle() {
        const title = document.title;
        const analysis = {
            length: title.length,
            hasKeyword: title.toLowerCase().includes('mostay'),
            isOptimal: title.length >= 30 && title.length <= 60
        };
        
        return analysis;
    }
    
    analyzeDescription() {
        const description = this.getMetaContent('description');
        const analysis = {
            length: description.length,
            hasKeyword: description.toLowerCase().includes('diseño web'),
            isOptimal: description.length >= 120 && description.length <= 160
        };
        
        return analysis;
    }
    
    analyzeHeadings() {
        const headings = document.querySelectorAll('h1, h2, h3, h4, h5, h6');
        const h1Count = document.querySelectorAll('h1').length;
        
        return {
            total: headings.length,
            h1Count: h1Count,
            hasOneH1: h1Count === 1,
            structure: Array.from(headings).map(h => ({
                level: parseInt(h.tagName.charAt(1)),
                text: h.textContent.trim()
            }))
        };
    }
    
    analyzeImages() {
        const images = document.querySelectorAll('img');
        const imagesWithAlt = Array.from(images).filter(img => img.alt);
        
        return {
            total: images.length,
            withAlt: imagesWithAlt.length,
            altPercentage: (imagesWithAlt.length / images.length) * 100
        };
    }
    
    analyzeLinks() {
        const links = document.querySelectorAll('a');
        const internalLinks = Array.from(links).filter(link => 
            link.href && link.href.includes(window.location.hostname)
        );
        const externalLinks = Array.from(links).filter(link => 
            link.href && !link.href.includes(window.location.hostname)
        );
        
        return {
            total: links.length,
            internal: internalLinks.length,
            external: externalLinks.length,
            withRelNoopener: Array.from(externalLinks).filter(link => 
                link.rel && link.rel.includes('noopener')
            ).length
        };
    }
    
    analyzePerformance() {
        return {
            loadTime: performance.now(),
            domContentLoaded: performance.getEntriesByType('navigation')[0]?.domContentLoadedEventEnd,
            firstPaint: performance.getEntriesByType('paint')[0]?.startTime
        };
    }
}

// Auto-initialize
document.addEventListener('DOMContentLoaded', () => {
    window.seoModule = new SEO();
    
    // Analizar SEO después de que se cargue todo
    setTimeout(() => {
        window.seoModule.analyzeSEO();
    }, 2000);
});

// Export for module systems
if (typeof module !== 'undefined' && module.exports) {
    module.exports = SEO;
}
