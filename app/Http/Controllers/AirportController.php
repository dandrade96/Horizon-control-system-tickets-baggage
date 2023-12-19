<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Traits\HttpResponses;

class AirportController extends Controller
{
    use HttpResponses;

    public function index(){
        $airports = Airport::all();

        return $this->response('Airport list', $airports);
    }
}
