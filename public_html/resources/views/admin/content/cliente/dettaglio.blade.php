<?php /*<body class="hold-transition sidebar-mini">

<div class="wrapper">

    <div class="card card-solid">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-sm-12 col-md-12">
                            <h3 class="d-inline-block d-sm-none">LOWA Men’s Renegade GTX Mid Hiking Boots Review</h3>
                            <div class="col-xl-10 col-lg-10 col-sm-12 col-md-12">
                                <img src="<?php echo ($articolo[0]->immagine)? $articolo[0]->immagine:URL::ASSET('/icona_nofoto.png') ?>" class="product-image" alt="Product Image">
                            </div>
                            <div class="col-xl-10 col-lg-10 col-sm-12 col-md-12 product-image-thumbs">
                                <div class="product-image-thumb active"><img src="<?php echo ($articolo[0]->immagine)? $articolo[0]->immagine:URL::ASSET('/icona_nofoto.png') ?>" alt="Product Image"></div>
                                <div class="product-image-thumb" ><img src="<?php echo ($articolo[0]->immagine)? $articolo[0]->immagine:URL::ASSET('/icona_nofoto.png') ?>" alt="Product Image"></div>
                                <div class="product-image-thumb" ><img src="<?php echo ($articolo[0]->immagine)? $articolo[0]->immagine:URL::ASSET('/icona_nofoto.png') ?>" alt="Product Image"></div>
                                <div class="product-image-thumb" ><img src="<?php echo ($articolo[0]->immagine)? $articolo[0]->immagine:URL::ASSET('/icona_nofoto.png') ?>" alt="Product Image"></div>
                                <div class="product-image-thumb" ><img src="<?php echo ($articolo[0]->immagine)? $articolo[0]->immagine:URL::ASSET('/icona_nofoto.png') ?>" alt="Product Image"></div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6" style="text-align: center;margin-top: 5%">
                            <h3 class="my-3"><?php echo $articolo[0]->descrizione ?></h3>
                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.</p>

                            <hr>
                            <h4>Colori Disponibili</h4>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-default text-center active">
                                    <input type="radio" name="color_option" id="color_option_a1" autocomplete="off" checked>
                                    Green
                                    <br>
                                    <i class="fas fa-circle fa-2x text-green"></i>
                                </label>
                                <label class="btn btn-default text-center">
                                    <input type="radio" name="color_option" id="color_option_a2" autocomplete="off">
                                    Blue
                                    <br>
                                    <i class="fas fa-circle fa-2x text-blue"></i>
                                </label>
                                <label class="btn btn-default text-center">
                                    <input type="radio" name="color_option" id="color_option_a3" autocomplete="off">
                                    Purple
                                    <br>
                                    <i class="fas fa-circle fa-2x text-purple"></i>
                                </label>
                                <label class="btn btn-default text-center">
                                    <input type="radio" name="color_option" id="color_option_a4" autocomplete="off">
                                    Red
                                    <br>
                                    <i class="fas fa-circle fa-2x text-red"></i>
                                </label>
                                <label class="btn btn-default text-center">
                                    <input type="radio" name="color_option" id="color_option_a5" autocomplete="off">
                                    Orange
                                    <br>
                                    <i class="fas fa-circle fa-2x text-orange"></i>
                                </label>
                            </div>

                            <h4 class="mt-3">Taglia <small>Please select one</small></h4>
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-default text-center">
                                    <input type="radio" name="color_option" id="color_option_b1" autocomplete="off">
                                    <span class="text-xl">S</span>
                                    <br>
                                    Small
                                </label>
                                <label class="btn btn-default text-center">
                                    <input type="radio" name="color_option" id="color_option_b2" autocomplete="off">
                                    <span class="text-xl">M</span>
                                    <br>
                                    Medium
                                </label>
                                <label class="btn btn-default text-center">
                                    <input type="radio" name="color_option" id="color_option_b3" autocomplete="off">
                                    <span class="text-xl">L</span>
                                    <br>
                                    Large
                                </label>
                                <label class="btn btn-default text-center">
                                    <input type="radio" name="color_option" id="color_option_b4" autocomplete="off">
                                    <span class="text-xl">XL</span>
                                    <br>
                                    Xtra-Large
                                </label>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">
                                <div class="bg-gray py-2 px-3 mt-4">
                                    <h2 class="mb-0" style="text-align: center">
                                        <?php if(sizeof($prezzo) > 0)echo number_format($prezzo[0]->prezzo,'2').'€'; else echo 'Prezzo non disponibile'?>
                                    </h2>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-sm-12 col-md-12" style="text-align: center">
                                <div class="mt-4">
                                    <form method="post">
                                        <div style="width: 100%;text-align: center">
                                            <button type="button" style="border:none;margin: 10px;background: transparent" onclick="diminiusci()">
                                                <i class="fa fa-solid fa-minus" style="background-color:white;border:none"></i>
                                            </button>
                                            <button type="button" style="border:none;margin: 10px;background: transparent" onclick="diminiusci()">
                                                <input type="hidden" step="1" value="1" name="quantita" id="quantita">
                                                <strong id="ciao"> 1 </strong>
                                            </button>
                                            <button type="button" style="border:none;margin: 10px;background: transparent" onclick="aggiungi()">
                                                <i class="fa fa-solid fa-plus" style="background-color:white;border:none"></i>
                                            </button>
                                        </div>
                                        <input type="hidden" value="<?php echo $articolo[0]->id ?>" name="id_prodotto" id="id_prodotto">
                                        <input type="hidden" value="<?php if(sizeof($prezzo) > 0 )echo number_format($prezzo[0]->prezzo,'2'); ?>" name="prezzo" id="prezzo">
                                        <button type="submit" name="aggiungi_al_carrello" id="aggiungi_al_carrello" value="1" style="border:none;width: 100%;background: transparent" >
                                            <div class="btn btn-primary btn-lg btn-flat" >
                                                <i class="fas fa-cart-plus fa-lg mr-2"></i>
                                                Aggiungi al Carrello
                                            </div>
                                        </button>
                                    </form>
                               </div>
                           </div>
<br>
                            <div class="mt-4 product-share" style="text-align: center;padding-top: 10px">
                                <a href="#" class="text-gray">
                                    <i class="fab fa-facebook-square fa-2x"></i>
                                </a>
                                <a href="#" class="text-gray">
                                    <i class="fab fa-instagram-square fa-2x"></i>
                                </a>
                                <a href="#" class="text-gray">
                                    <i class="fas fa-envelope-square fa-2x"></i>
                                </a>
                                <a href="#" class="text-gray">
                                    <i class="fas fa-rss-square fa-2x"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

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

<!-- ./wrapper -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- jQuery -->
<script>

    function diminiusci(){
        quantita = document.getElementById('quantita').value;
        if(quantita > 1)
        document.getElementById('quantita').value = parseInt(quantita) - 1 ;
        document.getElementById('ciao').innerHTML = document.getElementById('quantita').value;

    }

    function aggiungi(){
        quantita = document.getElementById('quantita').value;
        document.getElementById('quantita').value = parseInt(quantita) + 1 ;
        document.getElementById('ciao').innerHTML = document.getElementById('quantita').value;
    }


    $(document).ready(function() {
        <?php if(isset($_GET['aggiunto'])){?>
        $('#myModal').modal('show');
        <?php  } ?>
        $('.product-image-thumb').on('click', function () {
            var $image_element = $(this).find('img')
            $('.product-image').prop('src', $image_element.attr('src'))
            $('.product-image-thumb.active').removeClass('active')
            $(this).addClass('active')
        })
    })
</script>
</body>
</html>

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
*/ ?>
        <!-- Shop Details Section Begin -->




