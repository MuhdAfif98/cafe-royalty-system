<?php

namespace App\Livewire;

use App\Services\LoyaltyService;
use Livewire\Component;

class Dashboard extends Component
{
    public $pointsSummary = [];
    public $recentTransactions = [];
    public $userQrCode = null;

    public function mount()
    {
        $this->loadDashboardData();
    }

    public function loadDashboardData()
    {
        $user = auth()->user();
        if (!$user) {
            return;
        }

        $loyaltyService = app(LoyaltyService::class);
        $this->pointsSummary = $loyaltyService->getPointsSummary($user);

        // Load recent transactions
        $this->recentTransactions = $user->pointsTransactions()
            ->with('redemption')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->toArray();

        // Generate user QR code for staff scanning
        $this->userQrCode = \App\Models\QrCode::generateUserQr($user->id);
    }

    public function refresh()
    {
        $this->loadDashboardData();
        $this->dispatch('dashboard-refreshed');
    }

    public function render()
    {
        return view('livewire.dashboard')->layout('components.layouts.pwa');
    }
}
