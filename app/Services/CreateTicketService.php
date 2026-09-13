<?php

namespace App\Services;

use App\DTOs\CreateTicket;
use App\Models\Ticket;

class CreateTicketService
{
    public function execute(CreateTicket $createTicket)
    {
        return Ticket::create([
            'user_id' => $createTicket->userId,
            'subject' => $createTicket->subject,
            'message' => $createTicket->message,
            'status' => 'open',
        ]);
}
}
