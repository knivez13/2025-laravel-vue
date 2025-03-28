<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Subscription\SubscriptionType;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscription_types', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('code')->unique();
            $table->longText('description')->nullable();
            $table->integer('list_count')->nullable();
            $table->integer('sell_count')->nullable();
            $table->integer('discount')->default(0);
            $table->integer('day_package')->default(0);
            $table->integer('order')->default(0);
            $table->decimal('price', 18, 4)->default(0);
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
        SubscriptionType::create([
            'code' => 'BASIC',
            'description' => '',
            'order' => 1,
            'list_count' => 1,
            'sell_count' => 1,
            'discount' => 0,
            'day_package' => 30,
            'price' => 100,
        ]);

        SubscriptionType::create([
            'code' => 'ADVANCE',
            'description' => '',
            'order' => 2,
            'list_count' => 5,
            'sell_count' => 5,
            'discount' => 0,
            'day_package' => 30,
            'price' => 500,
        ]);

        SubscriptionType::create([
            'code' => 'VIP',
            'description' => '',
            'order' => 3,
            'list_count' => 0,
            'sell_count' => 0,
            'discount' => 0,
            'day_package' => 30,
            'price' => 0,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_types');
    }
};
