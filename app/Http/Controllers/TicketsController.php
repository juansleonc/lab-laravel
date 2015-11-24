<?php

namespace TeachMe\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use TeachMe\Entities\Ticket;

class TicketsController extends Controller
{
    public function latest()
    {
        $tickets = Ticket::orderBy('created_at', 'DESC')->paginate();

        return view('tickets.list', compact('tickets'));
    }
    public function popular()
    {
        $tickets = Ticket::orderBy('created_at', 'DESC')->paginate();

        return view('tickets.list', compact('tickets'));
    }
    public function open()
    {
        $tickets = Ticket::orderBy('created_at', 'DESC')->paginate();

        return view('tickets.list', compact('tickets'));
    }
    public function closed()
    {
        $tickets = Ticket::orderBy('created_at', 'DESC')->paginate();

        return view('tickets.list', compact('tickets'));
    }
    public function details($id, Guard $auth)
    {
        $ticket = Ticket::findOrFail($id);

        $user = $auth->user();

        return view('tickets/details', compact('ticket', 'user'));
    }
    public function create()
    {
      return view('tickets.create');
    }
    public function store(Request $request, Guard $auth)
    {
        $this->validate($request, [
            'title' => 'required|max:120'
        ]);

         $ticket = $auth->user()->tickets()->create([
            'title' => $request->get('title'),
            'status' => 'open',
        ]);
        /*
        $ticket = new Ticket();
        $ticket->title = $request->get('title');
        $ticket->status = 'open';
        $ticket->user_id = $auth->user()->id;
        $ticket->save();
        */
        return Redirect::route('tickets.details', $ticket->id);
    }
}
