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
use URL;


class AjaxController extends Controller
{
    public function aggiungi_al_carrello_index($cd_ar, $quantita, $sconto, $prezzo)
    {

        $utente = session('utente');

        $prodotti = DB::select('SELECT * from ar where id_ditta = \'' . $utente->id_ditta . '\' and cd_ar = \'' . str_replace('slash', '/', $cd_ar) . '\'');

        $cart = Session::get('cart');

        if ($cart == '')
            $cart = [];

        if (isset($cart[$prodotti[0]->id])) {
            $quantita = $quantita + $cart[$prodotti[0]->id]['quantita'];
        }

        $cart[$prodotti[0]->id] = array(
            "id" => $prodotti[0]->id,
            "nome" => $prodotti[0]->cd_ar,
            "immagine" => $prodotti[0]->immagine,
            "quantita" => $quantita,
            "prezzo" => str_replace('.', ',', $prezzo),
            "sconto" => ($sconto > 0) ? $sconto : '',
        );

        Session::put('cart', $cart);
        Session::save();

        return '/cliente/index/?aggiunto=1';
    }

    public function aggiungi_al_carrello($cd_ar, $quantita, $pagina, $sconto, $prezzo)
    {

        $utente = session('utente');
        if($quantita <= 0) return;
        $prodotti = DB::select('SELECT * from ar where id_ditta = \'' . $utente->id_ditta . '\' and cd_ar = \'' . str_replace('slash', '/', $cd_ar) . '\'');

        $cart = Session::get('cart');

        if ($cart == '')
            $cart = [];

        if (isset($cart[$prodotti[0]->id])) {
            $quantita = $quantita + $cart[$prodotti[0]->id]['quantita'];
        }

        $cart[$prodotti[0]->id] = array(
            "id" => $prodotti[0]->id,
            "nome" => $prodotti[0]->cd_ar,
            "immagine" => $prodotti[0]->immagine,
            "quantita" => $quantita,
            "prezzo" => str_replace('.', ',', $prezzo),
            "sconto" => ($sconto > 0) ? $sconto : '',
        );

        Session::put('cart', $cart);
        Session::save();

        if ($pagina != '')
            return '/cliente/articoli/?pagina=' . $pagina . '&aggiunto=1';
        else
            return '/cliente/articoli/?pagina=1&aggiunto=1';
    }

    public function cambia_note($id, Request $request)
    {

        $cart = session('cart');
        $dati = $request->all();
        $note = $dati['nota'];
        if ($note != '') {
            $cart[$id]['note'] = $note;
            Session::put('cart', $cart);
            Session::save();
            return 0;
        } else {
            $cart[$id]['note'] = '';
            Session::put('cart', $cart);
            Session::save();
            return 'errore';
        }
    }

    public function cambia_qta($qta, $id)
    {
        $cart = session('cart');

        $ditta = session('ditta');

        $id_ditta = DB::SELECT('SELECT * from ditta where token = \'' . $ditta . '\' ')[0]->id;

        $disponibile = DB::SELECT('SELECT COALESCE(Disponibile,\'0.00\') as disponibile from mggiacenza where id_ditta = \'' . $id_ditta . '\' and cd_mg = \'00001\' and cd_ar = \'' . $cart[$id]['nome'] . '\' ');
        if (sizeof($disponibile) > 0) $disponibile = $disponibile[0]->disponibile; else $disponibile = 0;

        if ($qta <= $disponibile) {
            $cart[$id]['quantita'] = $qta;
            Session::put('cart', $cart);
            Session::save();
        } else {
            $cart[$id]['quantita'] = $disponibile;
            Session::put('cart', $cart);
            Session::save();
            return 'max_disp';
        }
    }


