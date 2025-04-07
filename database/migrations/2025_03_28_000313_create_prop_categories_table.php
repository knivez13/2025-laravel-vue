<?php

use Illuminate\Support\Facades\Schema;
use App\Models\Maintenance\PropCategory;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prop_categories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code')->unique();
            $table->longText('description')->nullable();
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
        $amenities = [
            [
                "category_name" => "Agriculture",
                "description" => "Properties used for living purposes, including houses, apartments, and condos."
            ],
            [
                "category_name" => "Commercial",
                "description" => "Properties used for business or commercial purposes, such as office buildings, retail spaces, and industrial properties."
            ],
            [
                "category_name" => "Industrial Space",
                "description" => "Properties designed for industrial purposes, such as warehouses, factories, and manufacturing plants."
            ],
            [
                "category_name" => "Religious Space",
                "description" => "Vacant land or undeveloped land, used for farming, development, or investment."
            ],
            [
                "category_name" => "Exhibition",
                "description" => "Properties that combine residential, commercial, and/or industrial spaces in one building or complex."
            ],
            [
                "category_name" => "Work Space",
                "description" => "High-end, premium properties that offer extensive features and luxurious living or business environments."
            ],
            [
                "category_name" => "Medical",
                "description" => "Properties designed for leisure and vacation, such as resorts, timeshares, or vacation homes."
            ],
            [
                "category_name" => "Malls",
                "description" => "Properties used for agricultural activities, including farms, ranches, and orchards."
            ],
            [
                "category_name" => "Food Court",
                "description" => "Properties designed to accommodate students, such as dormitories, student apartments, or rental properties near universities."
            ],
            [
                "category_name" => "Hospitility",
                "description" => "Properties designed to accommodate students, such as dormitories, student apartments, or rental properties near universities."
            ],
            [
                "category_name" => "Special Purpose",
                "description" => "Properties designed to accommodate students, such as dormitories, student apartments, or rental properties near universities."
            ]
        ];
        foreach ($amenities as $u) {
            PropCategory::create(['code' => $u['category_name'], 'description' => $u['description']]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prop_categories');
    }
};
