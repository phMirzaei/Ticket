<?php

namespace App\Http\Controllers\Web;
use App\DTOs\RequestPhoneNumberVerification;
use App\DTOs\VerifyPhoneNumber;
use App\Http\Controllers\Controller;
use App\Services\RequestPhoneNumberVerificationService;
use App\Services\VerifyPhoneNumberService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\View\View;

class AuthWebController extends Controller
{
    public function login(): View
    {
        return view('auth.login');
    }



    public function requestOtp(
        Request $request,
        RequestPhoneNumberVerificationService $service
    ) {
        $validated = $request->validate([
            'phone' => ['required', 'string'],
        ]);

        $phone = $validated['phone'];

        $code = $service->execute(
            new RequestPhoneNumberVerification($phone)
        );

        return view('auth.otp', [
            'phone' => $phone,
            'code' => $code,
        ]);
    }

    public function otp(): View
    {
        return view('auth.otp');
    }

    public function verifyOtp(
        Request $request,
        VerifyPhoneNumberService $service
    ): RedirectResponse {
        $request->validate([
            'phone' => ['required', 'string'],
            'code' => ['required', 'string'],
        ]);

        $user = $service->execute(
            new VerifyPhoneNumber(
                $request->input('code'),
                $request->input('phone')
            )
        );

        $token = auth('api')->login($user);

        cookie()->queue(
            'token',
            $token,
            60 * 24
        );

        if (! $user->name) {
            return redirect()
                ->route('profile.name');
        }

        return redirect()
            ->route('tickets.create');
    }

    public function name(): View
    {
        return view('auth.name');
    }

    public function updateName(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'min:2',
                'max:100',
            ],
        ]);

        $token = $request->cookie('token');

        if (! $token) {
            return redirect()
                ->route('auth.login')
                ->with('error', 'ابتدا وارد شوید.');
        }

        $user = auth('api')
            ->setToken($token)
            ->user();

        if (! $user) {
            return redirect()
                ->route('auth.login')
                ->with('error', 'توکن معتبر نیست.');
        }

        $user->update([
            'name' => $request->input('name'),
        ]);

        return redirect()
            ->route('dashboard');
    }

    public function dashboard(Request $request): View|RedirectResponse
    {
        $token = $request->cookie('token');

        if (! $token) {
            return redirect()
                ->route('auth.login');
        }

        $user = auth('api')
            ->setToken($token)
            ->user();

        if (! $user) {
            return redirect()
                ->route('auth.login');
        }

        return view('dashboard', [
            'user' => $user,
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        $token = $request->cookie('token');

        if ($token) {
            auth('api')
                ->setToken($token)
                ->logout();
        }

        cookie()->queue(
            cookie()->forget('token')
        );

        return redirect()
            ->route('auth.login');
    }
}
