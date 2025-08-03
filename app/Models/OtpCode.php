<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtpCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone_number',
        'code',
        'type',
        'expires_at',
        'used',
        'used_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'used' => 'boolean',
        'used_at' => 'datetime',
    ];

    public static function generate($phoneNumber, $type = 'verification')
    {
        // Invalidate any existing OTPs for this phone number and type
        self::where('phone_number', $phoneNumber)
            ->where('type', $type)
            ->where('used', false)
            ->update(['used' => true]);

        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        return self::create([
            'phone_number' => $phoneNumber,
            'code' => $code,
            'type' => $type,
            'expires_at' => now()->addMinutes(10), // 10 minutes expiry
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

        return true;
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

    public function scopeForPhone($query, $phoneNumber)
    {
        return $query->where('phone_number', $phoneNumber);
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }
}
