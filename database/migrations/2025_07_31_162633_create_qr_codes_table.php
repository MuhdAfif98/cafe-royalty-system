<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('qr_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // The actual QR code data
            $table->enum('type', ['purchase', 'redemption', 'user']);
            $table->json('data'); // Encoded data (transaction_id, amount, user_id, etc.)
            $table->string('signature'); // Cryptographic signature
            $table->timestamp('expires_at');
            $table->boolean('used')->default(false);
            $table->timestamp('used_at')->nullable();
            $table->timestamps();

            $table->index(['code', 'type']);
            $table->index(['expires_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qr_codes');
    }
};
