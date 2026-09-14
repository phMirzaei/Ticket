<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Support\SupportController;
use App\Http\Controllers\Support\SupportTicketController;
use App\Http\Controllers\TicketWebController;
use App\Http\Controllers\Web\AuthWebController;
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
    Route::get('/tickets/{ticket}', [TicketWebController::class, 'show'])
        ->name('tickets.show');
    Route::post('/tickets/{ticket}/reply', [TicketWebController::class, 'reply'])
        ->name('tickets.reply');
});

Route::middleware(['auth', 'support'])->group(function () {
    Route::get('/support/dashboard', [SupportController::class, 'dashboard'])
        ->name('support.dashboard');
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
