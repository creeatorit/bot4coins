<!-- Chama o cabeçalho e o menu -->
<?php include("includes/header.php");?>

<!-- Script que coleta a cotação das Cryptomoedas -->
<script type="text/javascript" src="js/currency.js"></script>
         <?php 
         // Busca o valor depositado com status 4 (concluído)
         $valor_deposito = array();
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $sql = 'SELECT SUM(valor) AS valor FROM  depositos WHERE usuario = :usuario AND status = "4"';
         $stmt = $pdo->prepare($sql);
         $stmt->bindValue(':usuario', $_SESSION['UsuarioID']);
         $stmt->execute();
         if($stmt->rowCount() > 0) {
           $result = $stmt->fetch();
           $valor_depositado = $result['valor'];
         }

         // Busca o valor saques com status 4 (concluído)
         $results = array();
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $sql = 'SELECT SUM(valor) AS valor FROM  saques WHERE usuario = :usuario AND status = "4"';
         $stmt = $pdo->prepare($sql);
         $stmt->bindValue(':usuario', $_SESSION['UsuarioID']);
         $stmt->execute();
         if($stmt->rowCount() > 0) {
           $result = $stmt->fetch();
           $valor_sacado = $result['valor'];
         }
        
         $saldo = $valor_depositado-$valor_sacado;
         ?>
          <!-- PAGE CONTENT -->
          <div class="right_col" id="dashboard-v2" role="main">
            <div class="spacer_30"></div>
            <div class="clearfix"></div>
            <div class="row">
              
              <div class="col-lg-12">
                <h1>Meu saldo atual: <small>R$ <?php  echo  number_format($saldo,2,",","."); ?></small></h1>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-6 col-lg-4">
                <div class="panel panel-danger element-box-shadow market-place">
                  <div class="panel-heading no-padding">
                    <div class="div-market-place">
                      <h3> Dias de Ativação</h3>
                      <h1>10 de 180 dias</h1>
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
                      <h3>Bitcoin BTC</h3>
                      <div class="row">
                        <div class="coinmarketcap-currency-widget" data-currencyid="1" data-base="BRL" data-secondary="" data-ticker="false" data-rank="false" data-marketcap="false" data-volume="false" data-stats="USD" data-statsticker="false"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="panel panel-default exchange">
                    <div class="panel-body">
                      <h3>Litecoin LTC</h3>
                      <div class="row">
                        <div class="coinmarketcap-currency-widget" data-currencyid="2" data-base="BRL" data-secondary="" data-ticker="false" data-rank="false" data-marketcap="false" data-volume="false" data-stats="USD" data-statsticker="false"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="panel panel-default exchange">
                    <div class="panel-body">
                      <h3>Neo NEO</h3>
                      <div class="row">
                        <div class="coinmarketcap-currency-widget" data-currencyid="1376" data-base="BRL" data-secondary="" data-ticker="false" data-rank="false" data-marketcap="false" data-volume="false" data-stats="USD" data-statsticker="false"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="panel panel-default exchange">
                    <div class="panel-body">
                      <h3>Dash DASH</h3>
                      <div class="row">
                        <div class="coinmarketcap-currency-widget" data-currencyid="131" data-base="BRL" data-secondary="" data-ticker="false" data-rank="false" data-marketcap="false" data-volume="false" data-stats="USD" data-statsticker="false"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="panel panel-default exchange">
                    <div class="panel-body">
                      <h3>Ethereum ETH</h3>
                      <div class="row">
                        <div class="coinmarketcap-currency-widget" data-currencyid="1027" data-base="BRL" data-secondary="" data-ticker="false" data-rank="false" data-marketcap="false" data-volume="false" data-stats="USD" data-statsticker="false"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                  <div class="panel panel-default exchange">
                    <div class="panel-body">
                      <h3>Ripple XRP</h3>
                      <div class="row">
                        <div class="coinmarketcap-currency-widget" data-currencyid="52" data-base="BRL" data-secondary="" data-ticker="false" data-rank="false" data-marketcap="false" data-volume="false" data-stats="USD" data-statsticker="false"></div>
                      </div>
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
