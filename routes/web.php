<?php

use App\Http\Controllers\TicketWebController;
use App\Http\Controllers\Web\AuthWebController;
use App\Http\Controllers\Support\SupportController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthWebController::class, 'login'])
    ->name('auth.login');

Route::post('/login', [AuthWebController::class, 'requestOtp'])
    ->middleware('throttle:6,1')
    ->name('auth.request-otp');

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

Route::middleware('auth')->group(function () {
    Route::get('/tickets/create', [TicketWebController::class, 'create'])
        ->name('tickets.create');

    Route::post('/tickets', [TicketWebController::class, 'store'])
        ->name('tickets.store');

    Route::get('/tickets', [TicketWebController::class, 'index'])
        ->name('tickets.index');
});

Route::middleware(['auth', 'support'])->group(function () {
    Route::get('/support/dashboard', [SupportController::class, 'dashboard'])
        ->name('support.dashboard');

    Route::get('/support/tickets/{ticket}', [SupportController::class, 'show'])
        ->name('support.tickets.show');
});
