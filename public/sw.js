const CACHE_NAME = 'coffee-loyalty-v1';
const urlsToCache = [
    '/',
    '/manifest.json'
];

// Install event
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => {
                console.log('Opened cache');
                return cache.addAll(urlsToCache).catch(error => {
                    console.log('Cache addAll failed:', error);
                    // Continue with installation even if caching fails
                    return Promise.resolve();
                });
            })
    );
});

// Fetch event
self.addEventListener('fetch', event => {
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                // Return cached version or fetch from network
                if (response) {
                    return response;
                }
                return fetch(event.request);
            }
        )
    );
});

// Activate event
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cacheName => {
                    if (cacheName !== CACHE_NAME) {
                        console.log('Deleting old cache:', cacheName);
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
});

// Background sync for offline transactions
self.addEventListener('sync', event => {
    if (event.tag === 'background-sync') {
        event.waitUntil(doBackgroundSync());
    }
});

function doBackgroundSync() {
    // Sync offline transactions when connection is restored
    return fetch('/api/sync-offline-transactions', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            // Offline transaction data from IndexedDB
        })
    });
}

// Push notification handling
self.addEventListener('push', event => {
    const options = {
        body: event.data ? event.data.text() : 'You have new points!',
        icon: '/android-chrome-192x192.png',
        badge: '/android-chrome-192x192.png',
        vibrate: [100, 50, 100],
        data: {
            dateOfArrival: Date.now(),
            primaryKey: 1
        },
        actions: [
            {
                action: 'explore',
                title: 'View Points',
                icon: '/android-chrome-192x192.png'
            },
            {
                action: 'close',
                title: 'Close',
                icon: '/android-chrome-192x192.png'
            }
        ]
    };

    event.waitUntil(
        self.registration.showNotification('Coffee Shop Loyalty', options)
    );
});

// Notification click handling
self.addEventListener('notificationclick', event => {
    event.notification.close();

    if (event.action === 'explore') {
        event.waitUntil(
            clients.openWindow('/')
        );
    }
});
