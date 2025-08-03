<div class="me-10 w-full pb-4 md:w-[220px]">
    <flux:navlist>
        <flux:navlist.item :href="route('profile')" wire:navigate>{{ __('Profile') }}</flux:navlist.item>
    </flux:navlist>
</div>

<div class="w-full">
    {{ $slot }}
</div>
