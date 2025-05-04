<?php

use App\Models\Maintenance\GameType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {   /// Slot Games,Live Games,Sports Games,Live Casino,Virtual Games,Table Games
        Schema::create('game_types', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code')->unique();
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->uuid('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->uuid('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users');
            $table->uuid('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('users');
        });

        GameType::create([
            'code' => 'Sabong',
            'description' => 'Sabong',
        ]);
        GameType::create([
            'code' => 'Casino',
            'description' => 'Casino',
        ]);
        GameType::create([
            'code' => 'Sports Game',
            'description' => 'Sports Game',
        ]);
        GameType::create([
            'code' => 'Lotto',
            'description' => 'Lotto',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_types');
    }
};
