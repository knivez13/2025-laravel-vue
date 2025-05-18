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
        Schema::create('game_list_rounds', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('round_no')->default(0);

            $table->uuid('game_list_id')->nullable();
            $table->foreign('game_list_id')->references('id')->on('game_lists');

            $table->uuid('win_option_id')->nullable();
            $table->foreign('win_option_id')->references('id')->on('game_present_options');

            $table->tinyInteger('status')->default(0);

            $table->timestamps();
            $table->softDeletes();
            $table->uuid('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->uuid('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
            $table->uuid('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('users');
        });

        Schema::table('game_lists', function (Blueprint $table) {
            $table->uuid('current_round_id')->nullable();
            $table->foreign('current_round_id')->references('id')->on('game_list_rounds');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_list_rounds');
    }
};
