<!DOCTYPE html>
<html lang="it-it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="all">

    <?php // if(substr($utente->cd_cf,0,1) == 'F') {?>
    <?php $ditta = session('ditta'); ?>

    <link rel="shortcut icon" href="/img/<?php echo $ditta?>/logo_<?php echo $ditta?>.png" type="image/png">


    <style>
        .hero__slider.owl-carousel .owl-nav button.owl-next {
            left: 85% !important;
        }

        html, body {
            max-width: 100%;
        }

        html {
            overflow-y: hidden;
        }

        body {
            overflow-x: hidden;
        }

        .hero {
            background-size: cover !important;
            text-align: center !important;
            display: -webkit-flex !important;
            display: -ms-flexbox !important;
            display: flex !important;
            -webkit-align-items: center !important;
            -ms-flex-align: center !important;
            align-items: center !important;
            -webkit-justify-content: center !important;
            -ms-flex-pack: center !important;
            justify-content: center !important;
        }

        .hero__slider {
            background-size: cover !important;
            text-align: center !important;
            display: -webkit-flex !important;
            display: -ms-flexbox !important;
            display: flex !important;
            -webkit-align-items: center !important;
            -ms-flex-align: center !important;
            align-items: center !important;
            -webkit-justify-content: center !important;
            -ms-flex-pack: center !important;
            justify-content: center !important;
        }

        .owl-stage {
            background-size: cover !important;
            text-align: center !important;
            display: -webkit-flex !important;
            display: -ms-flexbox !important;
            display: flex !important;
            -webkit-align-items: center !important;
            -ms-flex-align: center !important;
            align-items: center !important;
            -webkit-justify-content: center !important;
            -ms-flex-pack: center !important;
            justify-content: center !important;
        }

        .modal-confirm {
            color: #636363;
            width: 325px;
            font-size: 14px;
        }

        .modal-confirm .modal-content {
            padding: 20px;
            border-radius: 5px;
            border: none;
        }

        .modal-confirm .modal-header {
            border-bottom: none;
            position: relative;
        }

        .modal-confirm h4 {
            text-align: center;
            font-size: 26px;
            margin: 30px 0 -15px;
        }

        .modal-confirm .form-control, .modal-confirm .btn {
            min-height: 40px;
            border-radius: 3px;
        }

        .modal-confirm .close {
            position: absolute;
            top: -5px;
            right: -5px;
        }

        .modal-confirm .modal-footer {
            border: none;
            text-align: left;
            border-radius: 5px;
            font-size: 13px;
        }

        .modal-confirm .icon-box {
            color: #fff;
            position: absolute;
            margin: 0 auto;
            left: 0;
            right: 0;
            top: -70px;
            width: 95px;
            height: 95px;
            border-radius: 50%;
            z-index: 9;
            background: #82ce34;
            padding: 15px;
            text-align: center;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
        }

        .modal-confirm .icon-box i {
            font-size: 58px;
            position: relative;
            top: 3px;
        }

        .modal-confirm.modal-dialog {
            margin-top: 80px;
        }

        .modal-confirm .btn {
            color: #fff;
            border-radius: 4px;
            background: #82ce34;
            text-decoration: none;
            transition: all 0.4s;
            line-height: normal;
            border: none;
        }

        .modal-confirm .btn:hover, .modal-confirm .btn:focus {
            background: #6fb32b;
            outline: none;
        }

        .trigger-btn {
            display: inline-block;
            margin: 100px auto;
        }

        #myModal .modal-dialog {
            -webkit-transform: translate(0, -50%);
            -o-transform: translate(0, -50%);
            transform: translate(0, -50%);
            top: 50%;
            margin: 0 auto;
        }

        .sconto {
            color: #b7b7b7;
            font-size: 18px;
            font-weight: 400;
            margin-left: 10px;
            text-decoration: line-through;
        }

        .telefono {
            display: block;
            font-size: 22px;
            color: #111111;
            height: 35px;
            width: 35px;
            position: absolute;
        }

        /* @media only screen and (max-width: 767px) {
             .cellulare {
                 display: none;
             }
         }
         @media only screen and (min-width: 767px) {
             .cellulare_si {
                 display: none;
             }
         }*/
        @media only screen and (max-width: 1025px) {
            .cellulare {
                display: none !important;
            }
        }

        @media only screen and (min-width: 1025px) {
            .cellulare_si {
                display: none !important;
            }
        }
    </style>

    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
          rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="/css/style.css" type="text/css">
