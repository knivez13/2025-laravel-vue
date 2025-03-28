<?php

use Illuminate\Support\Facades\Schema;
use App\Models\Maintenance\ModePayment;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mode_payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code')->unique();
            $table->longText('description')->nullable();
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
        $amenities = [
            "Cash",
            "Credit card",
            "E-wallet",
            "Bank Transfer",
            "Bank check",

        ];
        foreach ($amenities as $u) {
            ModePayment::create(['code' => $u, 'description' => $u]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mode_payments');
    }
};
