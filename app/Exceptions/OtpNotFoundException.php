<?php

namespace App\Exceptions;

use Exception;

class OtpNotFoundException extends Exception
{
    public function render()
    {
        return response()->json([
            'message' => 'OTP not found',
        ]);
    }
}
