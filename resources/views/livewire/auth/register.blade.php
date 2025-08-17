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
            <p class="text-neutral-600">Create your account</p>
        </div>

        <!-- Register Card -->
        <div class="bg-white rounded-xl shadow-sm border border-neutral-200 p-8">

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-800 text-sm">
                    {{ session('status') }}
                </div>
            @endif

            <form wire:submit="register" class="space-y-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-neutral-700 mb-2">Full Name</label>
                    <input
                        type="text"
                        id="name"
                        wire:model.live.debounce.300ms="name"
                        class="w-full px-4 py-3 border border-neutral-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-neutral-50 transition-colors placeholder-neutral-500"
                        placeholder="Enter your full name"
                        required
                        autofocus
                        autocomplete="name"
                    >
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-neutral-700 mb-2">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        wire:model.live.debounce.300ms="email"
                        class="w-full px-4 py-3 border border-neutral-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-neutral-50 transition-colors placeholder-neutral-500"
                        placeholder="email@example.com"
                        required
                        autocomplete="email"
                    >
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone Number -->
                <div>
                    <label for="phone_number" class="block text-sm font-medium text-neutral-700 mb-2">Phone Number</label>
                    <input
                        type="tel"
                        id="phone_number"
                        wire:model.live.debounce.300ms="phone_number"
                        class="w-full px-4 py-3 border border-neutral-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-neutral-50 transition-colors placeholder-neutral-500"
                        placeholder="1234567890"
                        required
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
                            wire:model.live.debounce.300ms="password"
                            class="w-full px-4 py-3 border border-neutral-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-neutral-50 transition-colors pr-12 placeholder-neutral-500"
                            placeholder="Create a password"
                            required
                            autocomplete="new-password"
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

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-neutral-700 mb-2">Confirm Password</label>
                    <div class="relative">
                        <input
                            type="password"
                            id="password_confirmation"
                            wire:model.live.debounce.300ms="password_confirmation"
                            class="w-full px-4 py-3 border border-neutral-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-primary-500 bg-neutral-50 transition-colors pr-12 placeholder-neutral-500"
                            placeholder="Confirm your password"
                            required
                            autocomplete="new-password"
                        >
                        <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-neutral-500 hover:text-neutral-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                </div>



                <!-- Register Button -->
                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    class="w-full bg-primary-600 hover:bg-primary-700 disabled:bg-neutral-400 text-white py-3 px-6 rounded-lg font-medium transition-colors"
                >
                    <span wire:loading.remove>Create Account</span>
                    <span wire:loading>Creating account...</span>
                </button>
            </form>

            <!-- Sign In Link -->
            <div class="text-center mt-6">
                <p class="text-sm text-neutral-600">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-primary-600 hover:text-primary-700">
                        Sign in
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