</head>

<body>
<?php
$cart = Session::get('cart');


if ($cart == '') $cart = [];


$totali = 0; ?>
        <!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>
<div class="offcanvas-menu-overlay"></div>
<div class="offcanvas-menu-wrapper">

    <div class="offcanvas__nav__option" style="text-align: center">

        <a href="/cliente/carrello"><img src="/img/icon/cart.png" alt=""> <span><?php echo sizeof($cart) ?></span></a>

        <div class="price">
            <?php
            $totali = 0.00;
            if (sizeof($cart) > 0) {
                foreach ($cart as $c) {
                    $totali = floatval($totali) + floatval($c['prezzo']) * floatval($c['quantita']);
                }
            }
            echo number_format($totali + (floatval($totali) / 100) * 22, 2, ',', '') . ' €'; ?>
        </div>
    </div>
    <div id="mobile-menu-wrap" style="text-align: center">
        <?php if (!session()->has('utente')){ ?>
        <a href="/cliente/login"><i class="fa fa-solid fa-user" style="color: black;vertical-align: middle;"></i></a>
        <?php }else{ ?>
        <a onclick="$('#uscire').modal('show');"><i class="fa fa-solid fa-sign-out"
                                                    style="color: black;vertical-align: middle;"></i></a>
        <?php } ?></div>

</div>
<div class="container">
    <div class="row" style="width: 105%">
        <div class="col-lg-2 col-md-2 col-4 telefono"
             style="height: 4.0625em!important;width: 4.0625em;display: flex;justify-content: center;align-items: center;background-size: contain;background:url('/img/GTR1234/logo_GTR1234.png')">
            <div class="header__logo">
                <a href="/cliente/index"><img src="/img/<?php echo $ditta?>/logo_<?php echo $ditta?>.png" height="50%"
                                              width="50%" alt=""></a>
            </div>
        </div>
        <div class="col-lg-8 col-md-8 col-6">
            <nav class="header__menu mobile-menu">
                <ul>
                    <li><a href="/cliente/index">Home</a></li>
                    <li <?php // class="active" ?> ><a href="/cliente/articoli?pagina=1">Negozio</a></li>
                    <li><a href="/cliente/carrello">Carrello</a></li>
                    <!--<li><a href="/cliente/ftp">CSV</a></li>
                    <li><a href="#">Pages</a>
                        <ul class="dropdown">
                            <li><a href="./about.html">About Us</a></li>
                            <li><a href="./shop-details.html">Shop Details</a></li>
                            <li><a href="./shopping-cart.html">Shopping Cart</a></li>
                            <li><a href="./checkout.html">Check Out</a></li>
                            <li><a href="./blog-details.html">Blog Details</a></li>
                        </ul>
                    </li>-->
                    <li><a href="/cliente/storico">Storico</a></li>
                    <li><a href="/cliente/reclami">Reclami</a></li>
                    <li><a href="/cliente/catalogo">Catalogo</a></li>
                    <li><a href="/cliente/contattaci">Contattaci</a></li>
                </ul>
            </nav>
        </div>
        <div class="col-lg-2 col-md-2 col-2">
            <div class="header__nav__option">
                <!--<a href="#" class="search-switch"><img src="/img/icon/search.png" alt=""></a>-->
                <div style="display: flex">
                    <?php if (!session()->has('utente')){ ?>
                    <a href="/cliente/login" style="display: inline-flex">
                        <i class="fa fa-solid fa-user"
                           style="color: black;"></i>
                        <p style="color: black;margin-left:5%;margin-top: -2%;"> Accedi/Registrati</p>
                    </a>
                    <?php }else{ ?>
                    <a onclick="$('#uscire').modal('show');"><i class="fa fa-solid fa-sign-out"
                                                                style="color: black;vertical-align: middle;"></i></a>
                    <?php } ?>
                    <a href="/cliente/carrello"><img src="/img/icon/cart.png" style="max-width: 120%" alt="">
                        <span id="size_of_refresh"><?php echo sizeof($cart) ?></span></a>
                    <div onclick="top.location.href='/cliente/carrello'"
                         class="price" id="refresh_cart">

                        <?php if (session()->has('utente')) {
                            $totali = 0.00;
                            if (sizeof($cart) > 0) {
                                foreach ($cart as $c) {
                                    $totali = floatval($totali) + floatval($c['prezzo']) * floatval($c['quantita']);
                                }
                            }
                            echo number_format($totali + (floatval($totali) / 100) * 22, 2, ',', '') . ' €';
                        } ?>
                    </div>
                </div>
            </div>

            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </div>
