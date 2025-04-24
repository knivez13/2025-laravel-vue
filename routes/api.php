<?php

use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::controller(\App\Http\Controllers\Api\Auth\AuthController::class)->group(function () {
    Route::post('login', 'login');
});

// Protected Routes (Requires Authentication)
Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('agent')->name('agent.')->group(function () {
        // Route::apiresource('bet-history', App\Http\Controllers\Api\Game\BetHistory\BetHistoryController::class)->only(['index',]);
    });
    Route::prefix('user')->name('user.')->group(function () {
        // Route::apiresource('bet-history', App\Http\Controllers\Api\Game\BetHistory\BetHistoryController::class)->only(['index',]);
    });

    Route::prefix('admin')->name('admin.')->group(function () {});
    Route::controller(\App\Http\Controllers\Api\Auth\AuthController::class)->group(function () {
        Route::post('login', 'login');
    });
});
