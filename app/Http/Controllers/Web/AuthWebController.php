<?php

namespace App\Http\Controllers\Web;

use App\DTOs\RequestPhoneNumberVerification;
use App\DTOs\AuthenticatedUser;
use App\DTOs\UpdatedName;
use App\DTOs\VerifyPhoneNumber;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SendOtpRequest;
use App\Http\Requests\Auth\UpdateNameRequest;
use App\Http\Requests\Auth\VerifyOtpRequest;
use App\Services\GetAuthenticatedUserService;
use App\Services\RequestPhoneNumberVerificationService;
use App\Services\UpdatedNameService;
use App\Services\VerifyPhoneNumberService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthWebController extends Controller
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

    public function updateName(
        UpdateNameRequest $request,
        UpdatedNameService $service
    ): RedirectResponse {
        $validated = $request->validated();

        $token = $request->cookie('token');

        if (! $token) {
            return redirect()
                ->route('auth.login')
                ->with('error', 'ابتدا وارد شوید.');
        }

        $service->execute(
            new UpdatedName(
                $token,
                $validated['name']
            )
        );

        return redirect()
            ->route('dashboard');
    }

    public function dashboard(
        Request $request,
        GetAuthenticatedUserService $service
    ): View|RedirectResponse {
        $token = $request->cookie('token');

        if (! $token) {
            return redirect()
                ->route('auth.login');
        }

        $user = $service->execute(new AuthenticatedUser($token));

        return view('dashboard', [
            'user' => $user,
        ]);
    }

    public function logout(
        Request $request
    ): RedirectResponse {
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
