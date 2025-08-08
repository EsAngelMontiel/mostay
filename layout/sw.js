/**
 * Service Worker - Mostay
 * Caching offline y optimización de rendimiento
 */

const CACHE_NAME = 'mostay-v1.0.0';
const STATIC_CACHE = 'mostay-static-v1.0.0';
const DYNAMIC_CACHE = 'mostay-dynamic-v1.0.0';

// Recursos críticos para cache inmediato
const STATIC_ASSETS = [
    '/',
    '/index.html',
    '/css/main.css',
    '/css/responsive.css',
    '/css/accessibility.css',
    '/js/app.js',
    '/js/modules/navigation.js',
    '/js/modules/slider.js',
    '/js/modules/performance.js',
    '/slick/slick.css',
    '/slick/slick.min.js',
    '/img/mostay-logo.svg',
    '/img/favicon.ico'
];

// Recursos externos para cache
const EXTERNAL_ASSETS = [
    'https://code.jquery.com/jquery-3.7.1.slim.min.js',
    'https://kit.fontawesome.com/64747c8ad2.js'
];

// Estrategias de cache
const CACHE_STRATEGIES = {
    STATIC: 'cache-first',
    DYNAMIC: 'network-first',
    EXTERNAL: 'stale-while-revalidate'
};

// Instalación del Service Worker
self.addEventListener('install', (event) => {
    console.log('🚀 Service Worker instalando...');
    
    event.waitUntil(
        caches.open(STATIC_CACHE)
            .then(cache => {
                console.log('📦 Cacheando recursos estáticos...');
                return cache.addAll(STATIC_ASSETS);
            })
            .then(() => {
                console.log('✅ Service Worker instalado correctamente');
                return self.skipWaiting();
            })
            .catch(error => {
                console.error('❌ Error instalando Service Worker:', error);
            })
    );
});

// Activación del Service Worker
self.addEventListener('activate', (event) => {
    console.log('🔄 Service Worker activando...');
    
    event.waitUntil(
        caches.keys()
            .then(cacheNames => {
                return Promise.all(
                    cacheNames.map(cacheName => {
                        if (cacheName !== STATIC_CACHE && cacheName !== DYNAMIC_CACHE) {
                            console.log('🗑️ Eliminando cache obsoleto:', cacheName);
                            return caches.delete(cacheName);
                        }
                    })
                );
            })
            .then(() => {
                console.log('✅ Service Worker activado');
                return self.clients.claim();
            })
    );
});

// Interceptación de requests
self.addEventListener('fetch', (event) => {
    const { request } = event;
    const url = new URL(request.url);
    
    // Estrategia para recursos estáticos
    if (isStaticAsset(request.url)) {
        event.respondWith(cacheFirst(request));
        return;
    }
    
    // Estrategia para recursos externos
    if (isExternalAsset(request.url)) {
        event.respondWith(staleWhileRevalidate(request));
        return;
    }
    
    // Estrategia para requests dinámicos
    if (request.method === 'GET') {
        event.respondWith(networkFirst(request));
        return;
    }
});

// Estrategia Cache First
async function cacheFirst(request) {
    const cache = await caches.open(STATIC_CACHE);
    const cachedResponse = await cache.match(request);
    
    if (cachedResponse) {
        return cachedResponse;
    }
    
    try {
        const networkResponse = await fetch(request);
        if (networkResponse.ok) {
            cache.put(request, networkResponse.clone());
        }
        return networkResponse;
    } catch (error) {
        console.error('Error en cache-first:', error);
        return new Response('Offline content not available', {
            status: 503,
            statusText: 'Service Unavailable'
        });
    }
}

// Estrategia Network First
async function networkFirst(request) {
    const cache = await caches.open(DYNAMIC_CACHE);
    
    try {
        const networkResponse = await fetch(request);
        if (networkResponse.ok) {
            cache.put(request, networkResponse.clone());
        }
        return networkResponse;
    } catch (error) {
        console.log('🌐 Network failed, trying cache...');
        const cachedResponse = await cache.match(request);
        
        if (cachedResponse) {
            return cachedResponse;
        }
        
        // Fallback para páginas HTML
        if (request.headers.get('accept').includes('text/html')) {
            return cache.match('/offline.html');
        }
        
        return new Response('Offline content not available', {
            status: 503,
            statusText: 'Service Unavailable'
        });
    }
}

// Estrategia Stale While Revalidate
async function staleWhileRevalidate(request) {
    const cache = await caches.open(DYNAMIC_CACHE);
    const cachedResponse = await cache.match(request);
    
    const fetchPromise = fetch(request).then(networkResponse => {
        if (networkResponse.ok) {
            cache.put(request, networkResponse.clone());
        }
        return networkResponse;
    }).catch(() => {
        console.log('🌐 Network failed for external asset');
    });
    
    return cachedResponse || fetchPromise;
}

// Helpers
function isStaticAsset(url) {
    return STATIC_ASSETS.some(asset => url.includes(asset)) ||
           url.includes('/css/') ||
           url.includes('/js/') ||
           url.includes('/img/') ||
           url.includes('/slick/');
}

function isExternalAsset(url) {
    return EXTERNAL_ASSETS.some(asset => url.includes(asset)) ||
           url.includes('fonts.googleapis.com') ||
           url.includes('fonts.gstatic.com');
}

// Background Sync para formularios offline
self.addEventListener('sync', (event) => {
    if (event.tag === 'background-sync') {
        console.log('🔄 Background sync iniciado');
        event.waitUntil(doBackgroundSync());
    }
});

async function doBackgroundSync() {
    try {
        const requests = await getOfflineRequests();
        for (const request of requests) {
            await sendOfflineRequest(request);
        }
        console.log('✅ Background sync completado');
    } catch (error) {
        console.error('❌ Error en background sync:', error);
    }
}

// Push notifications
self.addEventListener('push', (event) => {
    console.log('📱 Push notification recibida');
    
    const options = {
        body: event.data ? event.data.text() : 'Nueva notificación de Mostay',
        icon: '/img/mostay-logo.svg',
        badge: '/img/favicon.ico',
        vibrate: [100, 50, 100],
        data: {
            dateOfArrival: Date.now(),
            primaryKey: 1
        },
        actions: [
            {
                action: 'explore',
                title: 'Ver más',
                icon: '/img/favicon.ico'
            },
            {
                action: 'close',
                title: 'Cerrar',
                icon: '/img/favicon.ico'
            }
        ]
    };
    
    event.waitUntil(
        self.registration.showNotification('Mostay', options)
    );
});

// Click en notificación
self.addEventListener('notificationclick', (event) => {
    console.log('👆 Notificación clickeada');
    
    event.notification.close();
    
    if (event.action === 'explore') {
        event.waitUntil(
            clients.openWindow('/')
        );
    }
});

// Mensajes del cliente
self.addEventListener('message', (event) => {
    if (event.data && event.data.type === 'SKIP_WAITING') {
        self.skipWaiting();
    }
    
    if (event.data && event.data.type === 'GET_VERSION') {
        event.ports[0].postMessage({ version: CACHE_NAME });
    }
});

// Helpers para background sync
async function getOfflineRequests() {
    // Implementar lógica para obtener requests offline
    return [];
}

async function sendOfflineRequest(request) {
    // Implementar lógica para enviar requests offline
    return fetch(request.url, {
        method: request.method,
        headers: request.headers,
        body: request.body
    });
}
