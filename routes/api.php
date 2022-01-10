<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FlagController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SummaryController;
use Illuminate\Support\Facades\Route;


Route::prefix('/auth/')->group(function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegistrationController::class, 'register']);
});

Route::prefix('/')->group(
    function () {
        Route::get('flag/{iso}', [FlagController::class, 'flag']);
        Route::post('check-out', [CheckoutController::class, 'check_out']);
        Route::resource('rive-customer', BuyerController::class);
        Route::resource('transactions', SummaryController::class);
        Route::resource('products', ProductController::class);
    }
);

Route::middleware('auth:sanctum')->prefix('/')->group(
    function () {
    }
);
