<?php

namespace App\DTOs;

final readonly class CreateTicket
{
    public function __construct(
        public int $userId,
        public string $subject,
        public string $message,
    )
    {

}
}
