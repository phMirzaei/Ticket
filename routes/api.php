<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\TicketWebController;

Route::post('/auth/send-otp', [AuthController::class, 'requestOtp']);
Route::post('/auth/verify-otp', [AuthController::class, 'verifyOtp']);

Route::middleware('auth:api')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::post('/profile/name', [AuthController::class, 'updateName']);
//        Route::get('/tickets/create', [TicketWebController::class, 'create'])
//            ->name('tickets.create');
//        Route::post('/tickets', [TicketWebController::class, 'store'])
//            ->name('tickets.store');

});