    public function load_righe_storico($id_dotes, $stato)
    {

        $id_ditta = session('ditta');
        $id_ditta = DB::SELECT('SELECT * FROM ditta where token = \'' . $id_ditta . '\'  ')[0];
        $dotes = DB::SELECT('SELECT * FROM dotes_out where id_dotes =\'' . $id_dotes . '\' and id_ditta = \'' . $id_ditta->id . '\' and stato = ' . $stato . ' ');
        if (sizeof($dotes) <= 0) {
            $dotes = DB::SELECT('SELECT * from dotes where id_dotes =\'' . $id_dotes . '\' and  id_ditta = \'' . $id_ditta->id . '\' and stato = 1 ');
        }
        if ($stato != '3') {

            foreach ($dotes as $d) {

                $righe = DB::select('SELECT * from dorig_out Where id_dotes =\'' . $d->id_dotes . '\' and id_ditta = \'' . $id_ditta->id . '\' and stato = \'' . $d->stato . '\' ');
                if (sizeof($righe) <= 0) {
                    $righe = DB::select('SELECT * from dorig Where id_dotes =\'' . $d->id_dotes . '\' and id_ditta = \'' . $id_ditta->id . '\' and stato = \'' . $d->stato . '\' ');
                }
                foreach ($righe as $r) {
                    ?>

                    <?php $riga_old = DB::SELECT('SELECT * FROM dorig where id_dorig = \'' . $r->id_dorig . '\' and id_ditta = \'' . $id_ditta->id . '\'')[0]; ?>
                    <div class="row">
                        <div class="form-group col-md-3"
                             style="padding: 10px;<?php if ($r->cd_ar != $riga_old->cd_ar) echo 'background-color:yellow;'; ?>">
                            <input type="text" style="text-align: right" class="form-control"
                                   name="cd_ar_<?php echo $r->id_dorig ?>" value="<?php echo $r->cd_ar ?>"
                                   autocomplete="off" readonly>
                            <?php if ($r->cd_ar != $riga_old->cd_ar) { ?>
                                <input type="text" style="text-align: right" class="form-control"
                                       name="cd_ar_<?php echo $riga_old->id_dorig ?>_old"
                                       value="<?php echo $riga_old->cd_ar ?>" autocomplete="off" readonly>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-3"
                             style="padding: 10px;<?php if ($r->descrizione != $riga_old->descrizione) echo 'background-color:yellow;'; ?>">
                            <input type="text" style="text-align: right" class="form-control"
                                   name="descrizione_<?php echo $r->id_dorig ?>" value="<?php echo $r->descrizione ?>"
                                   autocomplete="off" readonly>
                            <?php if ($r->descrizione != $riga_old->descrizione) { ?>
                                <input type="text" style="color: red;text-align: right" class="form-control"
                                       name="cd_ar_<?php echo $riga_old->id_dorig ?>_old"
                                       value="<?php echo $riga_old->descrizione ?>" autocomplete="off" readonly>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-3"
                             style="padding: 10px;<?php if ($r->qta != $riga_old->qta) echo 'background-color:yellow;'; ?>">
                            <input type="number" style="text-align: right" class="form-control"
                                   name="quantita_<?php echo $r->id_dorig ?>" value="<?php echo $r->qta ?>" step="1"
                                   autocomplete="off" readonly>
                            <?php if ($r->qta != $riga_old->qta) { ?>
                                <input type="text" style="color: red;text-align: right" class="form-control"
                                       name="cd_ar_<?php echo $riga_old->id_dorig ?>_old"
                                       value="<?php echo $riga_old->qta ?>" autocomplete="off" readonly>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-3"
                             style="padding: 10px;<?php if ($r->prezzounitariov != $riga_old->prezzounitariov) echo 'background-color:yellow;'; ?>">
                            <input type="number" style="text-align: right" class="form-control"
                                   name="prezzo_<?php echo $r->id_dorig ?>" value="<?php echo $r->prezzounitariov ?>"
                                   step="0.01" autocomplete="off" readonly>
                            <?php if ($r->prezzounitariov != $riga_old->prezzounitariov) { ?>
                                <input type="text" style="color: red;text-align: right" class="form-control"
                                       name="cd_ar_<?php echo $riga_old->id_dorig ?>_old"
                                       value="<?php echo $riga_old->prezzounitariov ?>" autocomplete="off" readonly>
                            <?php } ?>
                        </div>
                        <input type="hidden" id="aliquota_<?php echo $r->id_dorig ?>"
                               name="aliquota_<?php echo $r->id_dorig ?>" value="<?php echo $r->aliquota ?>">
                        <input type="hidden" id="cd_aliquota_<?php echo $r->id_dorig ?>"
                               name="cd_aliquota_<?php echo $r->id_dorig ?>" value="<?php echo $r->cd_aliquota ?>">

                    </div>


                <?php }
            }
        }
        /*else{
            $righe = DB::select('SELECT * from dorig_out Where id_dotes =\''.$dotes[0]->id_dotes.'\' and id_ditta = \''.$id_ditta->id.'\' and stato = \''.$stato.'\' order by id desc');

            foreach($righe as $r){?>

                <?php $riga_old = DB::SELECT('SELECT * FROM dorig where id_dorig = \''.$r->id_dorig.'\' and id_ditta = \''.$id_ditta->id.'\'')[0];?>
                <div class="row">
                    <div class="form-group col-md-3" style="padding: 10px;<?php if ($r->cd_ar != $riga_old->cd_ar) echo 'background-color:yellow;';?>">
                        <input type="text" style="text-align: right" class="form-control" name="cd_ar_<?php echo $riga_old->id_dorig?>_old" value="<?php echo $riga_old->cd_ar?>" autocomplete="off" readonly>

                        <?php if ($r->cd_ar != $riga_old->cd_ar){?>
                            <input type="text"  style="color: red;text-align: right" class="form-control" name="cd_ar_<?php echo $r->id_dorig?>" value="<?php echo $r->cd_ar?>" autocomplete="off" readonly>

                        <?php } ?>
                    </div>
                    <div class="form-group col-md-3" style="padding: 10px;<?php if ($r->descrizione != $riga_old->descrizione) echo 'background-color:yellow;';?>">
                        <input type="text" style="text-align: right" class="form-control" name="cd_ar_<?php echo $riga_old->id_dorig?>_old" value="<?php echo $riga_old->descrizione?>" autocomplete="off" readonly>

                        <?php if ($r->descrizione != $riga_old->descrizione){?>

                            <input type="text" style="color: red;text-align: right" class="form-control" name="descrizione_<?php echo $r->id_dorig?>" value="<?php echo $r->descrizione ?>" autocomplete="off" readonly>

                        <?php } ?>
                    </div>
                    <div class="form-group col-md-3" style="padding: 10px;<?php if ($r->qta != $riga_old->qta) echo 'background-color:yellow;';?>">
                        <input type="text" style="text-align: right" class="form-control" name="cd_ar_<?php echo $riga_old->id_dorig?>_old" value="<?php echo $riga_old->qta?>" autocomplete="off" readonly>

                        <?php if ($r->qta != $riga_old->qta){?>

                            <input type="number" style="color: red;text-align: right" class="form-control" name="quantita_<?php echo $r->id_dorig?>" value="<?php echo $r->qta ?>" step="1"  autocomplete="off" readonly>

                        <?php } ?>
                    </div>
                    <div class="form-group col-md-3" style="padding: 10px;<?php if ($r->prezzounitariov != $riga_old->prezzounitariov) echo 'background-color:yellow;';?>">
                        <input type="text" style="text-align: right" class="form-control" name="cd_ar_<?php echo $riga_old->id_dorig?>_old" value="<?php echo $riga_old->prezzounitariov?>" autocomplete="off" readonly>

                        <?php if ($r->prezzounitariov != $riga_old->prezzounitariov){?>
                            <input type="number"  style="color:red;text-align: right" class="form-control" name="prezzo_<?php echo $r->id_dorig?>" value="<?php echo $r->prezzounitariov ?>" step="0.01" autocomplete="off" readonly>
                        <?php } ?>
                    </div>
                    <input type="hidden" id="aliquota_<?php echo $r->id_dorig?>" name="aliquota_<?php echo $r->id_dorig?>" value="<?php echo $r->aliquota?>">
                    <input type="hidden" id="cd_aliquota_<?php echo $r->id_dorig?>" name="cd_aliquota_<?php echo $r->id_dorig?>" value="<?php echo $r->cd_aliquota?>">

                </div>


            <?php }
        }*/
    }

    public function load_righe_fornitore($id_dotes)
    {

        $id_ditta = session('ditta');
        $id_ditta = DB::SELECT('SELECT * FROM ditta where token = \'' . $id_ditta . '\'  ')[0];
        $righe = DB::SELECT('SELECT * FROM dorig where id_dotes = \'' . $id_dotes . '\' and id_ditta = \'' . $id_ditta->id . '\' ');

        foreach ($righe as $r) {
            ?>
            <?php $riga_old = DB::SELECT('SELECT * FROM dorig_out where id_dorig = \'' . $r->id_dorig . '\' and id_ditta = \'' . $id_ditta->id . '\' and stato = \'3\' order by id desc ');
            if (sizeof($riga_old) > 0)
                $riga_old = $riga_old[0];
            else
                $riga_old = DB::SELECT('SELECT * FROM dorig where id_dorig = \'' . $r->id_dorig . '\' and id_ditta = \'' . $id_ditta->id . '\' and stato != \'3\' order by id desc')[0]; ?>
            <div class="row">
                <div class="form-group col-md-3">
                    <input type="text" class="form-control" name="cd_ar_<?php echo $r->id_dorig ?>"
                           value="<?php echo $r->cd_ar ?>" autocomplete="off" readonly>
                    <?php if ($r->cd_ar != $riga_old->cd_ar) { ?>
                        <input type="text" style="text-align: right" class="form-control"
                               name="cd_ar_<?php echo $riga_old->id_dorig ?>_old" value="<?php echo $riga_old->cd_ar ?>"
                               autocomplete="off" readonly>
                    <?php } ?>
                </div>
                <div class="form-group col-md-3">
                    <input type="text" class="form-control" name="descrizione_<?php echo $r->id_dorig ?>"
                           value="<?php echo $r->descrizione ?>" autocomplete="off" readonly>
                    <?php if ($r->descrizione != $riga_old->descrizione) { ?>
                        <input type="text" style="color: red;text-align: right" class="form-control"
                               name="cd_ar_<?php echo $riga_old->id_dorig ?>_old"
                               value="<?php echo $riga_old->descrizione ?>" autocomplete="off" readonly>
                    <?php } ?>
                </div>
                <div class="form-group col-md-3">
                    <input type="number" class="form-control" name="quantita_<?php echo $r->id_dorig ?>"
                           value="<?php echo $r->qta ?>" step="1" autocomplete="off">
                    <?php if ($r->qta != $riga_old->qta) { ?>
                        <input type="text" style="color: red;text-align: right" class="form-control"
                               name="cd_ar_<?php echo $riga_old->id_dorig ?>_old" value="<?php echo $riga_old->qta ?>"
                               autocomplete="off" readonly>
                    <?php } ?>
                </div>
                <div class="form-group col-md-3">
                    <input type="number" class="form-control" name="prezzo_<?php echo $r->id_dorig ?>"
                           value="<?php echo $r->prezzounitariov ?>" step="0.01" autocomplete="off">
                    <?php if ($r->prezzounitariov != $riga_old->prezzounitariov) { ?>
                        <input type="text" style="color: red;text-align: right" class="form-control"
                               name="cd_ar_<?php echo $riga_old->id_dorig ?>_old"
                               value="<?php echo $riga_old->prezzounitariov ?>" autocomplete="off" readonly>
                    <?php } ?>
                </div>
                <input type="hidden" id="aliquota_<?php echo $r->id_dorig ?>" name="aliquota_<?php echo $r->id_dorig ?>"
                       value="<?php echo $r->aliquota ?>">
                <input type="hidden" id="cd_aliquota_<?php echo $r->id_dorig ?>"
                       name="cd_aliquota_<?php echo $r->id_dorig ?>" value="<?php echo $r->cd_aliquota ?>">

            </div>
        <?php }

    }

    public function load_righe($id_dotes)
    {

        $id_ditta = session('ditta');
        $id_ditta = DB::SELECT('SELECT * FROM ditta where token = \'' . $id_ditta . '\'  ')[0];
        $righe = DB::SELECT('SELECT * FROM dorig where id_dotes = \'' . $id_dotes . '\' and id_ditta = \'' . $id_ditta->id . '\' ');

        foreach ($righe as $r) {
            ?>

            <?php $riga_old = DB::SELECT('SELECT * FROM dorig where id_dorig = \'' . $r->id_dorig . '\' and id_ditta = \'' . $id_ditta->id . '\'')[0]; ?>

            <div class="row">
                <div class="form-group col-md-3"
                     style="padding: 10px;<?php if ($r->cd_ar != $riga_old->cd_ar) echo 'background-color:yellow;'; ?>">
                    <input type="text" class="form-control" name="cd_ar_<?php echo $r->id_dorig ?>"
                           value="<?php echo $r->cd_ar ?>" autocomplete="off" readonly>
                </div>
                <div class="form-group col-md-3"
                     style="padding: 10px;<?php if ($r->descrizione != $riga_old->descrizione) echo 'background-color:yellow;'; ?>">
                    <input type="text" class="form-control" name="descrizione_<?php echo $r->id_dorig ?>"
                           value="<?php echo $r->descrizione ?>" autocomplete="off" readonly>
                </div>
                <div class="form-group col-md-3"
                     style="padding: 10px;<?php if ($r->qta != $riga_old->qta) echo 'background-color:yellow;'; ?>">
                    <input type="number" class="form-control" name="quantita_<?php echo $r->id_dorig ?>"
                           value="<?php echo $r->qta ?>" step="1" autocomplete="off" readonly>
                </div>
                <div class="form-group col-md-3"
                     style="padding: 10px;<?php if ($r->prezzounitariov != $riga_old->prezzounitariov) echo 'background-color:yellow;'; ?>">
                    <input type="number" class="form-control" name="prezzo_<?php echo $r->id_dorig ?>"
                           value="<?php echo $r->prezzounitariov ?>" step="0.01" autocomplete="off" readonly>
                </div>
                <input type="hidden" id="aliquota_<?php echo $r->id_dorig ?>" name="aliquota_<?php echo $r->id_dorig ?>"
                       value="<?php echo $r->aliquota ?>">
                <input type="hidden" id="cd_aliquota_<?php echo $r->id_dorig ?>"
                       name="cd_aliquota_<?php echo $r->id_dorig ?>" value="<?php echo $r->cd_aliquota ?>">

            </div>

        <?php }

    }

    public function load_richieste_storico($offset)
    {

        $id_ditta = session('ditta');
        $id_ditta = DB::SELECT('SELECT * FROM ditta where token = \'' . $id_ditta . '\'  ')[0];

        $dotes = DB::SELECT('SELECT * FROM dotes_out where id_ditta = \'' . $id_ditta->id . '\' and cd_do = \'ROF\' AND (stato != 0 AND stato != 3) LIMIT ' . $offset . ',15');

        $rifiutate = DB::SELECT('SELECT * from dotes where id_ditta = \'' . $id_ditta->id . '\' and stato = 1 LIMIT ' . $offset . ',15');

        foreach ($dotes as $d) {
            ?>
            <div class="col-md-12" style="padding-left: 1%; padding-right: 1%">

                <form method="post">
                    <div class="card card-primary collapsed-card">
                        <div class="card-header" <?php if ($d->stato == 1) echo 'style="background-color:red"';
                        if ($d->stato == 2) echo 'style="background-color:green"';
                        if ($d->stato == 3) echo 'style="background-color:gray"'; ?>>
                            <h3 class="card-title">Richiesta Ordine <strong><?php echo $d->numerodoc ?></strong> in data
                                <strong><?php echo date("d-m-Y", strtotime($d->datadoc)); ?></strong></h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"
                                        onclick="load_righe(<?php echo $d->id_dotes ?>,<?php echo $d->stato ?>)">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Articolo</label><br>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Descrizione</label><br>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Quantita</label><br>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Prezzo</label><br>
                                </div>
                            </div>

                            <div id="ajax_righe_<?php echo $d->id_dotes ?>_stato_<?php echo $d->stato ?>">
                                <div class="loader"
                                     id="loading-image_2_<?php echo $d->id_dotes ?>_stato_<?php echo $d->stato ?>"></div>
                            </div>
                            <div class="clearfix"></div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="hidden" id="id" name="id" value="<?php echo $d->id_dotes ?>">
                            <input type="hidden" id="cd_agente_1" name="cd_agente_1"
                                   value="<?php echo $d->cd_agente_1 ?>">
                            <input type="hidden" id="cd_agente_2" name="cd_agente_2"
                                   value="<?php echo $d->cd_agente_2 ?>">
                            <input type="hidden" id="cd_do" name="cd_do" value="<?php echo $d->cd_do ?>">
                            <input type="hidden" id="tipodocumento" name="tipodocumento"
                                   value="<?php echo $d->tipodocumento ?>">
                            <input type="hidden" id="numerodoc" name="numerodoc" value="<?php echo $d->numerodoc ?>">
                            <input type="hidden" id="cd_cf" name="cd_cf" value="<?php echo $d->cd_cf ?>">
                            <input type="hidden" id="cd_cfsede" name="cd_cfsede" value="<?php echo $d->cd_cfsede ?>">
                            <input type="hidden" id="cd_cfdest" name="cd_cfdest" value="<?php echo $d->cd_cfdest ?>">
                            <input type="hidden" id="cd_ls_1" name="cd_ls_1" value="<?php echo $d->cd_ls_1 ?>">
                            <input type="hidden" id="cd_mgesercizio" name="cd_mgesercizio"
                                   value="<?php echo $d->cd_mgesercizio ?>">
                            <input type="hidden" id="datadoc" name="datadoc" value="<?php echo $d->datadoc ?>">
                        </div>
                    </div>
                    <!-- /.card -->
                </form>


            </div>
        <?php }

        foreach ($rifiutate as $d) {
            ?>
            <div class="col-md-12" style="padding-left: 1%; padding-right: 1%">

                <form method="post">
                    <div class="card card-primary collapsed-card">
                        <div class="card-header" <?php if ($d->stato == 1) echo 'style="background-color:red"';
                        if ($d->stato == 2) echo 'style="background-color:green"';
                        if ($d->stato == 3) echo 'style="background-color:gray"'; ?>>
                            <h3 class="card-title">Richiesta Ordine <strong><?php echo $d->numerodoc ?></strong> in data
                                <strong><?php echo date("d-m-Y", strtotime($d->datadoc)); ?></strong></h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"
                                        onclick="load_righe(<?php echo $d->id_dotes ?>,<?php echo $d->stato ?>)">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label>Articolo</label><br>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Descrizione</label><br>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Quantita</label><br>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Prezzo</label><br>
                                </div>
                            </div>

                            <div id="ajax_righe_<?php echo $d->id_dotes ?>_stato_<?php echo $d->stato ?>">
                                <div class="loader"
                                     id="loading-image_2_<?php echo $d->id_dotes ?>_stato_<?php echo $d->stato ?>"></div>
                            </div>
                            <div class="clearfix"></div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <input type="hidden" id="id" name="id" value="<?php echo $d->id_dotes ?>">
                            <input type="hidden" id="cd_agente_1" name="cd_agente_1"
                                   value="<?php echo $d->cd_agente_1 ?>">
                            <input type="hidden" id="cd_agente_2" name="cd_agente_2"
                                   value="<?php echo $d->cd_agente_2 ?>">
                            <input type="hidden" id="cd_do" name="cd_do" value="<?php echo $d->cd_do ?>">
                            <input type="hidden" id="tipodocumento" name="tipodocumento"
                                   value="<?php echo $d->tipodocumento ?>">
                            <input type="hidden" id="numerodoc" name="numerodoc" value="<?php echo $d->numerodoc ?>">
                            <input type="hidden" id="cd_cf" name="cd_cf" value="<?php echo $d->cd_cf ?>">
                            <input type="hidden" id="cd_cfsede" name="cd_cfsede" value="<?php echo $d->cd_cfsede ?>">
                            <input type="hidden" id="cd_cfdest" name="cd_cfdest" value="<?php echo $d->cd_cfdest ?>">
                            <input type="hidden" id="cd_ls_1" name="cd_ls_1" value="<?php echo $d->cd_ls_1 ?>">
                            <input type="hidden" id="cd_mgesercizio" name="cd_mgesercizio"
                                   value="<?php echo $d->cd_mgesercizio ?>">
                            <input type="hidden" id="datadoc" name="datadoc" value="<?php echo $d->datadoc ?>">
                        </div>
                    </div>
                    <!-- /.card -->
                </form>


            </div>
        <?php }

    }

    public function check_cart()
    {

        $cart = Session::get('cart');


        if ($cart == '') $cart = [];

        $totali = 0.00;

        if (sizeof($cart) > 0) {

            foreach ($cart as $c) {

                if ($c['sconto'] == '')
                    $totali = floatval($totali) + floatval($c['prezzo']) * floatval($c['quantita']);
                else {
                    $totali = floatval($totali) + (floatval($c['prezzo']) - (floatval($c['prezzo']) / 100) * $c['sconto']) * floatval($c['quantita']);
                }
            }
        }
        ?>
        <script type="text/javascript">
            document.getElementById('size_of_refresh').innerHTML = '<?php echo sizeof($cart); ?>';
            document.getElementById('refresh_cart').innerHTML = '<?php echo number_format($totali + (floatval($totali) / 100) * 22, 2, ', ', ''); ?> €';
        </script>
        <?php
    }

    public function load_richieste($cd_cf, $offset)
    {

        $id_ditta = session('ditta');
        $id_ditta = DB::SELECT('SELECT * FROM ditta where token = \'' . $id_ditta . '\'  ')[0];

        $dotes = DB::SELECT('SELECT * FROM dotes where id_ditta = \'' . $id_ditta->id . '\' and cd_do = \'ROF\' and cd_cf = \'' . $cd_cf . '\' and stato = 0  LIMIT ' . $offset . ',15');
        if (sizeof($dotes) > 0) {
            foreach ($dotes as $d) {
                ?>
                <div class="col-md-12" style="padding-left: 1%; padding-right: 1%">
                    <form method="post">
                        <div class="card card-primary collapsed-card">
                            <div class="card-header" <?php if ($d->stato == 1) echo 'style="background-color:red"';
                            if ($d->stato == 2) echo 'style="background-color:green"' ?>>
                                <h3 class="card-title">Richiesta Ordine <strong><?php echo $d->numerodoc ?></strong> in
                                    data <strong><?php echo date("d-m-Y", strtotime($d->datadoc)); ?></strong></h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse" onclick="load_righe(<?php echo $d->id_dotes ?>)">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>Articolo</label><br>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Descrizione</label><br>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Quantita</label><br>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Prezzo</label><br>
                                    </div>
                                </div>
                                <div id="ajax_righe_<?php echo $d->id_dotes ?>">
                                    <div class="loader" id="loading-image_2_<?php echo $d->id_dotes ?>"></div>
                                </div>
                                <div class="clearfix"></div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <input type="hidden" id="id" name="id" value="<?php echo $d->id_dotes ?>">
                                <input type="hidden" id="cd_agente_1" name="cd_agente_1"
                                       value="<?php echo $d->cd_agente_1 ?>">
                                <input type="hidden" id="cd_agente_2" name="cd_agente_2"
                                       value="<?php echo $d->cd_agente_2 ?>">
                                <input type="hidden" id="cd_do" name="cd_do" value="<?php echo $d->cd_do ?>">
                                <input type="hidden" id="tipodocumento" name="tipodocumento"
                                       value="<?php echo $d->tipodocumento ?>">
                                <input type="hidden" id="numerodoc" name="numerodoc"
                                       value="<?php echo $d->numerodoc ?>">
                                <input type="hidden" id="cd_cf" name="cd_cf" value="<?php echo $d->cd_cf ?>">
                                <input type="hidden" id="cd_cfsede" name="cd_cfsede"
                                       value="<?php echo $d->cd_cfsede ?>">
                                <input type="hidden" id="cd_cfdest" name="cd_cfdest"
                                       value="<?php echo $d->cd_cfdest ?>">
                                <input type="hidden" id="cd_ls_1" name="cd_ls_1" value="<?php echo $d->cd_ls_1 ?>">
                                <input type="hidden" id="cd_mgesercizio" name="cd_mgesercizio"
                                       value="<?php echo $d->cd_mgesercizio ?>">
                                <input type="hidden" id="datadoc" name="datadoc" value="<?php echo $d->datadoc ?>">
                            </div>
                        </div>
                        <!-- /.card -->
                    </form>
                </div>
            <?php }
        }
    }

    public function load_articoli($filtro, $categoria, $marca, $pagina, $ord)
    {


        $filtro = str_replace('slash', '/', $filtro);

        $utente = session('utente');

        $arclasse1 = '';

        $arclasse2 = '';

        $arclasse3 = '';

        $armarca = '';

        $aralias = '';

        $ditta = 'GTR1234';

        if ($categoria != '0')
            list($arclasse1, $arclasse2, $arclasse3) = explode('-', $categoria);

        $cond = 'where ar.id_ditta = ' . $utente->id_ditta . ' and lsarticolo.prezzo != \'\' ';

        if ($categoria != '0--') {
            if ($arclasse1 != '')
                $cond .= ' and cd_arclasse1 = \'' . $arclasse1 . '\'';
            else
                $cond .= ' and cd_arclasse1 is not null';
            if ($arclasse2 != '')
                $cond .= ' and cd_arclasse2 = \'' . $arclasse2 . '\'';
            else
                $cond .= ' and cd_arclasse2 is not null';
            if ($arclasse3 != '')
                $cond .= ' and cd_arclasse3 = \'' . $arclasse3 . '\'';
            else
                $cond .= ' and cd_arclasse3 is not null';
        } else
            $cond .= 'and cd_arclasse1 is not null and cd_arclasse2 is not null and cd_arclasse3 is not null';
        if ($marca != '' && $marca != 0) {
            $armarca = 'LEFT JOIN armarca on armarca.cd_armarca = ar.marca and armarca.id_ditta = ' . $utente->id_ditta;
            $cond .= ' and armarca.id_armarca = \'' . $marca . '\'';
        }

        if ($filtro != '0') {
            $aralias = ' LEFT JOIN aralias on aralias.cd_ar = ar.cd_ar and aralias.id_ditta = ' . $utente->id_ditta;
            $cond = ' and (ar.descrizione like \'%' . $filtro . '%\' or aralias.alias like \'%' . $filtro . '%\' or ar.cd_ar like \'%' . $filtro . '%\' )';
        }


        $cond .= ' and cd_arprdclasse is not null';

        $max_pag = DB::SELECT('SELECT count(*) as count_pagine
        FROM ar  
        ' . $aralias . ' ' . $armarca . '
        LEFT JOIN mggiacenza on mggiacenza.cd_ar = ar.cd_ar and mggiacenza.cd_mg = \'00001\' and mggiacenza.id_ditta = ' . $utente->id_ditta . ' 
        LEFT JOIN lsarticolo ON lsarticolo.cd_ar = ar.cd_ar and lsarticolo.id_ditta = ' . $utente->id_ditta . '
        LEFT JOIN lsrevisione ON lsrevisione.id_lsrevisione = lsarticolo.id_lsrevisione AND lsrevisione.id_ditta = ' . $utente->id_ditta . '
        JOIN cf ON cf.cd_ls_1 = lsrevisione.cd_ls AND cf.cd_cf = \'' . $utente->cd_cf . '\' and cf.id_ditta = ' . $utente->id_ditta . ' ' . $cond);

        $cond .= ' group BY ar.cd_arprdclasse,ar.cd_arclasse1,ar.cd_arclasse2,ar.cd_arclasse3,ar.cd_arprdclasse,ar.cd_ar,ar.descrizione,lsarticolo.prezzo,ar.immagine, ar.id, lsarticolo.sconto, mggiacenza.giacenza, mggiacenza.ordinato, mggiacenza.disponibile';
        $cond .= ' order by ar.cd_arprdclasse,ar.cd_arclasse1,ar.cd_arclasse2,ar.cd_arclasse3,ar.cd_arprdclasse,ar.cd_ar ' . $ord;


        if ($pagina == 1)
            $cond .= ' LIMIT 12';

        if ($pagina != 1)
            $cond .= ' LIMIT 12 OFFSET ' . (($pagina * 12) - 1);


        if (substr($utente->cd_cf, 0, 1) == 'F') {
            $query = 'SELECT ar.id_ar,ar.cd_arprdclasse,(SELECT COALESCE(umfatt,0) from ararmisura where id_ditta = 5 and cd_ar = ar.cd_ar and cd_armisura = \'in\' LIMIT 1) as inner_misura,ar.cd_arclasse1,ar.cd_arclasse2,ar.cd_arclasse3,ar.cd_ar,ar.descrizione,lsarticolo.prezzo,(Select link from arimg where id_ditta = ' . $utente->id_ditta . '  and cd_ar = ar.cd_ar and Riga = 1 LIMIT 1  ) as immagine, ar.id , lsarticolo.sconto, ar.xqtaconf , COALESCE(mggiacenza.giacenza,0.00) as giacenza ,COALESCE(mggiacenza.giacenza - mggiacenza.impegnato,0.00) as immediato , COALESCE(mggiacenza.ordinato,0.00) as ordinato,if((mggiacenza.Giacenza - mggiacenza.Impegnato) > 0, mggiacenza.Disponibile - mggiacenza.Giacenza, mggiacenza.Ordinato + (mggiacenza.Giacenza - mggiacenza.Impegnato)) as bollino_blu, COALESCE(mggiacenza.disponibile,0.00) as disponibile
        FROM ar  
        ' . $aralias . ' ' . $armarca . '
        LEFT JOIN mggiacenza on mggiacenza.cd_ar = ar.cd_ar and mggiacenza.cd_mg = \'00001\' and mggiacenza.id_ditta = ' . $utente->id_ditta . ' 
        LEFT JOIN lsarticolo ON lsarticolo.cd_ar = ar.cd_ar and lsarticolo.id_ditta = ' . $utente->id_ditta . '
        LEFT JOIN lsrevisione ON lsrevisione.id_lsrevisione = lsarticolo.id_lsrevisione AND lsrevisione.id_ditta = ' . $utente->id_ditta . '
        JOIN cf ON cf.cd_ls_1 = lsrevisione.cd_ls AND cf.cd_cf = \'C000001\' and cf.id_ditta = ' . $utente->id_ditta . ' ' . $cond;
        } else {
            $query = 'SELECT ar.id_ar,ar.cd_arprdclasse,(SELECT COALESCE(umfatt,0) from ararmisura where id_ditta = 5 and cd_ar = ar.cd_ar and cd_armisura = \'in\' LIMIT 1) as inner_misura,ar.cd_arclasse1,ar.cd_arclasse2,ar.cd_arclasse3,ar.cd_ar,ar.descrizione,lsarticolo.prezzo,(Select link from arimg where id_ditta = ' . $utente->id_ditta . '  and cd_ar = ar.cd_ar and Riga = 1 LIMIT 1  ) as immagine, ar.id , lsarticolo.sconto, ar.xqtaconf , COALESCE(mggiacenza.giacenza,0.00) as giacenza ,COALESCE(mggiacenza.giacenza - mggiacenza.impegnato,0.00) as immediato , COALESCE(mggiacenza.ordinato,0.00) as ordinato,if((mggiacenza.Giacenza - mggiacenza.Impegnato) > 0, mggiacenza.Disponibile - mggiacenza.Giacenza, mggiacenza.Ordinato + (mggiacenza.Giacenza - mggiacenza.Impegnato)) as bollino_blu, COALESCE(mggiacenza.disponibile,0.00) as disponibile
        FROM ar  
        ' . $aralias . ' ' . $armarca . '
        LEFT JOIN mggiacenza on mggiacenza.cd_ar = ar.cd_ar and mggiacenza.cd_mg = \'00001\' and mggiacenza.id_ditta = ' . $utente->id_ditta . ' 
        LEFT JOIN lsarticolo ON lsarticolo.cd_ar = ar.cd_ar and lsarticolo.id_ditta = ' . $utente->id_ditta . '
        LEFT JOIN lsrevisione ON lsrevisione.id_lsrevisione = lsarticolo.id_lsrevisione AND lsrevisione.id_ditta = ' . $utente->id_ditta . '
        JOIN cf ON cf.cd_ls_1 = lsrevisione.cd_ls AND cf.cd_cf = \'' . $utente->cd_cf . '\' and cf.id_ditta = ' . $utente->id_ditta . ' ' . $cond;

        }
        $articoli = DB::SELECT($query);

        $count = sizeof($articoli);

        ?>


        <div class="row">
            <?php if (sizeof($articoli) > 0) { ?>
                <?php foreach ($articoli as $a) { ?>
                    <div class="col-lg-4 col-md-6 col-sm-6 zoom">
                        <form method="post">
                            <div class="product__item">
                                <!--<div class="banner">
                                    <a>&nbsp;
                                        <?php
                                /*                                        if ($a->disponibile >= 16) echo ' Merce <strong>Disponibile</strong>';
                                                                        if ($a->disponibile > 0 && $a->disponibile <= 15) echo ' Merce in <strong>Esaurimento</strong>';
                                                                        if ($a->disponibile <= 0 && $a->ordinato <= 0) echo ' Merce <strong>Esaurita</strong>';
                                                                        if ($a->disponibile <= 0 && $a->ordinato > 0) echo ' Merce in <strong>Arrivo</strong>';
                                                                        */ ?>&nbsp;
                                    </a>
                                </div>-->
                                <?php $immagine = $a->immagine; ?>
                                <div class="product__item__pic set-bg" data-setbg="<?php if ($immagine != '') {
                                    echo $immagine;
                                } else echo URL::ASSET("/img/" . $ditta . "/no_logo_" . "$ditta" . ".png ") ?>"
                                     style="background-image: url(<?php if ($immagine != '') {
                                         echo $immagine;
                                     } else echo URL::ASSET("/img/" . $ditta . "/no_logo_" . "$ditta" . ".png ") ?>);background-size:contain!important">
                                    <ul class="product__hover">
                                        <li><a href="./dettaglio/<?php echo $a->id_ar ?>"><img
                                                        src="/img/icon/search.png"
                                                        alt=""></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <input type="hidden" value="<?php echo $a->id ?>" name="id_prodotto"
                                           id="id_prodotto">
                                    <input type="hidden" value="1" name="quantita" id="quantita">
                                    <input type="hidden" value="<?php echo $a->sconto; ?>" name="sconto"
                                           id="sconto_<?php echo $a->id ?>">
                                    <input type="hidden" value="<?php echo $a->cd_ar; ?>" name="cd_ar"
                                           id="cd_ar_<?php echo $a->id ?>">
                                    <input type="hidden" value="<?php echo $pagina; ?>" name="pagina"
                                           id="pagina_<?php echo $a->id ?>">
                                    <input type="hidden"
                                           value="<?php if ($a->prezzo != '') echo number_format($a->prezzo, '2', ',', ''); ?>"
                                           name="prezzo" id="prezzo_<?php echo $a->id ?>">

                                    <button type="button" style="border:none;background: transparent"
                                            onclick="diminuisci('<?php echo $a->id ?>','<?php echo ($a->xqtaconf != '0.00') ? intval($a->xqtaconf) : '1' ?>')"
                                            id="diminuisci_<?php echo $a->id ?>" class="add-cart"><i class="fa fa-solid fa-minus
" style="background-color:white;border:none"></i></button>
                                    <input type="number" id="quantita_<?php echo $a->id ?>"
                                           style="width: 20%;text-align: center"
                                           class="add-cart"
                                           onchange="check(<?php echo $a->id ?>, <?php echo $a->xqtaconf; ?>, <?php echo $a->disponibile; ?>);"
                                           value="<?php /* echo ($a->disponibile > $a->xqtaconf) ? ($a->xqtaconf != '0.00') ? intval($a->xqtaconf) : '1' : '0' */ ?>0"
                                           step="<?php echo ($a->xqtaconf != '0.00') ? intval($a->xqtaconf) : '1' ?>">
                                    <button type="button" style="border:none;background: transparent"
                                            onclick="aumenta('<?php echo $a->id ?>','<?php echo ($a->xqtaconf != '0.00') ? intval($a->xqtaconf) : '1' ?>','<?php echo $a->disponibile ?>')"
                                            id="aumenta_<?php echo $a->id ?>" class="add-cart"><i
                                                class="fa fa-solid fa-plus"
                                                style="background-color:white;border:none"> </i></button>
                                    <i class="fa fa-solid fa-shopping-cart"
                                       style="background-color:white;border:none"></i>
                                    <button type="button" style="width:30%;border:none;background: transparent"
                                            onclick="aggiungi('<?php echo $a->id ?>')"
                                            id="aggiungi_<?php echo $a->id ?>" class="add-cart">
                                        <strong>
                                            AGGIUNGI
                                        </strong>

                                    </button>

                                    <?php /*
                                    <button type="submit" style="visibility: hidden!important;top: 22px!important;" value="<?php echo ($a->xqtaconf != '0.00')?intval($a->xqtaconf):'1'?>" name="aggiungi_al_carrello">
                                            <a class="add-cart col-1"> Aggiungi al carrello
                                        </a>
                                    </button>
-->*/ ?>
                                    <div style="text-align: center;display: flex;gap:3%">
                                        <div class="red" <?php
                                        if ($a->immediato >= 16) echo 'style="background: green;"';
                                        if ($a->immediato > 0 && $a->immediato <= 15) echo 'style="background: yellow;"';
                                        if ($a->immediato <= 0) echo 'style=""';/*
                                        if ($a->disponibile <= 0 && $a->ordinato > 0) echo 'style="background: yellow;"';*/
                                        ?>></div>
                                        <h7><?php echo $a->cd_ar ?></h7>
                                        <div class="red"
                                             style="<?php if ($a->bollino_blu > 0) echo 'background: blue'; else echo 'display:none;'; ?>"></div>
                                    </div>
                                    <h6><?php echo $a->descrizione ?></h6>
                                    <!--<div class="rating">
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>-->
                                    <h6 style="color:red"><?php echo ($a->inner_misura != '') ? 'Quantitá per Inner ' . number_format($a->inner_misura, '2', ',', '.') : ''; ?></h6>
                                    <h5><?php if ($a->prezzo != '') if ($a->sconto == '') {
                                            echo number_format($a->prezzo, '2', ',', '') . '€';
                                        }else {
                                        echo number_format($a->prezzo - ($a->prezzo / 100) * $a->sconto, 2, ',', '') ?></h5>
                                <span class="sconto"><?php echo number_format($a->prezzo, '2', ',', ''); ?>
                                €</span><?php } ?>

                                </div>
                            </div>
                        </form>
                    </div>

                <?php } ?>


            <?php } else { ?>
                <div class="col-lg-4 col-md-6 col-sm-6"></div> <?php } ?>
        </div>

        <script>
            document.getElementById('count').value = '<?php echo $count;?>';
            document.getElementById('max_pag').value = '<?php echo (sizeof($max_pag) > 0) ? intval((intval($max_pag[0]->count_pagine) / 12)) : 0;?>';
            <?php if ($pagina == 1) echo 'document.getElementById(\'mostra\').innerHTML = \'Mostrati 1 - 12 di ' . $count . ' risultati.\';';
            else echo 'document.getElementById(\'mostra\').innerHTML = \'Mostrati ' . (($pagina * 12) - 12) . '-' . ($pagina * 12) . ' di ' . $count . ' risultati.\';';
            if ($count < 12) echo 'document.getElementById(\'count2\').innerHTML = \'\';';
            if ($count < 24) echo 'document.getElementById(\'count3\').innerHTML = \'\';';
            if ($count < 36) echo 'document.getElementById(\'count4\').innerHTML = \'\';';?>

        </script>
        <?php

        if ($count <= 0 && $pagina != 1) {
            ?>
            <script type="text/javascript">
                top.location.href = 'https://gtrimport.it/cliente/articoli?pagina=1&articoli_finiti=1';
            </script>
            <?php
        }
    }

