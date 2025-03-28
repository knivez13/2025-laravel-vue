<?php

use Illuminate\Support\Facades\Schema;
use App\Models\Maintenance\PropCondition;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prop_conditions', function (Blueprint $table) {
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
                "condition_id" => 1,
                "condition_name" => "New",
                "description" => "The property is brand new and has never been lived in or used."
            ],
            [
                "condition_id" => 2,
                "condition_name" => "Renovated",
                "description" => "The property has been recently renovated or upgraded, with modern features."
            ],
            [
                "condition_id" => 3,
                "condition_name" => "Good",
                "description" => "The property is in good condition with no significant repairs needed."
            ],
            [
                "condition_id" => 4,
                "condition_name" => "Fair",
                "description" => "The property is in fair condition but may need minor repairs or updates."
            ],
            [
                "condition_id" => 5,
                "condition_name" => "Needs TLC",
                "description" => "The property requires significant repairs, maintenance, or renovation."
            ],
            [
                "condition_id" => 6,
                "condition_name" => "As-Is",
                "description" => "The property is being sold in its current condition without any repairs or warranties."
            ],
            [
                "condition_id" => 7,
                "condition_name" => "Historic",
                "description" => "The property has historic value and may require preservation or restoration efforts."
            ],
            [
                "condition_id" => 8,
                "condition_name" => "Uninhabitable",
                "description" => "The property is not fit for living due to major damage or disrepair."
            ]
        ];
        foreach ($amenities as $u) {
            PropCondition::create(['code' => $u['condition_name'], 'description' => $u['description']]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prop_conditions');
    }
};
