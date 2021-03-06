<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogOutController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\VerifyController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\FlagController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\StorePaymentController;
use App\Http\Controllers\StoreStripeDataController;
use App\Http\Controllers\StripeCheckOut;
use App\Http\Controllers\StripeConnectAccountOnBoardingController;
use App\Http\Controllers\StripePayoutController;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/stripe', [StoreStripeDataController::class, 'store']);
Route::post('/on-board', [StripeConnectAccountOnBoardingController::class, 'on_board']);
Route::post('/pay-out', [StripeConnectAccountOnBoardingController::class, 'transfer_payment']);
// Route::post('/pay-out', [StripePayoutController::class, 'pay_out']);
// Route::post('/pay-tabs', [StorePaymentController::class, 'store']);


Route::prefix('/auth/')->group(function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegistrationController::class, 'register']);
    Route::post('log_out', [LogOutController::class, 'log_out']);
    Route::post('send_code', [VerifyController::class, 'verify_code']);
});

Route::prefix('/')->group(
    function () {
        Route::get('flag/{iso}', [FlagController::class, 'flag']);
        Route::post('check-out', [StripeCheckOut::class, 'check_out']);
        Route::resource('rive-customer', BuyerController::class);
        Route::resource('products', ProductController::class);
    }
);

Route::middleware('auth:sanctum')->prefix('/')->group(
    function () {
        Route::resource('seller', SellerController::class);
        Route::resource('transactions', SummaryController::class);
        Route::resource('bank-account', BankAccountController::class);
        Route::post('verify', [SMSController::class, 'send_sms']);
        Route::post('resend', [SMSController::class, 'resend']);
        Route::post('change_password', [UserController::class, 'change_password']);
        Route::post('change_details', [UserController::class, 'change_details']);
    }
);
