<?php

use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('/login', [LoginController::class, '__invoke']);
    Route::post('/logout', [LogoutController::class, '__invoke'])->middleware('auth:api');
});

Route::group([
    'middleware' => ['api', 'auth:api']
], function () {
    Route::get('metrics', [DashboardController::class, 'index']);
    Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);
    Route::apiResource('products', ProductController::class);
    Route::get('products/search', [ProductController::class, 'search']);

    Route::post('orders', [OrderController::class, 'store']);
});
