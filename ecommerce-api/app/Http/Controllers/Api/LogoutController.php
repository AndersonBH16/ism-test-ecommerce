<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        try {
            auth()->logout();

            return response()->json(['message' => 'Successfully logged out']);
        }catch (JWTException){
            return response()->json(['error' => 'Token not found'], status: 401);
        }
    }
}
