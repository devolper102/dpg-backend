<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\GuestController;
use App\Http\Controllers\Api\RegisterController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('send-otp', 'sendOtp');
    Route::post('verify-otp', 'verifyOtp');
    Route::post('save-image', 'saveImage');
});
Route::controller(GuestController::class)->group(function(){
    Route::get('/get-services', 'getServices');
    // Route::post('send-otp', 'sendOtp');
    // Route::post('verify-otp', 'verifyOtp');
    // Route::post('save-image', 'saveImage');
});

Route::middleware('auth:sanctum')->group( function () {
    Route::controller(ApiController::class)->group(function(){
        Route::post('/update-location', 'updateLocation');
        Route::post('/update-fcm-token', 'updateFcmToken');
    });
});