    public function load_pagine($pagine, $count)
    {

        $pagin = $pagine;
        $count = intval($count);
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="product__pagination">
                    <?php if (intval($pagine) - 1 > 0) { ?><a
                        href="/cliente/articoli?pagina=<?php echo intval($pagine) - 1; ?>"><</a><?php } ?>
                    <?php if (intval($pagine) - 3 > 0) { ?><a
                        href="/cliente/articoli?pagina=<?php echo intval($pagine) - 3; ?>"><?php echo intval($pagine) - 3; ?></a><?php } ?>
                    <?php if (intval($pagine) - 2 > 0) { ?><a
                        href="/cliente/articoli?pagina=<?php echo intval($pagine) - 2; ?>"><?php echo intval($pagine) - 2; ?></a><?php } ?>
                    <?php if (intval($pagine) - 1 > 0) { ?><a
                        href="/cliente/articoli?pagina=<?php echo intval($pagine) - 1; ?>"><?php echo intval($pagine) - 1; ?></a><?php } ?>
                    <a class="active" href="/cliente/articoli?pagina=<?php echo $pagine ?>"><?php echo $pagine ?></a>
                    <?php if ((intval($pagine) + 1) * 12 <= $count) { ?><a
                        href="/cliente/articoli?pagina=<?php echo intval($pagine) + 1; ?>"><?php echo intval($pagine) + 1; ?></a><?php } ?>
                    <?php if ((intval($pagine) + 2) * 12 <= $count) { ?><a
                        href="/cliente/articoli?pagina=<?php echo intval($pagine) + 2; ?>"><?php echo intval($pagine) + 2; ?></a><?php } ?>
                    <?php if ((intval($pagine) + 3) * 12 <= $count) { ?><a
                        href="/cliente/articoli?pagina=<?php echo intval($pagine) + 3; ?>"><?php echo intval($pagine) + 3; ?></a><?php } ?>

                    <?php if (intval($pagine) < $count) { ?>
                        <?php if (intval($pagine + 1) < $count) { ?><a>...</a><?php } ?>
                        <a
                                href="/cliente/articoli?pagina=<?php echo intval($count); ?>"><?php echo intval($count); ?></a>
                    <?php } ?>
                    <a href="/cliente/articoli?pagina=<?php echo ++$pagine ?>">></a>
                </div>
            </div>
        </div>
        <?php
        if ($count <= 0 && $pagin != 1) {
            ?>
            <script type="text/javascript">
                top.location.href = 'https://gtrimport.it/cliente/articoli?pagina=1&articoli_finiti=1';
            </script>
            <?php

        }


    }

