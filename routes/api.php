<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogOutController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\VerifyController;

use App\Http\Controllers\BuyerController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FlagController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\UserController;
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
        Route::resource('products', ProductController::class);
    }
);

Route::middleware('auth:sanctum')->prefix('/')->group(
    function () {
        Route::post('log_out', [LogOutController::class, 'log_out']);
        Route::post('send_code', [VerifyController::class, 'verify_code']);
        Route::post('verify', [SMSController::class, 'send_sms']);
        Route::post('resend', [SMSController::class, 'resend']);
        Route::post('change_password', [UserController::class, 'change_password']);
        Route::post('change_details', [UserController::class, 'change_details']);
    }
);
