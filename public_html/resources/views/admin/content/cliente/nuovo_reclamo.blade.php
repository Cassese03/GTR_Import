<?php $ditta = session('ditta');?>


<!-- Contact Section Begin -->
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="contact__text">
                    <div class="section-title">
                        <span>Informazioni</span>
                        <h2>Reclami</h2>
                        <p>Scrivere le politiche di reso</p>
                    </div>
                    <?php if($ditta == 'GTR1234'){?>
                    <ul>
                        <li>
                            <h4>Italia</h4>

                            <p>Via Alberto Sordi, 9, 81030 Orta di Atella CE<br />+39 081 19169257</p>
                        </li>
                        <li>

                            <h4> BestWay </h4>

                            <p> Inserire Descrizione della società </p>

                            <a href="https://bestwaystore.it/ricambi.html">
                                <img style="width: 25%" data-setbg="/img/GTR1234/BestWay.jpg" src="/img/GTR1234/BestWay.jpg" onclick="location.href='https://bestwaystore.it/ricambi.html'">
                            </a>

                        </li>
                    </ul>
                    <?php } ?>
                    <?php if($ditta == 'BIO1234'){?>
                    <ul>
                        <li>
                            <h4>Italia</h4>

                            <p>Via Cervito, 15, 84084 Fisciano SA<br />+39 089 8201409</p>
                        </li>

                    </ul>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <h4>Compila il Form sottostante per inviare un reclamo </h4>
                <br>
                <div class="contact__form">
                    <form method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="number" step="1" min="1" placeholder="Riferimento Fattura" name="numerodoc" required autocomplete="off">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" placeholder="Codice Articolo" name="cd_ar" required autocomplete="off">
                            </div>
                            <div class="col-lg-12">
                                <input type="text" placeholder="Email" name="email" required autocomplete="off">
                            </div>
                            <div class="col-lg-6">
                                <label style="color: black" for="foto_prodotto">Inserire la foto del Prodotto : </label>
                                <input type="file" style="padding-top: 4%;" placeholder="Foto Prodotto"  name="foto_prodotto" id="foto_prodotto" required autocomplete="off">
                            </div>
                            <div class="col-lg-6">
                                <label style="color: black" for="foto_imballaggio">Inserire la foto dell' Imballaggio : </label>
                                <input type="file" style="padding-top: 4%;" placeholder="Foto Imballaggio" name="foto_imballaggio" id="foto_imballaggio" required autocomplete="off">
                            </div>
                            <div class="col-lg-12">
                                <textarea placeholder="Problematica" name="problema" required autocomplete="off"></textarea>
                                <button type="submit" style="width: 100%" class="site-btn">Invia Reclamo</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->