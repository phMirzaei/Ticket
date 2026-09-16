<?php

namespace App\DTOs;

final readonly class ReplyToTicket
{
    public function __construct(
        public int $ticketId,
        public int $userId,
        public string $message,
    ) {}
}
