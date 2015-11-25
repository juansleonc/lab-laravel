<?php

namespace TeachMe\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use TeachMe\Entities\Ticket;
use TeachMe\Entities\TicketComment;
use TeachMe\Http\Requests;
use TeachMe\Http\Controllers\Controller;
use TeachMe\Repositories\CommentsRepositories;
use TeachMe\Repositories\TicketRepository;

class CommentsController extends Controller
{
    private $commentsRepositories;
    private $ticketRepository;

    public function __construct(
        TicketRepository $ticketRepository,
        CommentsRepositories $commentsRepositories
    )
    {

        $this->commentsRepositories = $commentsRepositories;
        $this->ticketRepository = $ticketRepository;
    }
    public function submit($id, Request $request, Guard $auth)
    {
        $this->validate($request, [
           'comment' => 'required|max:250',
            'link' => 'url'
        ]);
        $ticket = $this->ticketRepository->findOrFail($id);
        $this->commentsRepositories->create(
            $ticket,
            currentUser(),
            $request->get('comment'),
            $request->get('link')
        );


        session()->flash('success', 'Tu comentario fue guardado satiscatoriamente ');
        return redirect()->back();
    }
}
