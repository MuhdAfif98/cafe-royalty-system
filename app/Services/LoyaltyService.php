<?php

namespace App\Services;

use App\Models\User;
use App\Models\PointsTransaction;
use App\Models\Redemption;
use App\Models\QrCode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LoyaltyService
{
    public function earnPoints(User $user, float $amount, string $transactionId = null, string $description = null)
    {
        // Validate daily limit
        if (!$user->canEarnPoints()) {
            throw new \Exception('Daily points limit reached (100 points per day)');
        }

        // Calculate points (1 point per $1, rounded down)
        $points = (int) floor($amount);

        if ($points <= 0) {
            throw new \Exception('Purchase amount must be at least $1 to earn points');
        }

        return DB::transaction(function () use ($user, $points, $amount, $transactionId, $description) {
            // Create points transaction
            $transaction = PointsTransaction::create([
                'user_id' => $user->id,
                'type' => 'earn',
                'points' => $points,
                'amount' => $amount,
                'transaction_id' => $transactionId,
                'status' => 'approved',
                'description' => $description ?? "Earned {$points} points for \${$amount} purchase",
                'expires_at' => now()->addMonths(12), // Points expire after 12 months
            ]);

            // Update user's points balance
            $user->increment('points_balance', $points);
            $user->update(['last_purchase_at' => now()]);

            Log::info("User {$user->id} earned {$points} points for \${$amount} purchase");

            return $transaction;
        });
    }

    public function redeemPoints(User $user, int $points, string $rewardType = 'discount')
    {
        if ($points <= 0) {
            throw new \Exception('Points must be greater than 0');
        }

        if ($user->points_balance < $points) {
            throw new \Exception('Insufficient points balance');
        }

        // Validate redemption rules (10 points = $1 discount)
        if ($points % 10 !== 0) {
            throw new \Exception('Points must be redeemed in multiples of 10');
        }

        $discountAmount = $points / 10;

        return DB::transaction(function () use ($user, $points, $discountAmount, $rewardType) {
            // Create points transaction for redemption
            $transaction = PointsTransaction::create([
                'user_id' => $user->id,
                'type' => 'redeem',
                'points' => $points,
                'status' => 'approved',
                'description' => "Redeemed {$points} points for \${$discountAmount} discount",
            ]);

            // Create redemption record
            $redemption = Redemption::create([
                'user_id' => $user->id,
                'points_transaction_id' => $transaction->id,
                'reward_type' => $rewardType,
                'discount_amount' => $discountAmount,
                'qr_code' => \Illuminate\Support\Str::random(32),
                'status' => 'pending',
            ]);

            // Update user's points balance
            $user->decrement('points_balance', $points);

            Log::info("User {$user->id} redeemed {$points} points for \${$discountAmount} discount");

            return $redemption;
        });
    }

    public function processQrCodePurchase(string $qrCodeData)
    {
        $qrCode = QrCode::where('code', $qrCodeData)->first();

        if (!$qrCode) {
            throw new \Exception('Invalid QR code');
        }

        if (!$qrCode->isValid()) {
            throw new \Exception('QR code is expired or already used');
        }

        if ($qrCode->type !== 'purchase') {
            throw new \Exception('Invalid QR code type');
        }

        $data = $qrCode->data;
        $amount = $data['amount'];
        $transactionId = $data['transaction_id'];

        // Check if transaction already processed
        $existingTransaction = PointsTransaction::where('transaction_id', $transactionId)->first();
        if ($existingTransaction) {
            throw new \Exception('Transaction already processed');
        }

        // Mark QR code as used
        $qrCode->markAsUsed();

        // Find user by scanning their QR code (this would be implemented in the staff interface)
        // For now, we'll assume the user is authenticated
        $user = auth()->user();
        if (!$user) {
            throw new \Exception('User not authenticated');
        }

        return $this->earnPoints($user, $amount, $transactionId, 'QR code purchase');
    }

    public function processQrCodeRedemption(string $qrCodeData)
    {
        $qrCode = QrCode::where('code', $qrCodeData)->first();

        if (!$qrCode) {
            throw new \Exception('Invalid QR code');
        }

        if (!$qrCode->isValid()) {
            throw new \Exception('QR code is expired or already used');
        }

        if ($qrCode->type !== 'redemption') {
            throw new \Exception('Invalid QR code type');
        }

        $data = $qrCode->data;
        $redemptionId = $data['redemption_id'];

        $redemption = Redemption::find($redemptionId);
        if (!$redemption) {
            throw new \Exception('Redemption not found');
        }

        if ($redemption->status !== 'pending') {
            throw new \Exception('Redemption already used or expired');
        }

        // Mark QR code and redemption as used
        $qrCode->markAsUsed();
        $redemption->markAsUsed();

        Log::info("Redemption {$redemptionId} used successfully");

        return $redemption;
    }

    public function getPointsSummary(User $user)
    {
        $totalEarned = $user->pointsTransactions()->earned()->approved()->sum('points');
        $totalRedeemed = $user->pointsTransactions()->redeemed()->approved()->sum('points');
        $pendingTransactions = $user->pointsTransactions()->pending()->count();
        $expiringPoints = $user->hasExpiringPoints();

        return [
            'current_balance' => $user->points_balance,
            'total_earned' => $totalEarned,
            'total_redeemed' => $totalRedeemed,
            'pending_transactions' => $pendingTransactions,
            'expiring_soon' => $expiringPoints,
            'can_earn_today' => $user->canEarnPoints(),
        ];
    }

    public function cleanupExpiredPoints()
    {
        $expiredTransactions = PointsTransaction::where('type', 'earn')
            ->where('status', 'approved')
            ->where('expires_at', '<', now())
            ->get();

        foreach ($expiredTransactions as $transaction) {
            $user = $transaction->user;

            // Only deduct if user still has points (they might have already spent them)
            if ($user && $user->points_balance > 0) {
                $deductAmount = min($user->points_balance, $transaction->points);
                $user->decrement('points_balance', $deductAmount);

                Log::info("Expired {$deductAmount} points for user {$user->id}");
            }
        }

        return $expiredTransactions->count();
    }
}
