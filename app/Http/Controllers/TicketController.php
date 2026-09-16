<?php

namespace App\Http\Controllers;

use App\DTOs\CreateTicket;
use App\DTOs\GetUserTickets;
use App\DTOs\ReplyToTicket;
use App\Http\Requests\Auth\ReplyToTicketRequest;
use App\Http\Requests\Tickets\StoreTicketRequest;
use App\Models\Ticket;
use App\Services\CreateTicketService;
use App\Services\GetUserTicketsService;
use App\Services\ReplyToTicketService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TicketController extends Controller
{
    public function index(GetUserTicketsService $service)
    {
        $tickets = $service->execute(new GetUserTickets(auth()->id()));

        return view('tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket): View
    {
        abort_unless($ticket->user_id === auth()->id(), 403);

        $ticket->load('messages.user');

        return view('tickets.show', compact('ticket'));
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(StoreTicketRequest $request, CreateTicketService $service): RedirectResponse
    {
        $validated = $request->validated();
        $service->execute(
            new CreateTicket(
                auth()->id(),
                $validated['subject'],
                $validated['message'],
            )
        );

        return redirect()
            ->route('dashboard')
            ->with('success', 'تیکت شما ثبت شد!');
    }

    public function reply(
        ReplyToTicketRequest $request, Ticket $ticket, ReplyToTicketService $replyToTicketService): RedirectResponse
    {
        abort_unless($ticket->user_id === auth()->id(), 403);

        abort_if($ticket->status === 'closed', 403);

        $validated = $request->validated();

        $data = new ReplyToTicket(
            ticketId: $ticket->id,
            userId: auth()->id(),
            message: $validated['message'],
        );

        $replyToTicketService->execute($data);

        return back()->with('success', 'پاسخ شما ثبت شد.');
    }
}
