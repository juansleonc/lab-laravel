<?php

namespace TeachMe\Http\Controllers;

use Illuminate\Http\Request;

use TeachMe\Http\Requests;
use TeachMe\Http\Controllers\Controller;

class VotesController extends Controller
{
    public function submit($id)
    {
        dd('Votando por el ticket ' . $id);
    }
    public function destroy($id)
    {
        dd('Quitanto el voto por el ticket ' . $id);
    }
}
