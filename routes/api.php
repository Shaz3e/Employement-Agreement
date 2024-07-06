<?php

use App\Http\Controllers\Api\ApiEmployeeController;
use App\Http\Controllers\Api\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


// Route::prefix('v1')->group( function() {
//     Route::apiResource('employees', ApiEmployeeController::class)->middleware('auth:sanctum');
// });



Route::prefix('v1')->group(function () {
    // Login route for authentication
    Route::post('login', [LoginController::class, 'login']);

    // Protected routes requiring authentication via Sanctum
    Route::middleware('auth:sanctum')->group(function () {
        // Logout route for logging out
        Route::post('logout', [LoginController::class, 'logout']);
        
        Route::apiResource('employees', ApiEmployeeController::class);
    });

    // Route for handling unauthorized access
    Route::fallback(function () {
        return response()->json(['error' => 'Unauthenticated. Please log in.'], 401);
    });
});