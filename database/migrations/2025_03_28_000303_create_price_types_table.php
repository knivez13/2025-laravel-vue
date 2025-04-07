<?php

use App\Models\Maintenance\PriceType;
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
        Schema::create('price_types', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code')->unique();
            $table->longText('description')->nullable();
            $table->string('payment_frequency')->nullable();
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
        $amenities = [
            [
                "term_id" => 1,
                "term_name" => "Full Payment Upfront",
                "description" => "The buyer pays the entire price of the property upfront, either in cash or through a wire transfer.",
                "payment_frequency" => "One-time"
            ],
            [
                "term_id" => 2,
                "term_name" => "Installments (Seller Financing)",
                "description" => "The buyer makes monthly payments directly to the seller over a specified term, without involving a bank or lender.",
                "payment_frequency" => "Monthly"
            ],
            [
                "term_id" => 3,
                "term_name" => "Mortgage Financing",
                "description" => "The buyer finances the property through a mortgage loan, typically with a bank or lender, with payments made monthly.",
                "payment_frequency" => "Monthly"
            ],
            [
                "term_id" => 4,
                "term_name" => "Rent-to-Own",
                "description" => "The tenant rents the property with an option to purchase it at the end of the rental term, often with part of the rent credited toward the purchase price.",
                "payment_frequency" => "Monthly"
            ],
            [
                "term_id" => 5,
                "term_name" => "Lease Option",
                "description" => "The tenant leases the property with the option to buy at a later date, but without the obligation to purchase.",
                "payment_frequency" => "Monthly"
            ],
            [
                "term_id" => 6,
                "term_name" => "Monthly Rental Payments",
                "description" => "The tenant makes monthly payments for the use of the property, with a lease agreement outlining the terms.",
                "payment_frequency" => "Monthly"
            ],
            [
                "term_id" => 7,
                "term_name" => "Annual Rental Payments",
                "description" => "The tenant pays the full rental amount for the year upfront or in a lump sum at the start of the lease term.",
                "payment_frequency" => "One-time"
            ],
            [
                "term_id" => 8,
                "term_name" => "Security Deposit + Monthly Rent",
                "description" => "The tenant pays a security deposit at the beginning of the lease and monthly rent thereafter. The security deposit is refundable at the end of the lease term, subject to conditions.",
                "payment_frequency" => "Monthly"
            ],
            [
                "term_id" => 9,
                "term_name" => "Down Payment + Monthly Mortgage Payments",
                "description" => "The buyer makes an initial down payment on the property and pays the remaining balance through a mortgage with monthly payments.",
                "payment_frequency" => "Monthly"
            ],
            [
                "term_id" => 11,
                "term_name" => "Weekly Rental Payments",
                "description" => "The tenant makes weekly rental payments for the use of the property, as per the lease agreement.",
                "payment_frequency" => "Weekly"
            ],
            [
                "term_id" => 12,
                "term_name" => "Quarterly Rental Payments",
                "description" => "The tenant makes payments for the property on a quarterly basis, either through installments or in lump sums.",
                "payment_frequency" => "Quarterly"
            ],
            [
                "term_id" => 13,
                "term_name" => "Semi-Annual Rental Payments",
                "description" => "The tenant pays the rental amount twice a year, typically in advance or through two large payments.",
                "payment_frequency" => "Semi-Annual"
            ]
        ];
        foreach ($amenities as $u) {
            PriceType::create(['code' => $u['term_name'], 'description' => $u['description'], 'payment_frequency' => $u['payment_frequency']]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_types');
    }
};