    public function load_seconda_categoria($categoria)
    {

        $utente = session('utente');

        $cond = '';

        if ($categoria != '0')
            list($arclasse1, $arclasse2, $arclasse3) = explode('-', $categoria);
        if ($categoria != '0') {
            if ($arclasse1 != '' && $arclasse1 != 0)
                $cond .= ' and cd_arclasse1 = \'' . $arclasse1 . '\'';
            else
                exit();
        }

        $categoria2 = DB::SELECT('SELECT * FROM arclasse2 where id_ditta = ' . $utente->id_ditta . ' ' . $cond);

        $seconda_categoria = '
                 <div class="card-heading">
                     <a data-toggle="collapse" data-target="#collapseOne">Seconda Categoria</a>
                 </div>
                 <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                     <div class="card-body">
                         <div class="shop__sidebar__categories">
                             <ul class="nice-scroll">';

        foreach ($categoria2 as $c) {
            $seconda_categoria .= '
                                 <li>
                                     <a class="prova1" onclick="filtro(\'' . $c->cd_arclasse1 . '-' . $c->cd_arclasse2 . '-' . '\'),terza_categoria(\'' . $c->cd_arclasse1 . '-' . $c->cd_arclasse2 . '-' . '\'),colore1(\'' . $c->id . '\')" id="attiva_' . $c->id . '"';
            if ($c->cd_arclasse2 == $arclasse2) $seconda_categoria .= ' style="color:blue" ';

            $seconda_categoria .= '>' . $c->descrizione . '</a>
                                 </li>';
        }


        $seconda_categoria .= '</ul>
                         </div>
                     </div>
                 </div>
             ';

        echo $seconda_categoria;
    }

