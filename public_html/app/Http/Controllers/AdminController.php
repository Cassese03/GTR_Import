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


class AdminController extends Controller
{

    public function insert_json(Request $request)
    {

        $dati = $request->all();

        if (isset($dati['file_json'])) {

            $target_dir = "uploads/";
            try {
                $target_file = $target_dir . basename($_FILES["file_json"]["name"]);
            } catch (\Exception $e) {

            }
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            $target_file = $target_dir . 'json_' . rand() . '.' . $imageFileType;

            if (isset($_POST["submit"])) {
                $uploadOk = 1;
            }

            if (file_exists($target_file)) {
                //  echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            if ($_FILES["file_json"]["size"] > 500000) {
                //  echo "file_json";
                $uploadOk = 0;
            }

            if ($imageFileType != "json") {
                $uploadOk = 0;

                return Redirect::to('/admin/insert_json?errore=File non Json');
            }

            if ($uploadOk == 0) {
                // echo "Sorry, your file was not uploaded.";
            }

            if ($uploadOk == 0) {
                return "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($_FILES["file_json"]["tmp_name"], $target_file)) {
                    echo $this->try_json(str_replace('uploads/', '', $target_file));
                    //echo "The file ". htmlspecialchars( basename( $_FILES["foto_imballaggio"]["name"])). " has been uploaded.";
                } else {
                    return "Sorry, your file was not uploaded.";
                    // echo "Sorry, there was an error uploading your file.";
                }
            }
        }

