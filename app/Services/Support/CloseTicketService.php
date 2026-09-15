<?php

namespace App\Services\Support;

use App\DTOs\Support\CloseTicket;
use App\Models\Ticket;

class CloseTicketService
{
    public function execute(CloseTicket $data): void
    {
        $ticket = Ticket::findOrFail($data->ticketId);

        $ticket->update([
            'status' => 'closed',
        ]);
    }
}
