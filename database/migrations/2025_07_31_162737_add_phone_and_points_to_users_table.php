<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_number')->unique()->after('email');
            $table->integer('points_balance')->default(0)->after('phone_number');
            $table->timestamp('last_purchase_at')->nullable()->after('points_balance');
            $table->boolean('phone_verified')->default(false)->after('last_purchase_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone_number', 'points_balance', 'last_purchase_at', 'phone_verified']);
        });
    }
};
