<?php

use App\Models\Maintenance\Utility;
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
        Schema::create('utilities', function (Blueprint $table) {
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
                "utility_id" => 1,
                "utility_name" => "Water",
                "description" => "The property includes water usage as part of the rent or price."
            ],
            [
                "utility_id" => 2,
                "utility_name" => "Electricity",
                "description" => "The property includes electricity usage as part of the rent or price."
            ],
            [
                "utility_id" => 3,
                "utility_name" => "Gas",
                "description" => "The property includes natural gas usage as part of the rent or price."
            ],
            [
                "utility_id" => 4,
                "utility_name" => "Internet",
                "description" => "The property includes internet service as part of the rent or price."
            ],
            [
                "utility_id" => 5,
                "utility_name" => "Cable TV",
                "description" => "The property includes cable television service as part of the rent or price."
            ],
            [
                "utility_id" => 6,
                "utility_name" => "Trash Collection",
                "description" => "The property includes trash or waste collection service as part of the rent or price."
            ],
            [
                "utility_id" => 7,
                "utility_name" => "Heating",
                "description" => "The property includes heating costs (e.g., central heating) as part of the rent or price."
            ],
            [
                "utility_id" => 8,
                "utility_name" => "Cooling",
                "description" => "The property includes cooling or air conditioning costs as part of the rent or price."
            ],
            [
                "utility_id" => 9,
                "utility_name" => "Landline Phone",
                "description" => "The property includes landline phone service as part of the rent or price."
            ],
            [
                "utility_id" => 10,
                "utility_name" => "None",
                "description" => "No utilities are included in the rent or purchase price."
            ]
        ];
        foreach ($amenities as $u) {
            Utility::create(['code' => $u['utility_name'], 'description' => $u['description']]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilities');
    }
};
