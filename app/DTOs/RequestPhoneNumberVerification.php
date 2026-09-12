<?php

namespace App\DTOs;

final readonly class RequestPhoneNumberVerification
{
    public function __construct(
        public string $phone,
    ) {}
}
