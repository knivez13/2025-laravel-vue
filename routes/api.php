<?php

use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::controller(\App\Http\Controllers\Api\Auth\AuthController::class)->group(function () {
    Route::post('login', 'login');
});

// Protected Routes (Requires Authentication)
Route::middleware(['auth:sanctum'])->group(function () {


    Route::apiResource('gameList', App\Http\Controllers\Api\GameModerator\GameList\GameListController::class);

    Route::prefix('maintenance')->name('maintenance.')->group(function () {
        Route::apiResource('agentGameCommission', App\Http\Controllers\Api\Maintenance\AgentGameCommission\AgentGameCommissionController::class)->except(['show']);
        Route::apiResource('agentType', App\Http\Controllers\Api\Maintenance\AgentType\AgentTypeController::class)->except(['show']);
        Route::apiResource('bankType', App\Http\Controllers\Api\Maintenance\BankType\BankTypeController::class)->except(['show']);
        Route::apiResource('gamePresent', App\Http\Controllers\Api\Maintenance\GamePresent\GamePresentController::class)->except(['show']);
        Route::apiResource('gamePresentAnnouncement', App\Http\Controllers\Api\Maintenance\GamePresentAnnouncement\GamePresentAnnouncementController::class)->except(['show']);
        Route::apiResource('gamePresentOption', App\Http\Controllers\Api\Maintenance\GamePresentOption\GamePresentOptionController::class)->except(['show']);
        Route::apiResource('gameProvider', App\Http\Controllers\Api\Maintenance\GameProvider\GameProviderController::class)->except(['show']);
        Route::apiResource('gameType', App\Http\Controllers\Api\Maintenance\GameType\GameTypeController::class)->except(['show']);
        Route::apiResource('liveVideo', App\Http\Controllers\Api\Maintenance\LiveVideo\LiveVideoController::class)->except(['show']);
        Route::apiResource('videoType', App\Http\Controllers\Api\Maintenance\VideoType\VideoTypeController::class)->except(['show']);
    });
});
