<?php

namespace App\Http\Controllers\Auth;

use App\DTOs\RequestPhoneNumberVerification;
use App\DTOs\VerifyPhoneNumber;
use App\Http\Controllers\Controller;
use App\Http\Requests\SendOtpRequest;
use App\Http\Requests\VerifyOtpRequest;
use App\Services\RequestPhoneNumberVerificationService;
use App\Services\VerifyPhoneNumberService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function requestOtp(
        SendOtpRequest $request,
        RequestPhoneNumberVerificationService $requestPhoneNumberVerificationService
    ): JsonResponse {
        $code = $requestPhoneNumberVerificationService->execute(
            new RequestPhoneNumberVerification(
                $request->validated('phone')
            )
        );

        return response()->json([
            'message' => 'کد با موفقیت ارسال شد.',
            'code' => $code,
        ]);
    }

    public function verifyOtp(
        VerifyOtpRequest $request,
        VerifyPhoneNumberService $verifyPhoneNumberService
    ): JsonResponse {
        $phone = $request->validated('phone');
        $code = $request->validated('code');

        $user = $verifyPhoneNumberService->execute(
            new VerifyPhoneNumber($code, $phone)
        );

        $token = auth('api')->login($user);

        return response()->json([
            'message' => 'ورود با موفقیت انجام شد.',
            'name' => $user->name,
            'token' => $token,
        ]);
    }

    public function me(): JsonResponse
    {
        return response()->json([
            'user' => auth('api')->user(),
        ]);
    }

    public function logout(): JsonResponse
    {
        auth('api')->logout();

        return response()->json([
            'message' => 'با موفقیت خارج شدید.',
        ]);
    }
    public function updateName(Request $request): JsonResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:100'],
        ]);

        $user = auth('api')->user();

        $user->update([
            'name' => $request->name,
        ]);

        return response()->json([
            'message' => 'نام با موفقیت ثبت شد.',
            'user' => $user,
        ]);
    }
}
