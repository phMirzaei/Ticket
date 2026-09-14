<?php

namespace App\Http\Controllers;

use App\DTOs\CreateTicket;
use App\DTOs\GetUserTickets;
use App\Http\Requests\Tickets\StoreTicketRequest;
use App\Services\CreateTicketService;
use App\Services\GetUserTicketsService;
use Illuminate\Http\RedirectResponse;

class TicketWebController extends Controller
{
    public function index(GetUserTicketsService $service)
    {
        $tickets = $service->execute(new GetUserTickets(auth()->id()));

        return view('tickets.index', compact('tickets'));
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
}
