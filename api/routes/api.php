<?php

use App\Http\Controllers\Auth\LoginController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('login', LoginController::class)->name('login');
});

Route::scopeBindings()->middleware('auth:sanctum')->group(function () {
    Route::prefix('provider')->name('provider.')->middleware("role:" . User::ROLE_PROVIDER)->group(function () {
        Route::prefix('{provider}')->group(function () {
            
        });
    });

    Route::prefix('consumer')->name('consumer.')->middleware("role:" . User::ROLE_CONSUMER)->group(function () {
        Route::prefix('{consumer}')->group(function () {
            
        });
    });
});