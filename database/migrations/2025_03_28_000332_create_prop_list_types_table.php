<?php

use Illuminate\Support\Facades\Schema;
use App\Models\Maintenance\PropListType;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prop_list_types', function (Blueprint $table) {
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
                "type_name" => "For Sale",
                "description" => "The property is available for purchase."
            ],
            [
                "type_name" => "For Rent",
                "description" => "The property is available for lease or rental."
            ],
            // [
            //     "type_name" => "Auction",
            //     "description" => "The property is being sold through an auction."
            // ],
            // [
            //     "type_name" => "For Lease",
            //     "description" => "The property is available for a long-term lease (commercial or residential)."
            // ],
            // [
            //     "type_name" => "Short Sale",
            //     "description" => "The property is being sold for less than the outstanding mortgage, typically due to financial hardship."
            // ],
            // [
            //     "type_name" => "Foreclosure",
            //     "description" => "The property is being sold due to the owner's inability to repay the mortgage."
            // ],
            // [
            //     "type_name" => "Rent to Own",
            //     "description" => "The property is available for rent with the option to purchase at a later time."
            // ]
        ];
        foreach ($amenities as $u) {
            PropListType::create(['code' => $u['type_name'], 'description' => $u['description']]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prop_list_types');
    }
};
