<div class="p-4">
    <!-- Hero Section -->
    <div class="relative mb-8 rounded-3xl overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-amber-900/80 to-amber-700/80"></div>
        <div class="relative p-8 text-white">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold">Welcome back!</h1>
                    <p class="text-amber-100">Track your coffee rewards</p>
                </div>
            </div>
            <div class="text-center">
                <div class="text-5xl font-bold mb-2">{{ number_format($pointsSummary['current_balance'] ?? 0) }}</div>
                <p class="text-amber-100">Available Points</p>
            </div>
        </div>
    </div>



    <!-- Quick Actions -->
    <div class="grid grid-cols-2 gap-4 mb-6">
        <a href="{{ route('purchases') }}" class="relative overflow-hidden bg-gradient-to-br from-amber-600 to-amber-700 hover:from-amber-700 hover:to-amber-800 text-white rounded-2xl p-6 text-center transition-all duration-300 shadow-xl transform hover:scale-105">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative">
                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <div class="font-bold text-lg">Earn Points</div>
                <div class="text-amber-100 text-sm">Scan & earn</div>
            </div>
        </a>

        <a href="{{ route('rewards') }}" class="relative overflow-hidden bg-gradient-to-br from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white rounded-2xl p-6 text-center transition-all duration-300 shadow-xl transform hover:scale-105">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative">
                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <div class="font-bold text-lg">Redeem</div>
                <div class="text-amber-100 text-sm">Get rewards</div>
            </div>
        </a>
    </div>

    <!-- User QR Code -->
    @if($userQrCode)
    <div class="relative overflow-hidden bg-white rounded-2xl shadow-xl p-6 mb-6">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-amber-100 to-amber-200 rounded-full -mr-16 -mt-16 opacity-50"></div>
        <div class="relative">
            <div class="flex items-center mb-4">
                <div class="w-10 h-10 bg-amber-100 rounded-full flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V6a1 1 0 00-1-1H5a1 1 0 00-1 1v1a1 1 0 001 1zm12 0h2a1 1 0 001-1V6a1 1 0 00-1-1h-2a1 1 0 00-1 1v1a1 1 0 001 1zM5 20h2a1 1 0 001-1v-1a1 1 0 00-1-1H5a1 1 0 00-1 1v1a1 1 0 001 1z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Your QR Code</h3>
                    <p class="text-gray-600 text-sm">Show this to staff to earn points</p>
                </div>
            </div>

            <div class="flex justify-center">
                <div class="bg-gradient-to-br from-amber-50 to-amber-100 p-6 rounded-2xl border-2 border-amber-200 shadow-inner">
                    @if($userQrCode)
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=192x192&data={{ urlencode($userQrCode->code) }}"
                             alt="QR Code"
                             class="w-48 h-48 rounded-lg shadow-lg"
                             id="user-qr-code">
                    @else
                        <div id="user-qr-code" class="w-48 h-48 bg-white rounded-lg flex items-center justify-center shadow-lg">
                            <span class="text-gray-400">Loading QR Code...</span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="text-center mt-4">
                <div class="inline-flex items-center px-3 py-1 bg-amber-100 text-amber-800 text-xs font-medium rounded-full">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Code: {{ $userQrCode->code }}
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Recent Activity -->
    <div class="relative overflow-hidden bg-white rounded-2xl shadow-xl p-6">
        <div class="absolute top-0 left-0 w-24 h-24 bg-gradient-to-br from-amber-100 to-amber-200 rounded-full -ml-12 -mt-12 opacity-50"></div>
        <div class="relative">
            <div class="flex items-center mb-6">
                <div class="w-10 h-10 bg-amber-100 rounded-full flex items-center justify-center mr-3">
                    <svg class="w-5 h-5 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Recent Activity</h3>
                    <p class="text-gray-600 text-sm">Your latest coffee adventures</p>
                </div>
            </div>

            @if(count($recentTransactions) > 0)
                <div class="space-y-4">
                    @foreach($recentTransactions as $transaction)
                    <div class="flex items-center justify-between p-4 bg-gradient-to-r from-amber-50 to-amber-100 rounded-xl border border-amber-200 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-full {{ $transaction['type'] === 'earn' ? 'bg-gradient-to-br from-amber-200 to-amber-300' : 'bg-gradient-to-br from-amber-300 to-amber-400' }} flex items-center justify-center mr-4 shadow-sm">
                                @if($transaction['type'] === 'earn')
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
                                    {{ $transaction['type'] === 'earn' ? 'Earned' : 'Redeemed' }} {{ $transaction['points'] }} points
                                </div>
                                <div class="text-sm text-gray-600">
                                    {{ \Carbon\Carbon::parse($transaction['created_at'])->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="font-bold text-lg {{ $transaction['type'] === 'earn' ? 'text-amber-700' : 'text-amber-600' }}">
                                {{ $transaction['type'] === 'earn' ? '+' : '-' }}{{ $transaction['points'] }}
                            </div>
                            <div class="text-xs text-gray-500 bg-white px-2 py-1 rounded-full">
                                {{ $transaction['status'] }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-gradient-to-br from-amber-100 to-amber-200 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold text-gray-800 mb-2">No transactions yet</h4>
                    <p class="text-gray-600 mb-4">Start your coffee journey today!</p>
                    <a href="{{ route('purchases') }}" class="inline-flex items-center px-4 py-2 bg-amber-600 text-white rounded-lg hover:bg-amber-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Make First Purchase
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>


