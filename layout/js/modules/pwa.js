/**
 * PWA Module - Mostay
 * Funcionalidades de Progressive Web App
 */

class PWA {
    constructor() {
        this.deferredPrompt = null;
        this.installButton = null;
        this.isInstalled = false;
        
        this.init();
    }
    
    init() {
        this.setupInstallPrompt();
        this.setupBeforeInstallPrompt();
        this.setupAppInstalled();
        this.setupOfflineDetection();
        this.setupUpdateNotification();
    }
    
    setupInstallPrompt() {
        // Crear botón de instalación si no existe
        this.installButton = document.querySelector('#pwa-install') || this.createInstallButton();
        
        if (this.installButton) {
            this.installButton.addEventListener('click', () => {
                this.installPWA();
            });
        }
    }
    
    createInstallButton() {
        const button = document.createElement('button');
        button.id = 'pwa-install';
        button.className = 'pwa-install-btn';
        button.innerHTML = `
            <i class="fas fa-download" aria-hidden="true"></i>
            <span>Instalar App</span>
        `;
        button.setAttribute('aria-label', 'Instalar Mostay como aplicación');
        
        // Agregar estilos
        const style = document.createElement('style');
        style.textContent = `
            .pwa-install-btn {
                position: fixed;
                bottom: 20px;
                right: 20px;
                background: #007bff;
                color: white;
                border: none;
                border-radius: 50px;
                padding: 12px 20px;
                font-size: 14px;
                cursor: pointer;
                box-shadow: 0 4px 12px rgba(0,123,255,0.3);
                transition: all 0.3s ease;
                z-index: 1000;
                display: none;
            }
            .pwa-install-btn:hover {
                background: #0056b3;
                transform: translateY(-2px);
                box-shadow: 0 6px 16px rgba(0,123,255,0.4);
            }
            .pwa-install-btn i {
                margin-right: 8px;
            }
            @media (max-width: 768px) {
                .pwa-install-btn {
                    bottom: 10px;
                    right: 10px;
                    padding: 10px 16px;
                    font-size: 12px;
                }
            }
        `;
        document.head.appendChild(style);
        
        // Agregar al body
        document.body.appendChild(button);
        
        return button;
    }
    
    setupBeforeInstallPrompt() {
        window.addEventListener('beforeinstallprompt', (e) => {
            console.log('📱 PWA install prompt disponible');
            
            // Prevenir el prompt automático
            e.preventDefault();
            
            // Guardar el evento para usarlo después
            this.deferredPrompt = e;
            
            // Mostrar el botón de instalación
            if (this.installButton) {
                this.installButton.style.display = 'block';
                
                // Ocultar después de 10 segundos
                setTimeout(() => {
                    this.installButton.style.display = 'none';
                }, 10000);
            }
        });
    }
    
    setupAppInstalled() {
        window.addEventListener('appinstalled', (e) => {
            console.log('✅ PWA instalada correctamente');
            this.isInstalled = true;
            
            // Ocultar el botón de instalación
            if (this.installButton) {
                this.installButton.style.display = 'none';
            }
            
            // Mostrar notificación de éxito
            this.showNotification('¡App instalada!', 'Mostay ha sido instalada como aplicación.');
            
            // Track analytics
            if (typeof gtag !== 'undefined') {
                gtag('event', 'pwa_installed', {
                    'event_category': 'engagement',
                    'event_label': 'pwa_install'
                });
            }
        });
    }
    
    setupOfflineDetection() {
        // Detectar cambios en la conectividad
        window.addEventListener('online', () => {
            console.log('🌐 Conexión restaurada');
            this.showNotification('Conexión restaurada', 'Ya puedes navegar normalmente.');
            document.body.classList.remove('offline');
        });
        
        window.addEventListener('offline', () => {
            console.log('📴 Sin conexión');
            this.showNotification('Sin conexión', 'Algunas funciones pueden no estar disponibles.');
            document.body.classList.add('offline');
        });
        
        // Verificar estado inicial
        if (!navigator.onLine) {
            document.body.classList.add('offline');
        }
    }
    
