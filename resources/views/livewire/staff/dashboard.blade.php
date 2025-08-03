<div class="p-4">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center mb-3">
            <div class="w-12 h-12 bg-gradient-to-br from-blue-200 to-blue-300 rounded-full flex items-center justify-center mr-4">
                <svg class="w-6 h-6 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Staff Dashboard</h1>
                <p class="text-gray-600">Scan customer QR codes and process transactions</p>
            </div>
        </div>
    </div>

    <!-- Message Display -->
    @if($message)
        <div class="mb-6 p-4 rounded-lg {{ $messageType === 'success' ? 'bg-green-50 border border-green-200 text-green-800' : 'bg-red-50 border border-red-200 text-red-800' }}">
            {{ $message }}
        </div>
    @endif

    <!-- Quick Actions -->
    <div class="grid grid-cols-3 gap-4 mb-6">
        <button wire:click="toggleScanner" class="relative overflow-hidden bg-gradient-to-br from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-2xl p-6 text-center transition-all duration-300 shadow-xl transform hover:scale-105">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative">
                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V6a1 1 0 00-1-1H5a1 1 0 00-1 1v1a1 1 0 001 1zm12 0h2a1 1 0 001-1V6a1 1 0 00-1-1h-2a1 1 0 00-1 1v1a1 1 0 001 1zM5 20h2a1 1 0 001-1v-1a1 1 0 00-1-1H5a1 1 0 00-1 1v1a1 1 0 001 1z"></path>
                    </svg>
                </div>
                <div class="font-bold text-lg">Scan QR Code</div>
                <div class="text-blue-100 text-sm">Customer or redemption</div>
            </div>
        </button>

        <button wire:click="toggleManualQrInput" class="relative overflow-hidden bg-gradient-to-br from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white rounded-2xl p-6 text-center transition-all duration-300 shadow-xl transform hover:scale-105">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative">
                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <div class="font-bold text-lg">Manual QR</div>
                <div class="text-purple-100 text-sm">Type QR code</div>
            </div>
        </button>

        <button wire:click="$set('showPurchaseForm', true)" class="relative overflow-hidden bg-gradient-to-br from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white rounded-2xl p-6 text-center transition-all duration-300 shadow-xl transform hover:scale-105">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative">
                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <div class="font-bold text-lg">Manual Entry</div>
                <div class="text-green-100 text-sm">Add points manually</div>
            </div>
        </button>
    </div>

    <!-- Manual QR Input Section -->
    @if($showManualQrInput)
    <div class="relative overflow-hidden bg-white rounded-2xl shadow-xl p-6 mb-6">
        <div class="absolute top-0 left-0 w-32 h-32 bg-gradient-to-br from-purple-100 to-purple-200 rounded-full -ml-16 -mt-16 opacity-50"></div>
        <div class="relative">
            <div class="flex items-center mb-6">
                <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Manual QR Code Entry</h2>
                    <p class="text-gray-600 text-sm">Enter QR code manually if camera doesn't work</p>
                </div>
            </div>

            <form wire:submit="processManualQrCode">
                <div class="mb-4">
                    <label for="manualQrCode" class="block text-sm font-medium text-gray-700 mb-2">QR Code</label>
                    <input
                        type="text"
                        id="manualQrCode"
                        wire:model="manualQrCode"
                        class="w-full px-4 py-3 border border-purple-200 rounded-lg focus:ring-2 focus:ring-purple-600 focus:border-transparent bg-purple-50"
                        placeholder="Enter QR code here..."
                        required
                    >
                </div>

                <div class="flex gap-3">
                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        class="flex-1 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 disabled:bg-gray-400 text-white px-6 py-3 rounded-xl transition-all duration-300 font-semibold shadow-lg transform hover:scale-105"
                    >
                        <span wire:loading.remove>Process QR Code</span>
                        <span wire:loading>Processing...</span>
                    </button>
                    <button
                        type="button"
                        wire:click="toggleManualQrInput"
                        class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-xl transition-colors"
                    >
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <!-- QR Scanner Section -->
    @if($showScanner)
    <div class="relative overflow-hidden bg-white rounded-2xl shadow-xl p-6 mb-6">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full -mr-16 -mt-16 opacity-50"></div>
        <div class="relative">
            <div class="flex items-center mb-6">
                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V6a1 1 0 00-1-1H5a1 1 0 00-1 1v1a1 1 0 001 1zm12 0h2a1 1 0 001-1V6a1 1 0 00-1-1h-2a1 1 0 00-1 1v1a1 1 0 001 1zM5 20h2a1 1 0 001-1v-1a1 1 0 00-1-1H5a1 1 0 00-1 1v1a1 1 0 001 1z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">QR Scanner</h2>
                    <p class="text-gray-600 text-sm">Point camera at customer QR code or redemption</p>
                </div>
            </div>

            <div class="text-center">
                <div id="qr-scanner-container" class="w-full max-w-sm mx-auto mb-6">
                    <div class="relative">
                        <video id="qr-video" class="w-full rounded-2xl shadow-lg" autoplay playsinline muted style="background-color: #000;"></video>
                        <div class="absolute inset-0 border-4 border-blue-400 rounded-2xl pointer-events-none"></div>
                        <div class="absolute top-4 left-4 right-4 text-center">
                            <div class="bg-black bg-opacity-50 text-white px-3 py-1 rounded-full text-sm">
                                Point camera at QR code
                            </div>
                        </div>
                        <div id="camera-status" class="absolute bottom-4 left-4 right-4 text-center">
                            <div class="bg-blue-600 bg-opacity-75 text-white px-3 py-1 rounded-full text-sm">
                                Starting camera...
                            </div>
                        </div>

                    </div>
                </div>

                <div class="mb-4">
                    <p class="text-sm text-gray-600 mb-2">Camera not working?</p>
                    <button wire:click="toggleManualQrInput" class="text-blue-600 hover:text-blue-700 text-sm underline">
                        Use manual QR entry instead
                    </button>
                </div>

                <button wire:click="toggleScanner" class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-xl transition-all duration-300 shadow-lg transform hover:scale-105">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Stop Scanner
                </button>
            </div>
        </div>
    </div>
    @endif

    <!-- Purchase Form -->
    @if($showPurchaseForm || $selectedUser)
    <div class="relative overflow-hidden bg-white rounded-2xl shadow-xl p-6 mb-6">
        <div class="absolute top-0 left-0 w-32 h-32 bg-gradient-to-br from-green-100 to-green-200 rounded-full -ml-16 -mt-16 opacity-50"></div>
        <div class="relative">
            <div class="flex items-center mb-6">
                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Process Purchase</h2>
                    <p class="text-gray-600 text-sm">Add points for customer purchase</p>
                </div>
            </div>

            @if($selectedUser)
            <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                        <span class="text-blue-800 font-semibold">{{ $selectedUser->initials() }}</span>
                    </div>
                    <div>
                        <div class="font-semibold text-gray-800">{{ $selectedUser->name }}</div>
                        <div class="text-sm text-gray-600">{{ $selectedUser->email }}</div>
                        <div class="text-sm text-blue-600">Current Points: {{ number_format($selectedUser->points_balance) }}</div>
                    </div>
                </div>
            </div>
            @endif

            <form wire:submit="processPurchase">
                <div class="mb-4">
                    <label for="purchaseAmount" class="block text-sm font-medium text-gray-700 mb-2">Purchase Amount ($)</label>
                    <input
                        type="number"
                        id="purchaseAmount"
                        wire:model="purchaseAmount"
                        step="0.01"
                        min="0.01"
                        max="1000"
                        class="w-full px-4 py-3 border border-green-200 rounded-lg focus:ring-2 focus:ring-green-600 focus:border-transparent bg-green-50"
                        placeholder="Enter purchase amount"
                        required
                    >
                </div>

                <div class="flex gap-3">
                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        class="flex-1 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 disabled:bg-gray-400 text-white px-6 py-3 rounded-xl transition-all duration-300 font-semibold shadow-lg transform hover:scale-105"
                    >
                        <span wire:loading.remove>Process Purchase</span>
                        <span wire:loading>Processing...</span>
                    </button>
                    <button
                        type="button"
                        wire:click="$set('showPurchaseForm', false); $set('selectedUser', null)"
                        class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-xl transition-colors"
                    >
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <!-- Recent Transactions -->
    <div class="relative overflow-hidden bg-white rounded-2xl shadow-xl p-6 mb-6">
        <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-amber-100 to-amber-200 rounded-full -mr-12 -mt-12 opacity-50"></div>
        <div class="relative">
            <div class="flex items-center mb-6">
                <div class="w-10 h-10 bg-amber-100 rounded-full flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Recent Transactions</h3>
                    <p class="text-gray-600 text-sm">Latest customer activity</p>
                </div>
            </div>

            @if(count($recentTransactions) > 0)
                <div class="space-y-4">
                    @foreach($recentTransactions as $transaction)
                    <div class="flex items-center justify-between p-4 bg-gradient-to-r from-amber-50 to-amber-100 rounded-xl border border-amber-200 shadow-sm">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-full {{ $transaction->type === 'earn' ? 'bg-gradient-to-br from-amber-200 to-amber-300' : 'bg-gradient-to-br from-amber-300 to-amber-400' }} flex items-center justify-center mr-4 shadow-sm">
                                @if($transaction->type === 'earn')
                                    <svg class="w-6 h-6 text-amber-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                @else
                                    <svg class="w-6 h-6 text-amber-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                @endif
                            </div>
                            <div>
                                <div class="font-semibold text-gray-800">
                                    {{ $transaction->user->name }}
                                </div>
                                <div class="text-sm text-gray-600">
                                    {{ $transaction->type === 'earn' ? 'Earned' : 'Redeemed' }} {{ $transaction->points }} points
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $transaction->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="font-bold text-lg {{ $transaction->type === 'earn' ? 'text-amber-700' : 'text-amber-600' }}">
                                {{ $transaction->type === 'earn' ? '+' : '-' }}{{ $transaction->points }}
                            </div>
                            <div class="text-xs text-gray-500 bg-white px-2 py-1 rounded-full">
                                {{ $transaction->status }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-500">No transactions yet</p>
                </div>
            @endif
        </div>
    </div>

    <!-- All Redemptions -->
    @if(count($allRedemptions) > 0)
    <div class="relative overflow-hidden bg-white rounded-2xl shadow-xl p-6">
        <div class="absolute top-0 left-0 w-24 h-24 bg-gradient-to-br from-green-100 to-green-200 rounded-full -ml-12 -mt-12 opacity-50"></div>
        <div class="relative">
            <div class="flex items-center mb-6">
                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">All Redemptions</h3>
                    <p class="text-gray-600 text-sm">Recent redemption activity</p>
                </div>
            </div>

            <div class="space-y-4">
                @foreach($allRedemptions as $redemption)
                <div class="flex items-center justify-between p-4 rounded-xl border shadow-sm {{ $redemption->status === 'pending' ? 'bg-gradient-to-r from-green-50 to-green-100 border-green-200' : 'bg-gradient-to-r from-gray-50 to-gray-100 border-gray-200' }}">
                    <div class="flex items-center">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center mr-4 shadow-sm {{ $redemption->status === 'pending' ? 'bg-gradient-to-br from-green-200 to-green-300' : 'bg-gradient-to-br from-gray-200 to-gray-300' }}">
                            @if($redemption->status === 'pending')
                                <svg class="w-6 h-6 text-green-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            @else
                                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            @endif
                        </div>
                        <div>
                            <div class="font-semibold text-gray-800">
                                {{ $redemption->user->name }}
                            </div>
                            <div class="text-sm text-gray-600">
                                ${{ number_format($redemption->discount_amount, 2) }} discount
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ $redemption->created_at->diffForHumans() }}
                                @if($redemption->status === 'used' && $redemption->used_at)
                                    • Used {{ $redemption->used_at->diffForHumans() }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="font-bold text-lg {{ $redemption->status === 'pending' ? 'text-green-700' : 'text-gray-600' }}">
                            -{{ $redemption->pointsTransaction ? $redemption->pointsTransaction->points : $redemption->discount_amount * 10 }}
                        </div>
                        <div class="text-xs text-gray-500 bg-white px-2 py-1 rounded-full">
                            {{ ucfirst($redemption->status) }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.min.js"></script>
<script>
    let video = null;
    let canvas = null;
    let scanning = false;
    let scannerRetryCount = 0;
    const MAX_RETRIES = 50; // 5 seconds max

    function updateCameraStatus(message) {
        const statusElement = document.getElementById('camera-status');
        if (statusElement) {
            statusElement.innerHTML = `<div class="bg-blue-600 bg-opacity-75 text-white px-3 py-1 rounded-full text-sm">${message}</div>`;
        }
    }

    document.addEventListener('livewire:init', () => {
        Livewire.on('start-scanner', () => {
            console.log('Livewire start-scanner event received');
            // Small delay to ensure DOM is ready
            setTimeout(() => {
                startScanner();
            }, 100);
        });

        Livewire.on('stop-scanner', () => {
            console.log('Livewire stop-scanner event received');
            stopScanner();
        });
    });

    function startScanner() {
        // Wait for video element to be available
        const videoElement = document.getElementById('qr-video');
        if (!videoElement) {
            scannerRetryCount++;
            if (scannerRetryCount > MAX_RETRIES) {
                console.error('Video element not found after maximum retries');
                updateCameraStatus('Scanner error');
                alert('Scanner failed to initialize. Please use manual QR entry.');
                Livewire.dispatch('stop-scanner');
                return;
            }
            console.error('Video element not found, retrying in 100ms... (attempt ' + scannerRetryCount + ')');
            setTimeout(startScanner, 100);
            return;
        }

        // Reset retry count on success
        scannerRetryCount = 0;

        video = videoElement;
        canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');

        // Check if getUserMedia is supported
        if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
            alert('Camera access is not supported in this browser. Please use a modern browser with camera support.');
            return;
        }

        // Check if we're on HTTPS (required for camera access)
        if (location.protocol !== 'https:' && location.hostname !== 'localhost' && location.hostname !== '127.0.0.1') {
            alert('Camera access requires HTTPS. Please access this page via HTTPS or localhost.');
            return;
        }

        console.log('Starting camera...');
        updateCameraStatus('Starting camera...');

        // Check if getUserMedia is available
        if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
            alert('Camera access is not supported in this browser. Please use manual QR entry.');
            Livewire.dispatch('stop-scanner');
            return;
        }

        // Start camera
        tryCameraConstraints();
    }

    function tryCameraConstraints() {
        updateCameraStatus('Starting camera...');

        // Get the video element
        const videoElement = document.getElementById('qr-video');
        if (!videoElement) {
            alert('Video element not found');
            Livewire.dispatch('stop-scanner');
            return;
        }

        // Start camera
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => {
                // Set video stream
                video = videoElement;
                video.srcObject = stream;
                video.setAttribute('playsinline', true);
                video.setAttribute('muted', true);
                video.setAttribute('autoplay', true);

                // Wait for video to be ready
                video.onloadedmetadata = function() {
                    updateCameraStatus('Camera ready');

                    video.play().then(() => {
                        updateCameraStatus('Scanning...');
                        scanning = true;
                        scanQRCode();
                    }).catch(playError => {
                        alert('Error starting video stream. Please try again.');
                        Livewire.dispatch('stop-scanner');
                    });
                };

                video.onerror = function(error) {
                    alert('Error loading video stream. Please try again.');
                    Livewire.dispatch('stop-scanner');
                };
            })
            .catch(err => {
                if (err.name === 'NotAllowedError') {
                    alert('Camera access denied. Please allow camera access in your browser settings and refresh the page.');
                } else if (err.name === 'NotFoundError') {
                    alert('No camera found on this device. Please use manual QR entry.');
                } else if (err.name === 'NotReadableError') {
                    alert('Camera is already in use by another application. Please close other apps using the camera.');
                } else {
                    alert('Camera error. Please try again or use manual QR entry.');
                }
                Livewire.dispatch('stop-scanner');
            });
    }

    function stopScanner() {
        scanning = false;
        scannerRetryCount = 0;

        if (video && video.srcObject) {
            video.srcObject.getTracks().forEach(track => track.stop());
        }
    }

    function scanQRCode() {
        if (!scanning || !video || !canvas) {
            return;
        }

        // Check if jsQR is available
        if (typeof jsQR === 'undefined') {
            console.error('jsQR library not loaded');
            return;
        }

        try {
            const context = canvas.getContext('2d');

            // Set canvas size to video size
            if (video.videoWidth > 0 && video.videoHeight > 0) {
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;

                // Draw video frame to canvas
                context.drawImage(video, 0, 0, canvas.width, canvas.height);

                // Get image data
                const imageData = context.getImageData(0, 0, canvas.width, canvas.height);

                // Scan for QR code
                const code = jsQR(imageData.data, imageData.width, imageData.height);

                if (code) {
                    console.log('QR Code detected:', code.data);
                    Livewire.dispatch('qr-code-scanned', { qrCodeData: code.data });
                    return;
                }
            }

            // Continue scanning
            requestAnimationFrame(scanQRCode);
        } catch (error) {
            console.error('Error in QR scanning:', error);
            // Continue scanning even if there's an error
            requestAnimationFrame(scanQRCode);
        }
    }
</script>
