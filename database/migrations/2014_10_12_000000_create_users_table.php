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
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('referral_code')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('avatar')->nullable();
            $table->decimal('sabong_com', 18, 10)->default(0);
            $table->decimal('lotto_com', 18, 10)->default(0);
            $table->decimal('sports_com', 18, 10)->default(0);
            $table->decimal('casino_com', 18, 10)->default(0);

            $table->decimal('min_bet_time', 18, 10)->default(0);
            $table->decimal('max_bet_time', 18, 10)->default(0);
            $table->decimal('max_bet_game', 18, 10)->default(0);
            $table->decimal('max_bet_draw', 18, 10)->default(0);

            $table->decimal('balance_ammount', 18, 10)->default(0);
            $table->decimal('cash_out_amount', 18, 10)->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
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
