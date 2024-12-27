<style>
    input {
        color: black !important;
    }
</style>
<?php if(!isset($result)) $result = 0?>
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-2"></div>
            <div class="col-lg-8 col-md-8">
                <div class="contact__form">
                    <form method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="text" value="<?php echo $contatti->name;?>" name="RagioneSociale"
                                       placeholder="Ragione Sociale">
                            </div>
                            <div class="col-lg-12">
                                <input type="text" value="" name="Indirizzo" placeholder="Indirizzo">
                            </div>
                            <div class="col-lg-2">
                                <input type="text" value="" name="Cap" placeholder="Cap">
                            </div>
                            <div class="col-lg-8">
                                <input type="text" value="" name="Localita" placeholder="Localita">
                            </div>
                            <div class="col-lg-2">
                                <input type="text" value="" name="Provincia" placeholder="Provincia">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" value="" required name="PartitaIva" placeholder="PartitaIva">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" value="" name="CodiceFiscale" placeholder="Codice Fiscale">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" value="<?php echo $contatti->email;?>" name="Email"
                                       placeholder="Indirizzo Email">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" value="<?php echo $contatti->telefono;?>" name="Telefono"
                                       placeholder="Telefono">
                            </div>
                            <div class="col-lg-12" style="text-align: center">
                                <a> Persona di riferimento </a>
                            </div>
                            <br>
                            <br>
                            <div class="col-lg-6">
                                <input type="text" value="" name="Nome" placeholder="Nome">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" value="" name="Cognome" placeholder="Cognome">
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" name="richiesta" value="Invia Richiesta" style="width: 100%"
                                        class="site-btn">Invia Richiesta
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-2 col-md-2"></div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    window.onload = function () {
        <?php if ($result == 1){ ?>
        $('#myModal').modal('show');
        <?php } ?>
    }

    document.title = '| REGISTRATI | GTRIMPORT ';
    headTag = document.getElementsByTagName('head');

    titleTag = document.createElement('META');
    titleTag.setAttribute("name", "title");
    titleTag.setAttribute("content", "GTRIMPORT - Registrazione per diventare nostro rifornitore");

    descriptionTag = document.createElement('META');
    descriptionTag.setAttribute("name", "description");
    descriptionTag.setAttribute("content", "GTR IMPORT - Registrazione al Portale Rivenditori: Accedi a un'Esclusiva Area Personale per diventare un nostro rivenditore e collaborare appieno con la nostra attivitá.");

    keywordsTag = document.createElement('META');
    keywordsTag.setAttribute("name", "keywords");
    keywordsTag.setAttribute("content", "GTRIMPORT,registrazione,Portale rivenditore,Gestione,ordini,Monitoraggio,dati,Account,servizi");

    headTag[0].appendChild(titleTag);
    headTag[0].appendChild(keywordsTag);
    headTag[0].appendChild(descriptionTag);
</script>


<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="fa fa-solid fa-check"></i>
                </div>
                <h4 class="modal-title w-100">Complimenti!</h4>
            </div>
            <div class="modal-body">
                <p class="text-center">Richiesta di registrazione avvenuta correttamente.</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-block" data-dismiss="modal" onclick="location.href = '/cliente/index'">OK</button>
            </div>
        </div>
    </div>
</div>