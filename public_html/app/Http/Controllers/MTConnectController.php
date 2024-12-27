<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PHPMailer\PHPMailer\PHPMailer;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TariffeImport;


class MTConnectController extends Controller
{

    public function sync($token){


        $plc = DB::select('SELECT * from plc where tipologia = 10 and token = "'.$token.'"');
        foreach ($plc as $p) {


            $path = 'mtconnect/'.$token.".xml";
            $xmlfile = file_get_contents($path);
            $new = simplexml_load_string($xmlfile);

            print_r($new->Streams);
        }

    }
}

