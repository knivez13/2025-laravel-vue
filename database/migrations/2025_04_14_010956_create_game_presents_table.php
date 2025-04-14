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
        Schema::create('game_presents', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code')->unique();
            $table->longText('description')->nullable();
            $table->decimal('min_bet', 18, 10)->default(0);
            $table->decimal('max_bet', 18, 10)->default(0);
            $table->decimal('max_total_bet', 18, 10)->default(0);
            $table->integer('bet_opt_winner')->default(0);

            $table->uuid('game_type_id')->nullable();
            $table->foreign('game_type_id')->references('id')->on('game_types');

            $table->uuid('game_provider_id')->nullable();
            $table->foreign('game_provider_id')->references('id')->on('game_providers');

            $table->uuid('live_one_id')->nullable();
            $table->foreign('live_one_id')->references('id')->on('live_videos');
            $table->uuid('live_two_id')->nullable();
            $table->foreign('live_two_id')->references('id')->on('live_videos');
            $table->uuid('live_three_id')->nullable();
            $table->foreign('live_three_id')->references('id')->on('live_videos');

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
        Schema::dropIfExists('game_presents');
    }
};
