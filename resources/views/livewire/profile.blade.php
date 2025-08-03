<div class="p-4">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Profile</h1>
        <p class="text-gray-600">Manage your account settings</p>
    </div>

    <!-- Message Display -->
    @if($message)
        <div class="mb-6 p-4 rounded-lg {{ $messageType === 'success' ? 'bg-green-50 border border-green-200 text-green-800' : 'bg-red-50 border border-red-200 text-red-800' }}">
            {{ $message }}
        </div>
    @endif

    <!-- Profile Information -->
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Profile Information</h2>

        <form wire:submit="updateProfile">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <input
                        type="text"
                        id="name"
                        wire:model="name"
                        class="w-full px-4 py-3 border border-amber-200 rounded-lg focus:ring-2 focus:ring-amber-600 focus:border-transparent bg-amber-50"
                        placeholder="Enter your full name"
                    >
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        wire:model="email"
                        class="w-full px-4 py-3 border border-amber-200 rounded-lg focus:ring-2 focus:ring-amber-600 focus:border-transparent bg-amber-50"
                        placeholder="Enter your email"
                    >
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                <div class="flex gap-2">
                    <input
                        type="tel"
                        id="phone_number"
                        wire:model="phone_number"
                        class="flex-1 px-4 py-3 border border-amber-200 rounded-lg focus:ring-2 focus:ring-amber-600 focus:border-transparent bg-amber-50"
                        placeholder="+1234567890"
                    >
                    <button
                        type="button"
                        wire:click="sendOtp"
                        wire:loading.attr="disabled"
                        class="px-4 py-3 bg-amber-700 hover:bg-amber-800 disabled:bg-gray-400 text-white rounded-lg transition-colors font-semibold shadow-lg"
                    >
                        <span wire:loading.remove>Verify</span>
                        <span wire:loading>Sending...</span>
                    </button>
                </div>
                @error('phone_number')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            @if($showOtpInput)
            <div class="mb-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                <label for="otp_code" class="block text-sm font-medium text-gray-700 mb-2">Enter OTP Code</label>
                <div class="flex gap-2">
                    <input
                        type="text"
                        id="otp_code"
                        wire:model="otp_code"
                        maxlength="6"
                        class="flex-1 px-4 py-3 border border-amber-200 rounded-lg focus:ring-2 focus:ring-amber-600 focus:border-transparent bg-amber-50"
                        placeholder="123456"
                    >
                    <button
                        type="button"
                        wire:click="verifyOtp"
                        wire:loading.attr="disabled"
                        class="px-4 py-3 bg-blue-500 hover:bg-blue-600 disabled:bg-gray-400 text-white rounded-lg transition-colors font-semibold"
                    >
                        <span wire:loading.remove>Verify</span>
                        <span wire:loading>Verifying...</span>
                    </button>
                </div>
                <p class="text-sm text-blue-600 mt-2">Enter the 6-digit code sent to your phone</p>
            </div>
            @endif

            <button
                type="submit"
                wire:loading.attr="disabled"
                class="w-full bg-amber-700 hover:bg-amber-800 disabled:bg-gray-400 text-white px-6 py-3 rounded-lg transition-colors font-semibold shadow-lg"
            >
                <span wire:loading.remove>Update Profile</span>
                <span wire:loading>Updating...</span>
            </button>
        </form>
    </div>

    <!-- Change Password -->
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Change Password</h2>

        <form wire:submit="updatePassword">
            <div class="mb-4">
                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                                    <input
                        type="password"
                        id="current_password"
                        wire:model="current_password"
                        class="w-full px-4 py-3 border border-amber-200 rounded-lg focus:ring-2 focus:ring-amber-600 focus:border-transparent bg-amber-50"
                        placeholder="Enter current password"
                    >
                @error('current_password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                    <input
                        type="password"
                        id="new_password"
                        wire:model="new_password"
                        class="w-full px-4 py-3 border border-amber-200 rounded-lg focus:ring-2 focus:ring-amber-600 focus:border-transparent bg-amber-50"
                        placeholder="Enter new password"
                    >
                    @error('new_password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                    <input
                        type="password"
                        id="new_password_confirmation"
                        wire:model="new_password_confirmation"
                        class="w-full px-4 py-3 border border-amber-200 rounded-lg focus:ring-2 focus:ring-amber-600 focus:border-transparent bg-amber-50"
                        placeholder="Confirm new password"
                    >
                </div>
            </div>

            <div class="mb-4 p-3 bg-amber-50 border border-amber-200 rounded-lg">
                <div class="text-sm text-gray-600">
                    <strong>Password Requirements:</strong>
                    <ul class="mt-1 list-disc list-inside">
                        <li>Minimum 8 characters</li>
                        <li>At least one uppercase letter</li>
                        <li>At least one number</li>
                        <li>At least one special character</li>
                    </ul>
                </div>
            </div>

            <button
                type="submit"
                wire:loading.attr="disabled"
                class="w-full bg-amber-700 hover:bg-amber-800 disabled:bg-gray-400 text-white px-6 py-3 rounded-lg transition-colors font-semibold shadow-lg"
            >
                <span wire:loading.remove>Change Password</span>
                <span wire:loading>Updating...</span>
            </button>
        </form>
    </div>

    <!-- Account Information -->
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Account Information</h2>

        <div class="space-y-3">
            <div class="flex items-center justify-between p-3 bg-amber-50 rounded-lg border border-amber-100">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="font-medium text-gray-800">Member Since</div>
                        <div class="text-sm text-gray-600">{{ auth()->user()->created_at->format('M Y') }}</div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between p-3 bg-amber-50 rounded-lg border border-amber-100">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full {{ auth()->user()->phone_verified ? 'bg-amber-100' : 'bg-red-100' }} flex items-center justify-center mr-3">
                        @if(auth()->user()->phone_verified)
                            <svg class="w-5 h-5 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        @else
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        @endif
                    </div>
                    <div>
                        <div class="font-medium text-gray-800">Phone Verification</div>
                        <div class="text-sm {{ auth()->user()->phone_verified ? 'text-amber-700' : 'text-red-600' }}">
                            {{ auth()->user()->phone_verified ? 'Verified' : 'Not Verified' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
