<?php

namespace TeachMe\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use TeachMe\Entities\Ticket;
use TeachMe\Entities\TicketComment;
use TeachMe\Http\Requests;
use TeachMe\Http\Controllers\Controller;

class CommentsController extends Controller
{
    public function submit($id, Request $request, Guard $auth)
    {
        $this->validate($request, [
           'comment' => 'required|max:250',
            'link' => 'url'
        ]);

        $comment = new TicketComment($request->all());
        $comment->user_id = $auth->id();

        $ticket = Ticket::findOrFail($id);
        $ticket->comments()->save($comment);
        session()->flash('success', 'Tu comentario fue guardado satiscatoriamente ');
        return redirect()->back();
    }
}
