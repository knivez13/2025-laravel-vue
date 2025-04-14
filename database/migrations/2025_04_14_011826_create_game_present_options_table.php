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
        Schema::create('game_present_options', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('order_list')->default(0);
            $table->uuid('game_present_id')->nullable();
            $table->foreign('game_present_id')->references('id')->on('game_presents');
            $table->string('code')->nullable();
            $table->longText('description')->nullable();
            $table->string('color')->nullable();
            $table->decimal('multiplier', 18, 6)->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->uuid('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->uuid('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
            $table->uuid('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_present_options');
    }
};
