<div class="p-4">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center mb-3">
            <div class="w-12 h-12 bg-gradient-to-br from-amber-200 to-amber-300 rounded-full flex items-center justify-center mr-4">
                <svg class="w-6 h-6 text-amber-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Earn Points</h1>
                <p class="text-gray-600">Scan QR codes or enter purchases manually</p>
            </div>
        </div>
    </div>

    <!-- Message Display -->
    @if($message)
        <div class="mb-6 p-4 rounded-lg {{ $messageType === 'success' ? 'bg-green-50 border border-green-200 text-green-800' : 'bg-red-50 border border-red-200 text-red-800' }}">
            {{ $message }}
        </div>
    @endif

    <!-- QR Scanner Section -->
    <div class="relative overflow-hidden bg-white rounded-2xl shadow-xl p-6 mb-6">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-amber-100 to-amber-200 rounded-full -mr-16 -mt-16 opacity-50"></div>
        <div class="relative">
            <div class="flex items-center mb-6">
                <div class="w-10 h-10 bg-amber-100 rounded-full flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V6a1 1 0 00-1-1H5a1 1 0 00-1 1v1a1 1 0 001 1zm12 0h2a1 1 0 001-1V6a1 1 0 00-1-1h-2a1 1 0 00-1 1v1a1 1 0 001 1zM5 20h2a1 1 0 001-1v-1a1 1 0 00-1-1H5a1 1 0 00-1 1v1a1 1 0 001 1z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Scan QR Code</h2>
                    <p class="text-gray-600 text-sm">Point your camera at the purchase QR code</p>
                </div>
            </div>

            @if($showScanner)
                <div class="text-center">
                    <div id="qr-scanner-container" class="w-full max-w-sm mx-auto mb-6">
                        <div class="relative">
                            <video id="qr-video" class="w-full rounded-2xl shadow-lg" autoplay></video>
                            <div class="absolute inset-0 border-4 border-amber-400 rounded-2xl pointer-events-none"></div>
                        </div>
                    </div>
                    <button wire:click="toggleScanner" class="bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-xl transition-all duration-300 shadow-lg transform hover:scale-105">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Stop Scanner
                    </button>
                </div>
            @else
                <div class="text-center">
                    <div class="w-48 h-48 bg-gradient-to-br from-amber-50 to-amber-100 rounded-2xl mx-auto mb-6 flex items-center justify-center border-2 border-amber-200 shadow-inner">
                        <svg class="w-16 h-16 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V6a1 1 0 00-1-1H5a1 1 0 00-1 1v1a1 1 0 001 1zm12 0h2a1 1 0 001-1V6a1 1 0 00-1-1h-2a1 1 0 00-1 1v1a1 1 0 001 1zM5 20h2a1 1 0 001-1v-1a1 1 0 00-1-1H5a1 1 0 00-1 1v1a1 1 0 001 1z"></path>
                        </svg>
                    </div>
                    <button wire:click="toggleScanner" class="bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-700 hover:to-amber-800 text-white px-8 py-4 rounded-xl transition-all duration-300 font-semibold shadow-xl transform hover:scale-105">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V6a1 1 0 00-1-1H5a1 1 0 00-1 1v1a1 1 0 001 1zm12 0h2a1 1 0 001-1V6a1 1 0 00-1-1h-2a1 1 0 00-1 1v1a1 1 0 001 1zM5 20h2a1 1 0 001-1v-1a1 1 0 00-1-1H5a1 1 0 00-1 1v1a1 1 0 001 1z"></path>
                        </svg>
                        Start QR Scanner
                    </button>
                </div>
            @endif
        </div>
    </div>

    <!-- Manual Purchase Entry -->
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Manual Entry</h2>
        <p class="text-gray-600 text-sm mb-4">Enter purchase amount for staff approval</p>

        <form wire:submit="submitManualPurchase">
            <div class="mb-4">
                <label for="manualAmount" class="block text-sm font-medium text-gray-700 mb-2">Purchase Amount ($)</label>
                <input
                    type="number"
                    id="manualAmount"
                    wire:model="manualAmount"
                    step="0.01"
                    min="1"
                    max="1000"
                    class="w-full px-4 py-3 border border-amber-200 rounded-lg focus:ring-2 focus:ring-amber-600 focus:border-transparent bg-amber-50"
                    placeholder="Enter amount (e.g., 5.50)"
                >
                @error('manualAmount')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button
                type="submit"
                wire:loading.attr="disabled"
                class="w-full bg-amber-700 hover:bg-amber-800 disabled:bg-gray-400 text-white px-6 py-3 rounded-lg transition-colors font-semibold shadow-lg"
            >
                <span wire:loading.remove>Submit for Approval</span>
                <span wire:loading>Processing...</span>
            </button>
        </form>
    </div>

    <!-- Pending Purchases -->
    @if(count($pendingPurchases) > 0)
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Pending Approvals</h2>

        <div class="space-y-3">
            @foreach($pendingPurchases as $purchase)
            <div class="flex items-center justify-between p-3 bg-amber-50 border border-amber-200 rounded-lg">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="font-medium text-gray-800">
                            ${{ number_format($purchase['amount'], 2) }} purchase
                        </div>
                        <div class="text-sm text-gray-600">
                            {{ \Carbon\Carbon::parse($purchase['created_at'])->diffForHumans() }}
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <div class="font-semibold text-amber-600">
                        +{{ $purchase['points'] }} points
                    </div>
                    <div class="text-xs text-gray-500">
                        Pending
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.min.js"></script>
<script>
    let video = null;
    let canvas = null;
    let ctx = null;
    let scanning = false;

    document.addEventListener('livewire:init', () => {
        Livewire.on('start-scanner', () => {
            startScanner();
        });

        Livewire.on('stop-scanner', () => {
            stopScanner();
        });
    });

    async function startScanner() {
        try {
            const stream = await navigator.mediaDevices.getUserMedia({
                video: { facingMode: 'environment' }
            });

            video = document.getElementById('qr-video');
            video.srcObject = stream;

            canvas = document.createElement('canvas');
            ctx = canvas.getContext('2d');

            scanning = true;
            scanQRCode();
        } catch (error) {
            console.error('Error accessing camera:', error);
            Livewire.dispatch('scanner-error', { error: 'Camera access denied' });
        }
    }

    function stopScanner() {
        scanning = false;
        if (video && video.srcObject) {
            video.srcObject.getTracks().forEach(track => track.stop());
        }
    }

    function scanQRCode() {
        if (!scanning) return;

        if (video.readyState === video.HAVE_ENOUGH_DATA) {
            canvas.height = video.videoHeight;
            canvas.width = video.videoWidth;
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

            const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
            const code = jsQR(imageData.data, imageData.width, imageData.height);

            if (code) {
                Livewire.dispatch('qr-code-scanned', { qrCodeData: code.data });
                return;
            }
        }

        requestAnimationFrame(scanQRCode);
    }
</script>
@endpush
