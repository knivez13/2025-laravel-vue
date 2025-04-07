<?php

use App\Models\Maintenance\FileType;
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
        Schema::create('file_types', function (Blueprint $table) {
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
                "document_id" => 1,
                "document_name" => "Title Deed",
                "description" => "A legal document proving ownership of a property."
            ],
            [
                "document_id" => 2,
                "document_name" => "Sale Agreement",
                "description" => "A contract between the buyer and seller outlining the terms of the sale."
            ],
            [
                "document_id" => 3,
                "document_name" => "Property Tax Receipt",
                "description" => "Proof of payment of property taxes for the year."
            ],
            [
                "document_id" => 4,
                "document_name" => "Home Inspection Report",
                "description" => "A detailed report of the property's condition, typically prepared by a professional inspector."
            ],
            [
                "document_id" => 5,
                "document_name" => "Mortgage Agreement",
                "description" => "A contract between the borrower and lender regarding the terms of the property loan."
            ],
            [
                "document_id" => 6,
                "document_name" => "Proof of Income",
                "description" => "Documents like pay stubs or bank statements to prove the buyer's income, typically needed for financing."
            ],
            [
                "document_id" => 7,
                "document_name" => "Identification Document",
                "description" => "A government-issued ID (e.g., passport, driver's license) verifying the identity of the buyer or seller."
            ],
            [
                "document_id" => 8,
                "document_name" => "Property Appraisal Report",
                "description" => "A report prepared by a licensed appraiser that estimates the market value of the property."
            ],
            [
                "document_id" => 9,
                "document_name" => "Homeowners Association (HOA) Documents",
                "description" => "Documents outlining the rules, regulations, and fees associated with a homeowners association."
            ],
            [
                "document_id" => 10,
                "document_name" => "Seller Disclosure Statement",
                "description" => "A statement provided by the seller, disclosing any known issues or defects with the property."
            ],
            [
                "document_id" => 11,
                "document_name" => "Deed of Trust",
                "description" => "A legal document that secures a loan against the property, often used in place of a mortgage."
            ],
            [
                "document_id" => 12,
                "document_name" => "Insurance Policy",
                "description" => "Proof of property insurance coverage, often required for mortgage approval."
            ],
            [
                "document_id" => 13,
                "document_name" => "Lease Agreement",
                "description" => "A contract between a property owner and a tenant outlining the terms of renting the property."
            ],
            [
                "document_id" => 14,
                "document_name" => "Utility Bills",
                "description" => "Recent utility bills (e.g., water, electricity, gas) to confirm the property's usage and associated costs."
            ],
            [
                "document_id" => 15,
                "document_name" => "Construction Permits",
                "description" => "Documents proving that the necessary permits were obtained for construction or renovation work."
            ],
            [
                "document_id" => 16,
                "document_name" => "Certificate of Occupancy",
                "description" => "A certificate issued by the local government or municipality confirming that the property complies with building codes and is safe to occupy."
            ]
        ];
        foreach ($amenities as $u) {
            FileType::create(['code' => $u['document_name'], 'description' => $u['description']]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_types');
    }
};
