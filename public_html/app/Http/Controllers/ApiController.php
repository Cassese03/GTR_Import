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


class ApiController extends Controller {

    public function get_plc($access_token,Request $request){

        $plcs = DB::select('SELECT descrizione,tipologia,CAST(indirizzo_ip AS CHAR(50)) as indirizzo_ip,porta,token from plc where abilitato = 1 and id_utente IN (Select id from utenti  where access_token = "'.htmlentities($access_token).'")');
        echo json_encode($plcs);
    }

    public function set_plc_status($token,$status){

        $plc = DB::select('select * from plc where token = "'.htmlentities($token).'"');

        if(sizeof($plc) > 0) {

            DB::update('update plc set ultimo_check = NOW(), status = '.$status.' where id='.$plc[0]->id);
            DB::table('plc')->where('id',$plc[0]->id)->update(array('status' => $status));
        }
    }

    public function get_registri_modbus($token,Request $request){

        $registri_modbus = DB::select('SELECT id_plc,indirizzo,nome,tipo,lettura,scrittura,holding from modbus_configurazione where id_plc IN (select id from plc where token = "'.htmlentities($token).'")');
        echo json_encode($registri_modbus);
    }

    public function get_scritture_modbus($token,Request $request){

        $scritture_modbus = DB::select('SELECT s.id,s.id_plc,s.indirizzo,s.valore,c.tipo,c.nome from modbus_scritture s JOIN modbus_configurazione c ON s.indirizzo = c.indirizzo and s.id_plc = c.id_plc  where s.ricevuto_plc = 0 and c.scrittura = 1 and s.id_plc IN (select id from plc where token = "'.htmlentities($token).'")');
        echo json_encode($scritture_modbus);
    }

    public function set_scrittura_modbus($token,Request $request){

        $plc = DB::select('select * from plc where token = "'.htmlentities($token).'"');

        if(sizeof($plc) > 0) {
            $data = json_decode(file_get_contents('php://input'), true);
            DB::table('modbus_scritture')->where('id',$data['id'])->update(array('ricevuto_plc' => 1));
        }
    }

    public function set_lettura_modbus($token,Request $request){

        $plc = DB::select('select * from plc where token = "'.htmlentities($token).'"');

        if(sizeof($plc) > 0) {
            $data = json_decode(file_get_contents('php://input'), true);
            DB::table('modbus_letture')->insert($data);
        }
    }

    public function get_registri_s7($token,Request $request){

        $registri_s7= DB::select('SELECT id_plc,indirizzo,nome,tipo,db,lettura,scrittura from s7_configurazione where id_plc IN (select id from plc where token = "'.htmlentities($token).'")');
        echo json_encode($registri_s7);
    }

    public function get_scritture_s7($token,Request $request){

        $scritture_s7 = DB::select('SELECT s.id,s.id_plc,s.indirizzo,s.valore,c.db,c.tipo,c.nome from s7_scritture s JOIN s7_configurazione c ON s.indirizzo = c.indirizzo and s.id_plc = c.id_plc  where s.ricevuto_plc = 0 and c.scrittura = 1 and s.id_plc IN (select id from plc where token = "'.htmlentities($token).'")');
        echo json_encode($scritture_s7);
    }

    public function set_scrittura_s7($token,Request $request){

        $plc = DB::select('select * from plc where token = "'.htmlentities($token).'"');

        if(sizeof($plc) > 0) {
            $data = json_decode(file_get_contents('php://input'), true);
            DB::table('s7_scritture')->where('id',$data['id'])->update(array('ricevuto_plc' => 1));
        }
    }

