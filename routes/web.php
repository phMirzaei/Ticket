<?php

use App\Http\Controllers\Web\AuthWebController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthWebController::class, 'login'])
    ->name('auth.login');

Route::post('/login', [AuthWebController::class, 'requestOtp'])
    ->name('auth.request-otp');

Route::get('/otp', [AuthWebController::class, 'otp'])
    ->name('auth.otp');

Route::post('/otp', [AuthWebController::class, 'verifyOtp'])
    ->name('auth.verify-otp');

Route::get('/complete-profile', [AuthWebController::class, 'name'])
    ->name('profile.name');

Route::post('/complete-profile', [AuthWebController::class, 'updateName'])
    ->name('profile.name.update');

Route::get('/dashboard', [AuthWebController::class, 'dashboard'])
    ->name('dashboard');

Route::post('/logout', [AuthWebController::class, 'logout'])
    ->name('auth.logout');
