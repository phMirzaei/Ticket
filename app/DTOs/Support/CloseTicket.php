<?php

namespace App\DTOs\Support;

final readonly class CloseTicket
{
    public function __construct(
        public int $ticketId,
    ) {}
}
