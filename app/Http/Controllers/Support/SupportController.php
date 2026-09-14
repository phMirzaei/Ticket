<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\View\View;

class SupportController extends Controller
{
    public function dashboard(): View
    {
        $tickets = Ticket::with('user')
            ->latest()
            ->get();

        return view('support.dashboard', compact('tickets'));

    }

    public function show(Ticket $ticket): View
    {
        $ticket->load('messages.user');

        return view('support.tickets.show', compact('ticket'));
    }
}
