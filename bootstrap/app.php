<?php

use App\Exceptions\OtpNotFoundException;
use App\Exceptions\WrongOtpException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Exceptions\OtpAttemptsExceededException;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo(
            fn() => route('auth.login')
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (OtpAttemptsExceededException $e, Request $request) {
            return redirect()->route('auth.login')->withErrors([
                'phone' => 'تعداد تلاش‌های وارد کردن کد تمام شد. لطفاً دوباره درخواست OTP کنید.',
            ]);
        });
        $exceptions->render(function (WrongOtpException $e, Request $request) {
            return back()
                ->withInput()
                ->withErrors([
                    'code' => 'کد وارد شده اشتباه است.',
                ]);
        });
        $exceptions->render(function (OtpNotFoundException $e, Request $request) {
            return back()
                ->withInput()
                ->withErrors([
                    'code' => 'کد پیدا نشد.',
                ]);
        });
    })->create();
