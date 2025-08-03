<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password',
        'points_balance',
        'last_purchase_at',
        'phone_verified',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password_has_been_set' => 'boolean',
        'last_purchase_at' => 'datetime',
        'phone_verified' => 'boolean',
        'role' => 'string',
    ];

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    /**
     * Check if user is staff
     */
    public function isStaff(): bool
    {
        return in_array($this->role, ['staff', 'admin']);
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function pointsTransactions()
    {
        return $this->hasMany(PointsTransaction::class);
    }

    public function redemptions()
    {
        return $this->hasMany(Redemption::class);
    }

    public function otpCodes()
    {
        return $this->hasMany(OtpCode::class, 'phone_number', 'phone_number');
    }

    public function getPointsBalanceAttribute($value)
    {
        return (int) $value;
    }

    public function canEarnPoints()
    {
        // Check daily limit (100 points per day)
        $todayPoints = $this->pointsTransactions()
            ->where('type', 'earn')
            ->where('status', 'approved')
            ->whereDate('created_at', today())
            ->sum('points');

        return $todayPoints < 100;
    }

    public function hasExpiringPoints()
    {
        if (!$this->last_purchase_at) {
            return false;
        }

        $expiryDate = $this->last_purchase_at->addMonths(12);
        $thirtyDaysBeforeExpiry = $expiryDate->subDays(30);

        return now()->gte($thirtyDaysBeforeExpiry) && now()->lt($expiryDate);
    }
}
