<div class="p-6">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-neutral-800 mb-2 font-heading">Install App</h1>
        <p class="text-neutral-600">Get quick access to your coffee loyalty app</p>
    </div>

    <!-- Install Button -->
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
        <div class="text-center">
            <div class="w-20 h-20 bg-primary-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                </svg>
            </div>
            <h2 class="text-xl font-semibold text-neutral-900 mb-2 font-heading">Install Cafe Royalty</h2>
            <p class="text-neutral-600 mb-6">Add this app to your home screen for quick access</p>

            <button id="installBtn" class="bg-primary-600 text-white px-8 py-3 rounded-xl text-lg font-medium hover:bg-primary-700 transition-colors flex items-center mx-auto space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
                <span>Install App</span>
            </button>

            <p id="installStatus" class="text-sm text-neutral-500 mt-3 hidden">Installation prompt will appear...</p>
        </div>
    </div>

    <!-- Manual Instructions -->
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <h2 class="text-xl font-semibold text-neutral-900 mb-4 font-heading">Manual Installation</h2>

        <div class="space-y-6">
            <!-- iOS Instructions -->
            <div class="border border-neutral-200 rounded-xl p-4">
                <div class="flex items-center mb-3">
                    <svg class="w-6 h-6 text-neutral-700 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>
                    </svg>
                    <h3 class="font-semibold text-neutral-900">iPhone/iPad</h3>
                </div>
                <ol class="list-decimal list-inside space-y-2 text-sm text-neutral-700">
                    <li>Tap the <strong>Share</strong> button <svg class="w-4 h-4 inline" fill="currentColor" viewBox="0 0 24 24"><path d="M16 5l-1.42 1.42-1.59-1.59V16h-1.98V4.83L9.42 6.42 8 5l4-4 4 4zm4 5v11c0 1.1-.9 2-2 2H6c-1.11 0-2-.9-2-2V10c0-1.11.89-2 2-2h3v2H6v11h12V10h-3V8h3c1.1 0 2 .89 2 2z"/></svg> in Safari</li>
                    <li>Scroll down and tap <strong>"Add to Home Screen"</strong></li>
                    <li>Tap <strong>"Add"</strong> to confirm</li>
                    <li>The app will appear on your home screen</li>
                </ol>
            </div>

            <!-- Android Instructions -->
            <div class="border border-neutral-200 rounded-xl p-4">
                <div class="flex items-center mb-3">
                    <svg class="w-6 h-6 text-neutral-700 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M16.61 15.15c-.46 0-.84-.37-.84-.84s.37-.84.84-.84.84.37.84.84-.37.84-.84.84M7.39 15.15c-.46 0-.84-.37-.84-.84s.37-.84.84-.84.84.37.84.84-.37.84-.84.84M16.61 7.15c-.46 0-.84-.37-.84-.84s.37-.84.84-.84.84.37.84.84-.37.84-.84.84M7.39 7.15c-.46 0-.84-.37-.84-.84s.37-.84.84-.84.84.37.84.84-.37.84-.84.84M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/>
                    </svg>
                    <h3 class="font-semibold text-neutral-900">Android</h3>
                </div>
                <ol class="list-decimal list-inside space-y-2 text-sm text-neutral-700">
                    <li>Tap the <strong>Menu</strong> button <svg class="w-4 h-4 inline" fill="currentColor" viewBox="0 0 24 24"><path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/></svg> in Chrome</li>
                    <li>Tap <strong>"Add to Home screen"</strong></li>
                    <li>Tap <strong>"Add"</strong> to confirm</li>
                    <li>The app will appear on your home screen</li>
                </ol>
            </div>

            <!-- Desktop Instructions -->
            <div class="border border-neutral-200 rounded-xl p-4">
                <div class="flex items-center mb-3">
                    <svg class="w-6 h-6 text-neutral-700 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <h3 class="font-semibold text-neutral-900">Desktop (Chrome/Edge)</h3>
                </div>
                <ol class="list-decimal list-inside space-y-2 text-sm text-neutral-700">
                    <li>Click the <strong>Install</strong> button in the address bar</li>
                    <li>Or click the <strong>Menu</strong> button and select "Install Cafe Royalty"</li>
                    <li>Click <strong>"Install"</strong> to confirm</li>
                    <li>The app will open in its own window</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<script>
    // Install Button Logic
    let deferredPrompt;
    const installBtn = document.getElementById('installBtn');
    const installStatus = document.getElementById('installStatus');

    window.addEventListener('beforeinstallprompt', (e) => {
        e.preventDefault();
        deferredPrompt = e;

        // Show install button
        if (installBtn) {
            installBtn.classList.remove('hidden');
        }
        if (installStatus) {
            installStatus.classList.remove('hidden');
        }
    });

    if (installBtn) {
        installBtn.addEventListener('click', async () => {
            if (deferredPrompt) {
                deferredPrompt.prompt();
                const { outcome } = await deferredPrompt.userChoice;
                if (outcome === 'accepted') {
                    console.log('User accepted the install prompt');
                    if (installStatus) {
                        installStatus.textContent = 'App installed successfully!';
                        installStatus.classList.remove('text-neutral-500');
                        installStatus.classList.add('text-green-600');
                    }
                } else {
                    console.log('User dismissed the install prompt');
                    if (installStatus) {
                        installStatus.textContent = 'Installation cancelled';
                        installStatus.classList.remove('text-neutral-500');
                        installStatus.classList.add('text-red-600');
                    }
                }
                deferredPrompt = null;
            }
        });
    }

    // Check if app is already installed
    window.addEventListener('appinstalled', (evt) => {
        console.log('App was installed');
        if (installStatus) {
            installStatus.textContent = 'App installed successfully!';
            installStatus.classList.remove('text-neutral-500');
            installStatus.classList.add('text-green-600');
        }
    });
</script>
