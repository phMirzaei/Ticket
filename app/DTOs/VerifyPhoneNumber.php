<?php

namespace App\DTOs;

final readonly class VerifyPhoneNumber
{
    public function __construct(
        public string $code,
        public string $phone,

    ) {}
}