    public function load_terza_categoria($categoria)
    {

        $utente = session('utente');

        $cond = '';

        if ($categoria != '0')
            list($arclasse1, $arclasse2, $arclasse3) = explode('-', $categoria);

        if ($categoria != '0') {
            if ($arclasse1 != '')
                $cond .= ' and cd_arclasse1 = \'' . $arclasse1 . '\'';
        }

        if ($categoria != '0') {
            if ($arclasse2 != '')
                $cond .= ' and cd_arclasse2 = \'' . $arclasse2 . '\'';
            else
                exit();
        }
        $categoria3 = DB::SELECT('SELECT * FROM arclasse3 where id_ditta = ' . $utente->id_ditta . ' ' . $cond);


        $terza_categoria = '
                         <div class="card-heading">
                             <a data-toggle="collapse" data-target="#collapseOne">Terza Categoria</a>
                         </div>
                         <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                             <div class="card-body">
                                 <div class="shop__sidebar__categories">
                                     <ul class="nice-scroll">';

        foreach ($categoria3 as $c) {
            $terza_categoria .= '
                                         <li>
                                             <a class="prova2" onclick="filtro(\'' . $c->cd_arclasse1 . '-' . $c->cd_arclasse2 . '-' . $c->cd_arclasse3 . '\'),colore2(\'' . $c->id . '\')" id="attiva_' . $c->id . '"';
            if ($c->cd_arclasse3 == $arclasse3) $terza_categoria .= ' style="color:blue" ';

            $terza_categoria .= '>' . $c->descrizione . '</a>
                                         </li>';
        }


        $terza_categoria .= '</ul>
                                 </div>
                             </div>
                         </div>
                     ';
        echo $terza_categoria;

    }

