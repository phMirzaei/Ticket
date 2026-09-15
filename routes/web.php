<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Support\SupportController;
use App\Http\Controllers\Support\SupportTicketController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'login'])
    ->name('auth.login');

Route::post('/login', [AuthController::class, 'requestOtp'])
    ->middleware('throttle:6,1')
    ->name('auth.request-otp');

Route::post('/otp', [AuthController::class, 'verifyOtp'])
    ->name('auth.verify-otp');

Route::get('/complete-profile', [AuthController::class, 'name'])
    ->name('profile.name');

Route::post('/complete-profile', [AuthController::class, 'updateName'])
    ->name('profile.name.update');

Route::get('/dashboard', [AuthController::class, 'dashboard'])
    ->name('dashboard');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('auth.logout');

Route::middleware('auth')->group(function () {
    Route::get('/tickets/create', [TicketController::class, 'create'])
        ->name('tickets.create');

    Route::post('/tickets', [TicketController::class, 'store'])
        ->name('tickets.store');

    Route::get('/tickets', [TicketController::class, 'index'])
        ->name('tickets.index');
    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])
        ->name('tickets.show');
    Route::post('/tickets/{ticket}/reply', [TicketController::class, 'reply'])
        ->name('tickets.reply');
});

Route::middleware(['auth', 'support'])->group(function () {
    Route::get('/support/dashboard', [SupportController::class, 'dashboard'])
        ->name('support.dashboard');
    Route::get('/support/tickets', [SupportController::class, 'index'])
        ->name('support.tickets.index');
    Route::get('/support/users', [SupportController::class, 'users'])
        ->name('support.users');
    Route::get('/support/tickets/{ticket}', [SupportController::class, 'show'])
        ->name('support.tickets.show');
    Route::post('/support/tickets/{ticket}/messages', [SupportTicketController::class, 'storeMessage'])
        ->name('support.tickets.messages.store');
    Route::post('/support/tickets/{ticket}/close', [SupportTicketController::class, 'close'])
        ->name('support.tickets.close')
        ->middleware('support');
});
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/supports', [AdminController::class, 'showSupports'])
        ->name('admin.supports');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');
    Route::get('/add/support/{user}', [AdminController::class, 'addSupportForm'])
        ->name('admin.add');
    Route::post('/add/support/{user}', [AdminController::class, 'addSupport'])
        ->name('admin.add.store');

});
