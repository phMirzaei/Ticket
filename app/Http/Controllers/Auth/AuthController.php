<?php

namespace App\Http\Controllers\Auth;

use App\DTOs\GetUserTickets;
use App\DTOs\RequestPhoneNumberVerification;
use App\DTOs\VerifyPhoneNumber;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SendOtpRequest;
use App\Http\Requests\Auth\UpdateNameRequest;
use App\Http\Requests\Auth\VerifyOtpRequest;
use App\Services\GetUserTicketsService;
use App\Services\RequestPhoneNumberVerificationService;
use App\Services\VerifyPhoneNumberService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function login(): View
    {
        return view('auth.login');
    }

    public function requestOtp(
        SendOtpRequest $request,
        RequestPhoneNumberVerificationService $service
    ): View {
        $validated = $request->validated();

        $phone = $validated['phone'];

        $code = $service->execute(
            new RequestPhoneNumberVerification($phone)
        );

        return view('auth.otp', [
            'phone' => $phone,
            'code' => $code,
        ]);
    }

    public function verifyOtp(
        VerifyOtpRequest $request,
        VerifyPhoneNumberService $service
    ): RedirectResponse {
        $validated = $request->validated();

        $user = $service->execute(
            new VerifyPhoneNumber(
                $validated['code'],
                $validated['phone']
            )
        );

        auth()->login($user);

        if (! $user->name) {
            return redirect()
                ->route('profile.name');
        }

        if ($user->role === 'support') {
            return redirect()
                ->route('support.dashboard');
        }
        if ($user->role === 'admin') {
            return redirect()
                ->route('admin.dashboard');
        }

        return redirect()
            ->route('dashboard');
    }

    public function name(): View
    {
        return view('auth.name');
    }

    public function updateName(
        UpdateNameRequest $request
    ): RedirectResponse {
        $validated = $request->validated();

        if (! auth()->check()) {
            return redirect()
                ->route('auth.login')
                ->with('error', 'ابتدا وارد شوید.');
        }

        $user = auth()->user();

        $user->update([
            'name' => $validated['name'],
        ]);
        if ($user->role === 'support') {
            return redirect()
                ->route('support.dashboard');
        }

        return redirect()
            ->route('dashboard');
    }

    public function dashboard(GetUserTicketsService $service): View|RedirectResponse
    {
        if (! auth()->check()) {
            return redirect()
                ->route('auth.login');
        }

        $user = auth()->user();
        $tickets = $service->execute(new GetUserTickets($user->id));

        return view('dashboard', [
            'user' => $user,
            'tickets' => $tickets,
        ]);
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();

        return redirect()
            ->route('auth.login');
    }
}
