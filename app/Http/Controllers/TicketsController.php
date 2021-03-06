<?php

namespace TeachMe\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use TeachMe\Entities\Ticket;
use TeachMe\Repositories\TicketRepository;

class TicketsController extends Controller
{
    /**
     * @var TicketRepository
     */
    private $ticketRepository;

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    public function latest()
    {
        $tickets = $this->ticketRepository->paginateLatest();

        return view('tickets.list', compact('tickets'));
    }
    public function open()
    {
        $tickets = $this->ticketRepository->paginateOpen();

        return view('tickets.list', compact('tickets'));
    }
    public function closed()
    {
        $tickets = $this->ticketRepository->paginateClose();

        return view('tickets.list', compact('tickets'));
    }
    public function details($id, Guard $auth)
    {
        $ticket = $this->ticketRepository->findOrFail($id);
        $user = $auth->user();

        return view('tickets/details', compact('ticket', 'user'));
    }
    public function popular()
    {
        $tickets = $this->ticketRepository->popular();

        return view('tickets.list', compact('tickets'));
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

        $ticket = $this->ticketRepository->openNew(currentUser(), $request->get('title'));

        return Redirect::route('tickets.details', $ticket->id);
    }
}
