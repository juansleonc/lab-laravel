<?php

namespace TeachMe\Repositories;

use TeachMe\Entities\Ticket;

class TicketRepository
{
    protected function selectTicketList()
    {
        return Ticket::selectRaw(
            'tickets.*,'
            . '( SELECT COUNT(*) FROM ticket_comments WHERE ticket_comments.ticket_id = tickets.id) AS num_comments , '
            . '( SELECT COUNT(*) FROM ticket_votes WHERE ticket_votes.ticket_id = tickets.id) AS num_votes'
        )->with('author');
    }

    public function paginateLatest(){
        return $this->selectTicketList()
        ->orderBy('created_at', 'DESC')
        ->paginate();
    }

    public function paginateOpen()
    {
        return $this->selectTicketList()
            ->where('status', 'open')
            ->orderBy('created_at', 'DESC')
            ->paginate();
    }

    public function paginateClose()
    {
        return $this->selectTicketList()
            ->where('status', 'closed')
            ->orderBy('created_at', 'DESC')
            ->paginate();
    }

    public function findOrFile($id)
    {
        return Ticket::with('author')->findOrFail($id);
    }

    public function popular()
    {
        Ticket::orderBy('created_at', 'DESC')->paginate();
    }


}