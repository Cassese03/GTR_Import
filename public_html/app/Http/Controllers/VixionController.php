<?php

namespace App\Http\Controllers;

use App\Imports\ArticoliImport;
use App\Imports\BOMImport;
use App\Imports\MagazzinoImport;
use App\Imports\BPImport;
use App\Imports\StoricoImport;
use App\Imports\VenditeImport;
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


class VixionController extends Controller {

    public static function auth($username,$password,$id_macchina,$plc){

        $url = 'https://api.vixion360.com:443/api/open/authenticate';
        $data = array("username" => $username,"password" => $password);

        $postdata = json_encode($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $result = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($result,true);

        VixionController::executedwork($result['token'],$id_macchina,$plc);

    }


    public static function executedwork($token,$id_macchina,$plc){



        $url = 'https://api.vixion360.com:443/api/open/analytics/executedwork/machine/'.$id_macchina.'?date='.date('Ymd').'&frequency=day';

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Accept: application/json",
            "x-access-token: ".$token
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);

        curl_close($curl);

        $result = json_decode($resp,true);

        if(isset($result['data']['programs'])) {
            foreach ($result['data']['programs'] as $r) {
                $name = $r['data']['name'];
                $duration = $r['data']['duration'];
                $start = $r['data']['start'];
                $start = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $start)));

                DB::insert('INSERT IGNORE INTO vixion_letture (id_plc,name,duration,start) VALUES (' . $plc->id . ',"' . $name . '","' . $duration . '","' . $start . '")');
            }
        }

        $minuti_inattivo = DB::select('SELECT TIMESTAMPDIFF(MINUTE,(SELECT start FROM vixion_letture ORDER BY start DESC LIMIT 1 ),NOW()) AS minuti_inattivo')[0]->minuti_inattivo;
        if ($minuti_inattivo < 120) {
            DB::update('update plc set ultimo_check = NOW(), status = 1 where id=' . $plc->id);
        } else {
            DB::update('update plc set ultimo_check = NOW(), status = 0 where id=' . $plc->id);
        }
    }


    public function sync($token){

        if($token == 'lkasjdlkaslasjkldjsakldasj') {
            $plc = DB::select('SELECT * from plc where tipologia = 7 and abilitato = 1');
            foreach ($plc as $p) {
                $variabili = json_decode($p->note);
                VixionController::auth($variabili->username, $variabili->password, $variabili->id_macchina, $p);
            }
        }
    }
}
