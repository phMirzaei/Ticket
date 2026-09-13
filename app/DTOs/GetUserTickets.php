<?php

namespace App\DTOs;

final readonly class GetUserTickets
{
    public function __construct(
        public int $userId,
    )
    {

}
}
