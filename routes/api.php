<?php

use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::controller(\App\Http\Controllers\Api\Auth\AuthController::class)->group(function () {
    Route::post('login', 'login');
});

// Protected Routes (Requires Authentication)
Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('maintenance')->group(function () {
        $resources = [
            'amenities'             => 'Amenity',
            'appliances'            => 'Appliances',
            'file-type'             => 'FileType',
            'mode-payment'          => 'ModePayment',
            'price-type'            => 'PriceType',
            'prop-category'         => 'PropCategory',
            'prop-condition'        => 'PropCondition',
            'prop-listType'         => 'PropListType',
            'prop-status'           => 'PropStatus',
            'prop-type'             => 'PropType',
            'utility'               => 'Utility',
            'near-location-filter'  => 'NearLocationFilter',
        ];

        foreach ($resources as $route => $controller) {
            Route::apiResource($route, "\\App\\Http\\Controllers\\Api\\Maintenance\\$controller\\{$controller}Controller")->except(['show']);
        }
    });
    Route::prefix('subscription')->group(function () {
        $subscriptions = [
            'subscription-type' => 'SubscriptionType',
            'user-subscription' => 'UserSubscription',
        ];

        foreach ($subscriptions as $route => $controller) {
            Route::apiResource($route, "\\App\\Http\\Controllers\\Api\\Subscription\\$controller\\{$controller}Controller")->except(['show']);
        }
    });
    Route::prefix('users')->group(function () {
        $subscriptions = [
            'user-list' => 'UserList',
            'role' => 'Role',
        ];

        foreach ($subscriptions as $route => $controller) {
            Route::apiResource($route, "\\App\\Http\\Controllers\\Api\\User\\$controller\\{$controller}Controller")->except(['destroy', 'store']);
        }
    });
});
