<?php

namespace App\Livewire;

use App\Services\LoyaltyService;
use Livewire\Component;
use Livewire\Attributes\On;

class Purchases extends Component
{
    public $showScanner = false;
    public $manualAmount = '';
    public $scannedQrCode = '';
    public $processing = false;
    public $message = '';
    public $messageType = '';

    public function toggleScanner()
    {
        $this->showScanner = !$this->showScanner;
        if ($this->showScanner) {
            $this->dispatch('start-scanner');
        } else {
            $this->dispatch('stop-scanner');
        }
    }

    #[On('qr-code-scanned')]
    public function handleQrCodeScanned($qrCodeData)
    {
        $this->scannedQrCode = $qrCodeData;
        $this->processQrCode();
    }

    public function processQrCode()
    {
        if (empty($this->scannedQrCode)) {
            return;
        }

        $this->processing = true;
        $this->message = '';
        $this->messageType = '';

        try {
            $loyaltyService = app(LoyaltyService::class);
            $transaction = $loyaltyService->processQrCodePurchase($this->scannedQrCode);

            $this->message = "Success! You earned {$transaction->points} points for your purchase.";
            $this->messageType = 'success';

            $this->scannedQrCode = '';
            $this->showScanner = false;

            $this->dispatch('purchase-processed');
        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            $this->messageType = 'error';
        }

        $this->processing = false;
    }

    public function submitManualPurchase()
    {
        $this->validate([
            'manualAmount' => 'required|numeric|min:1|max:1000',
        ]);

        $this->processing = true;
        $this->message = '';
        $this->messageType = '';

        try {
            $user = auth()->user();
            $loyaltyService = app(LoyaltyService::class);

            $transaction = $loyaltyService->earnPoints(
                $user,
                (float) $this->manualAmount,
                null,
                'Manual purchase entry (pending staff approval)'
            );

            $transaction->update(['status' => 'pending']);

            $this->message = "Purchase submitted for staff approval. You'll earn " . floor($this->manualAmount) . " points once approved.";
            $this->messageType = 'success';

            $this->manualAmount = '';
            $this->dispatch('purchase-processed');
        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            $this->messageType = 'error';
        }

        $this->processing = false;
    }

    public function render()
    {
        $user = auth()->user();
        $pendingPurchases = $user ? $user->pointsTransactions()
            ->where('type', 'earn')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get() : collect();

        return view('livewire.purchases', [
            'pendingPurchases' => $pendingPurchases
        ])->layout('components.layouts.pwa');
    }
}
