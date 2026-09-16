<?php

namespace App\Services;

use App\DTOs\ReplyToTicket;
use App\Models\Ticket;

class ReplyToTicketService
{
    public function execute(ReplyToTicket $data): void
    {
        $ticket = Ticket::findOrFail($data->ticketId);

        $ticket->messages()->create([
            'user_id' => $data->userId,
            'message' => $data->message,
        ]);

        $ticket->update([
            'status' => 'open',
        ]);
    }
}
