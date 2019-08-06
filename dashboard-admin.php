<!-- Chama o cabeçalho e o menu -->
<?php include("includes/header.php");?>
         
          <!-- PAGE CONTENT -->
          <div class="right_col" id="dashboard-v2" role="main">
            <div class="spacer_30"></div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-xs-12 col-sm-6 col-lg-4">
                <div class="panel panel-danger element-box-shadow market-place">
                  <div class="panel-heading no-padding">
                    <div class="div-market-place">
                      <h3> Dias de Ativação</h3>
                      <h1>10/365 dias</h1>
                      <h2>Entrou dia: 27/08/2019</h2>
                      <p class="text-bold text-white">Quero indicar um amigo</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-lg-4">
                <div class="panel panel-success element-box-shadow market-place">
                  <div class="panel-heading no-padding">
                    <div class="div-market-place">
                      <h3> Lucro Total </h3>
                      <h1>R$ 15.000,00</h1>
                      <h2>Plano Atual: Bronze</h2>
                      <p class="text-bold text-white">5% fixo mensal</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-lg-4">
                <div class="panel panel-info element-box-shadow market-place">
                  <div class="panel-heading no-padding">
                    <div class="div-market-place">
                      <h3> Saldo Disponível</h3>
                      <h1>R$ 1.500,00</h1>
                      <h2>Lucro ontem: R$ 150,00</h2>
                      <p class="text-bold text-white">Saque automático todo dia 5 de cada mês.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="spacer_30"></div>
           
            <div class="margin_left_right_30">
              <div class="row">
                <div class="col-sm-6 col-lg-4">
                  <div class="panel panel-default exchange">
                    <div class="panel-body">
                      <h3><i class="cc BTC" title="BTC"></i> Bitcoin BTC</h3>
                      <div class="row">
                        <div class="col-md-6">0.00000434 <span class="color-gray">BTC</span> <span class="text-info">$0.04</span></div>
                        <div class="col-md-6 text-right text-success">+1.35%</div>
                      </div>
                      <div class="highchart_currency" id="chart_btc"></div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="panel panel-default exchange">
                    <div class="panel-body">
                      <h3><i class="cc LTC" title="LTC"></i> Litecoin LTC</h3>
                      <div class="row">
                        <div class="col-md-6">0.00000434 <span class="color-gray">LTC</span> <span class="text-info">$0.04</span></div>
                        <div class="col-md-6 text-right text-danger">-1.35%</div>
                      </div>
                      <div class="highchart_currency" id="chart_ltc"></div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="panel panel-default exchange">
                    <div class="panel-body">
                      <h3><i class="cc NEO" title="NEO"></i> Neo NEO</h3>
                      <div class="row">
                        <div class="col-md-6">0.00000434 <span class="color-gray">NEO</span> <span class="text-info">$0.04</span></div>
                        <div class="col-md-6 text-right text-danger">-1.35%</div>
                      </div>
                      <div class="highchart_currency" id="chart_neo"></div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="panel panel-default exchange">
                    <div class="panel-body">
                      <h3><i class="cc DASH" title="DASH"></i> Dash DASH</h3>
                      <div class="row">
                        <div class="col-md-6">0.000434 <span class="color-gray">DASH</span> <span class="text-info">$0.04</span></div>
                        <div class="col-md-6 text-right text-success">+0.99%</div>
                      </div>
                      <div class="highchart_currency" id="chart_dash"></div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="panel panel-default exchange">
                    <div class="panel-body">
                      <h3><i class="cc ETH" title="ETH"></i> Ethereum ETH</h3>
                      <div class="row">
                        <div class="col-md-6">0.00000434 <span class="color-gray">LTC</span> <span class="text-info">$0.04</span></div>
                        <div class="col-md-6 text-right text-success">+0.35%</div>
                      </div>
                      <div class="highchart_currency" id="chart_eth"></div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="panel panel-default exchange">
                    <div class="panel-body">
                      <h3><i class="cc XRP" title="XRP"></i> Ripple XRP</h3>
                      <div class="row">
                        <div class="col-md-6">0.000434 <span class="color-gray">XRP</span> <span class="text-info">$0.04</span></div>
                        <div class="col-md-6 text-right text-danger">-0.99%</div>
                      </div>
                      <div class="highchart_currency" id="chart_ripple_xrp"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <a href="#" class="scrollToTop"><i class="fa fa-chevron-up text-white" aria-hidden="true"></i></a>
          </div>

          <div class="spacer_30"></div>
          
          <!-- Chama o rodapé -->
          <?php include("includes/footer.php");?>

        </div>
      </div>

      <!-- JS SCRIPTS -->
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/jquery.scrollbar.min.js"></script>
      <script src="assets/plugins/modernizr/modernizr.custom.js"></script>
      <script src="assets/plugins/classie/classie.js"></script>  
      <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
      <script src="assets/plugins/dataTables/jquery.dataTables.min.js"></script>
      <!-- CALENDAR -->
      <script src="assets/plugins/calendar/moment.min.js"></script>
      <script src="assets/plugins/calendar/fullcalendar.min.js"></script>
      <script src="assets/plugins/calendar/jquery.qtip.js"></script>
      <!-- Custom Charts Scripts -->
      <script src="assets/plugins/chartjs/Chart.bundle.js"></script>
      <script src="assets/plugins/chartjs/utils.js"></script>
      <script src="assets/js/charts.js"></script>
      <script src="assets/plugins/amcharts/amcharts.js"></script>
      <script src="assets/plugins/amcharts/depthChart/serial.js"></script>
      <script src="assets/plugins/amcharts/depthChart/export.min.js"></script>
      <script src="assets/plugins/amcharts/depthChart/light.js"></script>
      <script src="assets/js/charts-amcharts.js"></script>
      <!-- Custom Theme Scripts -->
      <script src="assets/js/custom.min.js"></script>
      <script src="assets/js/preloader.min.js"></script>
      <script>
        $(document).ready(function(){
          $('#data-tables-markets-1').DataTable();
        });
      </script>
    </div>
  </body>
</html>