    public function load_marche($marca)
    {

        $utente = session('utente');

        $marche = DB::SELECT('SELECT * FROM armarca where id_ditta = ' . $utente->id_ditta . ' ');

        foreach ($marche as $m) {
            ?>
            <li>
                <a class="prova_2"
                   onclick="filtro_2('<?php echo $m->id_armarca ?>'),colore_marca('<?php echo $m->id; ?>')"
                   id="attiva_marche_<?php echo $m->id ?>" <?php if ($m->id_armarca == $marca) echo 'style="color:blue;"' ?> ><?php echo $m->descrizione; ?></a>
            </li>
        <?php }

    }

    public function load_categoria($categoria)
    {

        $utente = session('utente');

        if ($categoria != '0')
            list($arclasse1, $arclasse2, $arclasse3) = explode('-', $categoria);

        $categoria_1 = DB::SELECT('SELECT * FROM arclasse1 where id_ditta = ' . $utente->id_ditta . ' ');

        /*<nav class="vertical" style="margin-left: 8px;">
            <ul>
                <?php foreach ($categoria as $c){?>
                <li>
                    <a onclick="filtro('<?php echo $c->cd_arclasse1.'--'; ?>')" href="#"><?php echo $c->descrizione; ?></a>
                    <ul>
                        <?php  $categoria2 = DB::SELECT('SELECT * FROM arclasse2 where id_ditta = '.$utente->id_ditta.' and cd_arclasse1 = \''.$c->cd_arclasse1.'\' ');foreach ($categoria2 as $c2){?>
                            <li>
                                <a onclick="filtro('<?php echo $c->cd_arclasse1.'-'.$c2->cd_arclasse2.'-'; ?>')" href="#"><?php echo $c2->descrizione; ?></a>
                                <ul>
                                    <?php  $categoria3 = DB::SELECT('SELECT * FROM arclasse3 where id_ditta = '.$utente->id_ditta.' and cd_arclasse1 = \''.$c->cd_arclasse1.'\' and cd_arclasse2 = \''.$c2->cd_arclasse2.'\' ');foreach ($categoria3 as $c3){?>
                                        <li><a onclick="filtro('<?php echo $c->cd_arclasse1.'-'.$c2->cd_arclasse2.'-'.$c3->cd_arclasse3; ?>')" href="#"><?php echo  $c3->descrizione?></a></li>
                                    <?php } ?>
                                </ul>
                            </li>

                        <?php }?>
                    </ul>
                </li>
               <?php }?>
            </ul>
        </nav> */
        foreach ($categoria_1 as $c) {
            ?>
            <li>
                <a class="prova"
                   onclick="filtro('<?php echo $c->cd_arclasse1 . '--'; ?>'),seconda_categoria('<?php echo $c->cd_arclasse1 . '--'; ?>'),colore('<?php echo $c->Id; ?>')"
                   id="attiva_<?php echo $c->Id ?>" <?php if ($c->cd_arclasse1 == $arclasse1) echo 'style="color:blue;"' ?> ><?php echo $c->descrizione; ?></a>
            </li>
        <?php }

    }

