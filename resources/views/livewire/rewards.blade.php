<div class="p-4">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-neutral-800 mb-2 font-heading">Redeem Points</h1>
        <p class="text-neutral-600">Convert your points into rewards</p>
    </div>

    <!-- Message Display -->
    @if($message)
        <div class="mb-6 p-4 rounded-lg {{ $messageType === 'success' ? 'bg-green-50 border border-green-200 text-green-800' : 'bg-red-50 border border-red-200 text-red-800' }}">
            {{ $message }}
        </div>
    @endif

    <!-- Available Rewards -->
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
        <h2 class="text-xl font-semibold text-neutral-800 mb-4 font-heading">Available Rewards</h2>

        <div class="grid gap-4">
            @foreach($availableRewards as $reward)
            <div class="border border-accent-200 rounded-lg p-4 hover:border-accent-400 transition-colors cursor-pointer {{ $selectedReward && $selectedReward['id'] === $reward['id'] ? 'border-accent-600 bg-accent-50' : '' }}"
                 wire:click="selectReward('{{ $reward['id'] }}')">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-12 h-12 rounded-full bg-accent-100 flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="font-semibold text-neutral-800">{{ $reward['name'] }}</div>
                            <div class="text-sm text-neutral-600">{{ $reward['description'] }}</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="font-bold text-accent-600">{{ $reward['points'] }} pts</div>
                        <div class="text-xs text-neutral-500">Required</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Redemption Form -->
    @if($selectedReward)
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
        <h2 class="text-xl font-semibold text-neutral-800 mb-4 font-heading">Redeem Points</h2>

        <form wire:submit="redeemPoints">
            <div class="mb-4">
                <label for="pointsToRedeem" class="block text-sm font-medium text-neutral-700 mb-2">Points to Redeem</label>
                <input
                    type="number"
                    id="pointsToRedeem"
                    wire:model="pointsToRedeem"
                    min="10"
                    max="1000"
                    step="10"
                    class="w-full px-4 py-3 border border-accent-200 rounded-lg focus:ring-2 focus:ring-accent-600 focus:border-transparent bg-accent-50"
                    placeholder="Enter points (multiples of 10)"
                >
                @error('pointsToRedeem')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4 p-3 bg-accent-50 border border-accent-200 rounded-lg">
                <div class="text-sm text-accent-800">
                    <strong>Exchange Rate:</strong> 10 points = $1 discount
                </div>
                @if($pointsToRedeem && $pointsToRedeem >= 10)
                    <div class="text-sm text-accent-800 mt-1">
                        <strong>You'll get:</strong> ${{ number_format($pointsToRedeem / 10, 2) }} discount
                    </div>
                @endif
            </div>

            <button
                type="submit"
                wire:loading.attr="disabled"
                class="w-full bg-accent-600 hover:bg-accent-700 disabled:bg-neutral-400 text-white px-6 py-3 rounded-lg transition-colors font-semibold shadow-lg"
            >
                <span wire:loading.remove>Redeem {{ $pointsToRedeem ? $pointsToRedeem : 'Points' }}</span>
                <span wire:loading>Processing...</span>
            </button>
        </form>
    </div>
    @endif

    <!-- All Redemptions -->
    @if(count($allRedemptions) > 0)
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">All Redemptions</h2>

        <div class="space-y-3">
            @foreach($allRedemptions as $redemption)
            <div class="border rounded-lg p-4 {{ $redemption->status === 'pending' ? 'border-amber-200 bg-amber-50' : 'border-gray-200 bg-gray-50' }}">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center mr-3 {{ $redemption->status === 'pending' ? 'bg-amber-100' : 'bg-gray-100' }}">
                            @if($redemption->status === 'pending')
                                <svg class="w-5 h-5 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            @else
                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            @endif
                        </div>
                        <div>
                            <div class="font-medium text-gray-800">
                                ${{ number_format($redemption->discount_amount, 2) }} Discount
                            </div>
                            <div class="text-sm text-gray-600">
                                {{ $redemption->created_at->diffForHumans() }}
                                @if($redemption->status === 'used' && $redemption->used_at)
                                    • Used {{ $redemption->used_at->diffForHumans() }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="font-semibold {{ $redemption->status === 'pending' ? 'text-amber-700' : 'text-gray-600' }}">
                            -{{ $redemption->points_transaction ? $redemption->points_transaction->points : $redemption->discount_amount * 10 }} pts
                        </div>
                        <div class="text-xs {{ $redemption->status === 'pending' ? 'text-amber-600' : 'text-gray-500' }}">
                            {{ ucfirst($redemption->status) }}
                        </div>
                    </div>
                </div>

                @if($redemption->status === 'pending')
                <div class="bg-amber-100 p-3 rounded-lg border border-amber-200">
                    <div class="text-sm text-gray-600 mb-2">Show this QR code to staff during checkout:</div>
                    <div class="flex justify-center">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=128x128&data={{ urlencode($redemption->qr_code) }}"
                             alt="Redemption QR Code"
                             class="w-32 h-32"
                             id="redemption-qr-{{ $redemption->id }}">
                    </div>
                    <div class="text-xs text-gray-500 text-center mt-2">Code: {{ $redemption->qr_code }}</div>
                </div>
                @else
                <div class="bg-gray-100 p-3 rounded-lg border border-gray-200">
                    <div class="text-sm text-gray-600 text-center">
                        This redemption has been used
                    </div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>


