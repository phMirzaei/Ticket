<?php

namespace App\DTOs;

final readonly class AuthenticatedUser
{
    public function __construct(
        public string $token,
    ) {}
}
