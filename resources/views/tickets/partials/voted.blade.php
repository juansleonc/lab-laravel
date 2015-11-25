@if( ! currentUser()->hasVoted($ticket))
    {!! Form::open(['route' => ['votes.submit', $ticket->id] , 'method' => 'POST']) !!}
    <button type="submit" class="btn btn-primary">
        <span class="glyphicon glyphicon-thumbs-up"></span> Votar
    </button>
    {!! Form::close() !!}
@else
    {!! Form::open(['route' => ['votes.destroy', $ticket->id], 'method' => 'DELETE']) !!}
    <button type="submit" class="btn btn-primary">
        <span class="glyphicon glyphicon-thumbs-up"></span> Quitar Voto
    </button>
    {!! Form::close() !!}
@endif