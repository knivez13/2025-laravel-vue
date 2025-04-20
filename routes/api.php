<?php

use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::controller(\App\Http\Controllers\Api\Auth\AuthController::class)->group(function () {
    Route::post('login', 'login');
});

// Protected Routes (Requires Authentication)
Route::middleware(['auth:sanctum'])->group(function () {

    Route::prefix('maintenance')->name('maintenance.')->group(function () {
        Route::apiResource('agentGameCommission', App\Http\Controllers\Api\Maintenance\AgentGameCommission\AgentGameCommissionController::class)->only(['index']);
        Route::apiResource('agentType', App\Http\Controllers\Api\Maintenance\AgentType\AgentTypeController::class)->only(['index']);
        Route::apiResource('bankType', App\Http\Controllers\Api\Maintenance\BankType\BankTypeController::class)->only(['index']);
        Route::apiResource('gamePresent', App\Http\Controllers\Api\Maintenance\GamePresent\GamePresentController::class)->only(['index']);
        Route::apiResource('gamePresentAnnouncement', App\Http\Controllers\Api\Maintenance\GamePresentAnnouncement\GamePresentAnnouncementController::class)->only(['index']);
        Route::apiResource('gamePresentOption', App\Http\Controllers\Api\Maintenance\GamePresentOption\GamePresentOptionController::class)->only(['index']);
        Route::apiResource('gameProvider', App\Http\Controllers\Api\Maintenance\GameProvider\GameProviderController::class)->only(['index']);
        Route::apiResource('gameType', App\Http\Controllers\Api\Maintenance\GameType\GameTypeController::class)->only(['index']);
        Route::apiResource('liveVideo', App\Http\Controllers\Api\Maintenance\LiveVideo\LiveVideoController::class)->only(['index']);
        Route::apiResource('videoType', App\Http\Controllers\Api\Maintenance\VideoType\VideoTypeController::class)->only(['index']);
    });
});
