<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index () {
        return view('tickets');
    }

    public function getTickets() {
        return Ticket::whereUserId(auth()->id())->with('booking')->get();
    }

    public function getDetails (Request $request, Ticket $ticket){
        $ticket->load(['booking', 'user']);
        return $ticket;
    }

    public function markAsUsed(Request $request, Ticket $ticket) {
        return $ticket->update(['used' => 1, 'updated_by_id' => auth()->id()]);
    }
}