    public function set_lettura_s7($token,Request $request){

        $plc = DB::select('select * from plc where token = "'.htmlentities($token).'"');

        if(sizeof($plc) > 0) {
            $plc = $plc[0];
            $data = json_decode(file_get_contents('php://input'), true);
            $data['indirizzo'] = floatval(str_replace(',','.',$data['indirizzo']));

            $id_lettura = DB::table('s7_letture')->insertGetId($data);

            // Aggiorna Num Pezzi Fase e chiudi se num pezzo >= pezzi pianificati
            $righe = DB::select('SELECT conf.indirizzo,o.id AS id_riga FROM fasi f
                JOIN odl_righe o ON o.id_fase = f.id AND o.id_plc = '.$plc->id.' AND o.completato = 0 AND f.protocollo = "S7"
                JOIN s7_configurazione conf ON conf.id = f.quantita_lettura_plc');

            foreach($righe as $r){
                if($data['indirizzo'] == $r->indirizzo){

                    echo 'Aggiorno Quantità di Fase';
                    DB::update('update odl_righe set qta_iniziale = '.$data['valore'].' where qta_iniziale = 0 and id = '.$r->id_riga);
                    DB::update('update odl_righe set qta_finale = '.$data['valore'].',qta_fatta = qta_finale - qta_iniziale where id = '.$r->id_riga);
                }
            }
        }


    }


    public function set_lettura_mtconnect($token,Request $request){

        $plc = DB::select('select * from plc where token = "'.htmlentities($token).'"');

        if(sizeof($plc) > 0) {
            $plc = $plc[0];
            $data = json_decode(file_get_contents('php://input'), true);
            $insert['id_plc'] = $plc->id;
            $insert['indirizzo'] = 1;
            $insert['valore'] = $data['valore'];
            $insert['num_pezzi'] = $data['num_pezzi'];
            $insert['timestamp'] = $data['timestamp'];
            DB::table('mtconnect_letture')->insert($insert);

            // Apri Fase se timestamp > timestamp ODL
            $righe = DB::select('SELECT a.descrizione AS programma,r.id_odl,r.id AS id_riga FROM articoli a
                JOIN odl o ON o.id_articolo = a.id and o.data <= "'.$data['timestamp'].'"
                JOIN odl_righe r ON r.id_odl = o.id AND r.inizio IS NULL and r.fine IS NULL and r.completato = 0 AND r.id_plc = '.$plc->id);

            foreach($righe as $r){
                if($data['valore'] == $r->programma){
                    DB::update('update odl_righe set inizio = "'.$data['timestamp'].'" where id = '.$r->id_riga);
                    DB::update('update odl set stato = 1 where id ='.$r->id_odl);
                }
            }

            // Aggiorna Num Pezzi Fase e chiudi se num pezzo >= pezzi pianificati
            $righe = DB::select('SELECT a.descrizione AS programma,r.id_odl,r.id AS id_riga FROM articoli a
                JOIN odl o ON o.id_articolo = a.id
                JOIN odl_righe r ON r.id_odl = o.id AND r.inizio IS NOT NULL and r.fine IS NULL and r.completato = 0 AND r.id_plc = '.$plc->id);

            foreach($righe as $r){
                if($data['valore'] == $r->programma){
                    DB::update('update odl_righe set qta_fatta = '.$data['num_pezzi'].' where id = '.$r->id_riga);
                    DB::update('update odl_righe set fine = NOW(),completato = 1 where qta_fatta >= qta and id = '.$r->id_riga);
                    ApiController::chiudi_odl($r->id_odl);
                }
            }

        }
    }


    public static function chiudi_odl($id_odl){
        $chiudi_odl = 1;
        $righe = DB::select('SELECT * from odl_righe where id_odl = '.$id_odl);
        foreach($righe as $r){
            if($r->completato == 0) $chiudi_odl = 0;
            break;
        }

        if($chiudi_odl) {
            DB::update('update odl set stato = 2,data_chiusura = NOW() where id ='.$id_odl);

            $odl = DB::select('SELECT * from odl where id = '.$id_odl);
            if(sizeof($odl) > 0){
                $odl = $odl[0];

                $dati['id_utente'] = $odl->id_utente;
                $dati['car'] = 1;
                $dati['id_articolo'] = $odl->id_articolo;
                $dati['qta'] = $odl->qta;
                $dati['causale'] = 'Carico Chiusura ODL '.$odl->numero;
                DB::table('mgmov')->insertGetId($dati);
            }

        }
    }

    public static function chudi_fase($id_riga){
        DB::update('update odl_righe set qta_fatta = qta,qta_finale = qta_iniziale + qta, fine = NOW(),completato = 1 where id='.$id_riga);
    }


    public function get_registri_opcua($token,Request $request){

        $registri_opcua = DB::select('SELECT id_plc,indirizzo,nome,tipo,lettura,scrittura from opcua_configurazione where id_plc IN (select id from plc where token = "'.htmlentities($token).'")');
        echo json_encode($registri_opcua);
    }

    public function get_scritture_opcua($token,Request $request){

        $scritture_modbus = DB::select('SELECT s.id,s.id_plc,s.indirizzo,s.valore,c.tipo,c.nome from opcua_scritture s JOIN opcua_configurazione c ON s.indirizzo = c.indirizzo and s.id_plc = c.id_plc where s.ricevuto_plc = 0 and c.scrittura = 1 and s.id_plc IN (select id from plc where token = "'.htmlentities($token).'")');
        echo json_encode($scritture_modbus);
    }

    public function set_scrittura_opcua($token){

        $plc = DB::select('select * from plc where token = "'.htmlentities($token).'"');

        if(sizeof($plc) > 0) {
            $data = json_decode(file_get_contents('php://input'), true);
            DB::table('opcua_scritture')->where('id',$data['id'])->update(array('ricevuto_plc' => 1));
        }
    }

    public function set_lettura_opcua($token){

        $plc = DB::select('select * from plc where token = "'.htmlentities($token).'"');

        if(sizeof($plc) > 0) {
            $data = json_decode(file_get_contents('php://input'), true);
            DB::table('opcua_letture')->insert($data);
        }
    }

}
