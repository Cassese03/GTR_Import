<?php

namespace App\Http\Controllers;

use App\Exports\ExcelExport;
use http\Env\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TariffeImport;
use PHPMailer\PHPMailer\PHPMailer;
use PHPUnit\TextUI\XmlConfiguration\ExtensionCollectionIterator;
use URL;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use RuntimeException;

class ClienteController extends Controller
{

    public function login($token = null, Request $request)
    {
        // return Redirect::to('cliente/manutenzione')->send();
        $dati = $request->all();
        $error = '';

        if (!session()->has('ditta')) {
            $accesso = DB::select('SELECT * from ditta where token = \'GTR1234\' ');
            if (sizeof($accesso) > 0) {
                session(['ditta' => $accesso[0]->token]);
                session()->save();
            }
        }
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
                if (substr($utente->cd_cf, 0, 1) == 'F') return Redirect::to('admin/index');
                if (substr($utente->cd_cf, 0, 1) == 'C') return Redirect::to('cliente/index');


            } else {
                $passInserita = DB::SELECT('Select SHA2(\'' . $dati['password'] . '\',\'256\') as Password ');

                $operatore = DB::select('SELECT * from operatore where operatore = "' . htmlentities($dati['username'], 3, 'UTF-8' . '') . '" and password = "' . htmlentities($passInserita[0]->Password, 3, 'UTF-8' . '') . '" and id_ditta = (SELECT id from ditta where token = \'' . $token1 . '\') LIMIT 1 ');

                if (sizeof($operatore) > 0) {

                    $utente = $operatore[0];
                    $utente->cd_cf = 'F001';
                    $utente->cd_provincia = '';
                    $utente->torna_admin = 0;
                    $utente->mostra_logout = 1;
                    session(['utente' => $utente]);
                    session()->save();
                    return Redirect::to('cliente/index');


                }

            }
            $error = 'Inserisci username e password corretti';

        }
        $page = 'cliente.login';
        return View::make('admin.index', compact('page', 'error'));
    }

    public function registrati(Request $request)
    {
        $contatti = DB::SELECT('SELECT \'\' as email,\'\' as name,\'\' as telefono')[0];
        $page = 'cliente.registrati';
        $result = 0;

        if (isset($dati['richiesta'])) {

            $corpo = '<strong>Nuovo Rivenditore GTR da WEB</strong><br>';
            $corpo .= '<strong>Ragione Sociale: </strong> ' . $dati['RagioneSociale'] . '<br>';
            $corpo .= '<strong>Indirizzo: </strong>' . $dati['Indirizzo'] . '<br>';
            $corpo .= '<strong>Cap: </strong>' . $dati['Cap'] . '<br>';
            $corpo .= '<strong>Localita: </strong>' . $dati['Localita'] . '<br>';
            $corpo .= '<strong>Provincia: </strong>' . $dati['Provincia'] . '<br>';
            $corpo .= '<strong>Partita Iva: </strong>' . $dati['PartitaIva'] . '<br>';
            $corpo .= '<strong>Codice Fiscale: </strong>' . $dati['CodiceFiscale'] . '<br>';
            $corpo .= '<strong>Email: </strong>' . $dati['Email'] . '<br>';
            $corpo .= '<strong>Telefono: </strong>' . $dati['Telefono'] . '<br>';
            $corpo .= '<strong>Nome e Cognome di Riferimento: </strong>' . $dati['Nome'] . ' ' . $dati['Cognome'] . '<br>';

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'mail.gtrimport.it';
            $mail->SMTPAuth = true;
            $mail->Username = 'ordini@gtrimport.it';
            $mail->Password = 'KGR/2022';
            $mail->SMTPSecure = 'ssl';
            $mail->CharSet = 'utf-8';
            $mail->Port = '465';
            $mail->setFrom('ordini@gtrimport.it');
            $mail->addAddress('attivazione@gtrimport.it');
            $mail->isHTML(true);
            $mail->Subject = 'Nuovo Rivenditore GTR da WEB';
            $mail->Body = $corpo;
            $mail->send();
            $result = 1;
        }
        return View::make('admin.index', compact('page', 'contatti', 'result'));
    }

    public function registrati_cliente(Request $request)
    {
        $contatti = DB::SELECT('SELECT \'\' as email,\'\' as name,\'\' as telefono')[0];
        $page = 'cliente.registrati_cliente';
        $result = 0;
        if (isset($dati['registrazione'])) {

            $corpo = '<strong>Nuovo Cliente GTR da WEB</strong><br>';
            $corpo .= '<strong>Ragione Sociale: </strong> ' . $dati['RagioneSociale'] . '<br>';
            $corpo .= '<strong>Indirizzo: </strong>' . $dati['Indirizzo'] . '<br>';
            $corpo .= '<strong>Cap: </strong>' . $dati['Cap'] . '<br>';
            $corpo .= '<strong>Localita: </strong>' . $dati['Localita'] . '<br>';
            $corpo .= '<strong>Provincia: </strong>' . $dati['Provincia'] . '<br>';
            $corpo .= '<strong>Partita Iva: </strong>' . $dati['PartitaIva'] . '<br>';
            $corpo .= '<strong>Codice Fiscale: </strong>' . $dati['CodiceFiscale'] . '<br>';
            $corpo .= '<strong>Email: </strong>' . $dati['Email'] . '<br>';
            $corpo .= '<strong>Telefono: </strong>' . $dati['Telefono'] . '<br>';
            $corpo .= '<strong>Nome e Cognome di Riferimento: </strong>' . $dati['Nome'] . ' ' . $dati['Cognome'] . '<br>';

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'mail.gtrimport.it';
            $mail->SMTPAuth = true;
            $mail->Username = 'ordini@gtrimport.it';
            $mail->Password = 'KGR/2022';
            $mail->SMTPSecure = 'ssl';
            $mail->CharSet = 'utf-8';
            $mail->Port = '465';
            $mail->setFrom('ordini@gtrimport.it');
            $mail->addAddress('attivazione@gtrimport.it');
            $mail->isHTML(true);
            $mail->Subject = 'Nuovo Cliente GTR da WEB';
            $mail->Body = $corpo;
            $mail->send();
            $result = 1;
        }
        return View::make('admin.index', compact('page', 'contatti', 'result'));
    }

    public function manutenzione(Request $request)
    {
        $page = 'cliente.manutenzione';

        return View::make('admin.index', compact('page'));

    }

    public function index(Request $request)
    {

        if (!session()->has('ditta')) {
            $accesso = DB::select('SELECT * from ditta where token = \'GTR1234\' ');
            if (sizeof($accesso) > 0) {
                session(['ditta' => $accesso[0]->token]);
                session()->save();
            }
        }

        // return Redirect::to('cliente/manutenzione')->send();
        $dati = $request->all();

        $ditta = session('ditta');

        $id_ditta = DB::SELECT('SELECT * from ditta where token = \'' . $ditta . '\' ')[0]->id;

        if (isset($dati['aggiungi_al_carrello'])) {

            if (!session()->has('utente'))
                return Redirect::to('admin/login')->send();
            else {
                $utente = session('utente');

                if (isset($dati['id_prodotto'])) {

                    $prodotti = DB::select('SELECT *, (SELECT link FROM arimg where id_ditta = ' . $utente->id_ditta . ' and cd_ar = ar.cd_ar order by id asc LIMIT 1 ) as copertina from ar where id_ditta = \'' . $utente->id_ditta . '\' and id = ' . $dati['id_prodotto'] . ' order by immagine desc ');

                    $cart = Session::get('cart');
                    if ($cart == '')
                        $cart = [];
                    if (isset($cart[$prodotti[0]->id])) {
                        $dati['quantita'] = $dati['quantita'] + $cart[$prodotti[0]->id]['quantita'];
                    }

                    $cart[$prodotti[0]->id] = array(
                        "id" => $prodotti[0]->id,
                        "nome" => $prodotti[0]->cd_ar,
                        "immagine" => $prodotti[0]->copertina,
                        "quantita" => $dati['quantita'],
                        "prezzo" => $dati['prezzo'],
                        "sconto" => $dati['sconto'],
                        "note" => "",
                    );

                    Session::put('cart', $cart);
                    Session::save();

                }

                return Redirect::to('/cliente/index/?aggiunto=1');
            }
        }

        if (isset($dati['inputRegistrati'])) {
            $contatti = DB::SELECT('SELECT \'' . str_replace('\\', '', $dati['inputEmail']) . '\' as email,\'' . str_replace('\\', '', $dati['inputName']) . '\' as name,\'' . str_replace('\\', '', $dati['inputTelefono']) . '\' as telefono')[0];
            $page = 'cliente.registrati';
            return View::make('admin.index', compact('page', 'contatti'));
        }

        if (isset($dati['richiesta'])) {

            $corpo = '<strong>Nuovo Rivenditore GTR da WEB</strong><br>';
            $corpo .= '<strong>Ragione Sociale: </strong> ' . $dati['RagioneSociale'] . '<br>';
            $corpo .= '<strong>Indirizzo: </strong>' . $dati['Indirizzo'] . '<br>';
            $corpo .= '<strong>Cap: </strong>' . $dati['Cap'] . '<br>';
            $corpo .= '<strong>Localita: </strong>' . $dati['Localita'] . '<br>';
            $corpo .= '<strong>Provincia: </strong>' . $dati['Provincia'] . '<br>';
            $corpo .= '<strong>Partita Iva: </strong>' . $dati['PartitaIva'] . '<br>';
            $corpo .= '<strong>Codice Fiscale: </strong>' . $dati['CodiceFiscale'] . '<br>';
            $corpo .= '<strong>Email: </strong>' . $dati['Email'] . '<br>';
            $corpo .= '<strong>Telefono: </strong>' . $dati['Telefono'] . '<br>';
            $corpo .= '<strong>Nome e Cognome di Riferimento: </strong>' . $dati['Nome'] . ' ' . $dati['Cognome'] . '<br>';

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'mail.gtrimport.it';
            $mail->SMTPAuth = true;
            $mail->Username = 'ordini@gtrimport.it';
            $mail->Password = 'KGR/2022';
            $mail->SMTPSecure = 'ssl';
            $mail->CharSet = 'utf-8';
            $mail->Port = '465';
            $mail->setFrom('ordini@gtrimport.it');
            $mail->addAddress('attivazione@gtrimport.it');
            $mail->isHTML(true);
            $mail->Subject = 'Nuovo Rivenditore GTR da WEB';
            $mail->Body = $corpo;
            $mail->send();
        }

        $page = 'cliente.index';

        if (!session()->has('utente')) {
            $articoli = DB::SELECT('SELECT ar.*,(SELECT link FROM arimg where id_ditta = ' . $id_ditta . ' and cd_ar = ar.cd_ar order by id asc LIMIT 1 ) as copertina,0 as prezzo,0 as sconto,COALESCE(mggiacenza.disponibile,0) as disponibile FROM ar  LEFT JOIN mggiacenza ON mggiacenza.cd_ar = ar.cd_ar and mggiacenza.cd_mg = \'00001\' and mggiacenza.id_ditta = \'' . $id_ditta . '\' where ar.attributi != \'\' and ar.id_ditta = \'' . $id_ditta . '\'  order by copertina desc  LIMIT 20 ');
        } else {
            $utente = session('utente');
            $articoli = DB::SELECT('SELECT ar.*,(SELECT link FROM arimg where id_ditta = ' . $id_ditta . ' and cd_ar = ar.cd_ar order by id asc LIMIT 1 ) as copertina,lsarticolo.prezzo,lsarticolo.sconto,COALESCE(mggiacenza.disponibile,0) as disponibile FROM ar LEFT JOIN mggiacenza ON mggiacenza.cd_ar = ar.cd_ar  and mggiacenza.cd_mg = \'00001\' and mggiacenza.id_ditta = \'' . $id_ditta . '\' LEFT JOIN lsarticolo ON lsarticolo.cd_ar = ar.cd_ar and lsarticolo.id_ditta = ' . $id_ditta . ' LEFT JOIN lsrevisione ON lsrevisione.id_lsrevisione = lsarticolo.id_lsrevisione AND lsrevisione.id_ditta = ' . $id_ditta . ' JOIN cf ON cf.cd_ls_1 = lsrevisione.cd_ls AND cf.cd_cf = \'' . $utente->cd_cf . '\' and cf.id_ditta = ' . $id_ditta . ' where ar.attributi != \'\' and ar.id_ditta = \'' . $id_ditta . '\'  order by copertina desc  LIMIT 20 ');
        }

        return View::make('admin.index', compact('page', 'articoli'));

    }

    public function contattaci(Request $request)
    {

        $page = 'cliente.contattaci';

        return View::make('admin.index', compact('page'));

    }

    public function policy(Request $request)
    {

        $page = 'cliente.policy';

        return View::make('admin.index', compact('page'));

    }

    public function reclami(Request $request)
    {

        $this->is_loggato();

        $dati = $request->all();

        if (isset($dati['ACCETTA'])) {
            DB::SELECT('UPDATE reclami SET stato = 1 where id_ditta = 5 and  id =' . $dati['id']);
            return Redirect::to('/cliente/reclami');
        }

        if (isset($dati['RIFIUTA'])) {
            DB::SELECT('UPDATE reclami SET stato = 2 where id_ditta = 5 and  id =' . $dati['id']);
            return Redirect::to('/cliente/reclami');
        }

        $utente = session('utente');

        $reclami = DB::SELECT('SELECT *,(if(reclami.stato = 0,\'In corso\',(if(reclami.stato = 1,\'Accettato\',\'Rifiutato\'))))  as stato_text from reclami where id_ditta  = ' . $utente->id_ditta . ' and cd_cf = \'' . $utente->cd_cf . '\' ');
        if (substr($utente->cd_cf, 0, 1) == 'F') {
            $reclami = DB::SELECT('SELECT *,(if(reclami.stato = 0,\'In corso\',(if(reclami.stato = 1,\'Accettato\',\'Rifiutato\'))))  as stato_text from reclami where reclami.data >= DATE_SUB(NOW(), INTERVAL 365 DAY) and reclami.stato != 0 and id_ditta  = ' . $utente->id_ditta . ' ORDER BY reclami.stato,reclami.data');
        }
        if (substr($utente->cd_cf, 0, 1) == 'F') {
            $reclami_aperti = DB::SELECT('SELECT *,(if(reclami.stato = 0,\'In corso\',(if(reclami.stato = 1,\'Accettato\',\'Rifiutato\'))))  as stato_text from reclami where reclami.stato = 0 
                                                                                                                                and id_ditta  = ' . $utente->id_ditta);
        } else
            $reclami_aperti = array();

        $page = 'cliente.reclami';

        return View::make('admin.index', compact('page', 'reclami', 'reclami_aperti', 'utente'));

    }

    public function nuovo_reclamo(Request $request)
    {

        $this->is_loggato();

        $dati = $request->all();

        $utente = session('utente');

        $page = 'cliente.nuovo_reclamo';

        if (isset($dati['problema'])) {

            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["foto_prodotto"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            $target_file = $target_dir . 'reclamo_' . rand() . '.' . $imageFileType;

            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES["foto_prodotto"]["tmp_name"]);
                if ($check !== false) {
                    //  echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    //   echo "File is not an image.";
                    $uploadOk = 0;
                }
            }

            if (file_exists($target_file)) {
                //  echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            if ($_FILES["foto_prodotto"]["size"] > 500000) {
                +
                    //  echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif") {
                //  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            /* print_r($_FILES);
             echo '<br>'.$target_file.'<br>';*/
            if ($uploadOk == 0) {
                // echo "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($_FILES["foto_prodotto"]["tmp_name"], $target_file)) {
                    // echo "The file ". htmlspecialchars( basename( $_FILES["foto_prodotto"]["name"])). " has been uploaded.";
                } else {
                    // echo "Sorry, there was an error uploading your file.";
                }
            }

            $target_dir1 = "uploads/";
            $target_file1 = $target_dir1 . basename($_FILES["foto_imballaggio"]["name"]);
            $uploadOk1 = 1;
            $imageFileType1 = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $target_file1 = $target_dir1 . 'reclamo_' . rand() . '.' . $imageFileType1;
            if (isset($_POST["submit"])) {
                $check1 = getimagesize($_FILES["foto_imballaggio"]["tmp_name"]);
                if ($check1 !== false) {
                    // echo "File is an image - " . $check1["mime"] . ".";
                    $uploadOk1 = 1;
                } else {
                    //echo "File is not an image.";
                    $uploadOk1 = 0;
                }
            }
            if (file_exists($target_file1)) {
                //echo "Sorry, file already exists.";
                $uploadOk1 = 0;
            }
            /*if ($_FILES["foto_imballaggio"]["size"] > 500000) {
                 echo "Sorry, your file is too large.";
                $uploadOk1 = 0;
            }*/
            if ($imageFileType1 != "jpg" && $imageFileType1 != "png" && $imageFileType1 != "jpeg"
                && $imageFileType1 != "gif") {
                //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk1 = 0;
            }
            if ($uploadOk1 == 0) {
                //echo "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($_FILES["foto_imballaggio"]["tmp_name"], $target_file1)) {
                    //echo "The file ". htmlspecialchars( basename( $_FILES["foto_imballaggio"]["name"])). " has been uploaded.";
                } else {
                    //echo "Sorry, there was an error uploading your file.";
                }
            }

            $insert['cd_ar'] = $dati['cd_ar'];
            $insert['riferimento_fattura'] = $dati['numerodoc'];
            $insert['email'] = $dati['email'];
            $insert['foto_prodotto'] = 'https://gtrimport.it/' . $target_file;
            $insert['foto_imballaggio'] = 'https://gtrimport.it/' . $target_file1;
            $insert['problematica'] = $dati['problema'];
            $insert['id_ditta'] = $utente->id_ditta;
            $insert['cd_cf'] = $utente->cd_cf;
            $insert['data'] = date('Y-m-d', strtotime('now'));
            $id = DB::table('reclami')->insertGetId($insert);


            $corpo = '<strong>Nuovo Reclamo x GTR da WEB</strong><br>';
            $corpo .= '<strong>Id Reclamo : </strong> ' . $id . '<br>';
            $corpo .= '<strong>Cliente : </strong> ' . $utente->cd_cf . '<br>';
            $corpo .= '<strong>Problema: </strong>' . $dati['problema'] . '<br>';
            $corpo .= '<strong>Riferimento Fattura : </strong>' . $insert['riferimento_fattura'] . '<br>';
            $corpo .= '<strong>Mail : </strong>' . $dati['email'] . '<br>';
            $corpo .= '<strong>Articolo : </strong>' . $insert['cd_ar'] . '<br>';
            $corpo .= '<strong>Data : </strong>' . $insert['data'] . '<br>';
            /*            $corpo .= '<strong>Foto Prodotto : </strong> ' . $insert['foto_prodotto'] . '<br>';
                        $corpo .= '<strong>Foto Imballaggio : </strong> ' . $insert['foto_imballaggio'] . '<br>';

                       */
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'mail.gtrimport.it';
            $mail->SMTPAuth = true;
            $mail->Username = 'ordini@gtrimport.it';
            $mail->Password = 'KGR/2022';
            $mail->SMTPSecure = 'ssl';
            $mail->CharSet = 'utf-8';
            $mail->Port = '465';
            $mail->setFrom('ordini@gtrimport.it');
            $mail->addAddress('ordini@gtrimport.it');
            //$mail->addAddress('hd.sviluppo@promedya.it');
            $mail->isHTML(true);
            $mail->Subject = 'Nuovo Reclamo x GTR da WEB';
            $mail->Body = $corpo;
            $mail->addAttachment('/home/gtrimport/public_html/public' . str_replace('https://gtrimport.it', '', $insert['foto_prodotto']), 'Foto Prodotto');
            $mail->addAttachment('/home/gtrimport/public_html/public' . str_replace('https://gtrimport.it', '', $insert['foto_imballaggio']), 'Foto Imballaggio');
            $mail->send();

        }
        return View::make('admin.index', compact('page'));

    }

    public function storico(Request $request)
    {

        $this->is_loggato();

        $dati = $request->all();

        $utente = session('utente');

        if (substr($utente->cd_cf, 0, 1) == 'F') {
            return Redirect::to('cliente/index');
        }

        $fatture = DB::SELECT('SELECT numerodoc,righeevadibili,cd_do,datadoc,cd_do,id_dotes, IF((SELECT count(pagata) from sc where id_ditta = ' . $utente->id_ditta . ' and id_dotes = dotes.id_dotes) =(SELECT count(pagata) from sc where id_ditta = ' . $utente->id_ditta . ' and pagata = 1 and id_dotes = dotes.id_dotes),1,IF((SELECT count(pagata) from sc where id_ditta = ' . $utente->id_ditta . ' and id_dotes = dotes.id_dotes) =(SELECT count(pagata) from sc where id_ditta = ' . $utente->id_ditta . ' and pagata = 0 and id_dotes = dotes.id_dotes),0,2)) as pagata FROM dotes where cd_do in (\'FTV\',\'FTA\') and id_ditta = ' . $utente->id_ditta . ' and cd_cf = \'' . $utente->cd_cf . '\' order by datadoc desc ');

        $ordini = DB::SELECT('SELECT numerodoc,righeevadibili,cd_do,datadoc,cd_do,id_dotes,\'\' as pagata FROM dotes where cd_do in (\'OVC\',\'OWC\') and id_ditta = ' . $utente->id_ditta . ' and cd_cf = \'' . $utente->cd_cf . '\' order by datadoc desc ');

        $page = 'cliente.storico';

        return View::make('admin.index', compact('page', 'fatture', 'ordini', 'utente'));

    }


    public function catalogo(Request $request)
    {

        //$this->is_loggato();

        //$dati = $request->all();

        $utente = session('utente');

        //$fatture = DB::SELECT('SELECT * FROM dotes where id_ditta = ' . $utente->id_ditta . ' and cd_cf = \'' . $utente->cd_cf . '\' order by numerodoc desc ');

        $page = 'cliente.catalogo';

        return View::make('admin.index', compact('page', 'utente'));

    }

    public function dettaglio_storico(Request $request, $id)
    {

        $this->is_loggato();

        $dati = $request->all();

        $utente = session('utente');

        $testa = DB::SELECT('SELECT *,IF((SELECT count(pagata) from sc where id_ditta = ' . $utente->id_ditta . ' and id_dotes = dotes.id_dotes) =(SELECT count(pagata) from sc where id_ditta = ' . $utente->id_ditta . ' and pagata = 1 and id_dotes = dotes.id_dotes),1,IF((SELECT count(pagata) from sc where id_ditta = ' . $utente->id_ditta . ' and id_dotes = dotes.id_dotes) =(SELECT count(pagata) from sc where id_ditta = ' . $utente->id_ditta . ' and pagata = 0 and id_dotes = dotes.id_dotes),0,2)) as pagata FROM dotes where id_ditta = ' . $utente->id_ditta . ' and cd_cf = \'' . $utente->cd_cf . '\' and id_dotes = \'' . $id . '\' order by numerodoc desc ');

        $righe = DB::SELECT('SELECT * FROM dorig where id_ditta = ' . $utente->id_ditta . ' and cd_cf = \'' . $utente->cd_cf . '\' and id_dotes = \'' . $id . '\'');

        $totali = DB::SELECT('SELECT * FROM dototali where id_ditta = ' . $utente->id_ditta . ' and id_dotes = \'' . $id . '\'');

        $page = 'cliente.dettaglio_storico';

        return View::make('admin.index', compact('page', 'testa', 'righe', 'utente', 'totali'));

    }

    public function dettaglio_storico_stampa(Request $request, $id)
    {

        $this->is_loggato();

        $dati = $request->all();

        $utente = session('utente');

        $testa = DB::SELECT('SELECT *,coalesce((SELECT (pagata) from sc where id_ditta = ' . $utente->id_ditta . ' and id_dotes = dotes.id_dotes order by pagata asc limit 1),\'NF\') as pagata FROM dotes where id_ditta = ' . $utente->id_ditta . ' and cd_cf = \'' . $utente->cd_cf . '\' and id_dotes = \'' . $id . '\' order by numerodoc desc ');

        $righe = DB::SELECT('SELECT * FROM dorig where id_ditta = ' . $utente->id_ditta . ' and cd_cf = \'' . $utente->cd_cf . '\' and id_dotes = \'' . $id . '\'');

        $totali = DB::SELECT('SELECT * FROM dototali where id_ditta = ' . $utente->id_ditta . ' and id_dotes = \'' . $id . '\'');


        return View::make('admin.content.cliente.dettaglio_storico_stampa', compact('testa', 'righe', 'utente', 'totali'));

    }

    public function dettaglio(Request $request, $articolo)
    {

        $this->is_loggato();

        $dati = $request->all();

        $utente = session('utente');

        if (isset($dati['aggiungi_al_carrello'])) {
            if (isset($dati['id_prodotto'])) {

                $prodotti = DB::select('SELECT * from ar where id_ditta = \'' . $utente->id_ditta . '\' and id = ' . $dati['id_prodotto']);

                $cart = Session::get('cart');
                if ($cart == '')
                    $cart = [];
                if (isset($cart[$prodotti[0]->id])) {
                    $dati['quantita'] = $dati['quantita'] + $cart[$prodotti[0]->id]['quantita'];
                }
                $img = DB::SELECT('SELECT link from arimg where id_ditta = \'' . $utente->id_ditta . '\' and cd_ar = \'' . $prodotti[0]->cd_ar . '\'');
                $cart[$prodotti[0]->id] = array(
                    "id" => $prodotti[0]->id,
                    "nome" => $prodotti[0]->cd_ar,
                    "immagine" => '',
                    "quantita" => $dati['quantita'],
                    "prezzo" => $dati['prezzo'],
                    "sconto" => $dati['sconto'],

                );

                Session::put('cart', $cart);
                Session::save();


            }

            return Redirect::to('/cliente/dettaglio/' . $prodotti[0]->id_ar . '?aggiunto=1');
        }

        $page = 'cliente.dettaglio';

        $articolo = DB::SELECT('SELECT *, (SELECT alias from aralias where cd_ar = ar.cd_ar and id_ditta = ' . $utente->id_ditta . ' LIMIT 1) as barcode FROM ar where id_ditta = ' . $utente->id_ditta . ' and id_ar = \'' . $articolo . '\' ');

        if (sizeof($articolo) > 0)
            $articolo = $articolo[0];
        else
            return Redirect::to('/cliente/articoli/?pagina=1&errore=1');

        $prezzo = DB::SELECT('SELECT * FROM lsarticolo where cd_ar = \'' . $articolo->cd_ar . '\' and id_lsrevisione = (SELECT id_lsrevisione FROM lsrevisione where id_ditta =' . $utente->id_ditta . ' AND cd_ls = (SELECT cd_ls_1 FROM cf where id_ditta =' . $utente->id_ditta . ' AND cd_cf = \'' . $utente->cd_cf . '\'))');

        $cond = ' where lsarticolo.prezzo != \'\' and ar.immagine != \'\'';

        $cond .= ' and ar.cd_ar != \'' . $articolo->cd_ar . '\'';

        if ($articolo->cd_arclasse1 != '')
            $cond .= ' and cd_arclasse1 = \'' . $articolo->cd_arclasse1 . '\' ';

        if ($articolo->cd_arclasse2 != '')
            $cond .= ' and cd_arclasse2 = \'' . $articolo->cd_arclasse2 . '\' ';

        if ($articolo->cd_arclasse3 != '')
            $cond .= ' and cd_arclasse3 = \'' . $articolo->cd_arclasse3 . '\' ';

        $simili = DB::SELECT('SELECT ar.id_ar,ar.cd_ar,ar.descrizione,lsarticolo.prezzo, ar.immagine, ar.id , ar.xqtaconf
                        FROM ar 
                        INNER JOIN lsrevisione ON lsrevisione.cd_ls = (SELECT cd_ls_1 FROM cf WHERE cd_cf  = \'' . $utente->cd_cf . '\' AND id_ditta = \'' . $utente->id_ditta . '\' ) AND lsrevisione.id_ditta = \'' . $utente->id_ditta . '\'
                        INNER JOIN lsarticolo ON lsarticolo.cd_ar = ar.cd_ar AND lsarticolo.id_ditta =\'' . $utente->id_ditta . '\' AND lsarticolo.id_lsrevisione = lsrevisione.id_lsrevisione
                        INNER JOIN cf ON cf.cd_ls_1 = lsrevisione.cd_ls AND cf.cd_cf = \'' . $utente->cd_cf . '\' ' . $cond . '
                        GROUP BY ar.id ,ar.cd_ar,ar.descrizione,lsarticolo.prezzo,ar.immagine
                        LIMIT 4');

        $scheda_tec = DB::SELECT('SELECT * FROM ararnota WHERE cd_ar = \'' . $articolo->cd_ar . '\' and id_nota  = 1 and id_ditta = ' . $utente->id_ditta . ' ');
        $scheda_web = DB::SELECT('SELECT * FROM ararnota WHERE cd_ar = \'' . $articolo->cd_ar . '\' and id_nota  = 3 and id_ditta = ' . $utente->id_ditta . ' ');

        if (sizeof($scheda_tec) > 0)
            $scheda_tec = $scheda_tec[0];
        else
            $scheda_tec = DB::SELECT('SELECT \'Nessuna Informazione\' as nota ')[0];

        if (sizeof($scheda_web) > 0)
            $scheda_web = $scheda_web[0];
        else


            $scheda_web = DB::SELECT('SELECT \'Nessuna Scheda\' as nota ')[0];

        $giacenza = DB::SELECT('SELECT Giacenza FROM ar where cd_ar = \'' . $articolo->cd_ar . '\' and id_ditta = \'' . $utente->id_ditta . '\' ')[0]->Giacenza;

        $disponibile = DB::SELECT('SELECT Disponibile FROM mggiacenza where cd_ar = \'' . $articolo->cd_ar . '\' and cd_mg = \'00001\' and id_ditta = \'' . $utente->id_ditta . '\' ');
        if (sizeof($disponibile) > 0)
            $disponibile = $disponibile[0]->Disponibile;
        else
            $disponibile = 0.00;

        $bollino_blu = DB::SELECT('SELECT if((Giacenza - Impegnato) > 0, Disponibile - Giacenza, Ordinato + (Giacenza - Impegnato)) as Disponibile FROM mggiacenza where cd_ar = \'' . $articolo->cd_ar . '\' and cd_mg = \'00001\' and id_ditta = \'' . $utente->id_ditta . '\' ');
        if (sizeof($bollino_blu) > 0) {
            $bollino_blu = $bollino_blu[0]->Disponibile;
            $first_order = DB::SELECT('SELECT * FROM dotes WHERE dataconsegna > current_date() and tipodocumento = \'O\' AND cd_cf LIKE \'F%\' AND  id_ditta = 5 and id_dotes IN (SELECT id_dotes FROM dorig WHERE id_ditta = 5 AND cd_ar = \'' . $articolo->cd_ar . '\') ORDER BY id_dotes asc ');
            if (sizeof($first_order) > 0)
                $first_order = $first_order[0]->dataconsegna;
            else
                $first_order = '';
        } else {
            $bollino_blu = 0.00;
            $first_order = '';
        }

        $immediato = DB::SELECT('SELECT (Giacenza - Impegnato) as Immediato FROM mggiacenza where cd_ar = \'' . $articolo->cd_ar . '\' and cd_mg = \'00001\' and id_ditta = \'' . $utente->id_ditta . '\' ');
        if (sizeof($immediato) > 0)
            $immediato = $immediato[0]->Immediato;
        else
            $immediato = 0.00;

        $ordinato = DB::SELECT('SELECT Ordinato FROM ar where cd_ar = \'' . $articolo->cd_ar . '\' and id_ditta = \'' . $utente->id_ditta . '\' ')[0]->Ordinato;

        $immagine = DB::SELECT('SELECT * FROM arimg where id_ditta = ' . $utente->id_ditta . ' and cd_ar = \'' . $articolo->cd_ar . '\' order by riga asc');

        $ditta = DB::SELECT('select * from ditta where id= \'' . $utente->id_ditta . '\'')[0]->token;

        $count_img = sizeof($immagine);

        return View::make('admin.index', compact('page', 'first_order', 'articolo', 'prezzo', 'bollino_blu', 'immediato', 'simili', 'scheda_tec', 'scheda_web', 'utente', 'ordinato', 'giacenza', 'disponibile', 'immagine', 'ditta', 'count_img'));

    }

    public
    function torna_admin()
    {

        $this->is_loggato();
        $utente = session('utente');


        $utenti = DB::select('SELECT * from utenti where id = ' . $utente->torna_admin);

        if (sizeof($utenti) > 0) {

            $utente = $utenti[0];
            $utente->torna_admin = 0;
            session(['utente' => $utente]);
            session()->save();

            if ($utente->tipologia == 1) return Redirect::to('admin/index');
            if ($utente->tipologia == 2) return Redirect::to('cliente/index');
        }

    }

    /*
        public function dettagli_modbus($id,Request $request){

            $this->is_loggato();
            $dati = $request->all();
            $utente = session('utente');


            if(isset($dati['invia_scrittura'])){
                unset($dati['invia_scrittura']);

                foreach($dati['scrittura'] as $key => $value){

                    if($value != '') {

                        $insert['id_plc'] = $id;
                        $insert['indirizzo'] = $key;
                        $insert['valore'] = $value;
                        DB::table('modbus_scritture')->insert($insert);
                    }


                }

                return Redirect::to('cliente/dettagli_modbus/'.$id);
            }

            if(isset($dati['elimina_scrittura'])){
                unset($dati['elimina_scrittura']);
                DB::table('modbus_scritture')->where('id',$dati['id'])->delete();
                return Redirect::to('cliente/dettagli_modbus/'.$id);
            }

            $plc = DB::select('SELECT * from plc where id = '.$id);
            if(sizeof($plc) > 0){
                $plc = $plc[0];

                $page = 'cliente.dettagli_modbus';
                $configurazione = DB::select('SELECT * from modbus_configurazione where id_plc = '.$id);
                $letture = DB::select('SELECT l.*,c.nome from modbus_letture l JOIN modbus_configurazione c ON l.indirizzo = c.indirizzo and c.lettura = 1 and l.id_plc = c.id_plc and l.id_plc = '.$id.' order by timestamp desc limit 0,200');
                $scritture = DB::select('SELECT s.*,c.nome from modbus_scritture s JOIN modbus_configurazione c ON s.indirizzo = c.indirizzo and s.id_plc = c.id_plc and s.id_plc = '.$id.' and s.ricevuto_plc = 0 and c.scrittura = 1 order by timestamp desc limit 0,200');
                return View::make('admin.index',compact('page','utente','plc','configurazione','letture','scritture'));
            }


        }

        public function configura_modbus($id,Request $request){

            $this->is_loggato();
            $dati = $request->all();
            $utente = session('utente');

            if(isset($dati['aggiungi'])){
                unset($dati['aggiungi']);
                $dati['id_plc'] = $id;
                DB::table('modbus_configurazione')->insert($dati);

                return Redirect::to('cliente/configura_modbus/'.$id);
            }

            if(isset($dati['modifica'])){
                unset($dati['modifica']);
                $dati['id_plc'] = $id;
                DB::table('modbus_configurazione')->where('id',$dati['id'])->update($dati);
                return Redirect::to('cliente/configura_modbus/'.$id);
            }

            if(isset($dati['elimina'])){
                unset($dati['elimina']);
                $dati['id_plc'] = $id;
                DB::table('modbus_configurazione')->where('id',$dati['id'])->delete();
                return Redirect::to('cliente/configura_modbus/'.$id);
            }

            $plc = DB::select('SELECT * from plc where id = '.$id);
            if(sizeof($plc) > 0){
                $plc = $plc[0];
                $page = 'cliente.configurazione_modbus';
                $configurazione = DB::select('SELECT * from modbus_configurazione where id_plc = '.$plc->id.' order by indirizzo asc');
                return View::make('admin.index',compact('page','utente','plc','configurazione'));
            }


        }

        public function dettagli_s7($id,Request $request){

            $this->is_loggato();
            $dati = $request->all();
            $utente = session('utente');


            if(isset($dati['invia_scrittura'])){
                unset($dati['invia_scrittura']);

                foreach($dati['scrittura'] as $key => $value){

                    if($value != '') {

                        $insert['id_plc'] = $id;
                        $insert['indirizzo'] = $key;
                        $insert['valore'] = $value;
                        DB::table('s7_scritture')->insert($insert);
                    }


                }

                return Redirect::to('cliente/dettagli_s7/'.$id);
            }

            if(isset($dati['elimina_scrittura'])){
                unset($dati['elimina_scrittura']);
                DB::table('s7_scritture')->where('id',$dati['id'])->delete();
                return Redirect::to('cliente/dettagli_s7/'.$id);
            }

            $plc = DB::select('SELECT * from plc where id = '.$id);
            if(sizeof($plc) > 0){
                $plc = $plc[0];

                $page = 'cliente.dettagli_s7';
                $configurazione = DB::select('SELECT * from s7_configurazione where id_plc = '.$id);
                $letture = DB::select('SELECT l.*,c.nome from s7_letture l JOIN s7_configurazione c ON l.indirizzo = c.indirizzo and l.id_plc = c.id_plc and l.id_plc = '.$id.' order by timestamp desc limit 0,200');
                $scritture = DB::select('SELECT s.*,c.nome from s7_scritture s JOIN s7_configurazione c ON s.indirizzo = c.indirizzo and s.id_plc = c.id_plc and s.id_plc = '.$id.' and s.ricevuto_plc = 0 and c.scrittura = 1 order by timestamp desc limit 0,200');
                return View::make('admin.index',compact('page','utente','plc','configurazione','letture','scritture'));
            }


        }

        public function configura_s7($id,Request $request){

            $this->is_loggato();
            $dati = $request->all();
            $utente = session('utente');

            if(isset($dati['aggiungi'])){
                unset($dati['aggiungi']);
                $dati['id_plc'] = $id;
                DB::table('s7_configurazione')->insert($dati);

                return Redirect::to('cliente/configura_s7/'.$id);
            }

            if(isset($dati['modifica'])){
                unset($dati['modifica']);
                $dati['id_plc'] = $id;
                DB::table('s7_configurazione')->where('id',$dati['id'])->update($dati);
                return Redirect::to('cliente/configura_s7/'.$id);
            }

            if(isset($dati['elimina'])){
                unset($dati['elimina']);
                $dati['id_plc'] = $id;
                DB::table('s7_configurazione')->where('id',$dati['id'])->delete();
                return Redirect::to('cliente/configura_s7/'.$id);
            }

            $plc = DB::select('SELECT * from plc where id = '.$id);
            if(sizeof($plc) > 0){
                $plc = $plc[0];
                $page = 'cliente.configurazione_s7';
                $configurazione = DB::select('SELECT * from s7_configurazione where id_plc = '.$plc->id.' order by indirizzo asc');
                return View::make('admin.index',compact('page','utente','plc','configurazione'));
            }


        }

        public function dettagli_opcua($id,Request $request){

            $this->is_loggato();
            $dati = $request->all();
            $utente = session('utente');


            if(isset($dati['invia_scrittura'])){
                unset($dati['invia_scrittura']);

                foreach($dati['scrittura'] as $key => $value){

                    if($value != '') {
                        $insert['id_plc'] = $id;
                        $insert['indirizzo'] = $key;
                        $insert['valore'] = $value;
                        DB::table('opcua_scritture')->insert($insert);
                    }


                }

                return Redirect::to('cliente/dettagli_opcua/'.$id);
            }

            if(isset($dati['elimina_scrittura'])){
                unset($dati['elimina_scrittura']);
                DB::table('opcua_scritture')->where('id',$dati['id'])->delete();
                return Redirect::to('cliente/dettagli_opcua/'.$id);
            }

            $plc = DB::select('SELECT * from plc where id = '.$id);
            if(sizeof($plc) > 0){
                $plc = $plc[0];

                $page = 'cliente.dettagli_opcua';
                $configurazione = DB::select('SELECT * from opcua_configurazione where id_plc = '.$id);
                $letture = DB::select('SELECT l.*,c.nome from opcua_letture l JOIN opcua_configurazione c ON l.indirizzo = c.indirizzo and l.id_plc = c.id_plc and l.id_plc = '.$id.' order by timestamp desc limit 0,200');
                $scritture = DB::select('SELECT s.*,c.nome from opcua_scritture s JOIN opcua_configurazione c ON s.indirizzo = c.indirizzo and s.id_plc = c.id_plc and s.id_plc = '.$id.' and s.ricevuto_plc = 0 order by timestamp desc limit 0,200');
                return View::make('admin.index',compact('page','utente','plc','configurazione','letture','scritture'));
            }


        }

        public function configura_opcua($id,Request $request){

            $this->is_loggato();
            $dati = $request->all();
            $utente = session('utente');

            if(isset($dati['aggiungi'])){
                unset($dati['aggiungi']);
                $dati['id_plc'] = $id;
                DB::table('opcua_configurazione')->insert($dati);

                return Redirect::to('cliente/configura_opcua/'.$id);
            }

            if(isset($dati['modifica'])){
                unset($dati['modifica']);
                $dati['id_plc'] = $id;
                DB::table('opcua_configurazione')->where('id',$dati['id'])->update($dati);
                return Redirect::to('cliente/configura_opcua/'.$id);
            }

            if(isset($dati['elimina'])){
                unset($dati['elimina']);
                $dati['id_plc'] = $id;
                DB::table('opcua_configurazione')->where('id',$dati['id'])->delete();
                return Redirect::to('cliente/configura_opcua/'.$id);
            }

            $plc = DB::select('SELECT * from plc where id = '.$id);
            if(sizeof($plc) > 0){
                $plc = $plc[0];
                $page = 'cliente.configurazione_opcua';
                $configurazione = DB::select('SELECT * from opcua_configurazione where id_plc = '.$plc->id.' order by indirizzo asc');
                return View::make('admin.index',compact('page','utente','plc','configurazione'));
            }


        }

        public function dettagli_vixion($id,Request $request){

            $this->is_loggato();
            $dati = $request->all();
            $utente = session('utente');


            $plc = DB::select('SELECT * from plc where id = '.$id);
            if(sizeof($plc) > 0){
                $plc = $plc[0];

                $page = 'cliente.dettagli_vixion';
                $letture = DB::select('SELECT * from vixion_letture where id_plc = '.$id.' order by start desc limit 0,200');
                return View::make('admin.index',compact('page','utente','plc','letture'));
            }


        }
        public function dettagli_mtconnect($id,Request $request){

            $this->is_loggato();
            $dati = $request->all();
            $utente = session('utente');


            $plc = DB::select('SELECT * from plc where id = '.$id);
            if(sizeof($plc) > 0){
                $plc = $plc[0];

                $page = 'cliente.dettagli_mtconnect';
                $letture = DB::select('SELECT * from mtconnect_letture where indirizzo = 1 and id_plc = '.$id.' order by timestamp desc limit 0,200');
                return View::make('admin.index',compact('page','utente','plc','letture'));
            }


        }
    */

    public
    function articoli(Request $request)
    {

        $this->is_loggato();
        $dati = $request->all();
        $utente = session('utente');

        if (isset($dati['aggiungi_al_carrello'])) {

            if (isset($dati['id_prodotto'])) {

                if (isset($dati['pagina'])) {
                    $pagina = $dati['pagina'];
                    unset($dati['pagina']);
                }

                $prodotti = DB::select('SELECT * from ar where id_ditta = \'' . $utente->id_ditta . '\' and id = ' . $dati['id_prodotto']);

                $cart = Session::get('cart');
                if ($cart == '')
                    $cart = [];
                if (isset($cart[$prodotti[0]->id])) {
                    $dati['quantita'] = $dati['quantita'] + $cart[$prodotti[0]->id]['quantita'];
                }

                $cart[$prodotti[0]->id] = array(
                    "id" => $prodotti[0]->id,
                    "nome" => $prodotti[0]->cd_ar,
                    "immagine" => $prodotti[0]->immagine,
                    "quantita" => $dati['quantita'],
                    "prezzo" => $dati['prezzo'],
                    "sconto" => $dati['sconto'],
                );

                Session::put('cart', $cart);
                Session::save();

            }
            if ($pagina != '')
                return Redirect::to('/cliente/articoli/?pagina=' . $pagina . '&aggiunto=1');
            else
                return Redirect::to('/cliente/articoli/?pagina=1&aggiunto=1');
        }


        $page = 'cliente.articoli';

        return View::make('admin.index', compact('page', 'utente'));


    }

    /* public function odl(Request $request){

         $this->is_loggato();
         $dati = $request->all();
         $utente = session('utente');

         if(isset($dati['aggiungi'])){
             unset($dati['aggiungi']);
             $dati['data'] = date('Y-m-d H:i:s', strtotime(str_replace('/', '-',$dati['data'])));
             $dati['id_utente'] = $utente->id;
             $insert_riga['id_odl'] = DB::table('odl')->insertGetId($dati);

             $fasi = DB::select('SELECT * from fasi_articoli where id_articolo ='.$dati['id_articolo']);
             foreach($fasi as $f){
                 $insert_riga['id_utente'] = $dati['id_utente'];
                 $insert_riga['id_fase'] = $f->id_fase;
                 $insert_riga['id_plc'] = $f->id_plc;
                 $insert_riga['qta'] = $dati['qta'];
                 DB::table('odl_righe')->insert($insert_riga);
             }
             return Redirect::to('cliente/odl');
         }

         if(isset($dati['modifica'])){
             unset($dati['modifica']);
             $dati['id_utente'] = $utente->id;
             $dati['data'] = date('Y-m-d H:i:s', strtotime(str_replace('/', '-',$dati['data'])));
             DB::table('odl')->where('id',$dati['id'])->update($dati);
             return Redirect::to('cliente/odl');

         }

         if(isset($dati['elimina'])){
             unset($dati['elimina']);
             $dati['id_utente'] = $utente->id;
             DB::table('odl')->where('id',$dati['id'])->delete();
             DB::table('odl_righe')->where('Id_odl',$dati['id'])->delete();
             return Redirect::to('cliente/odl');
         }

         $num_odl = DB::select('SELECT ifnull(max(numero)+1,1) as numero from odl where id_utente = '.$utente->id)[0]->numero;
         $odl = DB::select('SELECT o.*,a.descrizione as articolo from odl o LEFT JOIN articoli a ON a.id = o.id_articolo  where o.id_utente='.$utente->id.' order by data desc,id desc');
         $articoli = DB::select('SELECT * from articoli where id_utente='.$utente->id);

         $page = 'cliente.odl';
         return View::make('admin.index',compact('page','utente','odl','articoli','num_odl'));


     }

     public function dettaglio_odl($id_odl,Request $request){

         $this->is_loggato();
         $dati = $request->all();
         $utente = session('utente');

         if(isset($dati['start_fase'])){
             unset($dati['start_fase']);

             $odl = DB::select('SELECT * from odl where id = '.$id_odl);
             if(sizeof($odl) > 0) {
                 $odl = $odl[0];
                 DB::update('update odl set stato = 1 where stato = 0 and id ='.$odl->id);
                 $righe = DB::SELECT('SELECT * from odl_righe where id=' . $dati['id']);
                 if (sizeof($righe) > 0) {
                     $riga = $righe[0];
                     DB::update('update odl_righe set inizio = NOW() where id=' . $dati['id']);

                     $fasi = DB::select('SELECT * from fasi where id_utente = ' . $utente->id . ' and id =' . $riga->id_fase);
                     if (sizeof($fasi) > 0) {
                         $fase = $fasi[0];

                         if ($fase->numero_bolla_plc > 0) {
                             if ($fase->protocollo == 'S7') {
                                 $bolla_plc = DB::select('SELECT * from s7_configurazione where id= ' . $fase->numero_bolla_plc);

                                 if (sizeof($bolla_plc) > 0) {
                                     $bolla_plc = $bolla_plc[0];

                                     $insert['id_plc'] = $bolla_plc->id_plc;
                                     $insert['indirizzo'] = $bolla_plc->indirizzo;
                                     $insert['ricevuto_plc'] = 0;
                                     $insert['valore'] = $odl->numero;

                                     DB::table('s7_scritture')->insert($insert);

                                 }
                             }
                         }

                         if ($fase->quantita_plc > 0) {
                             if ($fase->protocollo == 'S7') {
                                 $quantita_plc = DB::select('SELECT * from s7_configurazione where id= ' . $fase->quantita_plc);

                                 if (sizeof($quantita_plc) > 0) {
                                     $quantita_plc = $quantita_plc[0];

                                     $insert['id_plc'] = $quantita_plc->id_plc;
                                     $insert['indirizzo'] = $quantita_plc->indirizzo;
                                     $insert['ricevuto_plc'] = 0;
                                     $insert['valore'] = intval($odl->qta);

                                     DB::table('s7_scritture')->insert($insert);

                                 }

                             }
                         }

                         $articoli = DB::select('SELECT * from articoli where id = '.$odl->id_articolo);
                         if(sizeof($articoli) > 0){
                             $articolo = $articoli[0];

                             if($articolo->protocollo1 == 'S7'){

                                 $campo_extra_plc1 = DB::select('SELECT * from s7_configurazione where id= ' . $articolo->id_variabile_plc1);

                                 if (sizeof($campo_extra_plc1) > 0) {
                                     $campo_extra_plc1 = $campo_extra_plc1[0];

                                     $insert['id_plc'] = $campo_extra_plc1->id_plc;
                                     $insert['indirizzo'] = $campo_extra_plc1->indirizzo;
                                     $insert['ricevuto_plc'] = 0;
                                     $insert['valore'] = $articolo->campo1;

                                     DB::table('s7_scritture')->insert($insert);

                                 }

                             }
                         }

                     }

                 }
             }

             return Redirect::to('cliente/dettaglio_odl/'.$id_odl);
         }

         if(isset($dati['fine_fase'])){
             unset($dati['fine_fase']);
             $righe = DB::SELECT('SELECT * from odl_righe where id='.$dati['id']);
             if(sizeof($righe) > 0){
                 $riga = $righe[0];
                 ApiController::chudi_fase($dati['id']);
                 ApiController::chiudi_odl($riga->id_odl);

                 return Redirect::to('cliente/dettaglio_odl/'.$id_odl);
             }
         }


         $odl = DB::select('SELECT o.*,a.descrizione as articolo from odl o LEFT JOIN articoli a ON a.id = o.id_articolo where o.id='.$id_odl);
         if(sizeof($odl) > 0) {
             $odl = $odl[0];
             $odl_righe = DB::select('SELECT o.*,f.descrizione as fase,p.descrizione as plc from odl_righe o LEFT JOIN fasi f ON f.id = o.id_fase LEFT JOIN plc p ON p.id = o.id_plc where o.id_odl = ' . $id_odl);
             $page = 'cliente.dettaglio_odl';
             return View::make('admin.index', compact('page', 'utente', 'odl', 'odl_righe'));
         }


     }*/

    public
    function carrello(Request $request)
    {

        $this->is_loggato();
        $dati = $request->all();
        $utente = session('utente');

        $max_disp = 0;

        $ordine = 0;
        if (isset($_GET['max_disp'])) {
            unset($_GET['max_disp']);
            $max_disp = 1;
        }
        if (isset($_GET['ordine'])) {
            unset($_GET['ordine']);
            $ordine = 1;
        }
        if (isset($dati['crea_documento'])) {
            if (isset($_FILES)) {
                $target_dir = "uploads/";
                $target_file = $target_dir . basename($_FILES["file_ldv"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                $target_file = $target_dir . 'file_ldv_' . rand() . '.' . $imageFileType;

                if (file_exists($target_file)) {
                    // echo "Sorry, file already exists.";
                    $uploadOk = 0;
                }

                if ($imageFileType != "pdf" && $imageFileType != "xls" && $imageFileType != "xlsx") {
                    // echo "Sorry, PDF,XLS & XLSX files are allowed.";
                    $uploadOk = 0;
                }
                if ($uploadOk == 0) {
                    //echo "Sorry, your file was not uploaded.";
                } else {
                    if (move_uploaded_file($_FILES["file_ldv"]["tmp_name"], $target_file)) {
                        //  echo "The file ". htmlspecialchars( basename( $_FILES["file_ldv"]["name"])). " has been uploaded.";
                    } else {
                        // echo "Sorry, there was an error uploading your file.";
                    }
                }
                if ($_FILES['file_ldv']['name'] == '')
                    $target_file = '';
            }
            $cart = Session::get('cart');

            if (sizeof($cart) > 0) {
                foreach ($cart as $c) {

                    $insert['cd_ar'] = $c['nome'];
                    //$insert['descrizione'] = DB::SELECT('SELECT * FROM ar WHERE cd_ar = \''.$c['nome'].'\' and id_ditta = \''.$utente->id_ditta.'\'')[0]->descrizione;
                    $ar = DB::SELECT('SELECT * FROM ar LEFT JOIN ararmisura on ararmisura.cd_ar = ar.cd_ar and ararmisura.id_ditta = \'' . $utente->id_ditta . '\' and ararmisura.umfatt = 1 WHERE ar.cd_ar = \'' . $c['nome'] . '\' and ar.id_ditta = \'' . $utente->id_ditta . '\'');

                    if ($ar[0]->aliquota != '')
                        $insert['aliquota'] = $insert['aliquota'][0]->aliquota;
                    else
                        $insert['aliquota'] = '22';

                    $insert['cd_aliquota'] = DB::SELECT('SELECT * FROM aliquota WHERE aliquota = 22 and id_ditta = \'' . $utente->id_ditta . '\'')[0]->cd_aliquota;
                    $insert['cd_cfsede'] = '';
                    $agente = DB::SELECT('SELECT * FROM cf WHERE cd_cf = \'' . $utente->cd_cf . '\' and id_ditta = \'' . $utente->id_ditta . '\'');
                    if (sizeof($agente) > 0)
                        $insert['cd_agente_1'] = $agente[0]->cd_agente_1;
                    else
                        $insert['cd_agente_1'] = '';
                    $insert['xcolli'] = '';
                    $insert['xbancali'] = '';
                    $insert['note'] = ($c['note']) ? $c['note'] : '';
                    $insert['scontoriga'] = ($c['sconto']) ? $c['sconto'] : '';
                    $insert['qta'] = $c['quantita'];
                    $insert['prezzo_unitario'] = str_replace(',', '.', $c['prezzo']);
                    $insert['totale'] = floatval($c['prezzo']) * floatval($c['quantita']);
                    $insert['imposta'] = floatval(floatval($insert['totale']) / 100) * floatval($insert['aliquota']);
                    $insert['id_ditta'] = $utente->id_ditta;
                    $insert['cd_cf'] = $utente->cd_cf;
                    $insert['da_inviare'] = 1;
                    $insert['send_mail'] = 1;
                    $insert['WEB'] = 1;
                    $insert['allegato'] = ($target_file != '') ? URL::ASSET($target_file) : null;
                    $insert['cd_armisura'] = $ar[0]->cd_armisura;
                    //$insert['cd_armisura'] = $ar[0]->cd_armisura;
                    if (isset($dati['data_ritiro']))
                        $insert['dataconsegna'] = $dati['data_ritiro'];

                    DB::table('cart')->insert($insert);

                }
            }

            Session::put('cart', '');
            Session::save();

            return Redirect::to('/cliente/carrello?ordine=1');
        }

        if (isset($dati['elimina_riga'])) {
            $cart = Session::get('cart');
            unset($cart[$dati['id']]);
            Session::put('cart', $cart);
            Session::save();
        }

        if (isset($dati['diminuisci'])) {
            $cart = Session::get('cart');
            $cart[$dati['id']]['quantita'] -= 1;
            if ($cart[$dati['id']]['quantita'] <= 0) unset($cart[$dati['id']]);
            Session::put('cart', $cart);
            Session::save();
        }

        if (isset($dati['aggiungi'])) {
            $cart = Session::get('cart');
            $cart[$dati['id']]['quantita'] += 1;
            if ($cart[$dati['id']]['quantita'] <= 0) unset($cart[$dati['id']]);
            Session::put('cart', $cart);
            Session::save();
        }


        $cart = Session::get('cart');

        $xqtaconf = DB::SELECT('SELECT cd_ar,COALESCE(xqtaconf,1) as xqtaconf FROM ar WHERE  id_ditta = \'' . $utente->id_ditta . '\'');
        $barcode = DB::SELECT('SELECT DISTINCT cd_ar,alias FROM aralias WHERE  id_ditta = \'' . $utente->id_ditta . '\'');

        if ($cart != null) {
            foreach ($cart as $chiave => $c) {
                $cart[$chiave]['barcode'] = '';
                foreach ($xqtaconf as $x)
                    if ($x->cd_ar == $c['nome']) {
                        $cart[$chiave]['xqtaconf'] = ($x->xqtaconf != '0.00') ? $x->xqtaconf : '1.00';
                    }
                foreach ($barcode as $b)
                    if ($b->cd_ar == $c['nome']) {
                        $cart[$chiave]['barcode'] = $b->alias;
                    }
                if ($c['immagine'] == ' ' || $c['immagine'] == '' || $c['immagine'] == null) {
                    $link = DB::SELECT('SELECT IFNULL(link,\'\') as link from arimg where riga = 1 and id_ditta = 5 and cd_ar = \'' . $c['nome'] . '\' ');
                    if (sizeof($link) > 0) {
                        $cart[$chiave]['immagine'] = $link[0]->link;
                    } else {
                        $cart[$chiave]['immagine'] = '';
                    }
                }
                if (!isset($cart[$chiave]['note']))
                    $cart[$chiave]['note'] = '';
            }
        }

        Session::put('cart', $cart);

        Session::save();


        $page = 'cliente.carrello';

        return View::make('admin.index', compact('page', 'cart', 'utente', 'ordine', 'max_disp'));
    }

    public
    function ordini(Request $request)
    {

        $this->is_loggato();
        $dati = $request->all();
        $utente = session('utente');

        $ordini = DB::SELECT('select dotes.*,dototali.totdocumentov from dotes left join dototali on dototali.id_dotes = dotes.id_dotes where dotes.id_ditta = \'' . $utente->id_ditta . '\' and dotes.cd_cf  = \'' . $utente->cd_cf . '\' ORDER BY dotes.id DESC');
        $page = 'cliente.ordini';
        return View::make('admin.index', compact('page', 'utente', 'ordini'));
    }

    public
    function ftp(Request $request)
    {

        $this->is_loggato();

        $dati = $request->all();

        $utente = session('utente');

        $giacenze = DB::SELECT('SELECT  if(f.disponibile<=0,0,f.disponibile)-if(f.ordinato<=0,0,f.ordinato) as immediato,if(f.disponibile<=0,0,f.disponibile) as disponibile,if(f.giacenza<=0,0,f.giacenza) as giacenza ,f.cd_ar,f.prezzo,f.descrizione FROM (
                                        SELECT * from ftp_gtr WHERE id_lsrevisione = (SELECT MAX(id_lsrevisione) FROM lsrevisione WHERE cd_ls = (SELECT cf.cd_ls_1 from cf WHERE cf.id_ditta = 5 AND cd_cf = \'C000003\') AND id_ditta = 5)
                                        ) f');

        if (sizeof($giacenze) > 0) {
            $data = $giacenze;

            /*
                $url = 'https://gtrimport.it/ftp.csv';
                $fileContents = file_get_contents($url);
                if ($fileContents === false) {
                    return 'Errore nel download del file.';
                }
            */

            $localFilePath = storage_path('/ftp.csv');

            $file = fopen($localFilePath, 'w+');

            if ($file === false) {
                $error = error_get_last();
                return 'Errore nell\'apertura del file: ' . $error['message'];
            }

            $directory = dirname($localFilePath);
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
            foreach ($data as $row) {

                $forftp = array(strval($row->cd_ar), strval($row->giacenza), strval($row->disponibile), strval($row->descrizione), strval($row->prezzo));

                $result = fputcsv($file, $forftp, ';');

                // Verifica se ci sono errori durante la scrittura nel file
                if ($result === false) {
                    $error = error_get_last();
                    fclose($file); // Chiudi il file prima di restituire l'errore
                    return 'Errore nella scrittura del file: ' . $error['message'];
                }
            }

            fclose($file);


            foreach ($data as $row) {

                $row2[] = array(strval($row->cd_ar), strval($row->giacenza), strval($row->disponibile), strval($row->descrizione), strval($row->prezzo));
            }

            return Excel::download(new ExcelExport($row2), 'ftp.csv');


        }
        return redirect('/ftp.csv');

        /*
            $page = 'cliente.ftp';
            return View::make('admin.index', compact('page', 'utente'));
        */
    }

    public
    function csv_dedicato($token, Request $request)
    {

        //$this->is_loggato();

        $cd_cf = DB::SELECT('SELECT * FROM xFtp where token = \'' . $token . '\' and id_ditta = 5');

        if (sizeof($cd_cf) <= 0)
            return response('{"error": "authentication failed"}', 403);
        else
            $cd_cf = $cd_cf[0]->cd_cf;

        $giacenze = DB::SELECT('SELECT if(if(f.disponibile<=0,0,f.disponibile)-if(f.ordinato<=0,0,f.ordinato) <= 0,0,if(f.disponibile<=0,0,f.disponibile)-if(f.ordinato<=0,0,f.ordinato)) as immediato,if(f.disponibile<=0,0,f.disponibile) as disponibile,if(f.giacenza<=0,0,f.giacenza) as giacenza,f.cd_ar,f.prezzo,f.descrizione,f.barcode,f.copertina,f.first_ordine FROM (
                                        SELECT * from ftp_gtr WHERE id_lsrevisione = (SELECT MAX(id_lsrevisione) FROM lsrevisione WHERE cd_ls = (SELECT cf.cd_ls_1 from cf WHERE cf.id_ditta = 5 AND cd_cf = \'' . $cd_cf . '\') AND id_ditta = 5)
                                        ) f');

        if (sizeof($giacenze) > 0) {
            $data = $giacenze;
            foreach ($data as $row) {
                $row2[] = array(strval($row->cd_ar), strval($row->giacenza), strval($row->disponibile), strval($row->immediato), strval($row->descrizione), strval($row->prezzo), strval($row->barcode), strval($row->copertina), strval($row->first_ordine));
            }
            return Excel::download(new ExcelExport($row2), 'ftp.csv');
        }

    }

    public
    function excel_dedicato($token, Request $request)
    {

        //$this->is_loggato();

        $cd_cf = DB::SELECT('SELECT * FROM xFtp where token = \'' . $token . '\' and id_ditta = 5');

        if (sizeof($cd_cf) <= 0)
            return response('{"error": "authentication failed"}', 403);
        else
            $cd_cf = $cd_cf[0]->cd_cf;

        $giacenze = DB::SELECT('SELECT if(if(f.disponibile<=0,0,f.disponibile)-if(f.ordinato<=0,0,f.ordinato) <= 0,0,if(f.disponibile<=0,0,f.disponibile)-if(f.ordinato<=0,0,f.ordinato)) as immediato,if(f.disponibile<=0,0,f.disponibile) as disponibile,if(f.giacenza<=0,0,f.giacenza) as giacenza ,f.cd_ar,f.prezzo,f.descrizione,f.barcode,f.copertina,f.first_ordine FROM (
                                        SELECT * from ftp_gtr WHERE id_lsrevisione = (SELECT MAX(id_lsrevisione) FROM lsrevisione WHERE cd_ls = (SELECT cf.cd_ls_1 from cf WHERE cf.id_ditta = 5 AND cd_cf = \'' . $cd_cf . '\') AND id_ditta = 5)
                                        ) f');

        if (sizeof($giacenze) > 0) {
            $data = $giacenze;
            foreach ($data as $row) {
                $row2[] = array(strval($row->cd_ar), strval($row->giacenza), strval($row->disponibile), strval($row->immediato), strval($row->descrizione), strval($row->prezzo), strval($row->barcode), strval($row->copertina), strval($row->first_ordine));
            }
            return Excel::download(new ExcelExport($row2), 'ftp.xlsx');
        }

    }


    /*   public function dettaglio_ordine(Request $request,$id){

           $this->is_loggato();
           $dati = $request->all();
           $utente = session('utente');
           $ditta = DB::SELECT('select * from ditta where id = \''.$utente->id_ditta.'\' ')[0];
           $ordini = DB::SELECT('select * from dotes where id_ditta = \''.$utente->id_ditta.'\' and cd_cf  = \''.$utente->cd_cf.'\' and id = \''.$id.'\'')[0];
           $righe = DB::SELECT('select * from dorig where id_ditta = \''.$utente->id_ditta.'\' and cd_cf  = \''.$utente->cd_cf.'\' and id_dotes = \''.$ordini->id_dotes.'\'');
           $totali = DB::SELECT('select * from dototali where id_ditta = \''.$utente->id_ditta.'\' and id_dotes = \''.$ordini->id_dotes.'\'')[0];
           $page = 'cliente.dettaglio_ordini';
           return View::make('admin.index', compact('page', 'utente','ordini','righe','totali','ditta'));
       }
       public function fasi(Request $request){

           $this->is_loggato();
           $dati = $request->all();
           $utente = session('utente');

           if(isset($dati['aggiungi'])){
               unset($dati['aggiungi']);
               $dati['id_utente'] = $utente->id;
               DB::table('fasi')->insert($dati);
               return Redirect::to('cliente/fasi');
           }

           if(isset($dati['modifica'])){
               unset($dati['modifica']);
               $dati['id_utente'] = $utente->id;
               DB::table('fasi')->where('id',$dati['id'])->update($dati);
               return Redirect::to('cliente/fasi');
           }

           if(isset($dati['elimina'])){
               unset($dati['elimina']);
               $dati['id_utente'] = $utente->id;
               DB::table('fasi')->where('id',$dati['id'])->delete();
               return Redirect::to('cliente/fasi');
           }

           $plc = DB::select('SELECT * from plc where id_utente = '.$utente->id);
           $fasi = DB::select('SELECT * from fasi where id_utente = '.$utente->id);

           $variabili_plc_s7_scrittura = DB::select('SELECT s7.id,CONCAT(plc.descrizione," -> ",s7.nome) as nome from s7_configurazione s7
                   JOIN plc ON plc.id_utente = '.$utente->id.' and plc.id = s7.id_plc and s7.scrittura = 1');

           $variabili_plc_s7_lettura = DB::select('SELECT s7.id,CONCAT(plc.descrizione," -> ",s7.nome) as nome from s7_configurazione s7
                   JOIN plc ON plc.id_utente = '.$utente->id.' and plc.id = s7.id_plc and s7.lettura = 1');


           $page = 'cliente.fasi';
           return View::make('admin.index',compact('page','utente','fasi','plc','variabili_plc_s7_scrittura','variabili_plc_s7_lettura'));


       }

       public function materiali(Request $request){

           $this->is_loggato();
           $dati = $request->all();
           $utente = session('utente');

           if(isset($dati['aggiungi'])){
               unset($dati['aggiungi']);
               $dati['id_utente'] = $utente->id;
               DB::table('materiali')->insert($dati);
               return Redirect::to('cliente/materiali');
           }

           if(isset($dati['modifica'])){
               unset($dati['modifica']);
               $dati['id_utente'] = $utente->id;
               DB::table('materiali')->where('id',$dati['id'])->update($dati);
               return Redirect::to('cliente/materiali');
           }

           if(isset($dati['elimina'])){
               unset($dati['elimina']);
               $dati['id_utente'] = $utente->id;
               DB::table('materiali')->where('id',$dati['id'])->delete();
               return Redirect::to('cliente/materiali');
           }

           if(isset($dati['carica_materiale'])){
               unset($dati['carica_materiale']);

               $dati['id_utente'] = $utente->id;
               $dati['car'] = 1;
               DB::table('mgmov')->insertGetId($dati);

               return Redirect::to('cliente/materiali');
           }

           if(isset($dati['scarica_materiale'])){
               unset($dati['scarica_materiale']);

               $dati['id_utente'] = $utente->id;
               $dati['qta'] = $dati['qta'] * -1;
               $dati['sca'] = 1;
               DB::table('mgmov')->insertGetId($dati);

               return Redirect::to('cliente/materiali');
           }

           if(isset($dati['rettifica_materiale'])){
               unset($dati['rettifica_materiale']);

               $giacenza = DB::select('SELECT ifnull(sum(mgmov.qta),0) as giacenza from mgmov where id_materiale = '.$dati['id_materiale'])[0]->giacenza;

               $dati['id_utente'] = $utente->id;
               $dati['qta'] = $dati['qta'] - $giacenza;
               $dati['ret'] = 1;
               DB::table('mgmov')->insertGetId($dati);

               return Redirect::to('cliente/materiali');
           }

           $materiali = DB::select('SELECT m.*,ifnull(sum(mgmov.qta),0) as giacenza from materiali m
               LEFT JOIN mgmov ON mgmov.id_materiale = m.id and mgmov.id_utente = m.id_utente
               where m.id_utente = '.$utente->id.'
               group by m.id');

           foreach($materiali as $m){
               $m->mgmov = DB::select('SELECT * from mgmov where id_materiale  ='.$m->id.' and id_utente = '.$utente->id);
           }

           $page = 'cliente.materiali';
           return View::make('admin.index',compact('page','utente','materiali'));

       }
    */
    public
    function logout()
    {
        $token = session('ditta');
        session()->flush();
        return Redirect::to('login/' . $token);
    }

    /**
     * Verifica se l'utente è loggato
     * @return \Illuminate\Http\RedirectResponse
     */

    public
    function is_loggato()
    {
        if (!session()->has('utente')) return Redirect::to('cliente/login')->send();
        //if (!session()->has('utente')) return Redirect::to('cliente/manutenzione')->send();
        //else  return Redirect::to('cliente/index')->send();
    }


}
