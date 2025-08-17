<div class="min-h-screen bg-neutral-50 flex items-center justify-center p-6">
    <div class="w-full max-w-md">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-primary-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-neutral-900 mb-2 font-heading">Sip n Save</h1>
            <p class="text-neutral-600">Sign in to your account</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-xl shadow-sm border border-neutral-200 p-8">

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-800 text-sm">
                    {{ session('status') }}
                </div>
            @endif

            <form wire:submit="login" class="space-y-6">
                <!-- Phone Number -->
                <div>
                    <label for="phone_number" class="block text-sm font-medium text-neutral-700 mb-2">Phone Number</label>
                    <input
                        type="tel"
                        id="phone_number"
                        wire:model="phone_number"
                        class="w-full px-4 py-3 border text-accent-900 border-neutral-300 rounded-xl bg-neutral-50 transition-colors placeholder-neutral-500"
                        placeholder="1234567890"
                        required
                        autofocus
                        autocomplete="tel"
                    >
                    @error('phone_number')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-neutral-700 mb-2">Password</label>
                    <div class="relative">
                        <input
                            type="password"
                            id="password"
                            wire:model="password"
                            class="w-full px-4 py-3 border text-accent-900 border-neutral-300 rounded-xl bg-neutral-50 pr-12 placeholder-neutral-500"
                            placeholder="Enter your password"
                            required
                            autocomplete="current-password"
                        >
                        <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-neutral-500 hover:text-neutral-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" wire:model="remember" class="w-4 h-4 text-primary-600 border-neutral-300 rounded">
                        <span class="ml-2 text-sm text-neutral-700">Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-primary-600 hover:text-primary-700">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <!-- Login Button -->
                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="w-full bg-primary-600 hover:bg-primary-700 disabled:bg-neutral-400 text-white py-3 px-6 rounded-lg font-medium transition-colors"
                >
                    <span wire:loading.remove>Sign In</span>
                    <span wire:loading>Signing in...</span>
                </button>
            </form>

            <!-- Sign Up Link -->
            @if (Route::has('register'))
                <div class="text-center mt-6">
                    <p class="text-sm text-neutral-600">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="text-primary-600 hover:text-primary-700">
                            Sign up
                        </a>
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>
