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
        Schema::create('property_lists', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('prop_type_id')->nullable();
            $table->foreign('prop_type_id')->references('id')->on('prop_types');

            $table->uuid('prop_status_id')->nullable();
            $table->foreign('prop_status_id')->references('id')->on('prop_statuses');

            $table->uuid('prop_condition_id')->nullable();
            $table->foreign('prop_condition_id')->references('id')->on('prop_conditions');

            $table->uuid('prop_category_id')->nullable();
            $table->foreign('prop_category_id')->references('id')->on('prop_categories');

            $table->uuid('prop_list_type_id')->nullable();
            $table->foreign('prop_list_type_id')->references('id')->on('prop_list_types');

            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('lon')->nullable();
            $table->string('lat')->nullable();

            $table->string('country')->nullable();
            $table->string('province')->nullable();
            $table->string('municipality')->nullable();
            $table->string('barangay')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('address')->nullable();

            $table->longText('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->longText('video_url')->nullable();
            $table->longText('virtual_tour_url')->nullable();
            $table->longText('floor_plan_url')->nullable();
            $table->longText('cover_photo')->nullable();

            $table->tinyInteger('pet_friendly')->default(0);
            $table->date('available_from_date')->nullable();

            $table->integer('build_year')->default(0);
            $table->integer('area_size')->default(0);

            $table->integer('room')->default(0);
            $table->integer('bathroom')->default(0);
            $table->integer('kitchen_size')->default(0);
            $table->integer('parking_size')->default(0);

            $table->uuid('mode_payment_id')->nullable();
            $table->foreign('mode_payment_id')->references('id')->on('mode_payments');
            $table->integer('min_rent_month')->default(0);

            $table->uuid('price_type_id')->nullable();
            $table->foreign('price_type_id')->references('id')->on('price_types');
            $table->decimal('price_amount', 18, 4)->default(0);

            $table->integer('view_count')->default(0);
            $table->integer('save_count')->default(0);

            $table->tinyInteger('is_visible')->default(0);
            $table->tinyInteger('is_availability')->default(0);

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
        Schema::dropIfExists('property_lists');
    }
};
