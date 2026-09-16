<?php

namespace App\DTOs;

final readonly class UpdatedName
{
    public function __construct(
        public string $token,
        public string $name,
    ) {}

}
