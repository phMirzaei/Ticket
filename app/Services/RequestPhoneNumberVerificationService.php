<?php

namespace App\Services;

use App\DTOs\RequestPhoneNumberVerification;
use App\Jobs\SendNotification;
use App\Models\Otp;
use Illuminate\Support\Facades\Hash;

class RequestPhoneNumberVerificationService
{
    public function execute(
        RequestPhoneNumberVerification $requestPhoneNumberVerification
    ) {
        $phone = $requestPhoneNumberVerification->phone;

        $code = random_int(1000, 9999);

        Otp::updateOrCreate(
            ['phone' => $phone],
            [
                'code' => Hash::make($code),
            ]
        );

        return $code;

        // SendNotification::dispatch(
        //     $phone,
        //     "کد تایید {$code} میباشد."
        // );
    }
}