        return View::make('insert_json');
    }

    public function try_json2($link)
    {
        $myfile = fopen('uploads/' . $link, "r") or die("Unable to open file!");
        $dati = fread($myfile, filesize('uploads/' . $link));
        fclose($myfile);
        print_r($dati);

    }
    public function insert_xquery($id_ditta,Request $request){

        $json = file_get_contents('php://input');
        $dati = json_decode($json, true);
        $query = $dati['query'];
        $id_dotes = $dati['id_dotes'];
        $id_dotes_ovc = $dati['id_dotes_ovc'];
        DB::select('INSERT INTO xquery (id_ditta,query,id_dotes,id_dotes_OVC) VALUES ('.$id_ditta.',"' . $query . '","'.$id_dotes.'","'.$id_dotes_ovc.'")');

    }
    public function try_json($link)
    {

        $myfile = fopen('uploads/' . $link, "r") or die("Unable to open file!");
        $dati = fread($myfile, filesize('uploads/' . $link));
        fclose($myfile);

        $dati = json_decode($dati, true);

        if (is_array($dati)) {
// NON INSERIRE ALTRI SPAZI SENNO SI SUPERA IL MAX VARCHAR
            $query = 'DECLARE @Iddorig nvarchar(max);';
            $nostroriford = $dati['verkoopordernummer'];
            $step1 = $dati['vervoerder'];
            foreach ($step1 as $c) {
                $prodotto = $c['lading'];
                foreach ($prodotto as $p) {
                    $consegna = $p['laaddatum'];
                    $consegna = str_replace('-00.00.00','',$consegna);
                    $todoc = $p['laadadres'];
                    foreach ($todoc as $d) {
                        foreach ($d['losadres'] as $prod) {
                            foreach ($prod['product'] as $p) {
                                foreach ($p['certificeringsinstantie'] as $l) {
                                    $lotto = $l["nummer"];
                                }
                                $cd_aliquota = '(SELECT TOP 1 Cd_Aliquota from dorig where id_dotes IN(SELECT top 1 Id_DoTes from DOTes WHERE Cd_Do = \'OF1\' and REPLACE(NumeroDoc,\' \',\'\') = \'' . intval(str_replace('PINT','',$p['bestelopdracht'])) . '\' order by id_dotes desc ))';
                                $cd_cgconto  = '(SELECT TOP 1 Cd_cgconto from dorig where id_dotes IN(SELECT top 1 Id_DoTes from DOTes WHERE Cd_Do = \'OF1\' and REPLACE(NumeroDoc,\' \',\'\') = \'' . intval(str_replace('PINT','',$p['bestelopdracht'])) . '\' order by id_dotes desc ))';
                                $linkcart    = '(SELECT TOP 1 linkcart from dorig where id_dotes IN(SELECT top 1 Id_DoTes from DOTes WHERE Cd_Do = \'OF1\' and REPLACE(NumeroDoc,\' \',\'\') = \'' . intval(str_replace('PINT','',$p['bestelopdracht'])) . '\' order by id_dotes desc ))';
                                $prezzo    = '(SELECT IIF((SELECT TOP 1 prezzounitariov from dorig where cd_ar = (SELECT top 1 Cd_AR from ar where xCd_xVarieta=\'' . $p['ras'] . '\' and  xCd_xCalibro=\'' . str_replace('-', '/', $p['maat']) . '\') and id_dotes IN(SELECT top 1 Id_DoTes from DOTes WHERE Cd_Do = \'OF1\' and REPLACE(NumeroDoc,\' \',\'\') = \'' . intval(str_replace('PINT','',$p['bestelopdracht'])) . '\' order by id_dotes desc )) is not null,(SELECT TOP 1 prezzounitariov from dorig where cd_ar = (SELECT top 1 Cd_AR from ar where xCd_xVarieta=\'' . $p['ras'] . '\' and  xCd_xCalibro=\'' . str_replace('-', '/', $p['maat']) . '\') and id_dotes IN(SELECT top 1 Id_DoTes from DOTes WHERE Cd_Do = \'OF1\' and REPLACE(NumeroDoc,\' \',\'\') = \'' . intval(str_replace('PINT','',$p['bestelopdracht'])) . '\' order by id_dotes desc )),0.00))';
                                $query .= 'IF NOT EXISTS (SELECT * FROM ARLotto WHERE Cd_Ar IN(SELECT top 1 Cd_AR from ar where xCd_xVarieta=\'' . $p['ras'] . '\' and  xCd_xCalibro=\'' . str_replace('-', '/', $p['maat']) . '\') and Cd_ARLotto=\'' . $lotto . '\') INSERT INTO ARLotto (Cd_Ar,cd_arlotto) values ((SELECT top 1 Cd_AR from ar where xCd_xVarieta=\'' . $p['ras'] . '\' and  xCd_xCalibro=\'' . str_replace('-', '/', $p['maat']) . '\'),\'' . $lotto . '\');';
                                $query .= 'UPDATE DOTES SET xriford = \''. $nostroriford .' '.$p['bestelopdracht'].'\', DataConsegna = \''.$consegna.'\' where id_dotes IN(SELECT top 1 Id_DoTes from DOTes WHERE Cd_Do=\'OF1\' and REPLACE(NumeroDoc,\' \',\'\')=\'' . intval(str_replace('PINT','',$p['bestelopdracht'])) . '\' order by id_dotes desc ) ';
                                $query .= 'INSERT INTO DORIG(PrezzoUnitarioV,xRigAgg,xconfezione,xcolli,cd_ar,qta,cd_arlotto,Id_DOTes,Cd_MG_P,Cd_CGConto,Cd_Aliquota,linkcart) values ('.$prezzo.',\''.$d['naam'] . ' ' . $d['adres'] . ', ' . $d['postcode'] . ' ' . $d['woonplaats'] . ' ' . $d['land'] . '  ' . $d['telefoonnummer'] . ' (' . $d['naam'] . ')\' ,' . $p['kg_productnetto_teverladen']/$p['emballage_verpakking_aantal'] . ',' . $p['emballage_verpakking_aantal'] . ',(SELECT top 1 Cd_AR from ar where xCd_xVarieta=\'' . $p['ras'] . '\' and  xCd_xCalibro=\'' . str_replace('-', '/', $p['maat']) . '\'),' . $p['kg_productnetto_teverladen'] . ',\'' . $lotto . '\',(SELECT top 1 Id_DoTes from DOTes WHERE Cd_Do=\'OF1\' and REPLACE(NumeroDoc,\' \',\'\')=\'' . intval(str_replace('PINT','',$p['bestelopdracht'])) . '\' order by id_dotes desc ),(SELECT TOP 1 Cd_MG_P FROM DORIG WHERE Cd_DO=(SELECT top 1 Cd_Do from DOTes WHERE Cd_Do=\'OF1\' and REPLACE(NumeroDoc,\' \',\'\')=\'' . intval(str_replace('PINT','',$p['bestelopdracht'])) . '\'  ORDER BY Id_DOTes DESC )),'.$cd_cgconto.','.$cd_aliquota.','.$linkcart.');';
                                //$query .= 'INSERT INTO DORIG(PrezzoUnitarioV,xRigAgg,xconfezione,xcolli,cd_ar,qta,cd_arlotto,Id_DOTes,Cd_MG_P,Cd_CGConto,Cd_Aliquota,linkcart) values ('.$prezzo.',\''.$d['naam'] . ' ' . $d['adres'] . ', ' . $d['postcode'] . ' ' . $d['woonplaats'] . ' ' . $d['land'] . '  ' . $d['telefoonnummer'] . ' (' . $d['naam'] . ')\' ,' . $p['kg_productnetto_teverladen']/$p['emballage_verpakking_aantal'] . ',' . $p['emballage_verpakking_aantal'] . ',(SELECT top 1 Cd_AR from ar where xCd_xVarieta=\'' . $p['ras'] . '\' and  xCd_xCalibro=\'' . str_replace('-', '/', $p['maat']) . '\'),' . $p['kg_productnetto_teverladen'] . ',\'' . $lotto . '\',(SELECT top 1 Id_DoTes from DOTes WHERE Cd_Do=\'OF1\' and REPLACE(NumeroDoc,\' \',\'\')=\'' . intval(str_replace('PINT','',$p['bestelopdracht'])) . '\' order by id_dotes desc ),(SELECT TOP 1 Cd_MG_P FROM DORIG WHERE Cd_DO=(SELECT top 1 Cd_Do from DOTes WHERE Cd_Do=\'OF1\' and REPLACE(NumeroDoc,\' \',\'\')=\'' . intval(str_replace('PINT','',$p['bestelopdracht'])) . '\'  ORDER BY Id_DOTes DESC )),'.$cd_cgconto.','.$cd_aliquota.','.$linkcart.');';
                                $query .= 'set @Iddorig=(SELECT TOP 1 Id_dorig from dorig order by id_dorig desc );';
                                //$cd_aliquota='(SELECT TOP 1 Cd_Aliquota from dorig where id_dotes IN(SELECT TOP 1 id_dotes from dorig where linkcf IN(SELECT id_dorig from dorig where id_dotes IN(SELECT TOP 1 Id_DoTes from DOTes where Cd_Do=\'OF1\' and REPLACE(NumeroDoc,\' \',\'\')=\'' . intval(str_replace('PINT','',$p['bestelopdracht'])) . '\'  ORDER BY Id_DOTes DESC))))';
                                $cd_aliquota = '4';
                                $cd_cgconto ='(SELECT TOP 1 Cd_cgconto from dorig where id_dotes IN(SELECT TOP 1 id_dotes from dorig where linkcf IN(SELECT id_dorig from dorig where id_dotes IN(SELECT TOP 1 Id_DoTes from DOTes where Cd_Do=\'OF1\' and REPLACE(NumeroDoc,\' \',\'\')=\'' . intval(str_replace('PINT','',$p['bestelopdracht'])) . '\'  ORDER BY Id_DOTes DESC))))';
                                $linkcart   ='(SELECT TOP 1 linkcart from dorig where id_dotes IN(SELECT TOP 1 id_dotes from dorig where linkcf IN(SELECT id_dorig from dorig where id_dotes IN(SELECT TOP 1 Id_DoTes from DOTes where Cd_Do=\'OF1\' and REPLACE(NumeroDoc,\' \',\'\')=\'' . intval(str_replace('PINT','',$p['bestelopdracht'])) . '\'  ORDER BY Id_DOTes DESC))))';
                                $prezzo   =  '(SELECT IIF((SELECT TOP 1 prezzounitariov from dorig where cd_ar =(SELECT top 1 Cd_AR from ar where xCd_xVarieta=\'' . $p['ras'] . '\' and  xCd_xCalibro=\'' . str_replace('-', '/', $p['maat']) . '\') and  id_dotes IN(SELECT TOP 1 id_dotes from dorig where linkcf IN(SELECT id_dorig from dorig where id_dotes IN(SELECT TOP 1 Id_DoTes from DOTes where Cd_Do=\'OF1\' and REPLACE(NumeroDoc,\' \',\'\')=\'' . intval(str_replace('PINT','',$p['bestelopdracht'])) . '\'  ORDER BY Id_DOTes DESC)))) IS NOT NULL ,(SELECT TOP 1 prezzounitariov from dorig where cd_ar =(SELECT top 1 Cd_AR from ar where xCd_xVarieta=\'' . $p['ras'] . '\' and  xCd_xCalibro=\'' . str_replace('-', '/', $p['maat']) . '\') and  id_dotes IN(SELECT TOP 1 id_dotes from dorig where linkcf IN(SELECT id_dorig from dorig where id_dotes IN(SELECT TOP 1 Id_DoTes from DOTes where Cd_Do=\'OF1\' and REPLACE(NumeroDoc,\' \',\'\')=\'' . intval(str_replace('PINT','',$p['bestelopdracht'])) . '\'  ORDER BY Id_DOTes DESC)))),0.00))';
                                $query .= 'UPDATE DOTES SET xriford = \''.  $nostroriford .' '.$p['bestelopdracht'].'\', DataConsegna = \''.$consegna.'\' where Id_DOTes=(SELECT TOP 1 id_dotes from dorig where linkcf IN(SELECT id_dorig from dorig where id_dotes IN(SELECT TOP 1 Id_DoTes from DOTes where Cd_Do=\'OF1\' and REPLACE(NumeroDoc,\' \',\'\')=\'' . intval(str_replace('PINT','',$p['bestelopdracht'])) . '\' order  by id_dotes desc ))); ';
                                $query .= 'INSERT INTO DORIG(PrezzoUnitarioV,xRigAgg,xconfezione,xcolli,cd_ar,qta,cd_arlotto,Id_DOTes,Cd_MG_P,linkcf,Cd_CGConto,Cd_Aliquota,linkcart) values ('.$prezzo.',\''.$d['naam'] . ' ' . $d['adres'] . ', ' . $d['postcode'] . ' ' . $d['woonplaats'] . ' ' . $d['land'] . '  ' . $d['telefoonnummer'] . ' (' . $d['naam'] . ')\' ,' . $p['kg_productnetto_teverladen']/$p['emballage_verpakking_aantal'] . ',' . $p['emballage_verpakking_aantal'] . ',(SELECT top 1 Cd_AR from ar where xCd_xVarieta=\'' . $p['ras'] . '\' and  xCd_xCalibro=\'' . str_replace('-', '/', $p['maat']) . '\'),' . $p['kg_productnetto_teverladen'] . ',\'' . $lotto . '\',(SELECT TOP 1 id_dotes from dorig where linkcf IN(SELECT id_dorig from dorig where id_dotes IN(SELECT TOP 1 Id_DoTes from DOTes where Cd_Do=\'OF1\' and REPLACE(NumeroDoc,\' \',\'\')=\'' . intval(str_replace('PINT','',$p['bestelopdracht'])) . '\'  ORDER BY Id_DOTes DESC))),\'00001\', @Iddorig,'.$cd_cgconto.','.$cd_aliquota.','.$linkcart.');';
                                //$query .= 'INSERT INTO DORIG(PrezzoUnitarioV,xRigAgg,xconfezione,xcolli,cd_ar,qta,cd_arlotto,Id_DOTes,Cd_MG_P,linkcf,Cd_CGConto,Cd_Aliquota,linkcart) values ('.$prezzo.',\''.$d['naam'] . ' ' . $d['adres'] . ', ' . $d['postcode'] . ' ' . $d['woonplaats'] . ' ' . $d['land'] . '  ' . $d['telefoonnummer'] . ' (' . $d['naam'] . ')\' ,' . $p['kg_productnetto_teverladen']/$p['emballage_verpakking_aantal'] . ',' . $p['emballage_verpakking_aantal'] . ',(SELECT top 1 Cd_AR from ar where xCd_xVarieta=\'' . $p['ras'] . '\' and  xCd_xCalibro=\'' . str_replace('-', '/', $p['maat']) . '\'),' . $p['kg_productnetto_teverladen'] . ',\'' . $lotto . '\',(SELECT TOP 1 id_dotes from dorig where linkcf IN(SELECT id_dorig from dorig where id_dotes IN(SELECT TOP 1 Id_DoTes from DOTes where Cd_Do=\'OF1\' and REPLACE(NumeroDoc,\' \',\'\')=\'' . intval(str_replace('PINT','',$p['bestelopdracht'])) . '\'  ORDER BY Id_DOTes DESC))),\'00001\', @Iddorig,'.$cd_cgconto.','.$cd_aliquota.','.$linkcart.');';
                                $query .= 'set @Iddorig=\'\';';
                                $query .= 'DELETE DORIG WHERE Cd_ARLotto is null and Id_DOTes=(SELECT TOP 1 Id_DoTes from DOTes where Cd_Do=\'OF1\' and REPLACE(NumeroDoc,\' \',\'\')=\'' . intval(str_replace('PINT','',$p['bestelopdracht'])) . '\' ORDER BY Id_DOTes DESC)';
                                $query .= 'DELETE DORIG WHERE Cd_ARLotto is null and Id_DOTes=(SELECT TOP 1 id_dotes from dorig where linkcf IN(SELECT id_dorig from dorig where id_dotes IN(SELECT TOP 1 Id_DoTes from DOTes where Cd_Do=\'OF1\' and REPLACE(NumeroDoc,\' \',\'\')=\'' . intval(str_replace('PINT','',$p['bestelopdracht'])) . '\' ORDER BY Id_DOTes DESC )));';
                            }
                        }
                    }
                }
                $id_dotes ='SELECT TOP 1 Id_DoTes from DORig where Cd_Do=\'OF1\' and (Cd_ARLotto is null or Cd_ARLotto = \'\') and REPLACE(NumeroDoc,\' \',\'\')=\'' . intval(str_replace('PINT','',$p['bestelopdracht'])) . '\' ORDER BY Id_DOTes DESC';
                $id_dotes_ovc ='SELECT TOP 1 id_dotes from dorig where linkcf IN(SELECT id_dorig from dorig where id_dotes IN(SELECT TOP 1 Id_DoTes from DOTes where Cd_Do=\'OF1\' and (Cd_ARLotto is null or Cd_ARLotto = \'\')  and REPLACE(NumeroDoc,\' \',\'\')=\'' . intval(str_replace('PINT','',$p['bestelopdracht'])) . '\' ORDER BY Id_DOTes DESC ))';
                DB::select('INSERT INTO xquery (id_ditta,query,id_dotes,id_dotes_OVC) VALUES (\'7\',"' . $query . '","'.$id_dotes.'","'.$id_dotes_ovc.'")');
                return Redirect::to('admin/insert_json?import=true');
            }
        }else{
/*
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'mail.beevoip.it';
            $mail->SMTPAuth = true;
            $mail->Username = 'hd.sviluppo@softmaint.it';
            $mail->Password = 'Settembre@2022';
            $mail->SMTPSecure = 'ssl';
            $mail->CharSet = 'utf-8';
            $mail->Port = '465';
            $mail->setFrom('hd.sviluppo@softmaint.it');
            $mail->addAddress('hd.sviluppo@softmaint.it');
            $mail->isHTML(true);
            $mail->Subject = 'Provvisiero - Errore su Json';
            $mail->Body = $dati;
            $mail->send();

            return Redirect::to('admin/insert_json?errore=JSON non Sincronizzato. Mail Mandata in Assistenza');*/
            return Redirect::to('admin/insert_json?errore=JSON non Sincronizzato.');
        }
    }

    public function login($token=null, Request $request)
    {

        $dati = $request->all();
        $error = '';
        if (!session()->has('ditta')) return Redirect::to('login/gtr1234')->send();
        $token1 = session('ditta');
        if (isset($dati['login'])) {

            if (session()->has('utente')) {
                $utente = session('utente');
                if (substr($utente->cd_cf, 0, 1) == 'F') return Redirect::to('admin/index');
                if (substr($utente->cd_cf, 0, 1) == 'C') return Redirect::to('cliente/index');
            }
            $utenti = DB::select('SELECT * from cf where xusername = "' . htmlentities($dati['username'], 3, 'UTF-8' . '') . '" and xpassword = "' . htmlentities($dati['password'], 3, 'UTF-8' . '') . '" and id_ditta = (SELECT id from ditta where token = \'' . $token1 . '\') LIMIT 1 ');
            if (sizeof($utenti) > 0) {

                $utente = $utenti[0];
                $utente->torna_admin = 0;
                $utente->mostra_logout = 1;
                session(['utente' => $utente]);
                session()->save();
                if (substr($utente->cd_cf, 0, 1) == 'F') return Redirect::to('fornitore/index');
                if (substr($utente->cd_cf, 0, 1) == 'C') return Redirect::to('cliente/index');

            } else {

                if ($dati['password'] != null)
                    $password = $dati['password'];

                $password = DB::SELECT('Select SHA2(\'' . $dati['password'] . '\',\'256\') as PASSWORD');

                if (sizeof($password) < 1)
                    $password = DB::SELECT('Select SubString(Convert(SHA2(\'' . $dati['password'] . '\',\'256\')USING UTF8MB4), 3, 64) as PASSWORD  ');

                $utenti = DB::select('SELECT *,  \'\' as cd_cf from operatore where operatore = "' . htmlentities($dati['username'], 3, 'UTF-8' . '') . '" and password = "' . $password[0]->PASSWORD . '" and id_ditta = (SELECT id from ditta where token = \'' . $token1 . '\') LIMIT 1 ');

                if (sizeof($utenti) > 0) {
                    $utente = $utenti[0];
                    $utente->torna_admin = 0;
                    $utente->mostra_logout = 1;
                    session(['utente' => $utente]);
                    session()->save();
                    return Redirect::to('admin/index');

                } else {
                    $error = 'Inserisci username e password corretti';
                }
            }

        }

        return View::make('admin.content.login', compact('error'));
    }

    public function index(Request $request)
    {

        if (!session()->has('ditta')) return Redirect::to('login/gtr1234')->send();

        $dati = $request->all();

        $ditta = session('ditta');

        $id_ditta = DB::SELECT('SELECT * from ditta where token = \'' . $ditta . '\' ')[0];

        $richieste = DB::SELECT('SELECT count(*) as conteggio FROM dotes where id_ditta = \'' . $id_ditta->id . '\' and cd_do = \'ROF\' and stato = 0 ')[0]->conteggio;
        $rifiutate = DB::SELECT('select count(*) as conteggio from dotes where id_ditta = \'' . $id_ditta->id . '\' and cd_do = \'ROF\' and id_dotes in (SELECT id_dotes from dotes where id_ditta = \'' . $id_ditta->id . '\' and stato = 1 ) ')[0]->conteggio;
        $risposte = DB::SELECT('SELECT count(*) as conteggio FROM dotes_out where id_ditta = \'' . $id_ditta->id . '\' and cd_do = \'ROF\' and stato = 0 ')[0]->conteggio;
        $storico = DB::SELECT('SELECT count(*) as conteggio FROM dotes_out where id_ditta = \'' . $id_ditta->id . '\' and cd_do = \'ROF\' and stato != 0')[0]->conteggio;

        $utente = session('utente');

        $page = 'index';

        return View::make('admin.index', compact('page', 'utente', 'ditta', 'richieste', 'rifiutate', 'risposte', 'storico'));

    }

    public function fornitore(Request $request)
    {

        if (!session()->has('ditta')) return Redirect::to('login/gtr1234')->send();

        $dati = $request->all();

        $ditta = session('ditta');

        $id_ditta = DB::SELECT('SELECT * from ditta where token = \'' . $ditta . '\' ')[0];

        $utente = session('utente');

        $page = 'amministratore_fornitore';

        $fornitore = DB::SELECT('SELECT cf.descrizione,cf.cd_cf, COUNT(dotes.id_dotes) AS conteggio FROM cf left join dotes on dotes.cd_cf = cf.cd_cf where cf.id_ditta = ' . $id_ditta->id . ' and dotes.cd_do = \'ROF\' and dotes.stato = 0 GROUP BY cf.cd_cf,cf.descrizione ');

        return View::make('admin.index', compact('page', 'utente', 'ditta', 'id_ditta', 'fornitore'));
    }

    public function richieste(Request $request, $cd_cf)
    {

        if (!session()->has('ditta')) return Redirect::to('login/gtr1234')->send();

        $dati = $request->all();

        $ditta = session('ditta');

        $id_ditta = DB::SELECT('SELECT * from ditta where token = \'' . $ditta . '\' ')[0];

        $utente = session('utente');

        $page = 'amministratore_conferme';
        /*
                if(isset($dati['RIFIUTA'])){
                    unset($dati['RIFIUTA']);
                    DB::update('UPDATE dotes SET stato = \'1\' where id_dotes = \''.$dati['id'].'\'');
                    DB::update('UPDATE dorig SET stato = \'1\' where id_dotes = \''.$dati['id'].'\'');
                    return Redirect::to('admin/richieste');

                }
                if(isset($dati['CONFERMA'])){
                    unset($dati['CONFERMA']);
                    $insert_dotes['id_dotes']=$dati['id'];
                    $insert_dotes['cd_cfdest']=$dati['cd_cfdest'];
                    $insert_dotes['cd_cfsede']=$dati['cd_cfsede'];
                    $insert_dotes['cd_agente_1']=$dati['cd_agente_1'];
                    $insert_dotes['cd_agente_2']=$dati['cd_agente_2'];
                    $insert_dotes['cd_ls_1']=$dati['cd_ls_1'];
                    $insert_dotes['cd_mgesercizio']=$dati['cd_mgesercizio'];
                    $insert_dotes['id_ditta']=$id_ditta->id;
                    $insert_dotes['cd_do']=$dati['cd_do'];
                    $insert_dotes['tipodocumento']=$dati['tipodocumento'];
                    $insert_dotes['numerodoc']=$dati['numerodoc'];
                    $insert_dotes['datadoc']=$dati['datadoc'];
                    $insert_dotes['cd_cf']=$dati['cd_cf'];
                    DB::table('dotes_out')->insert($insert_dotes);

                    $righe = DB::SELECT('SELECT * FROM dorig where id_dotes =\''.$dati['id'].'\' and id_ditta = \''.$id_ditta->id.'\' ');
                    foreach ($righe as $r) {
                        $insert_dorig['id_dotes'] = $dati['id'];
                        $insert_dorig['id_ditta'] = $id_ditta->id;
                        $insert_dorig['id_dorig'] = $r->id_dorig;
                        $insert_dorig['cd_cf'] = $dati['cd_cf'];
                        $insert_dorig['qta'] = $dati['quantita_'.$r->id_dorig];
                        $insert_dorig['cd_ar'] = $dati['cd_ar_'.$r->id_dorig];
                        $insert_dorig['xcolli'] = '';
                        $insert_dorig['xnumerobancali'] = '';
                        $insert_dorig['descrizione'] = $dati['descrizione_'.$r->id_dorig];
                        $insert_dorig['prezzounitariov'] = $dati['prezzo_'.$r->id_dorig];
                        $insert_dorig['cd_aliquota'] = $dati['cd_aliquota_'.$r->id_dorig];
                        $insert_dorig['aliquota'] = $dati['aliquota_'.$r->id_dorig];
                        $insert_dorig['scontoriga'] = '';
                        $insert_dorig['prezzototalev'] = floatval($dati['prezzo_'.$r->id_dorig]) * floatval($dati['quantita_'.$r->id_dorig]);
                        $insert_dorig['imposta'] = floatval(floatval($insert_dorig['prezzototalev'])/100) * floatval($insert_dorig['aliquota']);
                        $insert_dorig['prezzounitarioscontatov'] = '';
                        $insert_dorig['prezzototalev'] = '';
                        DB::table('dorig_out')->insert($insert_dorig);
                    }

                    DB::update('UPDATE dotes SET stato = \'2\' where id_dotes = \''.$dati['id'].'\'');
                    DB::update('UPDATE dorig SET stato = \'2\' where id_dotes = \''.$dati['id'].'\'');
                    return Redirect::to('admin/richieste');
                }
        */

        return View::make('admin.index', compact('page', 'utente', 'ditta', 'id_ditta', 'cd_cf'));
    }

    public function offerte(Request $request)
    {

        if (!session()->has('ditta')) return Redirect::to('login/gtr1234')->send();

        $dati = $request->all();

        $ditta = session('ditta');

        $id_ditta = DB::SELECT('SELECT * from ditta where token = \'' . $ditta . '\' ')[0];

        $utente = session('utente');

        $page = 'amministratore_offerte';


        $rifiutate = DB::SELECT('select * from dotes where id_ditta = \'' . $id_ditta->id . '\' and cd_do = \'ROF\' and id_dotes in (SELECT id_dotes from dotes where id_ditta = \'' . $id_ditta->id . '\' and stato = 1 ) ');

        foreach ($rifiutate as $d) {
            $d->righe = DB::select('SELECT * from dorig Where id_dotes =\'' . $d->id_dotes . '\' and id_ditta = \'' . $id_ditta->id . '\'');
        }


        return View::make('admin.index', compact('page', 'utente', 'ditta', 'id_ditta', 'rifiutate'));
    }

    public function risposte(Request $request)
    {

        if (!session()->has('ditta')) return Redirect::to('login/gtr1234')->send();

        $dati = $request->all();

        $ditta = session('ditta');

        $id_ditta = DB::SELECT('SELECT * from ditta where token = \'' . $ditta . '\' ')[0];

        $utente = session('utente');

        $page = 'amministratore_risposte';

        $dotes = DB::SELECT('SELECT * FROM dotes_out where id_ditta = \'' . $id_ditta->id . '\' and cd_do = \'ROF\' AND stato = 0');

        foreach ($dotes as $d) {
            $d->righe = DB::select('SELECT * from dorig_out Where id_dotes =\'' . $d->id_dotes . '\' and id_ditta = \'' . $id_ditta->id . '\' and stato = 0 ');
        }


        if (isset($dati['RIFIUTA'])) {
            unset($dati['RIFIUTA']);
            DB::update('UPDATE dotes_out SET stato = \'1\' where id_dotes = \'' . $dati['id'] . '\'');
            DB::update('UPDATE dorig_out SET stato = \'1\' where id_dotes = \'' . $dati['id'] . '\'');
            return Redirect::to('admin/risposte');

        }

        if (isset($dati['CONTROFFERTA'])) {
            unset($dati['CONTROFFERTA']);
            $righe = DB::SELECT('SELECT * FROM dorig_out where id_dotes = \'' . $dati['id'] . '\' and id_ditta = \'' . $id_ditta->id . '\'');
            foreach ($righe as $r) {
                //  $insert['cd_cfdest'] = $dati['cd_cfdest'];
                //  $insert['cd_cfsede'] = $dati['cd_cfsede'];
                $insert['cd_cf'] = $dati['cd_cf'];
                $insert['id_ditta'] = $id_ditta->id;
                //   $insert['cd_agente_1'] = $dati['cd_agente_1'];
                $insert['xcolli'] = '';
                $insert['xnumerobancali'] = '';
                $insert['stato'] = '0';
                //    $insert['note'] = '';
                //    $insert['scontoriga'] = '';
                $insert['cd_ar'] = $dati['cd_ar_' . $r->id_dorig];
                $insert['qta'] = $dati['quantita_' . $r->id_dorig];
                $insert['prezzounitariov'] = $dati['prezzo_' . $r->id_dorig];
                $insert['aliquota'] = $dati['aliquota_' . $r->id_dorig];
                $insert['cd_aliquota'] = $dati['cd_aliquota_' . $r->id_dorig];
                $insert['prezzototalev'] = floatval($dati['prezzo_' . $r->id_dorig]) * floatval($dati['quantita_' . $r->id_dorig]);
                $insert['imposta'] = floatval(floatval($insert['prezzototalev']) / 100) * floatval($insert['aliquota']);
                DB::table('dorig')->where('id_dorig', $r->id_dorig)->where('id_ditta', $id_ditta->id)->update($insert);
            }

            DB::update('UPDATE dotes SET stato = \'0\' where id_dotes = \'' . $dati['id'] . '\'');

            DB::update('UPDATE dotes_out SET stato = \'3\' where id_dotes = \'' . $dati['id'] . '\'');
            DB::update('UPDATE dorig_out SET stato = \'3\' where id_dotes = \'' . $dati['id'] . '\'');

            return Redirect::to('admin/risposte');

        }
        if (isset($dati['CONFERMA'])) {
            unset($dati['CONFERMA']);
            $righe = DB::SELECT('SELECT * FROM dorig_out where id_dotes = \'' . $dati['id'] . '\' and id_ditta = \'' . $id_ditta->id . '\' and stato != \'3\' ');
            foreach ($righe as $r) {
                $insert['cd_cfdest'] = $dati['cd_cfdest'];
                $insert['cd_cfsede'] = $dati['cd_cfsede'];
                $insert['cd_cf'] = $dati['cd_cf'];
                $insert['id_ditta'] = $id_ditta->id;
                $insert['cd_agente_1'] = $dati['cd_agente_1'];
                $insert['xcolli'] = '';
                $insert['xbancali'] = '';
                $insert['note'] = '';
                $insert['scontoriga'] = '';
                $insert['cd_ar'] = $dati['cd_ar_' . $r->id_dorig];
                $insert['qta'] = $dati['quantita_' . $r->id_dorig];
                $insert['prezzo_unitario'] = $dati['prezzo_' . $r->id_dorig];
                $insert['aliquota'] = $dati['aliquota_' . $r->id_dorig];
                $insert['cd_aliquota'] = $dati['cd_aliquota_' . $r->id_dorig];
                $insert['totale'] = floatval($dati['prezzo_' . $r->id_dorig]) * floatval($dati['quantita_' . $r->id_dorig]);
                $insert['imposta'] = floatval(floatval($insert['totale']) / 100) * floatval($insert['aliquota']);
                DB::table('cart')->insert($insert);
            }
            DB::update('UPDATE dotes_out SET stato = \'2\' where id_dotes = \'' . $dati['id'] . '\' and stato != \'3\' ');
            DB::update('UPDATE dorig_out SET stato = \'2\' where id_dotes = \'' . $dati['id'] . '\' and stato != \'3\'');
            return Redirect::to('admin/risposte');
        }
        return View::make('admin.index', compact('page', 'utente', 'ditta', 'id_ditta', 'dotes'));
    }

    public function storico(Request $request)
    {

        if (!session()->has('ditta')) return Redirect::to('login/gtr1234')->send();

        $dati = $request->all();

        $ditta = session('ditta');

        $id_ditta = DB::SELECT('SELECT * from ditta where token = \'' . $ditta . '\' ')[0];

        $utente = session('utente');

        $page = 'amministratore_storico';

        return View::make('admin.index', compact('page', 'utente', 'ditta', 'id_ditta'));
    }

    public function logout()
    {
        $token = session('ditta');
        session()->flush();
        return Redirect::to('login/' . $token);
    }

    /**
     * Verifica se l'utente è loggato
     * @return \Illuminate\Http\RedirectResponse
     */
    public function is_loggato()
    {
        if (!session()->has('utente')) return Redirect::to('admin/login')->send();
    }


}
