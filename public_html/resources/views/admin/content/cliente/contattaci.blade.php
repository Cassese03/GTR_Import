<?php $ditta = session('ditta');?>
        <!-- Map Begin -->
<div class="map">
    <?php if($ditta == 'GTR1234'){?>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3012.141137385989!2d14.264408015718155!3d40.97839022921178!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x133b01230bc9a21b%3A0x7f57cc0681d39aac!2sGTR%20Srl!5e0!3m2!1sit!2sit!4v1657554866945!5m2!1sit!2sit" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    <?php } ?>
    <?php if($ditta == 'BIO1234'){?>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3021.015242905296!2d14.768774915713973!3d40.7836790411636!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x133bc5c48ac4e385%3A0x181266606b588e39!2sBioplast%20s.r.l.!5e0!3m2!1sit!2sit!4v1657880790324!5m2!1sit!2sit" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    <?php } ?>
</div>
<!-- Map End -->

<!-- Contact Section Begin -->
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="contact__text">
                    <div class="section-title">
                        <span>Informazioni</span>
                        <h2>Contattaci</h2>
                        <p>Come ci si potrebbe aspettare da un'azienda che ha iniziato come appaltatore di interni di fascia alta, paghiamo
                            rigorosa attenzione.</p>
                    </div>
                    <?php if($ditta == 'GTR1234'){?>
                    <ul>
                        <li>
                            <h4>Italia</h4>

                            <p>Via Alberto Sordi, 9, 81030 Orta di Atella CE<br />+39 081 19169257</p>
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
                <div class="contact__form">
                    <form action="#">
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" placeholder="Nome">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" placeholder="Email">
                            </div>
                            <div class="col-lg-12">
                                <textarea placeholder="Messaggio"></textarea>
                                <button type="submit" style="width: 100%" class="site-btn">Invia Messaggio</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<script type="text/javascript">

    document.title = '| CONTATTACI | GTRIMPORT ';
    headTag = document.getElementsByTagName('head');

    titleTag = document.createElement('META');
    titleTag.setAttribute("name", "title");
    titleTag.setAttribute("content", "GTRIMPORT - Contattaci per avere piu informazioni dettagliate");

    descriptionTag = document.createElement('META');
    descriptionTag.setAttribute("name", "description");
    descriptionTag.setAttribute("content", "GTR IMPORT - Contattaci per Supporto Specializzato. Ricevi Risposte e Consulenza Personalizzata da Esperti del Settore. Mettiti in Contatto con Noi.");

    keywordsTag = document.createElement('META');
    keywordsTag.setAttribute("name", "keywords");
    keywordsTag.setAttribute("content", "GTRIMPORT,contattaci,supporto,risposte,consulenza,esperti,settore,contatto,assistenza");

    headTag[0].appendChild(titleTag);
    headTag[0].appendChild(keywordsTag);
    headTag[0].appendChild(descriptionTag);
</script>
<!-- Contact Section End -->