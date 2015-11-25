<?php

namespace TeachMe\Repositories;

use TeachMe\Entities\Ticket;

class TicketRepository extends BaseRepository
{
    public  function getModel()
    {
        return new Ticket();
    }

    protected function selectTicketList()
    {
        return $this->newQuery()->selectRaw(
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



    public function popular()
    {
        $this->newQuery()->orderBy('created_at', 'DESC')->paginate();
    }

    public function openNew($user, $title)
    {
        /*
        $ticket = $auth->user()->tickets()->create([
            'title' => $request->get('title'),
            'status' => 'open',
        ]);

        $ticket = new Ticket();
        $ticket->title = $request->get('title');
        $ticket->status = 'open';
        $ticket->user_id = $auth->user()->id;
        $ticket->save();
        */
        return $user->tickets()->create([
            'title' => $title,
            'status' => 'open',
        ]);
    }


}