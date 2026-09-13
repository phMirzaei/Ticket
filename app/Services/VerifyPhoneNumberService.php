<?php

namespace App\Services;

use App\DTOs\VerifyPhoneNumber;
use App\Exceptions\OtpAttemptsExceededException;
use App\Exceptions\OtpNotFoundException;
use App\Exceptions\WrongOtpException;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;

class VerifyPhoneNumberService
{
    public function execute(VerifyPhoneNumber $verifyPhoneNumber): User
    {
        $phone = $verifyPhoneNumber->phone;
        $code = $verifyPhoneNumber->code;

        $key = 'otp-verify:' . $phone;

        if (RateLimiter::tooManyAttempts($key, 3)) {
            throw new OtpAttemptsExceededException();
        }

        RateLimiter::hit($key, 600);

        $otp = Otp::where('phone', $phone)->first();

        if (! $otp) {
            throw new OtpNotFoundException;
        }

        if (! Hash::check($code, $otp->code)) {
            throw new WrongOtpException;
        }

        RateLimiter::clear($key);

        return DB::transaction(function () use ($otp): User {

            $user = User::firstOrCreate(
                ['phone' => $otp->phone],
                [
                    'role' => 'customer',
                ]
            );

            $otp->delete();

            return $user;
        });
    }}