</div>

<style>

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .shop__sidebar__categories ul, .shop__sidebar__price ul, .shop__sidebar__brand ul {
        height: auto;
    }

    .zoom {
        padding: 25px;
        transition: transform .2s;
    }

    .zoom:hover {
        -ms-transform: scale(1.0); /* IE 9 */
        -webkit-transform: scale(1.0); /* Safari 3-8 */
        transform: scale(1.1);
    }

    body {
        margin-top: 20px;
    }


    /* USER LIST TABLE */
    .user-list tbody td > img {
        position: relative;
        max-width: 50px;
        float: left;
        margin-right: 15px;
    }

    .user-list tbody td .user-link {
        display: block;
        font-size: 1.25em;
        padding-top: 3px;
        margin-left: 60px;
    }

    .user-list tbody td .user-subhead {
        font-size: 0.875em;
        font-style: italic;
    }

    /* TABLES */
    .table {
        border-collapse: separate;
    }

    .table-hover > tbody > tr:hover > td,
    .table-hover > tbody > tr:hover > th {
        background-color: #eee;
    }

    .table thead > tr > th {
        border-bottom: 1px solid #C2C2C2;
        padding-bottom: 0;
    }

    .table tbody > tr > td {
        font-size: 0.875em;
        background: #f5f5f5;
        border-top: 10px solid #fff;
        vertical-align: middle;
        padding: 12px 8px;
    }

    .table tbody > tr > td:first-child,
    .table thead > tr > th:first-child {
        padding-left: 20px;
    }

    .table thead > tr > th span {
        border-bottom: 2px solid #C2C2C2;
        display: inline-block;
        padding: 0 5px;
        padding-bottom: 5px;
        font-weight: normal;
    }

    .table thead > tr > th > a span {
        color: #344644;
    }

    .table thead > tr > th > a span:after {
        content: "\f0dc";
        font-family: FontAwesome;
        font-style: normal;
        font-weight: normal;
        text-decoration: inherit;
        margin-left: 5px;
        font-size: 0.75em;
    }

    .table thead > tr > th > a.asc span:after {
        content: "\f0dd";
    }

    .table thead > tr > th > a.desc span:after {
        content: "\f0de";
    }

    .table thead > tr > th > a:hover span {
        text-decoration: none;
        color: #2bb6a3;
        border-color: #2bb6a3;
    }

    .table.table-hover tbody > tr > td {
        -webkit-transition: background-color 0.15s ease-in-out 0s;
        transition: background-color 0.15s ease-in-out 0s;
    }

    .table tbody tr td .call-type {
        display: block;
        font-size: 0.75em;
        text-align: center;
    }

    .table tbody tr td .first-line {
        line-height: 1.5;
        font-weight: 400;
        font-size: 1.125em;
    }

    .table tbody tr td .first-line span {
        font-size: 0.875em;
        color: #969696;
        font-weight: 300;
    }

    .table tbody tr td .second-line {
        font-size: 0.875em;
        line-height: 1.2;
    }

    .table a.table-link {
        margin: 0 5px;
        font-size: 1.125em;
    }

    .table a.table-link:hover {
        text-decoration: none;
        color: #2aa493;
    }

    .table a.table-link.danger {
        color: #fe635f;
    }

    .table a.table-link.danger:hover {
        color: #dd504c;
    }

    .table-products tbody > tr > td {
        background: none;
        border: none;
        border-bottom: 1px solid #ebebeb;
        -webkit-transition: background-color 0.15s ease-in-out 0s;
        transition: background-color 0.15s ease-in-out 0s;
        position: relative;
    }

    .table-products tbody > tr:hover > td {
        text-decoration: none;
        background-color: #f6f6f6;
    }

    .table-products .name {
        display: block;
        font-weight: 600;
        padding-bottom: 7px;
    }

    .table-products .price {
        display: block;
        text-decoration: none;
        width: 50%;
        float: left;
        font-size: 0.875em;
    }

    .table-products .price > i {
        color: #8dc859;
    }

    .table-products .warranty {
        display: block;
        text-decoration: none;
        width: 50%;
        float: left;
        font-size: 0.875em;
    }

    .table-products .warranty > i {
        color: #f1c40f;
    }

    .table tbody > tr.table-line-fb > td {
        background-color: #9daccb;
        color: #262525;
    }

    .table tbody > tr.table-line-twitter > td {
        background-color: #9fccff;
        color: #262525;
    }

    .table tbody > tr.table-line-plus > td {
        background-color: #eea59c;
        color: #262525;
    }

    .table-stats .status-social-icon {
        font-size: 1.9em;
        vertical-align: bottom;
    }

    .table-stats .table-line-fb .status-social-icon {
        color: #556484;
    }

    .table-stats .table-line-twitter .status-social-icon {
        color: #5885b8;
    }

    .table-stats .table-line-plus .status-social-icon {
        color: #a75d54;
    }

    body {
        margin-top: 20px;
        color: #484b51;
    }

    .text-secondary-d1 {
        color: #728299 !important;
    }

    .page-header {
        margin: 0 0 1rem;
        padding-bottom: 1rem;
        padding-top: .5rem;
        border-bottom: 1px dotted #e2e2e2;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-pack: justify;
        justify-content: space-between;
        -ms-flex-align: center;
        align-items: center;
    }

    .page-title {
        padding: 0;
        margin: 0;
        font-size: 1.75rem;
        font-weight: 300;
    }

    .brc-default-l1 {
        border-color: #dce9f0 !important;
    }

    .ml-n1, .mx-n1 {
        margin-left: -.25rem !important;
    }

    .mr-n1, .mx-n1 {
        margin-right: -.25rem !important;
    }

    .mb-4, .my-4 {
        margin-bottom: 1.5rem !important;
    }

    hr {
        margin-top: 1rem;
        margin-bottom: 1rem;
        border: 0;
        border-top: 1px solid rgba(0, 0, 0, .1);
    }

    .text-grey-m2 {
        color: #888a8d !important;
    }

    .text-success-m2 {
        color: #86bd68 !important;
    }

    .font-bolder, .text-600 {
        font-weight: 600 !important;
    }

    .text-110 {
        font-size: 110% !important;
    }

    .text-blue {
        color: #478fcc !important;
    }

    .pb-25, .py-25 {
        padding-bottom: .75rem !important;
    }

    .pt-25, .py-25 {
        padding-top: .75rem !important;
    }

    .bgc-default-tp1 {
        background-color: rgba(121, 169, 197, .92) !important;
    }

    .bgc-default-l4, .bgc-h-default-l4:hover {
        background-color: #f3f8fa !important;
    }

    .page-header .page-tools {
        -ms-flex-item-align: end;
        align-self: flex-end;
    }

    .btn-light {
        color: #757984;
        background-color: #f5f6f9;
        border-color: #dddfe4;
    }

    .w-2 {
        width: 1rem;
    }

    .red {
        background: red;
        background-size: 5px 5px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border-color: black;
    }

    .text-120 {
        font-size: 120% !important;
    }

    .text-primary-m1 {
        color: #4087d4 !important;
    }

    .text-danger-m1 {
        color: #dd4949 !important;
    }

    .text-blue-m2 {
        color: #68a3d5 !important;
    }

    .text-150 {
        font-size: 150% !important;
    }

    .text-60 {
        font-size: 60% !important;
    }

    .text-grey-m1 {
        color: #7b7d81 !important;
    }

    .align-bottom {
        vertical-align: bottom !important;
    }

    .product__item > .banner {
        position: absolute;
        top: 10%;
        height: 24px;
        left: 0;
        width: auto;
        color: white;
        background-color: #007BFF;
        z-index: 10;
        padding-bottom: 0 !important;
    }

    .product__item > .banner ::after {
        position: absolute;
        content: "";
        width: 0;
        top: 0;
        left: 100%;
        border-width: 12px 12px 12px 0;
        border-color: #007BFF transparent #007BFF #007BFF;
        border-style: solid;
    }

</style>

</header>
<!-- Header Section End -->
