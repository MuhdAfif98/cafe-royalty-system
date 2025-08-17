<div class="p-4">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-neutral-900 font-heading">Good morning!</h1>
            <p class="text-neutral-600">Welcome back, {{ auth()->user()->name }}</p>
        </div>
        <button id="manualInstallBtn"
            class="hidden bg-primary-600 text-white px-4 py-2 rounded-xl text-sm font-medium hover:bg-primary-700 transition-colors flex items-center space-x-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
            </svg>
            <span>Install App</span>
        </button>
        <div class="w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center">
            <span class="text-primary-700 font-semibold text-sm">{{ auth()->user()->initials() }}</span>
        </div>
    </div>

    <!-- Points Card -->
    <div class="bg-gradient-to-br from-primary-600 to-primary-700 rounded-2xl p-6 mb-6 text-white shadow-lg">
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="text-primary-100 text-sm font-medium">Available Points</p>
                <h2 class="text-4xl font-bold font-heading">{{ number_format($pointsSummary['current_balance'] ?? 0) }}
                </h2>
            </div>
            <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                    </path>
                </svg>
            </div>
        </div>
        <div class="flex items-center text-primary-100 text-sm">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
            </svg>
            {{ number_format($pointsSummary['total_earned'] ?? 0) }} points earned this month
        </div>
    </div>

    <!-- User QR Code -->
    @if($userQrCode)
    <div class="bg-white rounded-2xl p-6 mb-6 shadow-sm border border-neutral-100">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h3 class="text-lg font-semibold text-neutral-900 font-heading">Your QR Code</h3>
                <p class="text-neutral-600 text-sm">Show this to staff to earn points</p>
            </div>
            <div class="w-10 h-10 bg-primary-100 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V6a1 1 0 00-1-1H5a1 1 0 00-1 1v1a1 1 0 001 1zm12 0h2a1 1 0 001-1V6a1 1 0 00-1-1h-2a1 1 0 00-1 1v1a1 1 0 001 1zM5 20h2a1 1 0 001-1v-1a1 1 0 00-1-1H5a1 1 0 00-1 1v1a1 1 0 001 1z">
                    </path>
                </svg>
            </div>
        </div>

        <div class="flex justify-center">
            <div class="bg-neutral-50 p-6 rounded-2xl border border-neutral-200">
                @if($userQrCode)
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=192x192&data={{ urlencode($userQrCode->code) }}"
                    alt="QR Code" class="w-48 h-48 rounded-xl shadow-sm" id="user-qr-code">
                @else
                <div id="user-qr-code"
                    class="w-48 h-48 bg-white rounded-xl flex items-center justify-center shadow-sm border border-neutral-200">
                    <span class="text-neutral-400">Loading QR Code...</span>
                </div>
                @endif
            </div>
        </div>

        <div class="text-center mt-4">
            <div
                class="inline-flex items-center px-3 py-1 bg-neutral-100 text-neutral-700 text-xs font-medium rounded-full">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Code: {{ $userQrCode->code }}
            </div>
        </div>
    </div>
    @endif

    <!-- Recent Activity -->
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-neutral-100">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-primary-100 rounded-xl flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-neutral-900 font-heading">Recent Activity</h3>
                    <p class="text-neutral-600 text-sm">Your latest coffee adventures</p>
                </div>
            </div>
            <a href="#" class="text-primary-600 hover:text-primary-700 text-sm font-medium">View All</a>
        </div>

        @if(count($recentTransactions) > 0)
        <div class="space-y-4">
            @foreach($recentTransactions as $transaction)
            <div
                class="flex items-center justify-between p-4 bg-neutral-50 rounded-xl border border-neutral-200 hover:bg-neutral-100 transition-colors">
                <div class="flex items-center">
                    <div
                        class="w-12 h-12 rounded-xl {{ $transaction['type'] === 'earn' ? 'bg-primary-100' : 'bg-accent-100' }} flex items-center justify-center mr-4">
                        @if($transaction['type'] === 'earn')
                        <svg class="w-6 h-6 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        @else
                        <svg class="w-6 h-6 text-accent-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1">
                            </path>
                        </svg>
                        @endif
                    </div>
                    <div>
                        <div class="font-semibold text-neutral-900">
                            {{ $transaction['type'] === 'earn' ? 'Earned' : 'Redeemed' }} {{ $transaction['points'] }}
                            points
                        </div>
                        <div class="text-sm text-neutral-600">
                            {{ \Carbon\Carbon::parse($transaction['created_at'])->diffForHumans() }}
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <div
                        class="font-bold text-lg {{ $transaction['type'] === 'earn' ? 'text-primary-700' : 'text-accent-600' }}">
                        {{ $transaction['type'] === 'earn' ? '+' : '-' }}{{ $transaction['points'] }}
                    </div>
                    <div class="text-xs text-neutral-600 bg-white px-2 py-1 rounded-full border border-neutral-200">
                        {{ $transaction['status'] }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12">
            <div class="w-20 h-20 bg-primary-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7">
                    </path>
                </svg>
            </div>
            <h4 class="text-lg font-semibold text-neutral-900 mb-2">No transactions yet</h4>
            <p class="text-neutral-600 mb-4">Start your coffee journey today!</p>
        </div>
        @endif
    </div>
</div>

<script>
    // Manual Install Button Logic
    let deferredPrompt;
    const manualInstallBtn = document.getElementById('manualInstallBtn');

    window.addEventListener('beforeinstallprompt', (e) => {
        e.preventDefault();
        deferredPrompt = e;

        // Show manual install button
        if (manualInstallBtn) {
            manualInstallBtn.classList.remove('hidden');
        }
    });

    if (manualInstallBtn) {
        manualInstallBtn.addEventListener('click', async () => {
            if (deferredPrompt) {
                deferredPrompt.prompt();
                const { outcome } = await deferredPrompt.userChoice;
                if (outcome === 'accepted') {
                    console.log('User accepted the install prompt');
                    manualInstallBtn.classList.add('hidden');
                } else {
                    console.log('User dismissed the install prompt');
                }
                deferredPrompt = null;
            }
        });
    }

    // Hide button if app is already installed
    window.addEventListener('appinstalled', (evt) => {
        console.log('App was installed');
        if (manualInstallBtn) {
            manualInstallBtn.classList.add('hidden');
        }
    });
</script>
