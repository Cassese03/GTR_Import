<!-- Breadcrumb Section Begin -->
<style>
    ::-webkit-scrollbar {
        width: 1px;
        height: 1px;
    }

    .loader2 {
        border: 4px solid #f3f3f3; /* Light grey */
        border-top: 4px solid #3498db; /* Blue */
        border-radius: 50%;
        width: 60px;
        height: 60px;
        animation: spin 0.5s linear infinite;
        margin: 20px auto;
        display: block;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }
</style>

<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Negozio</h4>
                    <div class="breadcrumb__links">
                        <a href="/cliente/index">Home</a>
                        <span>Negozio</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop__sidebar">
                    <div class="shop__sidebar__search">
                        <form>
                            <input type="text" id="modal_filtro" placeholder="Cerca Articolo...">
                            <button type="button" id="search_button" onclick="filtro(0)"><span
                                        class="icon_search"></span></button>
                        </form>
                        <button onclick="azzera_filtri()" style="width: 100%;color:#b7b7b7;border: 1px solid #e5e5e5;">
                            Azzerare Filtri
                        </button>

                    </div>

                    <input type="hidden" id="modal_categoria" value="0">
                    <input type="hidden" id="modal_marca" value="0">

                    <div class="shop__sidebar__accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseOne">Marche</a>
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__categories">
                                            <ul class="nice-scroll" id="ajax_marche"></ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseOne">Categorie</a>
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__categories">
                                            <ul class="nice-scroll" id="ajax_categoria"></ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="ajax_seconda_categoria" class="card">

                            </div>
                            <div id="ajax_terza_categoria" class="card">

                            </div>
                            <!--
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseTwo">Branding</a>
                                </div>
                                <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__brand">
                                            <ul>
                                                <li><a href="#">Louis Vuitton</a></li>
                                                <li><a href="#">Chanel</a></li>
                                                <li><a href="#">Hermes</a></li>
                                                <li><a href="#">Gucci</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                                </div>
                                <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__price">
                                            <ul>
                                                <li><a href="#">$0.00 - $50.00</a></li>
                                                <li><a href="#">$50.00 - $100.00</a></li>
                                                <li><a href="#">$100.00 - $150.00</a></li>
                                                <li><a href="#">$150.00 - $200.00</a></li>
                                                <li><a href="#">$200.00 - $250.00</a></li>
                                                <li><a href="#">250.00+</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseFour">Size</a>
                                </div>
                                <div id="collapseFour" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__size">
                                            <label for="xs">xs
                                                <input type="radio" id="xs">
                                            </label>
                                            <label for="sm">s
                                                <input type="radio" id="sm">
                                            </label>
                                            <label for="md">m
                                                <input type="radio" id="md">
                                            </label>
                                            <label for="xl">xl
                                                <input type="radio" id="xl">
                                            </label>
                                            <label for="2xl">2xl
                                                <input type="radio" id="2xl">
                                            </label>
                                            <label for="xxl">xxl
                                                <input type="radio" id="xxl">
                                            </label>
                                            <label for="3xl">3xl
                                                <input type="radio" id="3xl">
                                            </label>
                                            <label for="4xl">4xl
                                                <input type="radio" id="4xl">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseFive">Colors</a>
                                </div>
                                <div id="collapseFive" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__color">
                                            <label class="c-1" for="sp-1">
                                                <input type="radio" id="sp-1">
                                            </label>
                                            <label class="c-2" for="sp-2">
                                                <input type="radio" id="sp-2">
                                            </label>
                                            <label class="c-3" for="sp-3">
                                                <input type="radio" id="sp-3">
                                            </label>
                                            <label class="c-4" for="sp-4">
                                                <input type="radio" id="sp-4">
                                            </label>
                                            <label class="c-5" for="sp-5">
                                                <input type="radio" id="sp-5">
                                            </label>
                                            <label class="c-6" for="sp-6">
                                                <input type="radio" id="sp-6">
                                            </label>
                                            <label class="c-7" for="sp-7">
                                                <input type="radio" id="sp-7">
                                            </label>
                                            <label class="c-8" for="sp-8">
                                                <input type="radio" id="sp-8">
                                            </label>
                                            <label class="c-9" for="sp-9">
                                                <input type="radio" id="sp-9">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseSix">Tags</a>
                                </div>
                                <div id="collapseSix" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__tags">
                                            <a href="#">Product</a>
                                            <a href="#">Bags</a>
                                            <a href="#">Shoes</a>
                                            <a href="#">Fashio</a>
                                            <a href="#">Clothing</a>
                                            <a href="#">Hats</a>
                                            <a href="#">Accessories</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="shop__product__option">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__left">
                                <strong>
                                    <div id="mostra"></div>
                                </strong>
                                <br>
                                <div class="cellulare_si"
                                     style="gap:1em;justify-content: center;align-items: center;display: flex;position: sticky;left: 0;top:15%;flex-direction: column;z-index: 10;text-align: center">

                                    <div class="red" style="margin-left:1%;margin-right:5%;"></div>
                                    <a style="font-weight: bolder">Merce Immediata non Disponibile (da 0 a 2) </a>

                                    <div class="red" style="margin-left:1%;background: yellow;margin-right:5%;"></div>
                                    <a style="font-weight: bolder">Merce Immediata in Esaurimento (da 3 a 15) </a>

                                    <div class="red" style="margin-left:1%;background: green;margin-right:5%;"></div>
                                    <a style="font-weight: bolder">Merce Immediata Disponibile (+16) </a>

                                    <div class="red" style="margin-left:1%;background: blue;margin-right:5%;"></div>
                                    <a style="font-weight: bolder">Merce Ordinabile </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__right">
                                <p>Ordina per Prezzo:</p>
                                <select onchange="filtro(0)" id="ordina">
                                    <option value="asc">Dal più basso al piu alto</option>
                                    <option value="desc" selected>Dal più alto al piu basso</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="ajax_load_articoli"></div>
                <div class="loader2" id="loading-image"></div>
                <input type="hidden" id="count" name="count" value="">
                <input type="hidden" id="max_pag" name="max_pag" value="">
                <div id="ajax_load_pagine"></div>

            </div>
            <div class="col-lg-1 cellulare">
                <div style="gap:1em;justify-content: center;align-items: center;display: flex;position: sticky;left: 0;top:15%;flex-direction: column;z-index: 10;text-align: center">
                    <div class="red" style="margin-left:1%;margin-right:5%;"></div>
                    <a style="font-weight: bolder">Merce Immediata non Disponibile (da 0 a 2)</a>
                    <div class="red" style="margin-left:1%;background: yellow;margin-right:5%;"></div>
                    <a style="font-weight: bolder">Merce Immediata in Esaurimento (da 3 a 15) </a>
                    <div class="red" style="margin-left:1%;background: green;margin-right:5%;"></div>
                    <a style="font-weight: bolder">Merce Immediata Disponibile (+16)</a>
                    <div class="red" style="margin-left:1%;background: blue;margin-right:5%;"></div>
                    <a style="font-weight: bolder">Merce Ordinabile </a>
                </div>
            </div>
        </div>
    </div>
