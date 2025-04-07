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
        Schema::create('property_list_amenities', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('property_list_id')->nullable();
            $table->foreign('property_list_id')->references('id')->on('property_lists');
            $table->uuid('amenity_id')->nullable();
            $table->foreign('amenity_id')->references('id')->on('amenities');
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_list_amenities');
    }
};
