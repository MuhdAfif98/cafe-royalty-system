 <div class="flex flex-col gap-6">
    <x-auth-header :title="__('Forgot password')" :description="__('Enter your phone number to receive a password reset code')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="sendPasswordResetLink" class="flex flex-col gap-6">
        <!-- Phone Number -->
        <flux:input
            wire:model="phone_number"
            :label="__('Phone Number')"
            type="tel"
            required
            autofocus
            placeholder="+1234567890"
        />

        <flux:button variant="primary" type="submit" class="w-full">{{ __('Send password reset code') }}</flux:button>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-400">
        <span>{{ __('Or, return to') }}</span>
        <flux:link :href="route('login')" wire:navigate>{{ __('log in') }}</flux:link>
    </div>
</div>
