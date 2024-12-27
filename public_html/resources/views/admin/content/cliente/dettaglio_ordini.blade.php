<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <?php /*
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
            </div>
*/?>
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> <?php echo $ditta->nome ?>
                    <small class="float-right">Data: <?php echo date('d-m-Y',strtotime($ordini->datadoc));?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-xl-6 col-lg-6 col-sm-12 col-md-12 invoice-col" style="margin-top: 10px">
                  Da
                  <address>
                    <strong><?php echo $ditta->nome ?></strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    Telefono: (804) 123-5432<br>
                    Email: <?php echo $ditta->mail_to ?>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-xl-6 col-lg-6 col-sm-12 col-md-12 invoice-col" style="margin-top: 10px">
                  a
                  <address>
                    <strong><?php echo $utente->descrizione ?></strong><br>
                    <?php echo $utente->indirizzo ?><br>
                    <?php echo $utente->localita ?>, <?php echo $utente->cap ?><br>
                    Telefono: <br>
                    Email:
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-xl-6 col-lg-6 col-sm-12 col-md-12 invoice-col" style="margin-top: 10px">
                  <br><br>
                  <b>Identificativo Ordine: </b><?php echo $ordini->id ?><br>
                  <b>Da Pagare entro :</b> 2/22/2014 <br>
                  <b>Tipo Pagamento :</b>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row" style="margin-top: 10px">
                <div class="col-xl-12 col-lg-12 col-sm-3 col-md-3 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Quantità</th>
                      <th>Articolo</th>
                      <th>Descrizione</th>
                      <th>Prezzo Unitario</th>
                      <th>Totale Riga</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($righe as $r){?>
                    <tr>
                      <td><?php echo number_format($r->qta,2,',', '')?></td>
                      <td><?php echo $r->cd_ar?></td>
                      <td><?php echo $r->descrizione ?></td>
                      <td><?php echo number_format($r->prezzounitariov,2,',', '')?></td>
                      <td><?php echo number_format($r->prezzototalev,2,',', '')?></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-xl-6 col-lg-6 col-sm-12 col-md-12">

                </div>
                <!-- /.col -->
                <div class="col-xl-3 col-lg-3 col-sm-0 col-md-0">
                </div>
                <div class="col-xl-6 col-lg-6 col-sm-12 col-md-12">
                  <p class="lead">Importo del <?php echo date('d-m-Y',strtotime($ordini->datadoc));?></p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr style="text-align: right">
                        <th style="width:50%">Totale Imponibile:</th>
                        <td><?php echo number_format($totali->totimponibilev,2,',', '') ?> €</td>
                      </tr>
                      <tr style="text-align: right">
                        <th>Imposta</th>
                        <td><?php echo number_format($totali->totimpostav,2,',', '') ?> €</td>
                      </tr>
                      <tr style="text-align: right">
                        <th>Spedizione:</th>
                        <td><?php echo '0,00 €' ?></td>
                      </tr>
                      <tr style="text-align: right">
                        <th>Totale:</th>
                        <td><?php echo number_format($totali->totdocumentov,2,',', '') ?> €</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                 <?php /*<button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                  </button>*/?>
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  <!-- /.control-sidebar -->

  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../dist/js/demo.js"></script>

</html>
