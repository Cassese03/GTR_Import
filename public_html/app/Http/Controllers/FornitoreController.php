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


class FornitoreController extends Controller
{
    public function index(Request $request){

        if(!session()->has('ditta')) return Redirect::to('login/GTR1234')->send();

        $utente = session('utente');

        $dati = $request->all();

        $ditta = session('ditta');

        $id_ditta = DB::SELECT('SELECT * from ditta where token = \''.$ditta.'\' ')[0]->id;

        $richieste = DB::SELECT('SELECT count(*) as conteggio FROM dotes where id_ditta = \'' . $id_ditta. '\' and cd_do = \'ROF\' and stato = 0 and cd_cf = \'' . $utente->cd_cf . '\' ')[0]->conteggio;

        $inviate = DB::SELECT('SELECT count(*) as conteggio FROM dotes_out where id_ditta = \'' . $id_ditta . '\' and cd_do = \'ROF\' and id_dotes in (SELECT id_dotes from dotes where cd_cf = \'' . $utente->cd_cf . '\' and id_ditta = \'' . $id_ditta . '\' and stato != 0  ) and cd_cf = \'' . $utente->cd_cf . '\' and stato = 0 ')[0]->conteggio;

        $rifiutate = DB::SELECT('select count(*) as conteggio from dotes where id_ditta = \'' . $id_ditta . '\' and cd_do = \'ROF\' and id_dotes in (SELECT id_dotes from dotes where cd_cf = \'' . $utente->cd_cf . '\' and id_ditta = \'' . $id_ditta. '\' and stato = 1 ) ')[0]->conteggio;

        $inviate = intval($inviate)+intval($rifiutate);

        $risposte = DB::SELECT('SELECT count(*) as conteggio FROM dotes_out where id_ditta = \'' . $id_ditta . '\' and cd_do = \'ROF\' and cd_cf = \'' . $utente->cd_cf . '\' and stato != 0 ')[0]->conteggio;

        $utente = session('utente');

        $page = 'fornitore.index';

        return View::make('admin.index',compact('page','utente','ditta','richieste','inviate','risposte'));

    }

    public function richieste(Request $request)
    {

        if (!session()->has('ditta')) return Redirect::to('login/gtr1234')->send();

        $dati = $request->all();

        $ditta = session('ditta');

        $id_ditta = DB::SELECT('SELECT * from ditta where token = \'' . $ditta . '\' ')[0];

        $utente = session('utente');

        $page = 'fornitore.fornitore_conferme';

        $dotes = DB::SELECT('SELECT * FROM dotes where id_ditta = \'' . $id_ditta->id . '\' and cd_do = \'ROF\' and stato = 0 and cd_cf = \'' . $utente->cd_cf . '\' ');

        foreach ($dotes as $d) {
            $d->righe = DB::select('SELECT * from dorig Where id_dotes =\'' . $d->id_dotes . '\' and id_ditta = \'' . $id_ditta->id . '\' ');
        }

        if (isset($dati['RIFIUTA'])) {
            unset($dati['RIFIUTA']);
            DB::update('UPDATE dotes SET stato = \'1\' where id_dotes = \'' . $dati['id'] . '\'');
            DB::update('UPDATE dorig SET stato = \'1\' where id_dotes = \'' . $dati['id'] . '\'');
            return Redirect::to('fornitore/richieste');

        }
        if (isset($dati['CONFERMA'])) {
            unset($dati['CONFERMA']);
            $insert_dotes['id_dotes'] = $dati['id'];
            $insert_dotes['cd_cfdest'] = $dati['cd_cfdest'];
            $insert_dotes['cd_cfsede'] = $dati['cd_cfsede'];
            $insert_dotes['cd_agente_1'] = $dati['cd_agente_1'];
            $insert_dotes['cd_agente_2'] = $dati['cd_agente_2'];
            $insert_dotes['cd_ls_1'] = $dati['cd_ls_1'];
            $insert_dotes['cd_mgesercizio'] = $dati['cd_mgesercizio'];
            $insert_dotes['id_ditta'] = $id_ditta->id;
            $insert_dotes['cd_do'] = $dati['cd_do'];
            $insert_dotes['tipodocumento'] = $dati['tipodocumento'];
            $insert_dotes['numerodoc'] = $dati['numerodoc'];
            $insert_dotes['datadoc'] = $dati['datadoc'];
            $insert_dotes['cd_cf'] = $dati['cd_cf'];
            DB::table('dotes_out')->insert($insert_dotes);

            $righe = DB::SELECT('SELECT * FROM dorig where id_dotes =\'' . $dati['id'] . '\' and id_ditta = \'' . $id_ditta->id . '\' ');
            foreach ($righe as $r) {
                $insert_dorig['id_dotes'] = $dati['id'];
                $insert_dorig['id_ditta'] = $id_ditta->id;
                $insert_dorig['id_dorig'] = $r->id_dorig;
                $insert_dorig['cd_cf'] = $dati['cd_cf'];
                $insert_dorig['qta'] = $dati['quantita_' . $r->id_dorig];
                $insert_dorig['cd_ar'] = $dati['cd_ar_' . $r->id_dorig];
                $insert_dorig['xcolli'] = '';
                $insert_dorig['xnumerobancali'] = '';
                $insert_dorig['descrizione'] = $dati['descrizione_' . $r->id_dorig];
                $insert_dorig['prezzounitariov'] = $dati['prezzo_' . $r->id_dorig];
                $insert_dorig['cd_aliquota'] = $dati['cd_aliquota_' . $r->id_dorig];
                $insert_dorig['aliquota'] = $dati['aliquota_' . $r->id_dorig];
                $insert_dorig['scontoriga'] = '';
                $insert_dorig['prezzototalev'] = floatval($dati['prezzo_' . $r->id_dorig]) * floatval($dati['quantita_' . $r->id_dorig]);
                $insert_dorig['imposta'] = floatval(floatval($insert_dorig['prezzototalev']) / 100) * floatval($insert_dorig['aliquota']);
                $insert_dorig['prezzounitarioscontatov'] = '';
                $insert_dorig['prezzototalev'] = '';
                DB::table('dorig_out')->insert($insert_dorig);
            }

            DB::update('UPDATE dotes SET stato = \'2\' where id_dotes = \'' . $dati['id'] . '\'');
            DB::update('UPDATE dorig SET stato = \'2\' where id_dotes = \'' . $dati['id'] . '\'');
            return Redirect::to('fornitore/richieste');
        }


        return View::make('admin.index', compact('page', 'utente', 'ditta', 'id_ditta', 'dotes'));
    }

