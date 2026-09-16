<?php

namespace App\Http\Controllers\Support;

use App\DTOs\Support\CloseTicket;
use App\DTOs\Support\StoreMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Support\StoreMessageRequest;
use App\Models\Ticket;
use App\Services\Support\CloseTicketService;
use App\Services\Support\StoreMessageService;
use Illuminate\Http\RedirectResponse;

class SupportTicketController extends Controller
{
    public function storeMessage(StoreMessageRequest $request, StoreMessageService $service, Ticket $ticket)
    {
        abort_if($ticket->status === 'closed', 403);
        $validated = $request->validated();
        $data = new StoreMessage(
            ticketId: $ticket->id,
            userId: auth()->id(),
            message: $validated['message'],
        );
        $service->execute($data);

        return back()->with('success', 'پاسخ شما ثبت شد.');

    }

    public function close(CloseTicketService $service, Ticket $ticket): RedirectResponse
    {
        $data = new CloseTicket(
            ticketId: $ticket->id
        );
        $service->execute($data);

        return back()->with('success', 'تیکت بسته شد.');
    }
}
