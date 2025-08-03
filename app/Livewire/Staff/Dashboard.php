<?php

namespace App\Livewire\Staff;

use App\Models\User;
use App\Models\PointsTransaction;
use App\Models\Redemption;
use App\Services\LoyaltyService;
use Livewire\Component;
use Livewire\Attributes\On;

class Dashboard extends Component
{
    public $showScanner = false;
    public $scannedQrCode = '';
    public $processing = false;
    public $message = '';
    public $messageType = '';
    public $selectedUser = null;
    public $purchaseAmount = '';
    public $showPurchaseForm = false;
    public $manualQrCode = '';
    public $showManualQrInput = false;

    public function mount()
    {
        // Check if user is staff
        if (!auth()->user()->isStaff()) {
            return redirect()->route('dashboard');
        }
    }

    public function toggleScanner()
    {
        $this->showScanner = !$this->showScanner;
        if ($this->showScanner) {
            $this->dispatch('start-scanner');
        } else {
            $this->dispatch('stop-scanner');
        }
    }

    public function toggleManualQrInput()
    {
        $this->showManualQrInput = !$this->showManualQrInput;
        $this->manualQrCode = '';
    }

    public function processManualQrCode()
    {
        $this->validate([
            'manualQrCode' => 'required|string|min:10',
        ]);

        $this->scannedQrCode = $this->manualQrCode;
        $this->processQrCode();
        $this->manualQrCode = '';
        $this->showManualQrInput = false;
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
            // First, try to find redemption QR code (stored directly in redemptions table)
            $redemption = Redemption::where('qr_code', $this->scannedQrCode)
                ->where('status', 'pending')
                ->first();

            if ($redemption) {
                // Process redemption
                $this->processRedemption($redemption);
                $this->scannedQrCode = '';
                $this->showScanner = false;
                $this->processing = false;
                return;
            }

            // If not a redemption, try to find QR code in qr_codes table
            $qrCode = \App\Models\QrCode::where('code', $this->scannedQrCode)
                ->where('used', false)
                ->where('expires_at', '>', now())
                ->first();

            if (!$qrCode) {
                throw new \Exception('Invalid or expired QR code');
            }

            if ($qrCode->type === 'user') {
                // Customer QR code - show purchase form
                $user = User::find($qrCode->data['user_id']);
                if (!$user) {
                    throw new \Exception('User not found');
                }

                $this->selectedUser = $user;
                $this->showPurchaseForm = true;
                $this->message = "Customer found: {$user->name}";
                $this->messageType = 'success';
            } else {
                throw new \Exception('Unknown QR code type');
            }

            $this->scannedQrCode = '';
            $this->showScanner = false;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            $this->messageType = 'error';
        }

        $this->processing = false;
    }

    public function processPurchase()
    {
        $this->validate([
            'purchaseAmount' => 'required|numeric|min:0.01|max:1000',
        ]);

        $this->processing = true;
        $this->message = '';
        $this->messageType = '';

        try {
            $loyaltyService = app(LoyaltyService::class);
            $transaction = $loyaltyService->earnPoints(
                $this->selectedUser,
                (float) $this->purchaseAmount,
                null,
                'Staff-processed purchase'
            );

            $this->message = "Success! {$this->selectedUser->name} earned " . floor($this->purchaseAmount) . " points for their purchase.";
            $this->messageType = 'success';

            $this->purchaseAmount = '';
            $this->selectedUser = null;
            $this->showPurchaseForm = false;

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            $this->messageType = 'error';
        }

        $this->processing = false;
    }

    public function processRedemption($redemption)
    {
        try {
            if (!$redemption || $redemption->status !== 'pending') {
                throw new \Exception('Redemption not found or already used');
            }

            $redemption->markAsUsed();

            $this->message = "Redemption processed! Discount applied: \${$redemption->discount_amount}";
            $this->messageType = 'success';

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            $this->messageType = 'error';
        }
    }

    public function generatePurchaseQr()
    {
        $this->validate([
            'purchaseAmount' => 'required|numeric|min:0.01|max:1000',
        ]);

        try {
            $qrCode = \App\Models\QrCode::generatePurchaseQr(
                (float) $this->purchaseAmount,
                uniqid('staff_', true)
            );

            $this->message = "Purchase QR code generated! Amount: \${$this->purchaseAmount}";
            $this->messageType = 'success';
            $this->purchaseAmount = '';

        } catch (\Exception $e) {
            $this->message = $e->getMessage();
            $this->messageType = 'error';
        }
    }

    public function render()
    {
        $recentTransactions = PointsTransaction::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $allRedemptions = Redemption::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->get();

        return view('livewire.staff.dashboard', [
            'recentTransactions' => $recentTransactions,
            'allRedemptions' => $allRedemptions,
        ])->layout('components.layouts.pwa');
    }
}
