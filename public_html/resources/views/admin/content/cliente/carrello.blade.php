<?php if ($cart == '') $cart = []; ?>
<?php $ditta = session('utente'); ?>
<?php $ditta = DB::SELECT('select * from ditta where id= \'' . $ditta->id_ditta . '\'')[0]->token; ?>
        <!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Carrello</h4>
                    <div class="breadcrumb__links">
                        <a href="./index">Home</a>
                        <span>Carrello</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

{{--<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad cellulare_si">
    <section class="h-100 h-custom" style="background-color: #d2c9ff;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12">
                    <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                        <div class="card-body p-0">
                            <div class="row g-0">
                                <div class="col-lg-8">

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>--}}
<section class="shopping-cart spad cellulare">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="shopping__cart__table">
                    <table>
                        <thead>
                        <tr>
                            <th style="text-align: center"></th>
                            <th style="text-align: center">Prodotto</th>
                            <th style="text-align: center"></th>
                            <th style="text-align: center">Quantità</th>
                            <th style="text-align: center">Note</th>
                            <th style="text-align: center">Totale</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (sizeof($cart) > 0){ ?>
                            <?php foreach ($cart as $c){ ?>
                        <form method="post" id="form_id">
                            <tr>
                                <td>
                                    <div class="red" <?php $disponibile = DB::SELECT('SELECT if(Disponibile is null,0,Disponibile) as Disponibile FROM mggiacenza where cd_ar = \'' . $c['nome'] . '\' and cd_mg = \'00001\' and id_ditta = \'' . $utente->id_ditta . '\' ');if (sizeof($disponibile) > 0) $disponibile = $disponibile[0]->Disponibile; else $disponibile = 0; if ($disponibile > 50) echo 'style="background: green"';if ($disponibile <= 50 && $disponibile > 0) echo 'style="background: yellow"'; ?>></div>
                                </td>
                                <td class="product__cart__item" style="text-align: center">
                                    <div class="product__cart__item__pic zoom">
                                        <img src="<?php echo ($c['immagine'] != '')? $c['immagine']:'/img/'.$ditta.'/no_logo_'.$ditta.'.png';?>"
                                             style="max-height: 150px" alt="">
                                    </div>
                                </td>
                                <td>
                                    <div class="product__cart__item__text" style="text-align: center">
                                        <h6>
                                            <strong><?php echo $c['nome'] . '</strong> <br> ' . (($c['barcode'] != '') ? '- <br> ' . $c['barcode'] . '<br>' : '') . '- <br>';echo DB::SELECT('SELECT * FROM ar where cd_ar = \'' . $c['nome'] . '\' and id_ditta = ' . $utente->id_ditta . ' ')[0]->descrizione ?>
                                        </h6>
                                            <?php if ($c["sconto"] == 0){ ?>
                                        <h5><strong><?php echo $c["prezzo"] . '€'; ?></strong></h5>
                                        <?php }else{ ?>
                                        <h5><?php echo floatval($c["prezzo"]) - floatval(floatval($c["prezzo"]) / 100) * $c["sconto"] . '€'; ?></h5>
                                        <span class="sconto"><?php echo $c['prezzo'] . '€'; ?></span>
                                        <?php } ?>
                                    </div>
                                </td>
                                <td class="quantity__item" style="text-align: center">

                                    <button type="button" style="border:none;margin: 5px;background: transparent"
                                            id="diminuisci" name="diminuisci"
                                            onclick="diminuisci_c('<?php echo $c["id"]?>','<?php echo $c['nome'];?>','<?php echo ($c['xqtaconf'] != '0.00')?$c['xqtaconf']:'1.00';?>')"
                                            value="diminuisci">
                                        <i class="fa fa-solid fa-minus" style="background-color:white;border:none">
                                        </i>
                                    </button>
                                    <!--<strong><?php echo $c['quantita']; ?></strong>-->
                                    <input style="border:none;width: 20%;text-align: center" type="number" step="1"
                                           id="qta_<?php echo $c['nome'];?>" value="<?php echo $c['quantita'];?>"
                                           onblur="cambia(<?php echo $c["id"]?>,'<?php echo $c['nome']?>')">
                                    <button type="button" style="border:none;margin: 5px;background: transparent"
                                            id="aggiungi" name="aggiungi"
                                            onclick="aggiungi_c('<?php echo $c["id"]?>','<?php echo $c['nome'];?>','<?php echo ($c['xqtaconf'] != '0.00')?$c['xqtaconf']:'1.00';?>')"
                                            value="Aggiungi">
                                        <i class="fa fa-solid fa-plus" style="background-color:white;border:none"></i>
                                    </button>

                                </td>
                                <td class="cart__price" style="text-align: center">
                                    <input type="text" class="form-control"
                                           onkeyup="inserisci_nota('<?php echo $c["id"]?>','_cellulare')" name="note_{{ $c["id"] }}_cellulare"
                                           id="note_{{ $c["id"] }}_cellulare" value="<?php echo $c['note'];?>">
                                </td>
                                <td class="cart__price" style="text-align: center">
                                        <?php
                                        $c['prezzo'] = str_replace(',', '.', $c['prezzo']); if ($c["sconto"] == 0){ ?>
                                    <h5>
                                        <strong><?php echo number_format(floatval($c['prezzo']) * floatval($c["quantita"]), 2, ',', '') . '€'; ?></strong>
                                    </h5>
                                    <?php }else{ ?>
                                    <h5>
                                        <strong><?php echo number_format((floatval($c['prezzo']) - floatval(($c["prezzo"] / 100)) * floatval($c["sconto"])) * floatval($c["quantita"]), 2, ',', '') . '€'; ?></strong>
                                    </h5><span
                                            class="sconto"><?php echo floatval($c['prezzo']) * floatval($c["quantita"]) . '€'; ?></span>
                                    <?php } ?></td>
                                <td class="cart__close" style="text-align: center">
                                    <button type="submit" style="border:none;background: transparent" id="elimina_riga"
                                            name="elimina_riga" value="Elimina"><i class="fa fa-trash"></i></button>
                                </td>
                                <input type="hidden" name="id" id="id" value="<?php echo $c["id"]; ?>">
                                <input type="hidden" name="quantita" id="quantita"
                                       value="<?php echo $c["quantita"]; ?>">
                                <input type="hidden" name="sconto" id="sconto" value="<?php echo $c["sconto"]; ?>">
                            </tr>
                        </form>
                        <?php } ?>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php if (sizeof($cart) <= 0){ ?>
                <div class="container-fluid  mt-100">
                    <div class="row">

                        <div class="col-12">

                            <div class="card-body cart">
                                <div class="col-sm-12 empty-cart-cls text-center">
                                    <img src="https://i.imgur.com/dCdflKN.png" width="130" height="130"
                                         class="img-fluid mb-4 mr-3">
                                    <h3><strong>Il tuo carrello è vuoto</strong></h3>
                                    <h4>Aggiungi qualcosa!</h4>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
                <?php } ?>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="/cliente/articoli?pagina=1">Continua a Comprare</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn update__btn">
                            <a href="/cliente/carrello"><i class="fa fa-spinner"></i> Aggiorna carrello</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4" style="padding-top: 20px"><!--
                <div class="cart__discount">
                    <h6>Discount codes</h6>
                    <form action="#">
                        <input type="text" placeholder="Coupon code">
                        <button type="submit">Apply</button>
                    </form>
                </div>-->
                <div class="cart__total">
                    <h6>Totale Carrello</h6>
                    <ul>
                        <li>Imponibile <span><?php $totali = 0.00;if (sizeof($cart) > 0) {
                                    foreach ($cart as $c) {
                                        $c['prezzo'] = str_replace(',', '.', $c['prezzo']);
                                        if ($c['sconto'] == '') $totali = floatval(floatval($totali) + floatval($c['prezzo']) * floatval($c['quantita'])); else $totali = floatval(floatval($totali) + (floatval($c['prezzo']) - ($c['prezzo'] / 100) * $c['sconto']) * floatval($c['quantita']));
                                    }
                                } echo number_format($totali, 2, ',', ''); ?> €</span></li>
                        <li>Totale <span><?php $totali = 0.00; if (sizeof($cart) > 0) {
                                    foreach ($cart as $c) {
                                        $c['prezzo'] = str_replace(',', '.', $c['prezzo']);
                                        if ($c['sconto'] == '') $totali = floatval(floatval($totali) + floatval($c['prezzo']) * floatval($c['quantita'])); else $totali = floatval(floatval($totali) + (floatval($c['prezzo']) - ($c['prezzo'] / 100) * $c['sconto']) * floatval($c['quantita']));
                                    }
                                } echo number_format($totali + (floatval($totali) / 100) * 22, 2, ',', ''); ?> €</span>
                        </li>
                    </ul>
                    <p>Per favore, inserisci la modalità di spedizione / ritiro:</p>
                    <input type="radio" id="sede" name="spedizione" value="sede" required>
                    <label for="sede">Ritiro in Sede</label><br>
                    <input type="radio" id="corriere" name="spedizione" value="corriere" required>
                    <label for="corriere">Spedizione corriere</label><br>
                    <?php if ($utente->cd_provincia == 'AV' || $utente->cd_provincia == 'BN' || $utente->cd_provincia == 'CE' || $utente->cd_provincia == 'NA' || $utente->cd_provincia == 'SA'){ ?>
                    <input type="radio" id="interno" name="spedizione" value="interno">
                    <label for="interno">Consegna da G.T.R.</label>
                    <?php } ?>
                    <form method="post" enctype="multipart/form-data">

                        <div style="margin: 1em">

                            <label for="file_ldv" style="font-size: 0.85em">Inserire File LDV (NON OBBLIGATORIO)</label>
                            <input type="file" name="file_ldv" id="file_ldv" accept=".pdf, .xls, .xslx">

                        </div>

                        <div style="margin:3%;">
                            <label for="data_ritiro" style="font-size: 0.85em">Data Ritiro (NON OBBLIGATORIO)</label>
                            <input type="date" class="form-control" name="data_ritiro" id="data_ritiro">
                        </div>
                        <?php if (substr($utente->cd_cf, 0, 1) == 'C') {?>
                        <button type="<?php echo (sizeof($cart) > 0)? 'submit':'button'?>"
                                <?php echo (sizeof($cart) <= 0) ? 'onclick="$(\'#vuoto\').modal(\'show\');"' : '' ?> name="crea_documento"
                                class="primary-btn" value="crea" style="width:100%">
                            Invia Ordine
                        </button>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="shopping-cart spad cellulare_si">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="p-5">
                    <?php if (sizeof($cart) > 0){ ?>
                        <?php foreach ($cart as $c){ ?>
                    <form method="post" id="form_id">
                        <div class="row mb-4 d-flex justify-content-between align-items-center"
                             style="text-align: center;">
                            <div class="col-md-2 col-lg-2 col-xl-2">
                                <img src="<?php echo ($c['immagine'] != '')? $c['immagine']:'/img/'.$ditta.'/no_logo_'.$ditta.'.png'; ?>"
                                     class="img-fluid rounded-3" alt="Cotton T-shirt">
                            </div>
                            <div class="col-md-3 col-lg-3 col-xl-3 d-flex justify-content-center  align-items-center">
                                <div class="red"
                                        <?php $disponibile = DB::SELECT('SELECT if(Disponibile is null,0,Disponibile) as Disponibile FROM mggiacenza where cd_ar = \'' . $c['nome'] . '\' and cd_mg = \'00001\' and id_ditta = \'' . $utente->id_ditta . '\' ');if (sizeof($disponibile) > 0) $disponibile = $disponibile[0]->Disponibile; else $disponibile = 0; if ($disponibile > 50) echo 'style="background: green;margin-right:5%;"';if ($disponibile < 50 && $disponibile > 0) echo 'style="background: yellow;margin-right:5%;"';if ($disponibile <= 0) echo 'style="margin-right:5%;"'; ?> ></div>
                                <h6 class="text-muted"><?php echo '<strong>' . $c['nome'] . '</strong>'; ?></h6>
                            </div>
                            <div class="col-md-3 col-lg-3 col-xl-2 d-flex justify-content-center  align-items-center">
                                <h6 class="text-black mb-0"><?php echo DB::SELECT('SELECT * FROM ar where cd_ar = \'' . $c['nome'] . '\' and id_ditta = ' . $utente->id_ditta . ' ')[0]->descrizione; ?> </h6>
                            </div>
                            <div class="col-md-3 col-lg-3 col-xl-2 d-flex justify-content-center  align-items-center">
                                {{--                                <button class="btn btn-link px-2"
                                                                        onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                                    <i class="fa fa-solid fa-minus"></i>
                                                                </button>
                                                                <input id="form1" min="0" name="quantity" value="1" type="number"
                                                                       class="form-control form-control-sm"/>

                                                                <button class="btn btn-link px-2"
                                                                        onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                                    <i class="fa fa-solid fa-plus"></i>
                                                                </button>@--}}
                                <button type="button" style="border:none;margin: 5px;background: transparent"
                                        id="diminuisci" name="diminuisci"
                                        onclick="diminuisci_c('<?php echo $c["id"]?>','<?php echo $c['nome'];?>','<?php echo ($c['xqtaconf'] != '0.00')?$c['xqtaconf']:'1.00';?>')"
                                        value="diminuisci">
                                    <i class="fa fa-solid fa-minus" style="background-color:white;border:none">
                                    </i>
                                </button>
                                <input style="border:none;width: 20%;text-align: center" type="number" step="1"
                                       id="qta_<?php echo $c['nome'];?>" value="<?php echo $c['quantita'];?>"
                                       onblur="cambia(<?php echo $c["id"]?>,'<?php echo $c['nome']?>')">
                                <button type="button" style="border:none;margin: 5px;background: transparent"
                                        id="aggiungi" name="aggiungi"
                                        onclick="aggiungi_c('<?php echo $c["id"]?>','<?php echo $c['nome'];?>','<?php echo ($c['xqtaconf'] != '0.00')?$c['xqtaconf']:'1.00';?>')"
                                        value="Aggiungi">
                                    <i class="fa fa-solid fa-plus" style="background-color:white;border:none">
                                    </i>
                                </button>
                            </div>
                            <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                <h6 class="mb-0">
                                        <?php if ($c["sconto"] == 0){ ?>
                                    <h5><strong><?php echo $c["prezzo"] . '€'; ?></strong></h5>
                                    <?php }else{ ?>
                                    <h5><?php echo floatval($c["prezzo"]) - floatval(floatval($c["prezzo"]) / 100) * $c["sconto"] . '€'; ?></h5>
                                    <span class="sconto"><?php echo $c['prezzo'] . '€'; ?></span>
                                    <?php } ?>

                                    X <?php echo $c['quantita']; ?><?php
                                          $c['prezzo'] = str_replace(',', '.', $c['prezzo']); if ($c["sconto"] == 0){ ?>
                                    <h5>
                                        <strong><?php echo number_format(floatval($c['prezzo']) * floatval($c["quantita"]), 2, ',', '') . '€'; ?></strong>
                                    </h5>
                                    <?php }else{ ?>
                                    <h5>
                                        <strong><?php echo number_format((floatval($c['prezzo']) - floatval(($c["prezzo"] / 100)) * floatval($c["sconto"])) * floatval($c["quantita"]), 2, ',', '') . '€'; ?></strong>
                                    </h5><span
                                            class="sconto"><?php echo floatval($c['prezzo']) * floatval($c["quantita"]) . '€'; ?></span>
                                    <?php } ?>
                                </h6>
                            </div>

                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                <input type="text" class="form-control"
                                       onchange="inserisci_nota('<?php echo $c["id"]?>','_cellulare_si')" name="note_{{ $c["id"] }}_cellulare_si"
                                       id="note_{{ $c["id"] }}_cellulare_si" value="<?php echo $c['note'];?>">
                            </div>
                            <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                <button type="submit" style="border:none;background: transparent" id="elimina_riga"
                                        name="elimina_riga" value="Elimina"><i class="fa fa-trash"></i></button>
                            </div>
                            <input type="hidden" name="id" id="id" value="<?php echo $c["id"]; ?>">
                            <input type="hidden" name="quantita" id="quantita" value="<?php echo $c["quantita"]; ?>">
                            <input type="hidden" name="sconto" id="sconto" value="<?php echo $c["sconto"]; ?>">
                        </div>
                    </form>
                    <hr class="my-4">
                    <?php }
                    } ?>
                    <?php if (sizeof($cart) <= 0){ ?>
                    <div class="container-fluid  mt-100">
                        <div class="row">

                            <div class="col-12">

                                <div class="card-body cart">
                                    <div class="col-sm-12 empty-cart-cls text-center">
                                        <img src="https://i.imgur.com/dCdflKN.png" width="130" height="130"
                                             class="img-fluid mb-4 mr-3">
                                        <h3><strong>Il tuo carrello è vuoto</strong></h3>
                                        <h4>Aggiungi qualcosa!</h4>
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="/cliente/articoli?pagina=1">Continua a Comprare</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="/cliente/carrello"><i class="fa fa-spinner"></i> Aggiorna carrello</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-4" style="padding-top: 20px">
                <div class="cart__total">
                    <h6>Totale Carrello</h6>
                    <ul>
                        <li>Imponibile <span><?php $totali = 0.00;if (sizeof($cart) > 0) {
                                    foreach ($cart as $c) {
                                        $c['prezzo'] = str_replace(',', '.', $c['prezzo']);
                                        if ($c['sconto'] == '') $totali = floatval(floatval($totali) + floatval($c['prezzo']) * floatval($c['quantita'])); else $totali = floatval(floatval($totali) + (floatval($c['prezzo']) - ($c['prezzo'] / 100) * $c['sconto']) * floatval($c['quantita']));
                                    }
                                } echo number_format($totali, 2, ',', ''); ?> €</span></li>
                        <li>Totale <span><?php $totali = 0.00; if (sizeof($cart) > 0) {
                                    foreach ($cart as $c) {
                                        $c['prezzo'] = str_replace(',', '.', $c['prezzo']);
                                        if ($c['sconto'] == '') $totali = floatval(floatval($totali) + floatval($c['prezzo']) * floatval($c['quantita'])); else $totali = floatval(floatval($totali) + (floatval($c['prezzo']) - ($c['prezzo'] / 100) * $c['sconto']) * floatval($c['quantita']));
                                    }
                                } echo number_format($totali + (floatval($totali) / 100) * 22, 2, ',', ''); ?> €</span>
                        </li>
                    </ul>
                    <p>Per favore, inserisci la modalità di spedizione / ritiro:</p>
                    <input type="radio" id="sede" name="spedizione" value="sede" required>
                    <label for="sede">Ritiro in Sede</label><br>
                    <input type="radio" id="corriere" name="spedizione" value="corriere" required>
                    <label for="corriere">Spedizione corriere</label><br>
                    <?php if ($utente->cd_provincia == 'AV' || $utente->cd_provincia == 'BN' || $utente->cd_provincia == 'CE' || $utente->cd_provincia == 'NA' || $utente->cd_provincia == 'SA'){ ?>
                    <input type="radio" id="interno" name="spedizione" value="interno">
                    <label for="interno">Consegna da G.T.R.</label>
                    <?php } ?>
                    <form method="post" enctype="multipart/form-data">

                        <div style="margin: 1em">
                            <label for="file_ldv" style="font-size: 0.85em">Inserire File LDV (NON OBBLIGATORIO)</label>
                            <input type="file" name="file_ldv" id="file_ldv" accept=".pdf, .xls, .xslx">
                        </div>

                        <div style="margin:3%;">
                            <label for="data_ritiro" style="font-size: 0.85em">Data Ritiro (NON OBBLIGATORIO)</label>
                            <input type="date" class="form-control" name="data_ritiro" id="data_ritiro">
                        </div>
                        <button type="<?php echo (sizeof($cart) > 0)? 'submit':'button'?>"
                                <?php echo (sizeof($cart) <= 0) ? 'onclick="$(\'#vuoto\').modal(\'show\');"' : '' ?> name="crea_documento"
                                class="primary-btn" value="crea" style="width:100%">
                            Invia Ordine
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="vuoto" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box" style="background-color: red !important">
                    <i class="fa fa-solid fa-exclamation-triangle"></i>
                </div>
                <h4 class="modal-title w-100">Errore!</h4>
            </div>
            <div class="modal-body">
                <p class="text-center">Nessun articolo è stato aggiunto nel carrello.</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-block" style="background-color: red !important" data-dismiss="modal">
                    OK
                </button>
            </div>
        </div>
    </div>
</div>

<div id="ordine" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="fa fa-solid fa-check"></i>
                </div>
                <h4 class="modal-title w-100">Complimenti!</h4>
            </div>
            <div class="modal-body">
                <p class="text-center">Il tuo ordine è stato correttamente ricevuto.</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-block" data-dismiss="modal" onclick="clearpath();">OK</button>
            </div>
        </div>
    </div>
</div>
<div id="max_disp" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box" style="background-color: red">
                    <i class="fa fa-solid fa-times"></i>
                </div>
                <h4 class="modal-title w-100">Attenzione!</h4>
            </div>
            <div class="modal-body">
                <p class="text-center">Massimo disponibile raggiunto
                    .</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-block" data-dismiss="modal" onclick="clearpath();">OK</button>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script type="text/javascript">

    function clearpath() {
        location = location.origin + location.pathname;
    }

    function diminuisci_c(id, nome, xqtaconf) {
        quantita = document.getElementById('qta_' + nome).value;
        if (quantita > parseInt(xqtaconf)) {
            document.getElementById('qta_' + nome).value = parseInt(quantita) - parseInt(xqtaconf);
            cambia(id, nome)
        } else {
            $('#myModal').modal('show');
        }
    }

    function aggiungi_c(id, nome, xqtaconf) {
        quantita = document.getElementById('qta_' + nome).value;
        document.getElementById('qta_' + nome).value = parseInt(quantita) + parseInt(xqtaconf);
        cambia(id, nome)
    }

    document.addEventListener("keypress", function (event) {
        // If the user presses the "Enter" key on the keyboard
        if (event.key === "Enter") {
            // Cancel the default action, if needed
            event.preventDefault();
            // Trigger the button element with a click
            document.activeElement.blur();
        }
    });

    $(document).ready(function () {
        <?php if ($ordine == 1){ ?>
        $('#ordine').modal('show');
        <?php } ?>
        <?php if ($max_disp == 1){ ?>
        $('#max_disp').modal('show');
        <?php } ?>
    })

    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    function cambia(id, nome) {
        qta = document.getElementById('qta_' + nome).value;
        $.ajax({
            url: "<?php echo URL::asset('ajax/cambia_qta') ?>/" + qta + "/" + id,
        }).done(function (result) {
            if (result == 'max_disp') location.href = '?max_disp=1';
            else location.reload();
        });

    }

    function inserisci_nota(id,name) {
        nota = document.getElementById('note_' + id + name).value;
        $.ajax({
            url: "<?php echo URL::asset('ajax/cambia_note') ?>/" + id,
            data: {"nota": nota},
            dataType : 'json',
        }).done(function (result) {
            console.log(result);
        });

    }

</script>

<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box" style="background-color: red">
                    <i class="fa fa-solid fa-ban"></i>
                </div>
                <h4 class="modal-title w-100">Errore!</h4>
            </div>
            <div class="modal-body">
                <p class="text-center">Quantita' minima di acquisto raggiunta.</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>