    public function offerte(Request $request)
    {

        if (!session()->has('ditta')) return Redirect::to('login/gtr1234')->send();

        $dati = $request->all();

        $ditta = session('ditta');

        $id_ditta = DB::SELECT('SELECT * from ditta where token = \'' . $ditta . '\' ')[0];

        $utente = session('utente');

        $page = 'fornitore.fornitore_offerte';

        $dotes = DB::SELECT('SELECT * FROM dotes_out where id_ditta = \'' . $id_ditta->id . '\' and cd_do = \'ROF\' and id_dotes in (SELECT id_dotes from dotes where cd_cf = \'' . $utente->cd_cf . '\' and id_ditta = \'' . $id_ditta->id . '\' and stato != 0  ) and cd_cf = \'' . $utente->cd_cf . '\' and stato = 0 ');

        foreach ($dotes as $d) {
            $d->righe = DB::select('SELECT * from dorig_out Where id_dotes =\'' . $d->id_dotes . '\' and id_ditta = \'' . $id_ditta->id . '\'');
        }

        $rifiutate = DB::SELECT('select * from dotes where id_ditta = \'' . $id_ditta->id . '\' and cd_do = \'ROF\' and id_dotes in (SELECT id_dotes from dotes where cd_cf = \'' . $utente->cd_cf . '\' and id_ditta = \'' . $id_ditta->id . '\' and stato = 1 ) ');

        foreach ($rifiutate as $d) {
            $d->righe = DB::select('SELECT * from dorig Where id_dotes =\'' . $d->id_dotes . '\' and id_ditta = \'' . $id_ditta->id . '\'');
        }

        return View::make('admin.index', compact('page', 'utente', 'ditta', 'id_ditta', 'dotes', 'rifiutate'));
    }

    public function risposte(Request $request)
    {

        if (!session()->has('ditta')) return Redirect::to('login/gtr1234')->send();

        $dati = $request->all();

        $ditta = session('ditta');

        $id_ditta = DB::SELECT('SELECT * from ditta where token = \'' . $ditta . '\' ')[0];

        $utente = session('utente');

        $page = 'fornitore.fornitore_risposte';

        $dotes = DB::SELECT('SELECT * FROM dotes_out where id_ditta = \'' . $id_ditta->id . '\' and cd_do = \'ROF\' and cd_cf = \'' . $utente->cd_cf . '\' ');

        foreach ($dotes as $d) {
            $d->righe = DB::select('SELECT * from dorig_out Where id_dotes =\'' . $d->id_dotes . '\' and id_ditta = \'' . $id_ditta->id . '\' ');
        }

        return View::make('admin.index', compact('page', 'utente', 'ditta', 'id_ditta', 'dotes'));
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