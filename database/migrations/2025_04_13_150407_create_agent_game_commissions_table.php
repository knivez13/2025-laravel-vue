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
        Schema::create('agent_game_commissions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('agent_type_id')->nullable();
            $table->foreign('agent_type_id')->references('id')->on('agent_types');
            $table->uuid('game_type_id')->nullable();
            $table->foreign('game_type_id')->references('id')->on('game_types');
            $table->string('code')->nullable();
            $table->decimal('amount', 30, 8)->default(0);
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
        Schema::dropIfExists('agent_game_commissions');
    }
};
