<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redemption extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'points_transaction_id',
        'reward_type',
        'discount_amount',
        'qr_code',
        'status',
        'used_at',
    ];

    protected $casts = [
        'discount_amount' => 'decimal:2',
        'used_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pointsTransaction()
    {
        return $this->belongsTo(PointsTransaction::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeUsed($query)
    {
        return $query->where('status', 'used');
    }

    public function scopeExpired($query)
    {
        return $query->where('status', 'expired');
    }

    public function isExpired()
    {
        // Redemptions expire after 24 hours
        return $this->created_at->addHours(24)->lt(now());
    }

    public function markAsUsed()
    {
        $this->update([
            'status' => 'used',
            'used_at' => now(),
        ]);
    }
}
