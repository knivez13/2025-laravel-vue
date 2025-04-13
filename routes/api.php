<?php

use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::controller(\App\Http\Controllers\Api\Auth\AuthController::class)->group(function () {
    Route::post('login', 'login');
});

// Protected Routes (Requires Authentication)
Route::middleware(['auth:sanctum'])->group(function () {
    // Route::apiResource($route, "\\App\\Http\\Controllers\\Api\\Subscription\\$controller\\{$controller}Controller")->except(['show']);
});
