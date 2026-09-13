<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
class TicketWebController extends Controller
{
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
