<?php

use App\Models\Maintenance\Appliances;
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
        Schema::create('appliances', function (Blueprint $table) {
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
        $appliances = [
            "Air Conditioners",
            "Dishwashers",
            "Dryers",
            "Refrigerators",
            "Ovens",
            "Microwaves",
            "Coffee Machines",
            "Water Coolers",
            "Electric Kettles",
            "Blenders",
            "Toasters",
            "Washing Machines",
            "Garbage Disposal Units",
            "Electric Fans",
            "Space Heaters",
            "Coffee Makers",
            "Water Heaters",
            "Dehumidifiers",
            "Fridges",
            "Freezers",
            "Vending Machines",
            "Ice Machines",
            "Commercial Coffee Grinders",
            "Juicers",
            "Portable Air Conditioning Units",
            "Commercial Ranges",
            "Air Purifiers",
            "Dishwashers (Commercial)",
            "Toaster Ovens",
            "Deep Fryers",
            "Grills",
            "Induction Cooktops",
            "Stoves",
            "Hot Plates",
            "Cooktop Extractors",
            "Refrigerated Display Units",
            "Under-counter Fridges",
            "Countertop Ovens",
            "Chilled Water Dispensers",
            "Electric Cookers",
            "Convection Ovens",
            "Coffee Brewing Systems",
            "Refrigerated Storage Units",
            "Warmers (Food)",
            "Blow Dryers (for salons)",
            "Commercial Range Hoods",
            "Bar Refrigerators",
            "Dish Sanitizers",
            "Lawn Mowers (for premises)",
            "Clothes Steamers",
            "Electric Grills",
            "Pizza Ovens",
            "Steak Grills",
            "Treadmills (in fitness centers)",
            "Dough Mixers",
            "Ice Cream Makers",
            "Smoothie Makers",
            "Soda Dispensers",
            "Frozen Drink Machines",
            "Garment Steamers",
            "Electric Sandwich Makers",
            "Microwave Ovens (Commercial)",
            "Food Warmers",
            "Milk Frothers",
            "Wine Coolers",
            "Outdoor Fans",
            "Portable Heaters",
            "Electric Ranges",
            "Electric Skillets",
            "Chilled Beverage Dispensers",
            "Commercial Blenders",
            "Gas Cooktops",
            "Popcorn Machines",
            "Sous-Vide Machines",
            "Food Processors",
            "Freezer Units",
            "Electric Fryers",
            "Portable AC Units",
            "Refrigerated Beverage Vending Machines",
            "Countertop Refrigerators",
            "Toilet Paper Dispensers",
            "Towel Dispensers",
            "Security Cameras (with recording equipment)",
            "Overhead Projectors",
            "Sound Systems",
            "Office Shredders",
            "Heated Display Cases",
            "Digital Temperature Displays",
            "UV Sanitizers",
            "Electric Fans (for offices)",
            "Blowers (for drying facilities)"
        ];
        foreach ($appliances as $u) {
            Appliances::create(['code' => $u, 'description' => $u]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appliances');
    }
};
