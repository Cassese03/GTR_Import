
<?php $ditta = session('ditta'); ?>


<?php if ($ditta != 'GTR1234'){ ?>
<footer class="footer" style="padding-top:0!important;bottom: 0;position: relative;">
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="footer__copyright__text">
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                <p>Copyright &copy; 2021 <a href="http://www.b2bincloud.it/" target="_blank">b2bincloud.it</a>.
                    Tutti i Diritti Riservati
                    <a href="http://www.softmaint.it/" target="_blank">Softmaint SRL</a> | Versione <a> 1.0</a>
                </p>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </div>
        </div>
    </div>
</footer>
<?php } ?>
<?php if ($ditta == 'GTR1234'){ ?>
<footer class="footer cellulare" style="padding-top:0!important;bottom: 0;position: relative;">
    <div class="row" style="background: #007bff">
        <div class="col-2"></div>
        <div class="col-8 row" style="text-align: center">
            <div class="col-3">
                <a style="color: white;font-weight: bolder">Social</a>
                <br>
                <div class="row" style="padding-top: 5%;">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-2" onclick="location.href = 'https://www.instagram.com/gtr_s.r.l/'">
                        <svg style="color: white;" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 448 512">
                            <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/>
                        </svg>
                    </div>
                    <div class="col-lg-2" onclick="location.href = 'https://www.facebook.com/gtrimportsrl'">
                        <svg style="color: white;" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 512 512">
                            <path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"/>
                        </svg>
                    </div>
                    <div class="col-lg-2" onclick="location.href = 'https://www.linkedin.com/company/gtr-srl/'">
                        <svg style="color: white;" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 448 512">
                            <path d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"/>
                        </svg>
                    </div>
                    <div class="col-lg-2"></div>
                </div>
            </div>
            <div class="col-3" style="text-align: left">
                <a style="color: white;font-weight: bolder">Informazioni</a>
                <br>
                <a href="/cliente/index" style="color: white;font-weight: normal">Azienda</a>
                <br>
                <a href="/cliente/contattaci" style="color: white;font-weight: normal">Dove siamo</a>
                <br>
                {{--<a style="color: white;font-weight: normal">Supporto</a>
                <br>--}}
                <a href="/cliente/contattaci" style="color: white;font-weight: normal">Contatti</a>{{--
                <br>
                <a style="color: white;font-weight: normal">Condizioni Generali</a>--}}
                <br>
                <a href="/cliente/policy" style="color: white;font-weight: normal">Privacy Policy</a>
            </div>
            <div class="col-3" style="text-align: left">
                <a style="color: white;font-weight: bolder">Account</a>
                <br>
                <a href="/cliente/login" style="color: white;font-weight: normal">Accedi</a>
                <br>
                <a href="/cliente/registrati" style="color: white;font-weight: normal">Diventa Rivenditore</a>
                {{-- <br>
                 <a style="color: white;font-weight: normal">Diventa Cliente</a>--}}
            </div>
            <div class="col-3" style="text-align: left">
                <a style="color: white;font-weight: bolder">Contatti</a>
                <br>
                <a style="color: white;font-weight: normal">Indirizzo: Via Alberto Sordi, 9 81030 Orta di Atella
                    (CE)</a>
                <br>
                <a style="color: white;font-weight: normal">Telefono: 081 19814300</a>
                <br>
                <a style="color: white;font-weight: normal">WhatsApp: 3204019723</a>
                <br>
                <a style="color: white;font-weight: normal">Email: ordini@gtrimport.it</a>
            </div>
        </div>
        <div class="col-2"></div>
        <div class="col-lg-12 text-center" style="background: #413D3A">
            <div class="footer__copyright__text" style="margin-top: 0">
                <p>GTR SRL - Via F.Palizzi, 51 80014 Giugliano in Campania (NA) - P.IVA 04594151211 - tel. 08119814300 |
                    info@gtrimport.it </p>
            </div>
        </div>
    </div>
</footer>
<footer class="footer cellulare_si" style="padding-top:0!important;bottom: 0;position: relative;">
    <div class="row" style="background: #007bff">
        <div class="col-12 row" style="text-align: center">
            <div class="col-3">
                <a style="color: white;font-weight: bolder">Social</a>
                <br>
                <div style="display: flex;flex-direction: column;">
                    <div class="col-lg-2" onclick="location.href = 'https://www.instagram.com/gtr_s.r.l/'">
                        <svg style="color: white;margin:25%" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 448 512">
                            <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/>
                        </svg>
                    </div>
                    <div class="col-lg-2" onclick="location.href = 'https://www.facebook.com/gtrimportsrl'">
                        <svg style="color: white;margin:25%" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 512 512">
                            <path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"/>
                        </svg>
                    </div>
                    <div class="col-lg-2" onclick="location.href = 'https://www.linkedin.com/company/gtr-srl/'">
                        <svg style="color: white;margin:25%" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 448 512">
                            <path d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"/>
                        </svg>
                    </div>
                </div>

            </div>
            <div class="col-3" style="text-align: left">
                <a style="color: white;font-weight: bolder">Informazioni</a>
                <br>
                <a href="/cliente/index" style="color: white;font-weight: 100!important">Azienda</a>
                <br>
                <a href="/cliente/contattaci" style="color: white;font-weight: 100!important">Dove siamo</a>
                <br>
                {{--<a style="color: white;font-weight: 100!important">Supporto</a>
                <br>--}}
                <a href="/cliente/contattaci" style="color: white;font-weight: 100!important">Contatti</a>
                {{-- <br>
                 <a style="color: white;font-weight: 100!important">Condizioni Generali</a>--}}
                <br>
                <a href="/cliente/policy" style="color: white;font-weight: normal">Privacy Policy</a>
            </div>
            <div class="col-3" style="text-align: left">
                <a style="color: white;font-weight: bolder">Account</a>
                <br>
                <a href="/cliente/login" style="color: white;font-weight: 100!important">Accedi</a>
                <br>
                <a href="/cliente/registrati" style="color: white;font-weight: 100!important">Diventa Rivenditore</a>
                {{-- <br>
                 <a style="color: white;font-weight: 100!important">Diventa Cliente</a>--}}
            </div>
            <div class="col-3" style="text-align: left">
                <a style="color: white;font-weight: bolder">Contatti</a>
                <br>
                <a style="color: white;font-weight: 100!important">Indirizzo: Via Alberto Sordi, 9 81030 Orta di Atella
                    (CE)</a>
                <br>
                <a style="color: white;font-weight: 100!important">Telefono: 081 19814300</a>
                <br>
                <a style="color: white;font-weight: 100!important">WhatsApp: 3204019723</a>
                <br>
                <a style="color: white;font-weight: 100!important">Email: ordini@gtrimport.it</a>
            </div>
        </div>
        <div class="col-lg-12 text-center" style="background: #413D3A">
            <div class="footer__copyright__text" style="margin-top: 0">
                <p>GTR SRL - Via F.Palizzi, 51 80014 Giugliano in Campania (NA) - P.IVA 04594151211 - tel. 08119814300 |
                    info@gtrimport.it </p>
            </div>
        </div>
    </div>
</footer>
<?php } ?>


        <!-- Search Begin -->
