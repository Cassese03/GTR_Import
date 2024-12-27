
<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="/img/<?php echo $ditta?>/logo_<?php echo $ditta?>.png" alt="B2Bincloud.it" height="60" width="60">
</div>

<!-- Navbar -->


<!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Home</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/index">Home</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                    <div class="col-md-3 col-sm-6 col-12" onclick="top.location.href='/admin/fornitore'">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Richieste Inviate</span>
                                <span class="info-box-number"><?php echo $richieste?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12" onclick="top.location.href='/admin/offerte'">
                        <div class="info-box">
                            <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Rifiutate da Fornitore</span>
                                <span class="info-box-number"><?php echo $rifiutate?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12" onclick="top.location.href='/admin/risposte'">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Risposte da Fornitore</span>
                                <span class="info-box-number"><?php echo $risposte?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-3 col-sm-6 col-12" onclick="top.location.href='/admin/storico'">
                        <div class="info-box">
                            <span class="info-box-icon bg-danger"><i class="far fa-clock"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Storico</span>
                                <span class="info-box-number"><?php echo $storico?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                </div>
            <!-- /.row -->
            <!-- Main row -->

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<?php /*foreach($dispositivi as $d){ ?>


<form method="post" enctype="multipart/form-data">
    <div class="modal fade" id="modal_modifica_<?php echo $d->id ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modifica Dispositivo</h4>
                </div>
                <div class="modal-body row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nome <b style="color:red">*</b></label>
                            <input type="text" class="form-control" name="descrizione" placeholder="Descrizione" value="<?php echo $d->descrizione ?>" required>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tipologia <b style="color:red">*</b></label>
                            <select name="tipologia" class="form-control select2">
                                <?php foreach($plc_tipologie as $p){ ?>
                                <option value="<?php echo $p->id ?>" <?php echo ($p->id == $d->tipologia)?'selected':'' ?>><?php echo $p->descrizione ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Indirizzo IP<b style="color:red">*</b></label>
                            <input type="text" class="form-control" name="indirizzo_ip" value="<?php echo $d->indirizzo_ip ?>" placeholder="Indirizzo IP" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Porta<b style="color:red">*</b></label>
                            <input type="text" class="form-control" name="porta" placeholder="Porta" value="<?php echo $d->porta ?>" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Immagine <b style="color:red">*</b></label>
                            <input type="file" class="form-control" name="immagine">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Allegato</label>
                            <input type="file" class="form-control" name="allegato">
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Abilitato <b style="color:red">*</b></label>
                            <select name="abilitato" class="form-control select2">
                                <option value="1" <?php echo ($d->abilitato == 1)?'selected':'' ?>>SI</option>
                                <option value="0" <?php echo ($d->abilitato == 0)?'selected':'' ?>>NO</option>
                            </select>
                        </div>
                    </div>



                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Completato <b style="color:red">*</b></label>
                            <select name="completato" class="form-control select2">
                                <option value="1" <?php echo ($d->completato == 1)?'selected':'' ?>>SI</option>
                                <option value="0" <?php echo ($d->completato == 0)?'selected':'' ?>>NO</option>
                            </select>
                        </div>
                    </div>



                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Note <b style="color:red">*</b></label>
                            <textarea name="note" class="form-control" style="height:200px;"><?php echo $d->note ?></textarea>
                        </div>
                    </div>



                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Note Status <b style="color:red">*</b></label>
                            <textarea name="note_status" class="form-control" style="height:100px;"><?php echo $d->note_status ?></textarea>
                        </div>
                    </div>




                    <div class="clearfix"></div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Chiudi</button>
                    <input type="hidden" name="id" value="<?php echo $d->id ?>">
                    <input type="submit" class="btn btn-primary pull-right" name="modifica" value="Modifica" style="margin-right:5px;">
                </div>
            </div>
        </div>
    </div>
</form>


<?php }*/ ?>

<script type="text/javascript">

    window.onload = function() {
        $.ajax({
            url: "<?php echo URL::asset('ajax/load_articoli') ?>/0/0"
        }).done(function (result) {
            $('#ajax_articoli').html(result);
        });

        $.ajax({
            url: "<?php echo URL::asset('ajax/load_categoria') ?>/"
        }).done(function (result) {
            $('#ajax_categoria').html(result);
        });

    };

    function filtro(categoria){

        filtro_articolo = document.getElementById('modal_filtro').value;

        if(categoria == 0)
            categoria = document.getElementById("modal_categoria").value;
        else
            document.getElementById("modal_categoria").value = categoria;

        if(filtro_articolo == '')
            filtro_articolo = 0;

        if(categoria == null)
            categoria = 0;
        $.ajax({
            url: "<?php echo URL::asset('ajax/load_articoli') ?>/"+filtro_articolo+"/"+categoria
        }).done(function (result) {
            $('#ajax_articoli').html(result);
        });
    }
    function reset(){
        filtro_articolo = document.getElementById('modal_filtro').value = '';
        categoria = document.getElementById('modal_categoria').value = '0';
        $.ajax({
            url: "<?php echo URL::asset('ajax/load_articoli') ?>/0/0"
        }).done(function (result) {
            $('#ajax_articoli').html(result);
        });
    }

    function aggiungi(){
        $('#modal_aggiungi').modal('show');
    }
    function aggiungi_carrello(){
        alert('Agguingi al Carrello');
    }
    function carrello(){
        alert('Show Carrello');
    }

    function modifica(id){
        $('#modal_modifica_'+id).modal('show');
    }

</script>