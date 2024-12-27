<?php

namespace App\Http\Controllers\Test;
use App\Http\Controllers\Controller;
use App\Models\Agente;

class TestController extends Controller {

    function get() {
        return response()->json(Agente::all(), 200, [], JSON_PRETTY_PRINT);
    }

}