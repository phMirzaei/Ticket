<?php

namespace App\DTOs\Support;

final readonly class StoreMessage
{
    public function __construct(
        public int $userId,
        public int $ticketId,
        public string $message,
    ) {}
}
