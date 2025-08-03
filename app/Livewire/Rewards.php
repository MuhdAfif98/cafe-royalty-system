<?php

namespace App\Livewire;

use App\Services\LoyaltyService;
use Livewire\Component;

class Rewards extends Component
{
    public $pointsToRedeem = '';
    public $processing = false;
    public $message = '';
    public $messageType = '';
    public $selectedReward = null;

    public $availableRewards = [
        [
            'id' => 'discount_10',
            'name' => '$1 Discount',
            'points' => 10,
            'description' => 'Get $1 off your next purchase',
            'type' => 'discount'
        ],
        [
            'id' => 'discount_50',
            'name' => '$5 Discount',
            'points' => 50,
            'description' => 'Get $5 off your next purchase',
            'type' => 'discount'
        ],
        [
            'id' => 'discount_100',
            'name' => '$10 Discount',
            'points' => 100,
            'description' => 'Get $10 off your next purchase',
            'type' => 'discount'
        ],
    ];

    public function selectReward($rewardId)
    {
        $this->selectedReward = collect($this->availableRewards)->firstWhere('id', $rewardId);
        $this->pointsToRedeem = $this->selectedReward['points'];
    }

    public function redeemPoints()
    {
        $this->validate([
            'pointsToRedeem' => 'required|integer|min:10|max:1000',
        ]);

        if ($this->pointsToRedeem % 10 !== 0) {
            $this->addError('pointsToRedeem', 'Points must be redeemed in multiples of 10');
            return;
        }

        $this->processing = true;
        $this->message = '';
        $this->messageType = '';

        try {
            $user = auth()->user();
            $loyaltyService = app(LoyaltyService::class);

            $redemption = $loyaltyService->redeemPoints($user, (int) $this->pointsToRedeem);

            $this->message = "Success! You redeemed {$this->pointsToRedeem} points for a \${$redemption->discount_amount} discount. Show the QR code to staff during checkout.";
            $this->messageType = 'success';

            $this->pointsToRedeem = '';
            $this->selectedReward = null;

            $this->dispatch('redemption-processed');
        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            $this->messageType = 'error';
        }

        $this->processing = false;
    }

    public function render()
    {
        $user = auth()->user();
        $allRedemptions = $user ? $user->redemptions()
            ->orderBy('created_at', 'desc')
            ->get() : collect();

        return view('livewire.rewards', [
            'allRedemptions' => $allRedemptions
        ])->layout('components.layouts.pwa');
    }
}
