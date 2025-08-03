<div class="p-4">
    <div class="max-w-md mx-auto mt-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-gradient-to-br from-blue-200 to-blue-300 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-blue-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Staff Login</h1>
            <p class="text-gray-600">Access staff dashboard</p>
        </div>

        <!-- Message Display -->
        @if($message)
            <div class="mb-6 p-4 rounded-lg {{ $messageType === 'success' ? 'bg-green-50 border border-green-200 text-green-800' : 'bg-red-50 border border-red-200 text-red-800' }}">
                {{ $message }}
            </div>
        @endif

        <!-- Login Form -->
        <div class="relative overflow-hidden bg-white rounded-2xl shadow-xl p-6">
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full -mr-16 -mt-16 opacity-50"></div>
            <div class="relative">
                <form wire:submit="login">
                    <div class="mb-4">
                        <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                        <input
                            type="tel"
                            id="phone_number"
                            wire:model="phone_number"
                            class="w-full px-4 py-3 border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent bg-blue-50"
                            placeholder="+1234567890"
                            required
                        >
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <input
                            type="password"
                            id="password"
                            wire:model="password"
                            class="w-full px-4 py-3 border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent bg-blue-50"
                            placeholder="Enter password"
                            required
                        >
                    </div>

                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 disabled:bg-gray-400 text-white px-6 py-3 rounded-xl transition-all duration-300 font-semibold shadow-lg transform hover:scale-105"
                    >
                        <span wire:loading.remove>Login as Staff</span>
                        <span wire:loading>Logging in...</span>
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 text-sm">
                        ← Back to Customer Login
                    </a>
                </div>
            </div>
        </div>

        <!-- Staff Info -->
        <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <h3 class="font-semibold text-blue-800 mb-2">Staff Login Info</h3>
            <div class="text-sm text-blue-700">
                <p><strong>Phone:</strong> +1234567892</p>
                <p><strong>Password:</strong> staff123</p>
            </div>
        </div>
    </div>
</div>
