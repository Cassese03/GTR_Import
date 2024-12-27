<?php $utente = session('utente');
$ditta = session('ditta');
?>
<style>
    .wrapper_grid {
        position: relative;
        width: 400px;
        height: 400px;
        background-size: cover;
        overflow: hidden;
    }

    .box_grid {
        position: absolute;
        bottom: 25%;
        width: 85%;
        height: 25%;
        background: white;
        opacity: 0.8;
        text-align: left;
        padding-left: 1em;
    }

    .button_grid {
        position: absolute;
        bottom: 10%;
        width: 50%;
        height: 10%;
        background: transparent;
        opacity: 1;
    }


    .grid-item {
        font-size: 2em;
        text-align: center;
    }

    .hero__text h6 {
        opacity: 1;
    }

    .hero__text h2 {
        opacity: 1;
    }

    .hero__text p {
        opacity: 1;
    }

    .hero__text a {
        opacity: 1;
    }

    /* .owl-stage {
         transform: translate3d(0, 0, 0) !important;
     }*/

    html {
        font-size: 16px;
    }

    @media (max-width: 750px) {
        #categoria {
            margin-left: 0 !important;
            margin-right: 0 !important;
        }

        html {
            font-size: 12px;
        }

        .grid-item {
            padding: 1em 0 1em;
        }
    }
    h1 { font-size: 50px; }
    article { display: block; text-align: left; width: 650px; margin: 0 auto; }
    a { color: #dc8100; text-decoration: none; }
    a:hover { color: #333; text-decoration: none; }
</style>
<article>
    <h1>Torneremo presto!</h1>
    <div>
        <p>Ci scusiamo per l'inconveniente, ma al momento stiamo eseguendo alcuni interventi di manutenzione. Se ne hai bisogno puoi sempre <a href="mailto:info@gtrimport.it">contattarci</a>, altrimenti torneremo online a breve!</p>
    </div>
</article>
<!-- Hero Section Begin -->{{--
<section class="hero">
    <div class="hero__slider owl-carousel">
        --}}{{--<div class="hero__items set-bg" data-setbg="/img/<?php echo $ditta?>/prima.jpg">
            <div class="container col-sm-12">
                <div class="row">
                    <div class="col-12">
                        <div class="hero__text">
                            <h6>Collezione Estiva</h6>
                            <h2>Collezioni Primavera - Estate 2022</h2>
                            <p>Un'etichetta specializzata nella creazione di elementi essenziali di lusso. Realizzato
                                eticamente con un incrollabile
                                impegno per una qualità eccezionale.</p>
                            <a href="/cliente/articoli?pagina=1" class="primary-btn">Vai al Negozio <span
                                        class="arrow_right"></span></a>
                            <div class="hero__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="https://www.instagram.com/gtr_s.r.l/"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>--}}{{--
        <?php for ($i = 1;
                   $i < 12;
                   $i++) { ?>
        <div class="hero__items set-bg" data-setbg="/img/<?php echo $ditta?>/<?php echo $i ?>.jpg">
            <div class="container col-sm-12">
                <div class="row">
                    <div class="col-12">
                        <div class="hero__text">
                            <div class="hero__social">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php } ?>
    </div>
    <!-- Contenuto della pagina -->
</section>
--}}

<script type="text/javascript">

    <?php
    // Genera lo schema org
    $schema = array(
        "@context" => "https://gtrimport.it/cliente/index",
        "@type" => "Ingrosso Prodotti Invernali/Estivi",
        "name" => "GTR IMPORT SRL",
        "description" => "Descrizione dell'azienda",
        "url" => "https://www.gtrimport.it",
        "logo" => "https://www.gtrimport.it/img/GTR1234/logo_GTR1234.png",
        "contactPoint" => array(
            array(
                "@type" => "ContactPoint",
                "telephone" => "+39 081 19169257",
                "contactType" => "customer service",
            )
        ),
        // Altre informazioni dell'azienda...
    );

    // Converti l'array in formato JSON
    $jsonSchema = json_encode($schema);
    ?>

        document.title = '| HOME | GTRIMPORT ';
    headTag = document.getElementsByTagName('head');

    titleTag = document.createElement('META');
    titleTag.setAttribute("name", "title");
    titleTag.setAttribute("content", "GTRIMPORT - Accesso al Portale Clienti per Gestire i Tuoi Ordini e Richieste");

    descriptionTag = document.createElement('META');
    descriptionTag.setAttribute("name", "description");
    descriptionTag.setAttribute("content", "GTR IMPORT - Portale Clienti: Gestisci i Tuoi Ordini in Modo Semplice ed Efficace. Accedi all'Area Riservata per Monitorare i tuoi dati e Ottenere Assistenza Personalizzata.");

    keywordsTag = document.createElement('META');
    keywordsTag.setAttribute("name", "keywords");
    keywordsTag.setAttribute("content", "portale,clienti,gestione,ordini,monitoraggio,dettaglio,prodotti,assistenza,controllo,operazioni,area,riservata,registrazione,cliente");

    /* orgTag = document.createElement('script');
     orgTag.setAttribute("type", "application/ld+json");
     orgTag.innerHTML = <?php echo $jsonSchema; ?>


    */  headTag[0].appendChild(titleTag);
    headTag[0].appendChild(keywordsTag);
    headTag[0].appendChild(descriptionTag);
    //   headTag[0].appendChild(orgTag);

    window.onload
    {
        loader = document.getElementById("preloder");
        window.setTimeout(function () {
            loader.style.display = "none";
        }, 2500);
    }

    document.addEventListener("DOMContentLoaded", function () {
        var lazyBgElements = document.querySelectorAll(".lazy-bg");

        function lazyLoadBackground(element) {
            var imageUrl = element.getAttribute("data-setbg");
            element.style.backgroundImage = "url('" + imageUrl + "')";
        }
    });
</script>
<!-- Hero Section End -->{{--
<div style="display: flex;justify-content: center;align-items: center;flex-direction: column">
    <a style="text-align:center;font-weight: bolder;font-size:2.6rem"> CHI SIAMO </a>
    <a style="text-align:center;font-weight: normal;font-size:1.8em"> Impegno, dedizione, innovazione:</a>
    <a style="text-align:center;font-weight: normal;font-size:1.8em"> sono alcuni dei concetti fondamentali che mettono
        in moto l’azienda
        <strong>GTR s.r.l.</strong> </a> <br>
    <a style="text-align:center;font-weight: normal;font-size:1.8em"> I nostri prodotti sono il risultato di un’accurata
        ed estenuante
        ricerca tra <strong> bellezza e funzionalità </strong>, prestando attenzione a qualità e dettagli.</a>
    <a style="text-align:center;font-weight: normal;font-size:1.8em"> Seguiamo tutti i vari <strong>passaggi di
            produzione con
            importazione
            diretta</strong>, terminando con <strong>personalizzazione ed immissione sul mercato.</strong></a>
    <a style="text-align:center;font-weight: normal;font-size:1.8em">
        Infine, rispettiamo tutte le <strong>certificazioni e norme vigenti</strong>, tenendo
        conto di un particolare design ed un <strong>ottimo rapporto qualità prezzo</strong>.</a>
    <br>
    <a style="text-align:center;font-weight: normal;font-size:1.8em">
        Il nostro obiettivo da sempre è garantire la massima soddisfazione
        del cliente.</a>
    <br>
    --}}{{--    <button onclick="location.href='/cliente/catalogo';"
                style="border-radius: 0.5em;color: white;background-color: #1D71B9;border-color: #1D71B9;"><a
                    style="padding:0.1em;font-weight: 700;font-size: 1.5em">GUARDA I NOSTRI CATALOGHI</a></button>
        <br>
        <button onclick="location.href='/cliente/ftp';"
                style="border-radius: 0.5em;color: white;background-color: #413D3A;border-color: #413D3A;"><a
                    style="padding:0.1em;font-weight: 700;font-size: 1.5em">FILE CSV</a></button>--}}{{--
</div>--}}
{{--
<section class="shop-details" style="padding-top: 5%;">
    <div class="product__details__pic">
        <div class="row">
            <div class="col-md-2 d-flex align-items-center justify-content-center">
                <a class="btn btn-primary mb-3 mr-1" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                    <i class="fa fa-arrow-left"></i>
                </a>
            </div>

            <div class="col-md-8">
                <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x50%"
                                             style="aspect-ratio: 3/2;object-fit: cover;"
                                             src="<?php echo URL::ASSET('/img/'.$ditta.'/categoria (1).jpg') ?>">
                                        <div class="card-body">
                                            <h4 class="card-title">COLLEZIONE
                                                OUTDOOR
                                                2023</h4>
                                            <button onclick="location.href='/cliente/articoli?pagina=1';"
                                                    style="color: white;background-color: #1D71B9;border-color: #1D71B9;font-weight: 700;font-size: 1em">
                                                <a class="card-text">Vai al Negozio</a>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x50%"
                                             style="aspect-ratio: 3/2;object-fit: cover;"
                                             src="<?php echo URL::ASSET('/img/'.$ditta.'/categoria (2).jpg') ?>">
                                        <div class="card-body">
                                            <h4 class="card-title">PISCINA FUORI
                                                TERRA
                                                GIOCHI E
                                                GONFIABILI</h4>
                                            <button onclick="location.href='/cliente/articoli?pagina=1';"
                                                    style="color: white;background-color: #1D71B9;border-color: #1D71B9;font-weight: 700;font-size: 1em">
                                                <a class="card-text">Vai al Negozio</a>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x50%"
                                             style="aspect-ratio: 3/2;object-fit: cover;"
                                             src="<?php echo URL::ASSET('/img/'.$ditta.'/categoria (3).jpg') ?>">
                                        <div class="card-body">
                                            <h4 class="card-title">COLLEZIONE
                                                CHRISTMAS
                                                2023</h4>
                                            <button onclick="location.href='/cliente/articoli?pagina=1';"
                                                    style="color: white;background-color: #1D71B9;border-color: #1D71B9;font-weight: 700;font-size: 1em">
                                                <a class="card-text">Vai al Negozio</a>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x50%"
                                             style="aspect-ratio: 3/2;object-fit: cover;"
                                             src="<?php echo URL::ASSET('/img/'.$ditta.'/categoria (1).jpg') ?>">
                                        <div class="card-body">
                                            <h4 class="card-title">COLLEZIONE
                                                OUTDOOR
                                                2023</h4>
                                            <button onclick="location.href='/cliente/articoli?pagina=1';"
                                                    style="color: white;background-color: #1D71B9;border-color: #1D71B9;font-weight: 700;font-size: 1em">
                                                <a class="card-text">Vai al Negozio</a>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <img class="img-fluid" alt="100%x50%"
                                             style="aspect-ratio: 3/2;object-fit: cover;"
                                             src="<?php echo URL::ASSET('/img/'.$ditta.'/categoria (3).jpg') ?>">
                                        <div class="card-body">
                                            <h4 class="card-title">COLLEZIONE
                                                CHRISTMAS
                                                2023</h4>
                                            <button onclick="location.href='/cliente/articoli?pagina=1';"
                                                    style="color: white;background-color: #1D71B9;border-color: #1D71B9;font-weight: 700;font-size: 1em">
                                                <a class="card-text">Vai al Negozio</a>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-2 d-flex align-items-center justify-content-center">
                <a class="btn btn-primary mb-3 " href="#carouselExampleIndicators2" role="button" data-slide="next">
                    <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>--}}

<?php /*
 <section class="shop-details">
    <div class="product__details__pic">
        <div class="row">{{--
            <div class="col-lg-2 col-md-2"
                 style="display: flex;align-items: center;justify-content: center;flex-direction:row;">
                <div class="nav-link" data-toggle="tab" href="#tabs-4" role="tab" id="imm_pre"
                     onclick="rimuovi_attributo('4','pre')">
                    <i class="fa fa-arrow-left"></i>
                </div>
            </div>--}}
            <div class="col-lg-12 col-md-12"
                 style="display: flex;align-items: center;justify-content: center;flex-direction:row;">
                <div class="tab-content">
                    <div class="tab-pane active" id="tabs-1"
                         role="tabpanel">
                        <div class="grid-item col-xl-4 col-md-4 col-sm-12">
                            <div class="wrapper_grid"
                                 style="background: url('/img/<?php echo $ditta?>/primobanner.jpg');background-size: cover">
                                <div class="box_grid">
                                    <a style="font-weight: 900;font-size: 1em;color: #1D71B9"> COLLEZIONE OUTDOOR
                                        2023</a>
                                </div>
                                <div class="button_grid">
                                    <button onclick="location.href='/cliente/articoli?pagina=1';"
                                            style="color: white;background-color: #1D71B9;border-color: #1D71B9;font-weight: 700;font-size: 0.50em">
                                        <a>VAI AL NEGOZIO</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="tabs-2"
                         role="tabpanel">
                        <div class="grid-item col-xl-4 col-md-4 col-sm-12">
                            <div class="wrapper_grid"
                                 style="background: url('/img/<?php echo $ditta?>/secondobanner.jpg');background-size: cover">
                                <div class="box_grid">
                                    <a style="font-weight: 900;font-size: 0.8em;color: #1D71B9"> PISCINA FUORI TERRA
                                        GIOCHI E
                                        GONFIABILI</a>
                                </div>
                                <div class="button_grid">
                                    <button onclick="location.href='/cliente/articoli?pagina=1';"
                                            style="color: white;background-color: #1D71B9;border-color: #1D71B9;font-weight: 700;font-size: 0.50em">
                                        <a>VAI AL NEGOZIO</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="tabs-3"
                         role="tabpanel">
                        <div class="grid-item col-xl-4 col-md-4 col-sm-12">
                            <div class="wrapper_grid"
                                 style="background: url('/img/<?php echo $ditta?>/terzobanner.jpg');background-size: cover">
                                <div class="box_grid">
                                    <a style="font-weight: 900;font-size: 1em;color: #1D71B9"> COLLEZIONE CHRISTMAS
                                        2023</a>
                                </div>
                                <div class="button_grid">
                                    <button onclick="location.href='/cliente/articoli?pagina=1';"
                                            style="color: white;background-color: #1D71B9;border-color: #1D71B9;font-weight: 700;font-size: 0.50em">
                                        <a>VAI AL NEGOZIO</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--<div class="tab-content">
                    <div class="tab-pane" id="tabs-4"
                         role="tabpanel">
                        <div class="grid-item col-xl-4 col-md-4 col-sm-12">
                            <div class="wrapper_grid"
                                 style="background: url('/img/<?php echo $ditta?>/terzobanner.jpg');background-size: cover">
                                <div class="box_grid">
                                    <a style="font-weight: 900;font-size: 1em;color: #1D71B9"> TEST TEST TEST </a>
                                </div>
                                <div class="button_grid">
                                    <button onclick="location.href='/cliente/articoli?pagina=1';"
                                            style="color: white;background-color: #1D71B9;border-color: #1D71B9;font-weight: 700;font-size: 0.50em">
                                        <a>VAI AL NEGOZIO</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>--}}
            </div>{{--
            <div class="col-lg-2 col-md-2"
                 style="display: flex;align-items: center;justify-content: center;flex-direction:row;">
                <div class="nav-link" data-toggle="tab" href="#tabs-4" role="tab" id="imm_suc"
                     onclick="rimuovi_attributo('4','succ')">
                    <i class="fa fa-arrow-right"></i>
                </div>
            </div>--}}
        </div>
    </div>
</section>
*/ ?>
{{--
<section class="shop-details">
    <form method="post" enctype="multipart/form-data">
        <div class="product__details__pic">

            <div class="content row">
                <div class="col-xl-2 col-md-2 col-sm-0">
                </div>
                <div class="col-xl-8 col-md-8 col-sm-12">
                    <div class="card" style="background: #413D3A">
                        <div class="card-body row">
                            <div class="col-12 text-left">
                                <h4 style="color: white!important">Diventa <br></h4>
                                <h2 style="color: white"><strong>Rivenditore GTR</strong></h2>
                                <h4 style="color: white!important">
                                    Riservato agli operatori di settore
                                </h4>
                            </div>
                            <div class="col-12" style="margin-top: 2%;">
                                <div class="form-group">
                                    <input placeholder="Ragione Sociale" type="text" name="inputName"
                                           class="form-control">
                                </div>
                                <div class="form-group">
                                    <input placeholder="Indirizzo E-Mail" type="email" name="inputEmail"
                                           class="form-control">
                                </div>
                                <div class="form-group">
                                    <input placeholder="Telefono" type="text" name="inputTelefono" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <input type="submit" class="btn btn-primary" name="inputRegistrati"
                                       style="backgroud-color: #1D71B9;width: 100%" value="Registrati">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-2 col-md-2 col-sm-0">
                </div>
            </div>
        </div>
    </form>
</section>--}}
{{--
<section class="product spad">

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="filter__controls">
                    <li class="active" data-filter=".Novita">Novità</li>
                    <li data-filter=".Promo">Promo</li>
                    <li data-filter=".Richiesti">Più Richiesti</li>
                </ul>
            </div>
        </div>
        <div class="row product__filter">
        </div>
    </div>
</section>--}}
<!-- Product Section End -->

<!-- Categories Section Begin
<section class="categories spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="categories__text">
                    <h2>Clothings Hot <br /> <span>Shoe Collection</span> <br /> Accessories</h2>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="categories__hot__deal">
                    <img src="/img/product-sale.png" alt="">
                    <div class="hot__deal__sticker">
                        <span>Sale Of</span>
                        <h5>$29.99</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-1">
                <div class="categories__deal__countdown">
                    <span>Deal Of The Week</span>
                    <h2>Multi-pocket Chest Bag Black</h2>
                    <div class="categories__deal__countdown__timer" id="countdown">
                        <div class="cd-item">
                            <span>3</span>
                            <p>Days</p>
                        </div>
                        <div class="cd-item">
                            <span>1</span>
                            <p>Hours</p>
                        </div>
                        <div class="cd-item">
                            <span>50</span>
                            <p>Minutes</p>
                        </div>
                        <div class="cd-item">
                            <span>18</span>
                            <p>Seconds</p>
                        </div>
                    </div>
                    <a href="#" class="primary-btn">Vai al Negozio</a>
                </div>
            </div>
        </div>
    </div>
</section>      -->
<!-- Categories Section End -->

<!-- Instagram Section Begin
<section class="instagram spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="instagram__pic">
                    <div class="instagram__pic__item set-bg" data-setbg="/img/instagram/instagram-1.jpg"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="/img/instagram/instagram-2.jpg"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="/img/instagram/instagram-3.jpg"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="/img/instagram/instagram-4.jpg"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="/img/instagram/instagram-5.jpg"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="/img/instagram/instagram-6.jpg"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="instagram__text">
                    <h2>Instagram</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.</p>
                    <h3>#Male_Fashion</h3>
                </div>
            </div>
        </div>
    </div>
</section>          -->
<!-- Instagram Section End -->

<!-- Latest Blog Section Begin
<section class="latest spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Latest News</span>
                    <h2>Fashion New Trends</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="/img/blog/blog-1.jpg"></div>
                    <div class="blog__item__text">
                        <span><img src="/img/icon/calendar.png" alt=""> 16 February 2020</span>
                        <h5>What Curling Irons Are The Best Ones</h5>
                        <a href="#">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="/img/blog/blog-2.jpg"></div>
                    <div class="blog__item__text">
                        <span><img src="/img/icon/calendar.png" alt=""> 21 February 2020</span>
                        <h5>Eternity Bands Do Last Forever</h5>
                        <a href="#">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="/img/blog/blog-3.jpg"></div>
                    <div class="blog__item__text">
                        <span><img src="/img/icon/calendar.png" alt=""> 28 February 2020</span>
                        <h5>The Health Benefits Of Sunglasses</h5>
                        <a href="#">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>                     -->

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

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
    /*
        function rimuovi_attributo(new_attivo, pos) {

            non_attivi = document.getElementsByClassName("tab-pane active");

            if (pos == 'pre') {
                non_attivi[0].classList.remove("active");
            }
            if (pos == 'succ') {
                non_attivi[2].classList.remove("active");
            }

            non_attivi = document.getElementsByClassName("tab-pane active");

            attivo = document.getElementById("tabs-" + new_attivo);

            new_none = document.getElementsByClassName('tab-pane');

            attivo.classList.add("active");

            for (i = 0; i < new_none.length; i++) {
                if (!new_none[i].classList.contains('active') == true) {
                    console.log(new_none[i].id);
                    new_none = new_none[i].id;
                    break;
                }
            }

            document.getElementById('imm_suc').removeAttribute('href');
            document.getElementById('imm_suc').removeAttribute('onclick');

            document.getElementById('imm_pre').removeAttribute('href');
            document.getElementById('imm_pre').removeAttribute('onclick');


            document.getElementById('imm_suc').setAttribute('href', new_none);
            document.getElementById('imm_suc').setAttribute('onclick', 'rimuovi_attributo(\'' + new_none + '\',\'succ\')');
            document.getElementById('imm_pre').setAttribute('href', new_none);
            document.getElementById('imm_pre').setAttribute('onclick', 'rimuovi_attributo(\'' + new_none + '\',\'pre\')');

        }
    */
    function aumenta(id, xqtaconf, disponibile) {
        quantita = document.getElementById('quantita_' + id).value;
        quantita = parseInt(quantita) + parseInt(xqtaconf);
        if (quantita <= disponibile)
            document.getElementById('quantita_' + id).value = quantita;
        else {
            document.getElementById('quantita_' + id).value = disponibile;
            $('#max_disp').modal('show');
        }

    }

    function diminuisci(id, xqtaconf) {
        quantita = document.getElementById('quantita_' + id).value;
        quantita = parseInt(quantita) - parseInt(xqtaconf);
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
        prezzo = document.getElementById('prezzo_' + id).value;
        if (quantita == null || quantita == '')
            quantita = 0
        if (sconto == null || sconto == '')
            sconto = 0
        if (prezzo == null || prezzo == '')
            prezzo = 0

        $.ajax({
            url: "<?php echo URL::asset('ajax/aggiungi_al_carrello_index') ?>/" + cd_ar + "/" + quantita + "/" + sconto + "/" + prezzo
        }).done(function (result) {
            location.href = result;
        });

    }

    $(document).ready(function () {
        <?php if (isset($_GET['aggiunto'])){ ?>
        $('#myModal').modal('show');
        <?php } ?>
        $('.product-image-thumb').on('click', function () {
            var $image_element = $(this).find('img')
            $('.product-image').prop('src', $image_element.attr('src'))
            $('.product-image-thumb.active').removeClass('active')
            $(this).addClass('active')
        })
    })


</script>

