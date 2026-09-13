<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TicketWebController extends Controller
{
    public function index()
    {
        $tickets=Ticket::where('user_id',auth()->id())->latest()->get();
        return view('tickets.index',compact('tickets'));
    }
    public function create()
    {
       return view('tickets.create');
    }

    public function store(Request $request):redirectResponse
    {
$validated = $request->validate([
    'subject' => ['required', 'string', 'max:255'],
    'message' => ['required', 'string'],
]);
$request->user()->tickets()->create([
    'subject' => $validated['subject'],
    'message' => $validated['message'],
    'status'=>'open'
]);
return redirect()->route('dashboard')->with('success', 'تیکت شما ثبت شد!');
    }
}
