<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\View\View;

class SupportController extends Controller
{
    public function dashboard(): View
    {
        $allTickets = Ticket::all();
        $latestTickets = Ticket::latest()->take(5)->get();

        return view('support.dashboard', compact('allTickets', 'latestTickets'));

    }

    public function index(): View
    {
        $tickets = Ticket::all();

        return view('support.tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket): View
    {
        $ticket->load('messages.user');

        return view('support.tickets.show', compact('ticket'));
    }
}
