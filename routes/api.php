<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/connection', function () {
    return 'Connected';
});

Route::resource('/products', ProductController::class);

Route::prefix('/auth/')->group(function () {
    Route::post('login', [UserController::class, 'login']);
    Route::post('register', [UserController::class, 'register']);
});

Route::middleware(['auth:sanctum'])->group(
    function () {
        Route::prefix('/')->group(function () {
            Route::resource('summary', SummaryController::class);
            Route::post('summary/show', [SummaryController::class, 'summary']);
        });
    }
);