    /*
     *
     * <li><a href="#">Products +</a>
          <ul>
            <li>
              <a href="#">Sites +</a>
              <ul>
                <li><a href="#">Site 1</a></li>
                <li><a href="#">Site 2</a></li>
              </ul>
            </li>*/

    public function mostra_giacenze($id_articolo, Request $request)
    {

        $dati = $request->all();

        $articoli = DB::select('select * from articoli where id=' . $id_articolo);
        if (sizeof($articoli) > 0) {
            $articolo = $articoli[0];
            $ehere_string = ' where a.id =' . $id_articolo;

            $movimenti = DB::select('
            SELECT a.codice as articolo,mag.codice as magazzino,CONCAT(u.nome," ",u.cognome) as operatore,m.posizione,m.piano,m.lotto,sum(quantita) as quantita,ret,car,sca from mgmov m
            JOIN articoli a ON a.id = m.id_articolo
            JOIN magazzini mag ON mag.id = m.id_magazzino
            JOIN utenti u ON u.id = m.id_operatore
            ' . $ehere_string . '
            group by m.id_magazzino,m.posizione,m.piano,m.lotto
            
            
      	');

            return View::make('admin.ajax.lista_movimenti', compact('movimenti', 'articolo'));
        }
    }

    public function mostra_rettifica($id_articolo, Request $request)
    {

        $dati = $request->all();

        $articoli = DB::select('select * from articoli where id=' . $id_articolo);
        if (sizeof($articoli) > 0) {
            $articolo = $articoli[0];
            $ehere_string = ' where a.id =' . $id_articolo;

            $movimenti = DB::select('
            SELECT m.id,a.codice as articolo,mag.codice as magazzino,CONCAT(u.nome," ",u.cognome) as operatore,m.posizione,m.piano,m.lotto,sum(quantita) as quantita,ret,car,sca from mgmov m
            JOIN articoli a ON a.id = m.id_articolo
            JOIN magazzini mag ON mag.id = m.id_magazzino
            JOIN utenti u ON u.id = m.id_operatore
            ' . $ehere_string . '
            group by m.id_magazzino,m.posizione,m.piano,m.lotto
            
            
      	');

            return View::make('admin.ajax.lista_movimenti_rettifica', compact('movimenti', 'articolo'));
        }
    }

    public function mostra_giacenza($id_articolo, Request $request)
    {

        $dati = $request->all();

        $articoli = DB::select('select * from articoli where id=' . $id_articolo);
        if (sizeof($articoli) > 0) {
            $articolo = $articoli[0];
            $ehere_string = ' where a.id =' . $id_articolo;

            $movimenti = DB::select('
            SELECT m.id,a.codice as articolo,mag.codice as magazzino,CONCAT(u.nome," ",u.cognome) as operatore,m.posizione,m.piano,m.lotto,sum(quantita) as quantita,ret,car,sca from mgmov m
            JOIN articoli a ON a.id = m.id_articolo
            JOIN magazzini mag ON mag.id = m.id_magazzino
            JOIN utenti u ON u.id = m.id_operatore
            ' . $ehere_string . '
            group by m.id_magazzino,m.posizione,m.piano,m.lotto
            
            
      	');

            return View::make('admin.ajax.lista_movimenti_giacenza', compact('movimenti', 'articolo'));
        }
    }

}
