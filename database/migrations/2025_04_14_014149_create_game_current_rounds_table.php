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
        Schema::create('game_current_rounds', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('game_list_id')->nullable();
            $table->foreign('game_list_id')->references('id')->on('game_lists');
            $table->uuid('game_round_id')->nullable();
            $table->foreign('game_round_id')->references('id')->on('game_list_rounds');
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
        Schema::dropIfExists('game_current_rounds');
    }
};
