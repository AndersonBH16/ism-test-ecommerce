<?php

use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\Api\LogoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Rutas de autenticación
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('/login', [LoginController::class, '__invoke']);
    Route::post('/logout', [LogoutController::class, '__invoke'])->middleware('auth:api');
});

// Rutas protegidas
Route::group([
    'middleware' => ['api', 'auth:api']
], function () {

    // Productos
    Route::apiResource('products', ProductController::class);
    Route::get('products/search', [ProductController::class, 'search']);

    // Categorías
    Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);

    // Carrito
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index']);
        Route::post('/add', [CartController::class, 'addToCart']);
        Route::put('/update/{id}', [CartController::class, 'updateQuantity']);
        Route::delete('/remove/{id}', [CartController::class, 'removeFromCart']);
        Route::delete('/clear', [CartController::class, 'clearCart']);
        Route::get('/count', [CartController::class, 'getCartCount']);
    });
});
