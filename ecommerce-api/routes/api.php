<?php

use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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
    Route::apiResource('products', ProductController::class);

    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index']);
        Route::post('/add', [CartController::class, 'addToCart']);
        Route::put('/update/{id}', [CartController::class, 'updateQuantity']);
        Route::delete('/remove/{id}', [CartController::class, 'removeFromCart']);
    });

    Route::prefix('wishlist')->group(function () {
        Route::post('/add', function() {
            return response()->json(['message' => 'Added to wishlist']);
        });
    });
});
