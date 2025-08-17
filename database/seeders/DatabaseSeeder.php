<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Ensure default test user exists (idempotent)
        User::updateOrCreate(
            [
                'phone_number' => '1234567890',
            ],
            [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => Hash::make('password'),
                'phone_verified' => true,
                'role' => 'customer',
            ]
        );

        // Ensure an admin user exists
        User::updateOrCreate(
            [
                'phone_number' => '1234567892',
            ],
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'phone_verified' => true,
                'role' => 'admin',
            ]
        );
    }
}
