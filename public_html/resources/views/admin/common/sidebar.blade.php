<?php $utente = session('utente'); ?>
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <img src="/img/<?php echo $ditta?>/logo_<?php echo $ditta?>.png" alt="logo" style="background:white;height:10%;width:15%;margin:0 auto;display:block;">
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a  class="brand-link">
                <img src="/img/<?php echo $ditta?>/logo_<?php echo $ditta?>.png" alt="Logo" style="background:white;width:100%;height:10%;margin:0 auto;display:block;">
        </a>

        <!-- Sidebar -->
        <div class="sidebar">


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <?php if(substr($utente->cd_cf,0,1) == 'F'){?>
                    <li class="nav-item">
                        <a href="/fornitore/index" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Home
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/fornitore/richieste" class="nav-link">
                            <i class="far fa-envelope nav-icon"></i>
                            <p>
                                Richieste
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/fornitore/offerte" class="nav-link">
                            <i class="far fa-flag nav-icon"></i>
                            <p>
                                Offerte Inviate
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/fornitore/risposte" class="nav-link">
                            <i class="far fa-copy nav-icon"></i>
                            <p>
                                Risposte da Cliente
                            </p>
                        </a>
                    </li>
                    <?php } ?>
                    <?php if(substr($utente->cd_cf,0,1) == ''){?>
                    <li class="nav-item">
                        <a href="/admin/index" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Home
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin/fornitore" class="nav-link">
                            <i class="far fa-envelope nav-icon"></i>
                            <p>
                                Richieste Inviate
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin/offerte" class="nav-link">
                            <i class="far fa-flag nav-icon"></i>
                            <p>
                               Rifiutate da Fornitore
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin/risposte" class="nav-link">
                            <i class="far fa-copy nav-icon"></i>
                            <p>
                                Risposte da Fornitore
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin/storico" class="nav-link">
                            <i class="far fa-clock nav-icon"></i>
                            <p>
                                Storico
                            </p>
                        </a>
                    </li>
                    <?php } ?>
                    <li class="nav-item">
                            <a href="/admin/logout" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>

                    <?php /*

                        <li class="nav-item">
                            <a href="/cliente/index" class="nav-link">
                                <!--<i class="nav-icon fas fa-home"></i>-->
                                <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                                <lord-icon
                                        src="https://cdn.lordicon.com/nlzvfogq.json"
                                        trigger="loop"
                                        colors="primary:#ffffff,secondary:#ffffff"
                                        style="width:25px;height:25px">
                                </lord-icon>
                                <p>
                                    Articoli
                                </p>
                            </a>
                        </li>



                            <li class="nav-item">
 <lord-icon
                                        src="https://cdn.lordicon.com/gmzxduhd.json"
                                        trigger="loop"
                                        colors="primary:#ffffff,secondary:#ffffff"
                                        style="width:25px;height:25px">
                                </lord-icon>

                                <a href="/cliente/articoli" class="nav-link">
                                    <!--<i class="nav-icon fas fa-box"></i>-->
                                    <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                                    <lord-icon
                                            src="https://cdn.lordicon.com/nlzvfogq.json"
                                            trigger="loop"
                                            colors="primary:#ffffff,secondary:#ffffff"
                                            style="width:25px;height:25px">
                                    </lord-icon>
                                    <p>
                                        Articoli
                                    </p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="/cliente/ordini" class="nav-link">
                                    <!--<i class="nav-icon fas fa-step-forward"></i>-->
                                    <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                                    <lord-icon
                                            src="https://cdn.lordicon.com/puvaffet.json"
                                            trigger="loop"
                                            colors="primary:#ffffff,secondary:#ffffff"
                                            style="width:25px;height:25px">
                                    </lord-icon>
                                    <p>
                                        Ordini
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/cliente/carrello" class="nav-link">

                                    <script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
                                    <lord-icon
                                        src="https://cdn.lordicon.com/slkvcfos.json"
                                        trigger="loop"
                                        colors="primary:#ffffff,secondary:#ffffff"
                                        style="width:25px;height:25px">
                                    </lord-icon>

                                    <p>
                                        Carrello
                                    </p>
                                </a>
                            </li>
                    <!--
                                                <li class="nav-item">
                                                    <a href="/cliente/odl" class="nav-link">
                                                        <i class="nav-icon fas fa-sort-amount-up-alt"></i>
                                                        <p>
                                                            Gestione ODL
                                                        </p>
                                                    </a>
                                                </li>


                                                <li class="nav-item">
                                                    <a href="#" class="nav-link">
                                                        <i class="nav-icon fas fa-warehouse"></i>
                                                        <p>
                                                            Magazzino WIP
                                                        </p>
                                                    </a>
                                                </li>-->



                        <?php if($utente->torna_admin > 0){ ?>
                            <li class="nav-item">
                                <a href="/admin/utenti/2" class="nav-link">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>
                                        Torna Admin
                                    </p>
                                </a>
                            </li>
                        <?php } ?>


                        <?php if(isset($utente->mostra_logout) && $utente->mostra_logout == 1){ ?>
                            <li class="nav-item">
                                <a href="/cliente/logout" class="nav-link">
                                    <i class="nav-icon fas fa-sign-out-alt"></i>
                                    <p>
                                        Logout
                                    </p>
                                </a>
                            </li>
                        <?php } ?>

                    <?php } ?>
*/?>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>