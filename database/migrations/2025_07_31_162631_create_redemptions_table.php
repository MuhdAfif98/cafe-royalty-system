<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('redemptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('points_transaction_id')->constrained()->onDelete('cascade');
            $table->string('reward_type'); // e.g., 'discount', 'free_coffee'
            $table->decimal('discount_amount', 8, 2)->nullable();
            $table->string('qr_code')->unique()->nullable(); // For redemption QR codes
            $table->enum('status', ['pending', 'used', 'expired'])->default('pending');
            $table->timestamp('used_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index(['qr_code']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('redemptions');
    }
};
