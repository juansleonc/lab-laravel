<?php

namespace TeachMe\Repositories;


use TeachMe\Entities\Ticket;
use TeachMe\Entities\TicketVote;
use TeachMe\Entities\User;

class VoteRepository extends BaseRepository
{
    public function getModel()
    {
        return new TicketVote();
    }

    public function vote(User $user, Ticket $ticket)
    {
        if($user->hasVoted($ticket)) return false;

        $user->voted()->attach($ticket);
        return true;
    }
    public function unvote(User $user, Ticket $ticket)
    {
        if(!$user->hasVoted($ticket)) return false;
        $user->voted()->detach($ticket);
        return true;
    }

}