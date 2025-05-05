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
        Schema::create('live_videos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('game_type_id')->nullable();
            $table->foreign('game_type_id')->references('id')->on('game_types');
            $table->uuid('video_type_id')->nullable();
            $table->foreign('video_type_id')->references('id')->on('video_types');
            $table->string('name');
            $table->string('code')->nullable();
            $table->string('app_name')->nullable();
            $table->string('stream_key')->nullable();
            $table->string('url')->nullable();
            $table->string('server_ip')->nullable();
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
        Schema::dropIfExists('live_videos');
    }
};
