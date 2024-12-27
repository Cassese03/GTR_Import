<?php $ditta = session('ditta'); ?>

        <!-- Contact Section Begin -->
<section class="contact spad">
    <?php if (substr($utente->cd_cf, 0, 1) == 'C') { ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="contact__text">
                    <div class="section-title">
                        <span>Informazioni</span>
                        <h2>Reclami</h2>
                        <p>Scrivere le politiche di reso</p>
                    </div>
                    <ul>
                        <li>
                            <h4>Italia</h4>

                            <p>Via Alberto Sordi, 9, 81030 Orta di Atella CE<br/>+39 081 19169257</p>
                        </li>
                        <li>

                            <a style="text-align: center;margin-inside: 5px">
                                <img style="width: 25%" data-setbg="/img/GTR1234/BestWay.jpg"
                                     src="/img/GTR1234/BestWay.jpg"
                                     onclick="location.href='https://bestwaystore.it/ricambi.html'">
                            </a>
                            <a style="text-align: center;" href="https://bestwaystore.it/ricambi.html"> PER ASSISTENZA
                                DIRETTA PREMI QUI </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <button class="btn-primary" onclick="location.href='/cliente/nuovo_reclamo'"
                        style="margin-left: 78%;background-color: #84B0CA;border-color: #84B0CA;border-radius: 10px">
                    Crea Reclamo
                </button>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-box clearfix">
                            <div class="table-responsive">
                                <table class="table user-list">
                                    <thead>
                                    <tr style="background-color: #84B0CA">
                                        <th style="text-align: center;color: white"><label>Stato</label></th>
                                        <th style="text-align: center;color: white"><label>N° Fattura</label></th>
                                        <th style="text-align: center;color: white"><label>Articolo </label></th>
                                        <th style="text-align: center;color: white"><label>Problema</label></th>
                                        <th style="text-align: center;color: white"><label>Email</label></th>
                                        <!--<th>&nbsp;</th>-->
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($reclami  as $r){ ?>
                                    <tr>
                                        <td>
                                            <a class="user-link"><?php echo $r->stato_text ?></a>
                                        </td>
                                        <td>
                                            <a class="user-link"><?php echo $r->riferimento_fattura ?></a>
                                        </td>
                                        <td style="text-align: center">
                                                <?php echo $r->cd_ar; ?>
                                        </td>
                                        <td style="text-align: center">
                                            <span class="label label-danger"><?php echo $r->problematica ?></span>
                                        </td>
                                        <td>
                                            <a><?php echo $r->email; ?></a>
                                        </td>

                                    </tr>
                                    <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                            <ul class="pagination pull-right">
                                <!--     <li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
                                     <li><a href="#">1</a></li>
                                     <li><a href="#">2</a></li>
                                     <li><a href="#">3</a></li>
                                     <li><a href="#">4</a></li>
                                     <li><a href="#">5</a></li>
                                     <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>-->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php if (substr($utente->cd_cf, 0, 1) == 'F') { ?>
    <div class="row" style="margin-left: 10%;margin-right: 10%;">
        <div style="text-align: center;width: 100%;"><label><strong>RECLAMI DA GESTIRE</strong></label></div>
        <div class="col-lg-12 col-md-12">
            <div class="main-box clearfix">
                <div class="table-responsive">
                    <table class="table user-list">
                        <thead>
                        <tr style="background-color: #84B0CA">
                            <th style="text-align: center;color: white"><label>Id</label></th>
                            <th style="text-align: center;color: white"><label>Stato</label></th>
                            <th style="text-align: center;color: white"><label>N° Fattura</label></th>
                            <th style="text-align: center;color: white"><label>Articolo </label></th>
                            <th style="text-align: center;color: white"><label>Problema</label></th>
                            <th style="text-align: center;color: white"><label>Email</label></th>
                            <th style="text-align: center;color: white;width:10%"><label>Data</label></th>
                            <th style="text-align: center;color: white"></th>
                            <!--<th>&nbsp;</th>-->
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reclami_aperti  as $r){ ?>
                        <tr>
                            <td>
                                <a style="margin-left:0px!important" class="user-link">
                                        <?php echo $r->id ?>
                                </a>
                            </td>
                            <td>
                                <a style="margin-left:0px!important" class="user-link">
                                        <?php echo $r->stato_text ?>
                                </a>
                            </td>
                            <td>
                                <a style="margin-left:0px!important"
                                   class="user-link"><?php echo $r->riferimento_fattura ?></a>
                            </td>
                            <td style="text-align: center">
                                    <?php echo $r->cd_ar; ?>
                            </td>
                            <td style="text-align: center">
                                <span class="label label-danger"><?php echo $r->problematica ?></span>
                            </td>
                            <td>
                                <a><?php echo $r->email; ?></a>
                            </td>
                            <td>
                                <a><?php echo date('d-m-Y', strtotime($r->data))
                                    ; ?></a>
                            </td>
                            <td>
                                <button class="btn btn-primary" onclick="openReclamo(<?php echo $r->id; ?>)"
                                        style="background-color: #17a2b8;border-color: #17a2b8;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-chevron-compact-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                              d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671"/>
                                    </svg>
                                </button>
                            </td>

                        </tr>
                        <?php } ?>

                        </tbody>
                    </table>
                </div>
                <ul class="pagination pull-right">
                    <!--     <li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
                         <li><a href="#">1</a></li>
                         <li><a href="#">2</a></li>
                         <li><a href="#">3</a></li>
                         <li><a href="#">4</a></li>
                         <li><a href="#">5</a></li>
                         <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>-->
                </ul>
            </div>
        </div>
    </div>

    <?php if (sizeof($reclami) > 0) { ?>
    <div class="row" style="margin-left: 10%;margin-right: 10%;">
        <div style="text-align: center;width: 100%;"><label><strong>RECLAMI GESTITI</strong></label></div>
        <div class="col-lg-12">
            <div class="main-box clearfix">
                <div class="table-responsive">
                    <table class="table user-list">
                        <thead>
                        <tr style="background-color: #84B0CA">
                            <th style="text-align: center;color: white"><label>Id</label></th>
                            <th style="text-align: center;color: white"><label>Stato</label></th>
                            <th style="text-align: center;color: white"><label>N° Fattura</label></th>
                            <th style="text-align: center;color: white"><label>Articolo </label></th>
                            <th style="text-align: center;color: white"><label>Problema</label></th>
                            <th style="text-align: center;color: white"><label>Email</label></th>
                            <th style="text-align: center;color: white;width:10%"><label>Data</label></th>
                            <!--<th>&nbsp;</th>-->
                        </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reclami  as $r){ ?>
                        <tr>
                            <td>
                                <a class="user-link"><?php echo $r->id ?></a>
                            </td>
                            <td>
                                <a class="user-link"><?php echo $r->stato_text ?></a>
                            </td>
                            <td>
                                <a class="user-link"><?php echo $r->riferimento_fattura ?></a>
                            </td>
                            <td style="text-align: center">
                                    <?php echo $r->cd_ar; ?>
                            </td>
                            <td style="text-align: center">
                                <span class="label label-danger"><?php echo $r->problematica ?></span>
                            </td>
                            <td>
                                <a><?php echo $r->email; ?></a>
                            </td>
                            <td>
                                <a><?php echo date('d-m-Y', strtotime($r->data));?></a>
                            </td>

                        </tr>
                        <?php } ?>


                        </tbody>
                    </table>
                </div>
                <ul class="pagination pull-right">
                    <!--     <li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
                         <li><a href="#">1</a></li>
                         <li><a href="#">2</a></li>
                         <li><a href="#">3</a></li>
                         <li><a href="#">4</a></li>
                         <li><a href="#">5</a></li>
                         <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>-->
                </ul>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php } ?>
</section>
<!-- Contact Section End -->

<?php foreach ($reclami_aperti as $r){ ?>
<form method="post">
    <div id="reclamiModal_{{$r->id}}" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                        <i class="fa fa-solid fa-check"></i>
                    </div>
                    <h4 class="modal-title w-100">Gestisci Reclamo</h4>
                </div>
                <div class="modal-body">
                    <strong> NR° Fattura : {{$r->riferimento_fattura}}</strong>
                    <br>
                    <strong> Codice Cliente : {{$r->cd_cf}}</strong>
                    <br>
                    <strong> Email : {{$r->email}}</strong>
                    <br>
                    <br>
                    <p class="text-center">
                        {{$r->problematica}}
                    </p>
                </div>
                <div class="modal-footer">
                    <div class="row" style="width: 100%">
                        <input type="hidden" name="id" value="{{$r->id}}">
                        <div class="col-6">
                            <button type="submit" name="ACCETTA" value="Accetta" class="btn btn-success btn-block">
                                Accetta
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="submit" style="background-color:#dc3545!important" name="RIFIUTA"
                                    value="Rifiuta" class="btn btn-danger btn-block">
                                Rifiuta
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php } ?>
<script type="text/javascript">

    function openReclamo(id) {
        $('#reclamiModal_' + id).modal('show');
    }

</script>