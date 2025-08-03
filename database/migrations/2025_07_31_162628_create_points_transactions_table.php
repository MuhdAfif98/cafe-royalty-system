<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('points_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['earn', 'redeem']);
            $table->integer('points');
            $table->decimal('amount', 8, 2)->nullable(); // Purchase amount for earning points
            $table->string('transaction_id')->unique()->nullable(); // For QR code transactions
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('description')->nullable();
            $table->timestamp('expires_at')->nullable(); // For points expiration
            $table->timestamps();

            $table->index(['user_id', 'type']);
            $table->index(['status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('points_transactions');
    }
};