</section>

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
                <p class="text-center">Articolo aggiunto correttamente al carrello.</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<div id="myError" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box" style="background-color: red">
                    <i class="fa fa-solid fa-times"></i>
                </div>
                <h4 class="modal-title w-100">Errore!</h4>
            </div>
            <div class="modal-body">
                <p class="text-center">Articolo non trovato nel database. Riprova più tardi.</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
<div id="articoli_finiti" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box" style="background-color: red">
                    <i class="fa fa-solid fa-times"></i>
                </div>
                <h4 class="modal-title w-100">Avviso</h4>
            </div>
            <div class="modal-body">
                <p class="text-center">Non ci sono ulteriori Articoli per questa categoria.</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success btn-block" data-dismiss="modal"
                        onclick="top.location = '/cliente/articoli?pagina=1';">OK
                </button>
            </div>
        </div>
    </div>
</div>

<div id="max_disp" class="modal fade">
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
                <button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
    $("form").keypress(function (e) {
        //Enter key
        if (e.which == 13) {
            document.getElementById('search_button').click();
            return false;
        }
    });

    function aumenta(id, xqtaconf, disponibile) {
        quantita = document.getElementById('quantita_' + id).value;

        check_xqtaconf = parseFloat(parseFloat(quantita) / parseFloat(xqtaconf));
        if ((check_xqtaconf % 1) === 0) {
            quantita = parseInt(quantita) + parseInt(xqtaconf);
        } else {
            quantita = parseInt(parseInt(check_xqtaconf) * xqtaconf) + parseInt(xqtaconf);
        }

        if (quantita <= disponibile)
            document.getElementById('quantita_' + id).value = quantita;
        else {
            if (disponibile > 0) {
                document.getElementById('quantita_' + id).value = disponibile;
            } else {
                document.getElementById('quantita_' + id).value = 0;
            }
            $('#max_disp').modal('show');
        }


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

    function check(id, xqtaconf, disponibile) {
        quantita = document.getElementById('quantita_' + id).value;
        quantita = parseInt(quantita);
        if (quantita <= disponibile) {
            check_xqtaconf = parseFloat(parseFloat(quantita) / parseFloat(xqtaconf));
            if ((check_xqtaconf % 1) === 0) {
                document.getElementById('quantita_' + id).value = quantita;
            } else {
                document.getElementById('quantita_' + id).value = parseInt(parseInt(check_xqtaconf) * xqtaconf);
            }
        } else {
            if (disponibile > 0) {
                document.getElementById('quantita_' + id).value = disponibile;
            } else {
                document.getElementById('quantita_' + id).value = 0;
            }
            $('#max_disp').modal('show');
        }


    }

    function diminuisci(id, xqtaconf) {
        quantita = document.getElementById('quantita_' + id).value;

        check_xqtaconf = parseFloat(parseFloat(quantita) / parseFloat(xqtaconf));
        if ((check_xqtaconf % 1) === 0) {
            quantita = parseInt(quantita) - parseInt(xqtaconf);
        } else {
            quantita = parseInt(parseInt(check_xqtaconf) * xqtaconf) - parseInt(xqtaconf);
        }

        if (quantita > 0)
            document.getElementById('quantita_' + id).value = quantita;
    }

    function aggiungi(id) {

        cd_ar = document.getElementById('cd_ar_' + id).value;
        if (cd_ar == null)
            cd_ar = 0;

        if (cd_ar != 0) {
            pos = cd_ar.search('/');
            if (pos != (-1)) {
                cd_ar = cd_ar.substr(0, pos) + 'slash' + cd_ar.substr(pos + 1)
            }
        }
        quantita = document.getElementById('quantita_' + id).value;
        sconto = document.getElementById('sconto_' + id).value;
        pagina = document.getElementById('pagina_' + id).value;
        prezzo = document.getElementById('prezzo_' + id).value;
        if (quantita == null || quantita == '')
            quantita = 0
        if (sconto == null || sconto == '')
            sconto = 0
        if (pagina == null || pagina == '')
            pagina = 1
        if (prezzo == null || prezzo == '')
            prezzo = 0

        $.ajax({
            url: "<?php echo URL::asset('ajax/aggiungi_al_carrello') ?>/" + cd_ar + "/" + quantita + "/" + pagina + "/" + sconto + "/" + prezzo
        }).done(function (result) {
            $('#myModal').modal('show');
            check_cart();
        });

    }

    $('#modal_filtro').val(localStorage.getItem("modal_filtro"));
    //   $('#modal_categoria').val(localStorage.getItem("modal_categoria"));

    $(document).ready(function () {
        <?php if (isset($_GET['aggiunto'])){ ?>
        $('#myModal').modal('show');
        <?php } ?>
        <?php if (isset($_GET['errore'])){ ?>
        $('#myError').modal('show');
        <?php } ?>
        <?php if (isset($_GET['articoli_finiti'])){ ?>
        $('#articoli_finiti').modal('show');
        <?php } ?>
    })

    function check_cart() {
        $.ajax({
            url: "<?php echo URL::asset('ajax/check_cart') ?>"
        }).done(function (result) {
            $('#loading-image').html(result);
        });
    }

    function azzera_filtri() {
        localStorage.setItem("modal_filtro", "");
        localStorage.setItem("modal_categoria", "");
        localStorage.setItem("modal_marca", "");
        location.reload();
    }

    function colore(id) {

        const element = document.getElementById("ajax_categoria");
        let nodes = element.getElementsByClassName("prova");
        for (let i = 0; i < nodes.length; i++) {
            nodes[i].style.color = "#b7b7b7";
        }

        document.getElementById("attiva_" + id).style.color = 'blue';

    }

    function colore_marca(id) {

        const element = document.getElementById("ajax_marche");
        let nodes = element.getElementsByClassName("prova_2");
        for (let i = 0; i < nodes.length; i++) {
            nodes[i].style.color = "#b7b7b7";
        }

        document.getElementById("attiva_marche_" + id).style.color = 'blue';

    }

    function colore1(id) {

        const element = document.getElementById("ajax_seconda_categoria");
        let nodes = element.getElementsByClassName("prova1");
        for (let i = 0; i < nodes.length; i++) {
            nodes[i].style.color = "#b7b7b7";
        }

        document.getElementById("attiva_" + id).style.color = 'blue';

    }

    function colore2(id) {

        const element = document.getElementById("ajax_terza_categoria");
        let nodes = element.getElementsByClassName("prova2");
        for (let i = 0; i < nodes.length; i++) {
            nodes[i].style.color = "#b7b7b7";
        }

        document.getElementById("attiva_" + id).style.color = 'blue';

    }


    function seconda_categoria(categoria) {

        $.ajax({
            url: "<?php echo URL::asset('ajax/load_seconda_categoria') ?>/" + categoria
        }).done(function (result) {
            $('#ajax_seconda_categoria').html(result);
        });
        document.getElementById("ajax_terza_categoria").innerHTML = '';

    }

    function terza_categoria(categoria) {

        $.ajax({
            url: "<?php echo URL::asset('ajax/load_terza_categoria') ?>/" + categoria
        }).done(function (result) {
            $('#ajax_terza_categoria').html(result);
        });

    }

    function filtro_2(marca) {

        $('#loading-image').show();

        document.getElementById('ajax_load_articoli').innerHTML = '';

        filtro_articolo = document.getElementById('modal_filtro').value;

        if (filtro_articolo == '' || filtro_articolo == null)
            filtro_articolo = 0;

        localStorage.setItem("modal_filtro", filtro_articolo);

        ord = document.getElementById('ordina').value;

        if (filtro_articolo != 0) {
            pos = filtro_articolo.search('/');
            if (pos != (-1)) {
                filtro_articolo = filtro_articolo.substr(0, pos) + 'slash' + filtro_articolo.substr(pos + 1)
            }
        }
        if (marca == 0)
            marca = document.getElementById("modal_marca").value;
        else
            document.getElementById("modal_marca").value = marca;

        if (marca == null || marca == '')
            marca = localStorage.getItem("modal_marca");

        localStorage.setItem("modal_marca", marca);

        if (marca == 0)
            localStorage.setItem("modal_marca", "");

        categoria = localStorage.getItem("modal_categoria");

        if (categoria == '' || categoria == null)
            categoria = 0;

        if (categoria == null || categoria == '' || categoria == 0)
            categoria = '0--';

        if (filtro_articolo == 0)
            localStorage.setItem("modal_filtro", "");


        count = '';

        $.ajax({
            url: "<?php echo URL::asset('ajax/load_articoli') ?>/" + filtro_articolo + "/" + categoria + "/" + marca + "/" + '<?php echo $_GET['pagina'] ?>' + "/" + ord
        }).done(function (result) {
            $('#ajax_load_articoli').html(result);
            count = document.getElementById('count').value;

            max_pag = document.getElementById('max_pag').value;

            $.ajax({
                url: "<?php echo URL::asset('ajax/load_pagine') ?>/" + '<?php echo $_GET['pagina'] ?>' + "/" + max_pag
            }).done(function (result) {
                $('#ajax_load_pagine').html(result);
            });
        });

        $('#loading-image').hide();
    }

    function filtro(categoria) {

        $('#loading-image').show();

        document.getElementById('ajax_load_articoli').innerHTML = '';

        filtro_articolo = document.getElementById('modal_filtro').value;

        if (filtro_articolo == '' || filtro_articolo == null)
            filtro_articolo = 0;

        localStorage.setItem("modal_filtro", filtro_articolo);

        ord = document.getElementById('ordina').value;

        if (filtro_articolo != 0) {
            pos = filtro_articolo.search('/');
            if (pos != (-1)) {
                filtro_articolo = filtro_articolo.substr(0, pos) + 'slash' + filtro_articolo.substr(pos + 1)
            }
        }
        if (categoria == 0)
            categoria = document.getElementById("modal_categoria").value;
        else
            document.getElementById("modal_categoria").value = categoria;

        if (categoria == null || categoria == '')
            categoria = localStorage.getItem("modal_categoria");

        if (categoria == null || categoria == '')
            categoria = '0--';

        localStorage.setItem("modal_categoria", categoria);

        if (categoria == 0)
            localStorage.setItem("modal_categoria", "");

        if (filtro_articolo == 0)
            localStorage.setItem("modal_filtro", "");

        marca = localStorage.getItem("modal_marca");
        if (marca == '' || marca == null)
            marca = 0;

        count = '';

        $.ajax({
            url: "<?php echo URL::asset('ajax/load_articoli') ?>/" + filtro_articolo + "/" + categoria + "/" + marca + "/" + '<?php echo $_GET['pagina'] ?>' + "/" + ord
        }).done(function (result) {
            $('#ajax_load_articoli').html(result);
            count = document.getElementById('count').value;

            max_pag = document.getElementById('max_pag').value;

            $.ajax({
                url: "<?php echo URL::asset('ajax/load_pagine') ?>/" + '<?php echo $_GET['pagina'] ?>' + "/" + max_pag
            }).done(function (result) {
                $('#ajax_load_pagine').html(result);
            });
        });

        $('#loading-image').hide();
    }

    window.onload = function () {

        categoria = localStorage.getItem("modal_categoria");

        filtro_articolo = localStorage.getItem("modal_filtro");

        marca = localStorage.getItem("modal_marca");
        if (marca == '' || marca == null)
            marca = 0;

        if (filtro_articolo == null || filtro_articolo == '')
            filtro_articolo = 0;

        if (categoria == null || categoria == '')
            categoria = '0--';

        if (filtro_articolo != 0) {
            pos = filtro_articolo.search('/');
            if (pos != (-1)) {
                filtro_articolo = filtro_articolo.substr(0, pos) + 'slash' + filtro_articolo.substr(pos + 1)
            }
        }

        $.ajax({
            url: "<?php echo URL::asset('ajax/load_articoli') ?>/" + filtro_articolo + "/" + categoria + "/" + marca + "/" + '<?php echo $_GET['pagina'] . '/desc'; ?>'
        }).done(function (result) {
            $('#ajax_load_articoli').html(result);

            max_pag = document.getElementById('max_pag').value;

            $.ajax({
                url: "<?php echo URL::asset('ajax/load_pagine') ?>/" + '<?php echo $_GET['pagina'] ?>' + "/" + max_pag
            }).done(function (result) {
                $('#ajax_load_pagine').html(result);
            });
        });

        $.ajax({
            url: "<?php echo URL::asset('ajax/load_marche') ?>/" + marca
        }).done(function (result) {
            $('#ajax_marche').html(result);
        });
        $.ajax({
            url: "<?php echo URL::asset('ajax/load_categoria') ?>/" + categoria
        }).done(function (result) {
            $('#ajax_categoria').html(result);
        });

        $.ajax({
            url: "<?php echo URL::asset('ajax/load_seconda_categoria') ?>/" + categoria
        }).done(function (result) {
            $('#ajax_seconda_categoria').html(result);
        });

        $.ajax({
            url: "<?php echo URL::asset('ajax/load_terza_categoria') ?>/" + categoria
        }).done(function (result) {
            $('#ajax_terza_categoria').html(result);
        });
        $('#loading-image').hide();
    };


</script>

<!-- Shop Section End -->