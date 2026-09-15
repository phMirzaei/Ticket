<?php

namespace App\Services;

use App\DTOs\GetUserTickets;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Collection;

class GetUserTicketsService
{
    public function execute(GetUserTickets $getUserTickets): Collection
    {
        return Ticket::where('user_id', $getUserTickets->userId)
            ->latest()
            ->get();
    }
}
