<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class QrCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'data',
        'signature',
        'expires_at',
        'used',
        'used_at',
    ];

    protected $casts = [
        'data' => 'array',
        'expires_at' => 'datetime',
        'used' => 'boolean',
        'used_at' => 'datetime',
    ];

    public static function generatePurchaseQr($amount, $transactionId)
    {
        $data = [
            'type' => 'purchase',
            'amount' => $amount,
            'transaction_id' => $transactionId,
            'timestamp' => now()->timestamp,
        ];

        $code = Str::random(32);
        $signature = hash_hmac('sha256', json_encode($data), config('app.key'));

        return self::create([
            'code' => $code,
            'type' => 'purchase',
            'data' => $data,
            'signature' => $signature,
            'expires_at' => now()->addMinutes(5), // 5 minutes expiry
        ]);
    }

    public static function generateUserQr($userId)
    {
        $data = [
            'type' => 'user',
            'user_id' => $userId,
            'timestamp' => now()->timestamp,
        ];

        $code = Str::random(32);
        $signature = hash_hmac('sha256', json_encode($data), config('app.key'));

        return self::create([
            'code' => $code,
            'type' => 'user',
            'data' => $data,
            'signature' => $signature,
            'expires_at' => now()->addMinutes(5),
        ]);
    }

    public static function generateRedemptionQr($redemptionId, $userId)
    {
        $data = [
            'type' => 'redemption',
            'redemption_id' => $redemptionId,
            'user_id' => $userId,
            'timestamp' => now()->timestamp,
        ];

        $code = Str::random(32);
        $signature = hash_hmac('sha256', json_encode($data), config('app.key'));

        return self::create([
            'code' => $code,
            'type' => 'redemption',
            'data' => $data,
            'signature' => $signature,
            'expires_at' => now()->addHours(24), // 24 hours for redemptions
        ]);
    }

    public function isValid()
    {
        if ($this->used) {
            return false;
        }

        if ($this->expires_at->lt(now())) {
            return false;
        }

        // Verify signature
        $expectedSignature = hash_hmac('sha256', json_encode($this->data), config('app.key'));
        return hash_equals($this->signature, $expectedSignature);
    }

    public function markAsUsed()
    {
        $this->update([
            'used' => true,
            'used_at' => now(),
        ]);
    }

    public function scopeValid($query)
    {
        return $query->where('used', false)
                    ->where('expires_at', '>', now());
    }
}
