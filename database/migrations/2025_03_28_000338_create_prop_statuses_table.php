<?php

use App\Models\Maintenance\PropStatus;
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
        Schema::create('prop_statuses', function (Blueprint $table) {
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
                "status_name" => "Available",
                "description" => "The property is available for sale or rent."
            ],
            [
                "status_name" => "Under Contract",
                "description" => "The property has an offer or agreement in place, but the sale or rent is not finalized yet."
            ],
            [
                "status_name" => "Sold",
                "description" => "The property has been sold and is no longer available."
            ],
            [
                "status_name" => "Leased",
                "description" => "The property has been leased to a tenant and is no longer available for new leases."
            ],
            [
                "status_name" => "Pending",
                "description" => "The property is awaiting further actions or decisions before the transaction can proceed."
            ],
            [
                "status_name" => "Off Market",
                "description" => "The property is no longer listed for sale or rent, but it has not been sold or leased yet."
            ],
            [
                "status_name" => "Canceled",
                "description" => "The property listing has been canceled, either by the seller or the listing agent."
            ],
            [
                "status_name" => "Expired",
                "description" => "The listing has expired because the seller did not renew or extend the listing contract."
            ]
        ];
        foreach ($amenities as $u) {
            PropStatus::create(['code' => $u['status_name'], 'description' => $u['description']]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prop_statuses');
    }
};
