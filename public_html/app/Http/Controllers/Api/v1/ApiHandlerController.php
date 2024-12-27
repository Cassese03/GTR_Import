<?php
namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;

interface ApiHandlerController
{

    public function getIdDitta();
    public function getAR(Request $request);

}