<div id="uscire" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header" style="margin-top: -15%">
                <h4 class="modal-title w-100">Attendi!</h4>
            </div>
            <div class="modal-body">
                <p class="text-center">Sei sicuro di voler effettuare il Logout?</p>
            </div>
            <div class="modal-footer">
                <div style="width: 45%;position:absolute;right:50%;">
                    <button class="btn btn-success btn-block" onclick="top.location.href='/cliente/logout'">Si</button>
                </div>
                <div style="width: 45%;position:absolute;left:50%;">
                    <button class="btn btn-warning btn-block" style="background-color: red" data-dismiss="modal">No
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch">+</div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Search here.....">
        </form>
    </div>
</div>
<script type="text/javascript">
    var _iub = _iub || [];
    _iub.csConfiguration = {
        "askConsentAtCookiePolicyUpdate": true,
        "floatingPreferencesButtonDisplay": "bottom-right",
        "perPurposeConsent": true,
        "siteId": 3190586,
        "whitelabel": false,
        "cookiePolicyId": 68928867,
        "lang": "it",
        "banner": {
            "acceptButtonDisplay": true,
            "closeButtonRejects": true,
            "customizeButtonDisplay": true,
            "explicitWithdrawal": true,
            "listPurposes": true,
            "position": "float-top-center"
        }
    };
</script>
{{--
<script type="text/javascript" src="//cdn.iubenda.com/cs/iubenda_cs.js" charset="UTF-8" async></script>
--}}


<!-- Search End -->
<!-- Js Plugins -->
<script src="/js/jquery-3.3.1.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/jquery.nice-select.min.js"></script>
<script src="/js/jquery.nicescroll.min.js"></script>
<script src="/js/jquery.magnific-popup.min.js"></script>
<script src="/js/jquery.countdown.min.js"></script>
<script src="/js/jquery.slicknav.js"></script>
<script src="/js/mixitup.min.js"></script>
<script src="/js/owl.carousel.min.js"></script>
<script src="/js/main.js"></script>
</body>

</html>
