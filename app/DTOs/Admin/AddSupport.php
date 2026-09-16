<?php

namespace App\DTOs\Admin;

final readonly class AddSupport
{
    public function __construct(
        public int $userId,
    ) {}
}
