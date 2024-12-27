<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Dettaglio Fattura </h4>
                    <div class="breadcrumb__links">
                        <a href="/cliente/index">Home</a>
                        <a href="/cliente/storico">Storico</a>
                        <span>Dettaglio</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad" style="margin-top: -4%!important">
    <div class="container">

        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>

        <div class="page-content container">
            <div class="page-header text-blue-d2">
                <h1 class="page-title text-secondary-d1">
                    Fattura
                    <small class="page-info">
                        <i class="fa fa-angle-double-right text-80"></i>
                        ID: <?php echo $testa[0]->numerodoc; ?>
                    </small>
                </h1>

                <div class="page-tools">
                    <div class="action-buttons">
                        <a class="btn bg-white btn-light mx-1px text-95"
                           onclick="window.open(window.location.href+'/stampa');" data-title="Print">
                            <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                            Print
                        </a>{{--
                        <a class="btn bg-white btn-light mx-1px text-95" href="#" data-title="PDF">
                            <i class="mr-1 fa fa-file-pdf-o text-danger-m1 text-120 w-2"></i>
                            Export
                        </a>--}}
                    </div>
                </div>
            </div>

            <div class="container px-0">
                <div class="row mt-4">
                    <div class="col-12 col-lg-12">
                        <!-- .row -->

                        <hr class="row brc-default-l1 mx-n1 mb-4"/>

                        <div class="row">
                            <div class="col-sm-6">
                                <div>
                                    <span class="text-sm text-grey-m2 align-middle">A:</span>
                                    <span class="text-600 text-110 text-blue align-middle"><?php echo $utente->descrizione; ?></span>
                                </div>
                                <div class="text-grey-m2">
                                    <div class="my-1">
                                        <?php echo $utente->localita . ',' . $utente->indirizzo ?>
                                    </div>
                                    <div class="my-1">
                                        <?php echo $utente->cd_nazione . ',' . $utente->cd_provincia ?>
                                    </div>
                                    <div class="my-1"><i class="fa fa-envelope fa-flip-horizontal text-secondary"></i>
                                        <b class="text-600"><?php echo $utente->email ?></b></div>
                                </div>
                            </div>
                            <!-- /.col -->

                            <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                                <hr class="d-sm-none"/>
                                <div class="text-grey-m2">
                                    <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                        Fattura
                                    </div>

                                    <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span
                                                class="text-600 text-90">ID: </span><?php echo $testa[0]->numerodoc ?>
                                    </div>

                                    <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span
                                                class="text-600 text-90">Data Documento:</span> <?php echo $testa[0]->datadoc ?>
                                    </div>

                                    <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span
                                                class="text-600 text-90">Stato:</span> {{--<span class="badge badge-warning badge-pill px-25">
                                    <?php if($testa[0]->stato == 0) echo 'Non Fatturata'; if($testa[0]->stato == 1) echo 'Non Pagata'; if($testa[0]->stato == 2) echo 'Pagata'; ?></span>--}}
                                        <span class="badge badge-warning badge-pill px-25"><?php if ($testa[0]->cd_do == 'FTV') { ?><?php if ($testa[0]->pagata == 'NF') echo 'Non Fatturata';
                                                if ($testa[0]->pagata == '0') echo 'Non Pagata';
                                                if ($testa[0]->pagata == '1') echo 'Pagata';
                                                if ($testa[0]->pagata == '2') echo 'Pagata Parzialmente';
                                                ?><?php } else { ?><?php echo ($testa[0]->righeevadibili == 0) ? 'Evaso' : 'Da Evadere';
                                            } ?></span>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>

                        <div class="mt-4">
                            <div class="row text-600 text-white bgc-default-tp1 py-25">
                                <div class="d-none d-sm-block col-1" style="text-align: center">#</div>
                                <div class="col-9 col-sm-5" style="text-align: center">Descrizione</div>
                                <div class="d-none d-sm-block col-4 col-sm-2" style="text-align: center">Quantità</div>
                                <div class="d-none d-sm-block col-sm-2" style="text-align: center">Prezzo Unitario</div>
                                <div class="col-2" style="text-align: center">Prezzo Totale</div>
                            </div>

                            <div class="text-95 text-secondary-d3">
                                <div class="text-95 text-secondary-d3">
                                    <?php foreach ($righe as $r) { ?>
                                    <div class="row mb-2 mb-sm-0 py-25">
                                        <div class="d-none d-sm-block col-1"><?php echo $r->cd_ar; ?> </div>
                                        <div class="col-9 col-sm-5"
                                             style="text-align: center"><?php echo $r->descrizione ?></div>
                                        <div class="d-none d-sm-block col-2"
                                             style="text-align: center"><?php echo $r->qta ?></div>
                                        <div class="d-none d-sm-block col-2 text-95"
                                             style="text-align: center"><?php echo number_format($r->prezzounitariov, '2',',',' ') . ' €' ?></div>
                                        <div class="col-2 text-secondary-d2"
                                             style="text-align: center"><?php echo number_format($r->prezzototalev, '2',',',' ') . ' €' ?></div>
                                    </div>
                                    <?php } ?>
                                </div>

                            </div>

                            <div class="row border-b-2 brc-default-l2"></div>

                            <!-- or use a table instead -->
                            <!--
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless border-0 border-b-2 brc-default-l1">
                            <thead class="bg-none bgc-default-tp1">
                                <tr class="text-white">
                                    <th class="opacity-2">#</th>
                                    <th>Description</th>
                                    <th>Qty</th>
                                    <th>Unit Price</th>
                                    <th width="140">Amount</th>
                                </tr>
                            </thead>

                            <tbody class="text-95 text-secondary-d3">
                                <tr></tr>
                                <tr>
                                    <td>1</td>
                                    <td>Domain registration</td>
                                    <td>2</td>
                                    <td class="text-95">$10</td>
                                    <td class="text-secondary-d2">$20</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    -->

                            <div class="row mt-3">
                                <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                                    <!--Extra note such as company or payment information...-->
                                </div>

                                <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                                    <div class="row my-2">
                                        <div class="col-7 text-right">
                                            Imponibile
                                        </div>
                                        <div class="col-5" style="text-align: right;">
                                            <span class="text-120 text-secondary-d1"><?php echo (sizeof($totali) > 0) ? number_format($totali[0]->totimponibilev, '2',',',' ') . ' €' : ''; ?></span>
                                        </div>
                                    </div>

                                    <div class="row my-2">
                                        <div class="col-7 text-right">
                                            Iva (22%)
                                        </div>
                                        <div class="col-5" style="text-align: right;">
                                            <span class="text-110 text-secondary-d1"><?php echo (sizeof($totali) > 0) ? number_format($totali[0]->totimpostav, '2',',',' ') . ' €' : ''; ?></span>
                                        </div>
                                    </div>

                                    <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                        <div class="col-7 text-right">
                                            Totale
                                        </div>
                                        <div class="col-5" style="text-align: right;">
                                            <span class="text-150 text-success-d3 opacity-2"><?php echo (sizeof($totali) > 0) ? number_format($totali[0]->totdocumentov, '2',',',' ') . ' €' : ''; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr/>

                            <div>
                                <span class="text-secondary-d1 text-105">Grazie per averci scelto</span>
                                <!--<a href="#" class="btn btn-info btn-bold px-4 float-right mt-3 mt-lg-0">Pay Now</a>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Checkout Section End -->
