<?php

use App\Models\Maintenance\VideoType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('video_types', function (Blueprint $table) {
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

        VideoType::create([
            'code' => 'Embed Code',
            'description' => 'Embed Code',
        ]);
        VideoType::create([
            'code' => 'Antmedia',
            'description' => 'Antmedia',
        ]);
        VideoType::create([
            'code' => 'Youtube Link',
            'description' => 'Youtube Link',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_types');
    }
};
