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
}
