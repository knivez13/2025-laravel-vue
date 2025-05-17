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
        Schema::create('game_lists', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('game_present_id')->nullable();
            $table->foreign('game_present_id')->references('id')->on('game_presents');

            $table->string('game_name')->nullable();
            $table->string('event_name')->nullable();

            $table->integer('total_round')->default(0);
            $table->integer('multiplier')->default(0);
            $table->decimal('rate', 18, 6)->default(0);

            $table->decimal('padding', 18, 8)->default(0);

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
        Schema::dropIfExists('game_lists');
    }
};
