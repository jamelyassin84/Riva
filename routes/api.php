<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShippingInformationController;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/connection', function () {
    return 'Connected';
});


Route::prefix('/auth/')->group(function () {
    Route::post('login', [UserController::class, 'login']);
    Route::post('register', [UserController::class, 'register']);
});

Route::prefix('/')->group(
    function () {
        Route::resource('products', ProductController::class);
        Route::resource('ship', ShippingInformationController::class);
    }
);

Route::middleware(['auth:sanctum'])->group(
    function () {
        Route::prefix('/')->group(function () {
            Route::resource('summary', SummaryController::class);
            Route::post('summary/show', [SummaryController::class, 'summary']);
        });
    }
);
