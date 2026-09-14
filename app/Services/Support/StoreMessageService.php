<?php

namespace App\Services\Support;

use App\DTOs\Support\StoreMessage;
use App\Models\Ticket;

class StoreMessageService
{
    public function execute(StoreMessage $message)
    {
        $ticket = Ticket::findOrFail($message->ticketId);
        $ticket->messages()->create([
            'user_id' => $message->userId,
            'message' => $message->message,
        ]);
        $ticket->update([
            'status' => 'answered',
        ]);
    }
}