<section class="shop-details">
    <div class="product__details__pic" style="background:white;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__breadcrumb">
                        <a href="/cliente/index">Home</a>
                        <a href="/cliente/articoli?pagina=1">Negozio</a>
                        <span>Dettagli del Prodotto</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2 col-md-2" style="height: auto;margin-top: 20%">
                    <div class="nav-link" data-toggle="tab" href="#tabs-<?php echo $count_img?>" role="tab" id="imm_pre"
                         onclick="rimuovi_attributo('<?php echo $count_img?>')">
                        <i class="fa fa-arrow-left"></i>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <div class="tab-content">
                        <?php $t = 0; foreach ($immagine as $i){
                            $t++; ?>
                        <div class="tab-pane<?php echo ($t == 1)? ' active':''?>" id="tabs-<?php echo $t;?>"
                             role="tabpanel">
                            <div class="product__details__pic__item">
                                <img src="<?php echo ($i->link)? URL::ASSET($i->link):'/img/'.$ditta.'/no_logo_'.$ditta.'.png';?>"
                                     alt="">
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2" style="height: auto;margin-top: 20%">
                    <div class="nav-link" data-toggle="tab" href="#tabs-2" role="tab" id="imm_suc"
                         onclick="rimuovi_attributo('2')">
                        <i class="fa fa-arrow-right"></i>
                    </div>
                </div>
            </div>
            <?php /*<div class="row" style="padding-top: 5%;padding-left: 15%">
            <?php $t = 0; foreach($immagine as $i){
                    $t++;?>
            <div class="col-lg-3 col-md-3" style="margin: 1%">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabs-<?php echo $t;?>" role="tab" onclick="rimuovi_attributo()">
                            <div class="product__thumb__pic set-bg" style="width: 250px!important;height: 150px!important;" data-setbg="<?php echo ($i->link)? URL::ASSET($i->link):'/img/'.$ditta.'/no_logo_'.$ditta.'.png';?>">
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <?php }


            <section class="hero">
                <div class="hero__slider owl-carousel">
                    <?php // $immagine = DB::SELECT('SELECT * FROM arimg where id_ditta = '.$utente->id_ditta.' and cd_ar = \''.$articolo->cd_ar.'\'');?>
                    <?php $t = 0; foreach($immagine as $i){ $t++;?>
                    <div class="hero__items set-bg" style="height: 600px;padding-top:0;background-size: contain" data-setbg="<?php echo ($i->link)? URL::ASSET($i->link):'/img/'.$ditta.'/no_logo_'.$ditta.'.png';?>">
                        <div class="container col-sm-12">
                            <div class="row">
                                <div class="col-12">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </section>
 */ ?>
            <div class="row" style="padding-top: 5%;">
                <?php $t = 0; foreach ($immagine as $i){
                    $t++; if ($t <= 7){ ?>
                <div class="col-lg-2 col-md-2">
                    <ul class="nav nav-tabs" role="tablist" style="width: 100%">
                        <li class="nav-item" style="width: 100%">
                            <a class="nav-link" data-toggle="tab" href="#tabs-<?php echo $t;?>" role="tab"
                               style="width: 100%"
                               onclick="rimuovi_attributo('<?php echo $t;?>')">
                                <div class="product__thumb__pic set-bg"
                                     style=";width: 100%;background-position: center center;background-size:contain;"
                                     data-setbg="<?php echo ($i->link)? URL::ASSET($i->link):'/img/'.$ditta.'/no_logo_'.$ditta.'.png';?>">
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <?php }
                } ?>

            </div>


            <?php /*
            <div class="col-lg-3 col-md-3" style="margin: 1%">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab" onclick="rimuovi_attributo()">
                            <div class="product__thumb__pic set-bg"  style="width: 250px!important;height: 150px!important;"  data-setbg="<?php echo ($articolo->immagine2)? URL::ASSET($articolo->immagine2):'/img/'.$ditta.'/no_logo_'.$ditta.'.png';?>">
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-3" style="margin: 1%">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab" onclick="rimuovi_attributo()">
                            <div class="product__thumb__pic set-bg"  style="width: 250px!important;height: 150px!important;"  data-setbg="<?php echo ($articolo->immagine3)? URL::ASSET($articolo->immagine3):'/img/'.$ditta.'/no_logo_'.$ditta.'.png';?>">
                            </div>
                        </a>
                    </li>
                </ul>
            </div> */ ?>
        </div>
    </div>
    <div class="product__details__content" style="margin-top: -5%">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="product__details__text">
                        <h4><?php echo $articolo->cd_ar; ?></h4>
                        <div class="red"
                             style="margin-left:48%;

                 <?php
                                        if ($immediato >= 16) echo 'style="background: green;"';
                                        if ($immediato > 0 && $immediato <= 15) echo 'style="background: yellow;"';
                                        if ($immediato <= 0) echo 'style=""';/*
                                        if ($immediato <= 0 && $a->ordinato > 0) echo 'style="background: yellow;"';*/
                                        ?>">
                            <br></div>
                        <div>
                            <label style="color:black;font-weight: bold">
                                <?php if ($immediato > 15) echo 'Merce Immediata';
                                if ($immediato > 1 && $immediato < 16) echo 'Merce Immediata in Esaurimento';
                                if ($immediato <= 0) echo 'Merce Immediata Esaurita';/*
                                      if ($immediato <= 0 && $ordinato > 0) echo 'Merce in Arrivo'; */ ?>

                            </label>
                            <label style="color:black;font-weight: bold">
                                : <?php echo ($immediato <= 0) ? 0 : $immediato ?></label>
                            <br>
                            <div class="red"
                                 style="margin-left:48%;

                 <?php  if($bollino_blu > 0) echo 'background: blue'; else echo 'display:none;';?>">
                                <br></div>
                            <label style="color:black;font-weight: bold">
                                <!-- DISPONIBILE MA NON IMMEDIATA -->
                                <?php echo 'Merce in Arrivo'; ?>
                            </label>
                            <label style="color:black;font-weight: bold">
                                : <?php echo ($bollino_blu <= 0) ? 0 : $bollino_blu; ?></label>
                        </div>

                        <!--<div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                            --><!--<span> - 5 Reviews</span>-->
                        <!--</div>-->
                        <h3><?php if (sizeof($prezzo) > 0){ ?><?php if ($prezzo[0]->sconto == '') echo number_format($prezzo[0]->prezzo, '2'); else{
                                echo number_format($prezzo[0]->prezzo - ($prezzo[0]->prezzo / 100) * $prezzo[0]->sconto, 2); ?>
                            €<span><?php echo number_format($prezzo[0]->prezzo, '2'); ?>€</span></h3><?php }
                                                                                                     } ?>
                                                                                                     <?php if ($articolo->barcode != ''){ ?>
                        <h6><strong>EAN code: </strong><?php echo $articolo->barcode; ?></h6>
                        <?php } ?>

                        <p><?php echo $articolo->descrizione ?></p>
                        <!--<div class="product__details__option">
                            <div class="product__details__option__size">
                                <span>Taglie:</span>
                                <label for="xxl">xxl
                                    <input type="radio" id="xxl">
                                </label>
                                <label class="active" for="xl">xl
                                    <input type="radio" id="xl">
                                </label>
                                <label for="l">l
                                    <input type="radio" id="l">
                                </label>
                                <label for="sm">s
                                    <input type="radio" id="sm">
                                </label>
                            </div>
                            <div class="product__details__option__color">
                                <span>Colori:</span>
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
                                <label class="c-9" for="sp-9">
                                    <input type="radio" id="sp-9">
                                </label>
                            </div>
                        </div>-->
                        <form>
                            <div class="product__details__cart__option">
                                <div class="quantity">
                                    <button type="button" style="border:none;margin: 10px;background: transparent"
                                            onclick="diminiusci()">
                                        <i class="fa fa-solid fa-minus" style="background-color:white;border:none"></i>
                                    </button>
                                    <button type="button" style="border:none;margin: 10px;background: transparent">
                                        <input type="hidden"
                                               step="<?php echo (number_format($articolo->xqtaconf,0)>0)? number_format($articolo->xqtaconf,0):1 ?>"
                                               value="<?php  echo ($immediato > number_format($articolo->xqtaconf,0)) ? (number_format($articolo->xqtaconf,0) != '0.00') ? number_format($articolo->xqtaconf,0) : '1' : '0'?>"
                                               name="quantita" id="quantita">
                                        <strong id="ciao"><?php echo ($immediato > number_format($articolo->xqtaconf, 0)) ? (number_format($articolo->xqtaconf, 0) != '0.00') ? number_format($articolo->xqtaconf, 0) : '1' : '0' ?></strong>
                                    </button>
                                    <button type="button" style="border:none;margin: 10px;background: transparent"
                                            onclick="aggiungi()">
                                        <i class="fa fa-solid fa-plus" style="background-color:white;border:none"></i>
                                    </button>

                                </div>
                                <input type="hidden" value="<?php echo $articolo->id ?>" name="id_prodotto"
                                       id="id_prodotto">
                                <input type="hidden" value="<?php  if(sizeof($prezzo) > 0 )echo $prezzo[0]->sconto?>"
                                       name="sconto" id="sconto">
                                <input type="hidden"
                                       value="<?php if(sizeof($prezzo) > 0 )echo number_format($prezzo[0]->prezzo,'2',',',''); ?>"
                                       name="prezzo" id="prezzo">
                                <button type="submit" name="aggiungi_al_carrello" id="aggiungi_al_carrello" value="1"
                                        class="primary-btn">Aggiungi al Carrello
                                </button>
                            </div>
                        </form>
                        <!--
                        <div class="product__details__last__option">
                            <ul>
                                <li><span>SKU:</span> 3812912</li>
                                <li><span>Categories:</span> Clothes</li>
                                <li><span>Tag:</span> Clothes, Skin, Body</li>
                            </ul>
                        </div>
                        -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs"
                                   role="tab">Descrizione</a>
                            </li><!--
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Customer
                                    Previews(5)</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-7" role="tab">Additional
                                    information</a>
                            </li>-->
                        </ul>
                        <div class="tab-content" style="text-align: center">
                            <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                <div class="product__details__tab__content">
                                    <p class="note"></p>
                                    <div class="product__details__tab__content__item">
                                        <h5>Informazioni sul Prodotto</h5>
                                        <p><?php
                                           echo $scheda_tec->nota ?></p>
                                    </div>
                                    <div class="product__details__tab__content__item">
                                        <h5>Scheda Web</h5>
                                        <p><?php
                                           echo $scheda_web->nota ?></p>
                                    </div>
                                </div>
                            </div><!--
                            <div class="tab-pane" id="tabs-6" role="tabpanel">
                                <div class="product__details__tab__content">
                                    <div class="product__details__tab__content__item">
                                        <h5>Products Infomation</h5>
                                        <p>A Pocket PC is a handheld computer, which features many of the same
                                            capabilities as a modern PC. These handy little devices allow
                                            individuals to retrieve and store e-mail messages, create a contact
                                            file, coordinate appointments, surf the internet, exchange text messages
                                            and more. Every product that is labeled as a Pocket PC must be
                                            accompanied with specific software to operate the unit and must feature
                                            a touchscreen and touchpad.</p>
                                        <p>As is the case with any new technology product, the cost of a Pocket PC
                                            was substantial during it’s early release. For approximately $700.00,
                                            consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                            These days, customers are finding that prices have become much more
                                            reasonable now that the newness is wearing off. For approximately
                                            $350.00, a new Pocket PC can now be purchased.</p>
                                    </div>
                                    <div class="product__details__tab__content__item">
                                        <h5>Material used</h5>
                                        <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                            from synthetic materials, not natural like wool. Polyester suits become
                                            creased easily and are known for not being breathable. Polyester suits
                                            tend to have a shine to them compared to wool and cotton suits, this can
                                            make the suit look cheap. The texture of velvet is luxurious and
                                            breathable. Velvet is a great choice for dinner party jacket and can be
                                            worn all year round.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-7" role="tabpanel">
                                <div class="product__details__tab__content">
                                    <p class="note">Nam tempus turpis at metus scelerisque placerat nulla deumantos
                                        solicitud felis. Pellentesque diam dolor, elementum etos lobortis des mollis
                                        ut risus. Sedcus faucibus an sullamcorper mattis drostique des commodo
                                        pharetras loremos.</p>
                                    <div class="product__details__tab__content__item">
                                        <h5>Products Infomation</h5>
                                        <p>A Pocket PC is a handheld computer, which features many of the same
                                            capabilities as a modern PC. These handy little devices allow
                                            individuals to retrieve and store e-mail messages, create a contact
                                            file, coordinate appointments, surf the internet, exchange text messages
                                            and more. Every product that is labeled as a Pocket PC must be
                                            accompanied with specific software to operate the unit and must feature
                                            a touchscreen and touchpad.</p>
                                        <p>As is the case with any new technology product, the cost of a Pocket PC
                                            was substantial during it’s early release. For approximately $700.00,
                                            consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                            These days, customers are finding that prices have become much more
                                            reasonable now that the newness is wearing off. For approximately
                                            $350.00, a new Pocket PC can now be purchased.</p>
                                    </div>
                                    <div class="product__details__tab__content__item">
                                        <h5>Material used</h5>
                                        <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                            from synthetic materials, not natural like wool. Polyester suits become
                                            creased easily and are known for not being breathable. Polyester suits
                                            tend to have a shine to them compared to wool and cotton suits, this can
                                            make the suit look cheap. The texture of velvet is luxurious and
                                            breathable. Velvet is a great choice for dinner party jacket and can be
                                            worn all year round.</p>
                                    </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</section>
<!-- Shop Details Section End -->

<!-- Related Section Begin -->
<section class="related spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="related-title">Prodotti Simili</h3>
            </div>
        </div>
        <div class="row">
            <?php foreach ($simili as $s){ ?>

            <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                <form method="post">
                    <div class="product__item">
                        <div class="product__item__pic set-bg"
                             style="background-size:contain;width: 100%;background-position: center center"
                             data-setbg="<?php echo URL::ASSET($s->immagine)?>">
                            <!--<span class="label">New</span>-->
                            <ul class="product__hover">
                                <!--<li><a href="#"><img src="/img/icon/heart.png" alt=""></a></li>
                                <li><a href="#"><img src="/img/icon/compare.png" alt=""> <span>Compare</span></a></li>-->
                                <li><a href="/cliente/dettaglio/<?php echo $s->id_ar ?>"><img src="/img/icon/search.png"
                                                                                              alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text" style="text-align: center">
                            <h6><?php echo $s->descrizione ?></h6>
                            <button type="submit" style="visibility: hidden!important;top: 22px!important;"
                                    value="<?php echo ($immediato > $s->xqtaconf) ? ($s->xqtaconf != '0.00') ? intval($s->xqtaconf) : '1' : '0'?>"
                                    name="aggiungi_al_carrello">
                                <a class="add-cart">+ Aggiungi al Carrello</a>
                            </button>
                            <input type="hidden" value="<?php echo $s->id ?>" name="id_prodotto" id="id_prodotto">
                            <input type="hidden" value="1" name="quantita" id="quantita">
                            <input type="hidden"
                                   value="<?php if($s->prezzo != '' )echo number_format($s->prezzo,'2',',',''); ?>"
                                   name="prezzo" id="prezzo">
                            <h5><?php echo number_format($s->prezzo, 2, ',', '') . '€' ?></h5>
                        </div>
                    </div>
                </form>
            </div>
            <?php } ?>
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

<!-- ./wrapper -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- jQuery -->
<!-- Related Section End -->
<script type="text/javascript">

    $(document).ready(function () {
        <?php if (isset($_GET['aggiunto'])){ ?>
        $('#myModal').modal('show');
        <?php } ?>
    })

    function rimuovi_attributo(new_attivo) {

        non_attivi = document.getElementsByClassName("nav-link");

        for (i = 0; i < non_attivi.length; i++) {
            non_attivi[i].classList.remove("active");
        }

        new_attivo = parseInt(new_attivo);

        document.getElementById('imm_suc').removeAttribute('href');
        document.getElementById('imm_suc').removeAttribute('onclick');

        document.getElementById('imm_pre').removeAttribute('href');
        document.getElementById('imm_pre').removeAttribute('onclick');

        if ((new_attivo + 1) > parseInt(<?php echo $count_img; ?>))
            piu_attivo = 1;
        else
            piu_attivo = (new_attivo + 1);

        document.getElementById('imm_suc').setAttribute('href', '#tabs-' + piu_attivo);
        document.getElementById('imm_suc').setAttribute('onclick', 'rimuovi_attributo(\'' + piu_attivo + '\')');

        if ((new_attivo - 1) < 1)
            meno_attivo = <?php echo $count_img; ?>;
        else
            meno_attivo = (new_attivo - 1);


        document.getElementById('imm_pre').setAttribute('href', '#tabs-' + meno_attivo);
        document.getElementById('imm_pre').setAttribute('onclick', 'rimuovi_attributo(\'' + meno_attivo + '\')');

    }

    function diminiusci() {
        quantita = document.getElementById('quantita').value;
        if (quantita > <?php echo (number_format($articolo->xqtaconf, 0)) ? number_format($articolo->xqtaconf, 0) : 1 ?>)
            document.getElementById('quantita').value = parseInt(quantita) - parseInt(<?php echo (number_format($articolo->xqtaconf, 0)) ? number_format($articolo->xqtaconf, 0) : 1 ?>);
        document.getElementById('ciao').innerHTML = document.getElementById('quantita').value;

    }

    function aggiungi() {
        quantita = document.getElementById('quantita').value;
        if (parseInt(quantita) + parseInt(<?php echo (number_format($articolo->xqtaconf, 0)) ? number_format($articolo->xqtaconf, 0) : 1 ?>) <= '<?php echo $immediato; ?>') {
            document.getElementById('quantita').value = parseInt(quantita) + parseInt(<?php echo (number_format($articolo->xqtaconf, 0)) ? number_format($articolo->xqtaconf, 0) : 1 ?>);
            document.getElementById('ciao').innerHTML = document.getElementById('quantita').value;
        } else
            $('#max_disp').modal('show');
    }
</script>