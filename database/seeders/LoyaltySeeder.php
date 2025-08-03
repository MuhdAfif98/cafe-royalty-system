<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\PointsTransaction;
use App\Models\Redemption;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LoyaltySeeder extends Seeder
{
    public function run(): void
    {
        // Create a test user
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone_number' => '+1234567891',
            'password' => Hash::make('Password123!'),
            'points_balance' => 150,
            'phone_verified' => true,
        ]);

        // Create some sample transactions
        $transactions = [
            [
                'type' => 'earn',
                'points' => 25,
                'amount' => 25.50,
                'status' => 'approved',
                'description' => 'Earned 25 points for $25.50 purchase',
                'created_at' => now()->subDays(5),
            ],
            [
                'type' => 'earn',
                'points' => 15,
                'amount' => 15.75,
                'status' => 'approved',
                'description' => 'Earned 15 points for $15.75 purchase',
                'created_at' => now()->subDays(3),
            ],
            [
                'type' => 'earn',
                'points' => 30,
                'amount' => 30.00,
                'status' => 'approved',
                'description' => 'Earned 30 points for $30.00 purchase',
                'created_at' => now()->subDays(1),
            ],
            [
                'type' => 'redeem',
                'points' => 20,
                'status' => 'approved',
                'description' => 'Redeemed 20 points for $2.00 discount',
                'created_at' => now()->subHours(12),
            ],
        ];

        foreach ($transactions as $transactionData) {
            $transaction = PointsTransaction::create(array_merge($transactionData, [
                'user_id' => $user->id,
                'expires_at' => $transactionData['type'] === 'earn' ? now()->addMonths(12) : null,
            ]));

            // Create redemption for redeem transaction
            if ($transaction->type === 'redeem') {
                Redemption::create([
                    'user_id' => $user->id,
                    'points_transaction_id' => $transaction->id,
                    'reward_type' => 'discount',
                    'discount_amount' => $transaction->points / 10,
                    'qr_code' => 'REDEEM_' . uniqid(),
                    'status' => 'used',
                    'used_at' => now()->subHours(10),
                ]);
            }
        }

        // Create a pending transaction
        PointsTransaction::create([
            'user_id' => $user->id,
            'type' => 'earn',
            'points' => 10,
            'amount' => 10.25,
            'status' => 'pending',
            'description' => 'Manual purchase entry (pending staff approval)',
            'created_at' => now()->subHours(2),
        ]);

        // Create an active redemption
        $activeTransaction = PointsTransaction::create([
            'user_id' => $user->id,
            'type' => 'redeem',
            'points' => 50,
            'status' => 'approved',
            'description' => 'Redeemed 50 points for $5.00 discount',
            'created_at' => now()->subHours(1),
        ]);

        Redemption::create([
            'user_id' => $user->id,
            'points_transaction_id' => $activeTransaction->id,
            'reward_type' => 'discount',
            'discount_amount' => 5.00,
            'qr_code' => 'REDEEM_' . uniqid(),
            'status' => 'pending',
        ]);

        $this->command->info('Loyalty system seeded successfully!');
        $this->command->info('Test user: john@example.com / Password123!');
    }
}