    setupUpdateNotification() {
        // Escuchar actualizaciones del Service Worker
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.addEventListener('controllerchange', () => {
                console.log('🔄 Service Worker actualizado');
                this.showNotification('Actualización disponible', 'Recarga la página para ver los cambios.');
            });
        }
    }
    
    async installPWA() {
        if (!this.deferredPrompt) {
            console.log('❌ No hay prompt de instalación disponible');
            return;
        }
        
        try {
            // Mostrar el prompt de instalación
            this.deferredPrompt.prompt();
            
            // Esperar la respuesta del usuario
            const { outcome } = await this.deferredPrompt.userChoice;
            
            console.log(`📱 Usuario ${outcome} la instalación`);
            
            // Limpiar el prompt
            this.deferredPrompt = null;
            
            // Ocultar el botón
            if (this.installButton) {
                this.installButton.style.display = 'none';
            }
            
            // Track analytics
            if (typeof gtag !== 'undefined') {
                gtag('event', 'pwa_install_prompt', {
                    'event_category': 'engagement',
                    'event_label': outcome
                });
            }
            
        } catch (error) {
            console.error('❌ Error durante la instalación:', error);
        }
    }
    
    showNotification(title, message) {
        // Verificar si las notificaciones están permitidas
        if (!('Notification' in window)) {
            console.log('❌ Este navegador no soporta notificaciones');
            return;
        }
        
        if (Notification.permission === 'granted') {
            new Notification(title, {
                body: message,
                icon: '/img/mostay-logo.svg',
                badge: '/img/favicon.ico'
            });
        } else if (Notification.permission !== 'denied') {
            Notification.requestPermission().then(permission => {
                if (permission === 'granted') {
                    new Notification(title, {
                        body: message,
                        icon: '/img/mostay-logo.svg',
                        badge: '/img/favicon.ico'
                    });
                }
            });
        }
    }
    
    // Solicitar permisos de notificación
    async requestNotificationPermission() {
        if (!('Notification' in window)) {
            console.log('❌ Notificaciones no soportadas');
            return false;
        }
        
        if (Notification.permission === 'granted') {
            return true;
        }
        
        if (Notification.permission === 'denied') {
            console.log('❌ Permisos de notificación denegados');
            return false;
        }
        
        const permission = await Notification.requestPermission();
        return permission === 'granted';
    }
    
    // Solicitar permisos de push
    async requestPushPermission() {
        if (!('serviceWorker' in navigator) || !('PushManager' in window)) {
            console.log('❌ Push notifications no soportadas');
            return false;
        }
        
        try {
            const registration = await navigator.serviceWorker.ready;
            const permission = await registration.pushManager.subscribe({
                userVisibleOnly: true,
                applicationServerKey: this.urlBase64ToUint8Array('YOUR_VAPID_PUBLIC_KEY')
            });
            
            console.log('✅ Push subscription creada:', permission);
            return true;
            
        } catch (error) {
            console.error('❌ Error solicitando push permission:', error);
            return false;
        }
    }
    
    // Convertir VAPID key
    urlBase64ToUint8Array(base64String) {
        const padding = '='.repeat((4 - base64String.length % 4) % 4);
        const base64 = (base64String + padding)
            .replace(/-/g, '+')
            .replace(/_/g, '/');
        
        const rawData = window.atob(base64);
        const outputArray = new Uint8Array(rawData.length);
        
        for (let i = 0; i < rawData.length; ++i) {
            outputArray[i] = rawData.charCodeAt(i);
        }
        return outputArray;
    }
    
    // Verificar si la app está instalada
    isAppInstalled() {
        return window.matchMedia('(display-mode: standalone)').matches ||
               window.navigator.standalone === true;
    }
    
    // Obtener información del Service Worker
    async getServiceWorkerInfo() {
        if (!('serviceWorker' in navigator)) {
            return null;
        }
        
        const registration = await navigator.serviceWorker.getRegistration();
        return {
            active: registration?.active?.state || 'none',
            waiting: registration?.waiting?.state || 'none',
            installing: registration?.installing?.state || 'none'
        };
    }
    
    // Forzar actualización del Service Worker
    async updateServiceWorker() {
        if (!('serviceWorker' in navigator)) {
            return false;
        }
        
        try {
            const registration = await navigator.serviceWorker.getRegistration();
            if (registration) {
                await registration.update();
                console.log('🔄 Service Worker actualización solicitada');
                return true;
            }
        } catch (error) {
            console.error('❌ Error actualizando Service Worker:', error);
        }
        
        return false;
    }
    
    // Limpiar cache
    async clearCache() {
        if (!('caches' in window)) {
            return false;
        }
        
        try {
            const cacheNames = await caches.keys();
            await Promise.all(
                cacheNames.map(cacheName => caches.delete(cacheName))
            );
            console.log('🗑️ Cache limpiado');
            return true;
        } catch (error) {
            console.error('❌ Error limpiando cache:', error);
            return false;
        }
    }
}

// Auto-initialize
document.addEventListener('DOMContentLoaded', () => {
    window.pwaModule = new PWA();
});

// Export for module systems
if (typeof module !== 'undefined' && module.exports) {
    module.exports = PWA;
}
