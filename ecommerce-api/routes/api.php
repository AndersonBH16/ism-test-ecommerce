<?php

use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\Api\LogoutController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function (){
    Route::post('/login', [LoginController::class, '__invoke']);
    Route::post('/logout', [LogoutController::class, '__invoke']);
});
