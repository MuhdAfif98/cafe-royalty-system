<div class="p-6">
    <!-- User Avatar and Info -->
    <div class="text-center mb-8">
        <div class="w-24 h-24 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <span class="text-3xl font-bold text-primary-700">{{ auth()->user()->initials() }}</span>
        </div>
        <h1 class="text-2xl font-bold text-neutral-900 mb-1">{{ auth()->user()->name }}</h1>
        <p class="text-neutral-600 text-sm">{{ auth()->user()->email }}</p>
        <button class="mt-4 bg-neutral-900 text-white px-6 py-2 rounded-lg font-medium hover:bg-neutral-800 transition-colors">
            Edit profile
        </button>
    </div>

    <!-- Inventories Section -->
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-neutral-900 mb-3 font-heading">Inventories</h2>
        <div class="bg-white rounded-xl shadow-sm border border-neutral-200">
            <a href="#" class="flex items-center justify-between p-4 hover:bg-neutral-50 transition-colors">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-primary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </div>
                    <span class="font-medium text-neutral-900">My stores</span>
                </div>
                <div class="flex items-center">
                    <div class="w-6 h-6 bg-primary-600 rounded-full flex items-center justify-center mr-2">
                        <span class="text-white text-xs font-bold">2</span>
                    </div>
                    <svg class="w-5 h-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
            </a>
            <a href="#" class="flex items-center justify-between p-4 hover:bg-neutral-50 transition-colors border-t border-neutral-100">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-neutral-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <span class="font-medium text-neutral-900">Support</span>
                </div>
                <svg class="w-5 h-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </div>

    <!-- Preferences Section -->
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-neutral-900 mb-3 font-heading">Preferences</h2>
        <div class="bg-white rounded-xl shadow-sm border border-neutral-200">
            <div class="flex items-center justify-between p-4">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-neutral-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM4.19 4.19A2 2 0 004 6v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 01-2-2V6a2 2 0 012-2z"></path>
                        </svg>
                    </div>
                    <span class="font-medium text-neutral-900">Push notifications</span>
                </div>
                <div class="w-12 h-6 bg-primary-600 rounded-full relative">
                    <div class="w-5 h-5 bg-white rounded-full absolute top-0.5 right-0.5 shadow-sm"></div>
                </div>
            </div>
            <div class="flex items-center justify-between p-4 border-t border-neutral-100">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-neutral-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <span class="font-medium text-neutral-900">Face ID</span>
                </div>
                <div class="w-12 h-6 bg-primary-600 rounded-full relative">
                    <div class="w-5 h-5 bg-white rounded-full absolute top-0.5 right-0.5 shadow-sm"></div>
                </div>
            </div>
            <a href="#" class="flex items-center justify-between p-4 border-t border-neutral-100 hover:bg-neutral-50 transition-colors">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-neutral-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <span class="font-medium text-neutral-900">PIN Code</span>
                </div>
                <svg class="w-5 h-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
            <form method="POST" action="{{ route('logout') }}" class="border-t border-neutral-100">
                @csrf
                <button type="submit" class="w-full flex items-center justify-between p-4 hover:bg-red-50 transition-colors text-left">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                        </div>
                        <span class="font-medium text-red-600">Logout</span>
                    </div>
                    <svg class="w-5 h-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>
