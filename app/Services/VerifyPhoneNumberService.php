<?php

namespace App\Services;

use App\DTOs\VerifyPhoneNumber;
use App\Exceptions\OtpNotFoundException;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class VerifyPhoneNumberService
{
    public function execute(VerifyPhoneNumber $verifyPhoneNumber): User
    {
        $phone = $verifyPhoneNumber->phone;
        $code = $verifyPhoneNumber->code;

        $otp = Otp::where('phone', $phone)->first();

        if (! $otp) {
            throw new OtpNotFoundException;
        }

        if (! Hash::check($code, $otp->code)) {
            throw new \DomainException('کد وارد شده اشتباه است.');
        }

        return DB::transaction(function () use ($otp): User {

            $user = User::firstOrCreate(
                ['phone' => $otp->phone],
                [
                    'name' => 'کاربر',
                    'role' => 'customer',
                ]
            );

            return $user;
        });
    }
}
