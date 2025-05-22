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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('username')->unique();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('address')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('email')->nullable();
            $table->string('referral_code')->nullable();
            $table->string('avatar')->nullable();
            $table->decimal('min_bet_time', 30, 8)->default(0);
            $table->decimal('max_bet_time', 30, 8)->default(0);
            $table->decimal('max_bet_game', 30, 8)->default(0);
            $table->decimal('max_bet_draw', 30, 8)->default(0);

            $table->string('ip_address')->nullable();
            $table->timestamp('last_online')->nullable();
            $table->decimal('commission_amount', 30, 8)->default(0);
            $table->decimal('balance_amount', 30, 8)->default(0);
            $table->decimal('cash_out_amount', 30, 8)->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('status')->default(1);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
