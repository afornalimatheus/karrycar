<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Provider\Vehicles\VehicleController;
use App\Http\Controllers\ReservationController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('login', LoginController::class)->name('login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('provider')->name('provider.')->middleware("role:" . User::ROLE_PROVIDER)->group(function () {
        Route::prefix('{provider}')->middleware('owns:provider')->group(function () {
            Route::apiResource('vehicles', VehicleController::class)->scoped();
        });
    });

    Route::prefix('consumer')->name('consumer.')->middleware("role:" . User::ROLE_CONSUMER)->group(function () {
        Route::prefix('{consumer}')->middleware('owns:consumer')->group(function () {
            Route::get('/available-vehicles', [VehicleController::class, 'getAvailableVehicles'])->name('available-vehicles.index');

            Route::apiResource('reservations', ReservationController::class)->scoped();
        });
    });
});