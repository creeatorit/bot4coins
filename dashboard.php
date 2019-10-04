<?php
// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();

$nivel_necessario = 1;

// Verifica se não há a variável da sessão que identifica o usuário
//if (!isset($_SESSION['UsuarioID']) AND ($_SESSION['UsuarioNivel'] >$nivel_necessario) OR ($_SESSION['UsuarioNivel'] <$nivel_necessario2)) {
if (!isset($_SESSION['UsuarioID']) or ($_SESSION['UsuarioNivel'] < $nivel_necessario)) {
    // Destrói a sessão por segurança
    session_destroy();
    // Redireciona o visitante de volta pro login
    header("Location: login");
    exit;
} ?>

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
         $sql = 'SELECT SUM(valor) AS valor FROM  saques WHERE usuario = :usuario AND status = "2"';
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
            <!-- <div class="row">
              <div class="col-lg-12">
                <h2 class="text-right">Meu saldo atual: <font color="#33bf1d" class="text-bold">R$ <?php  echo  number_format($saldo,2,",","."); ?></font></h2><br /><br />
              </div>
            </div> -->

            <?php 
              $pdo = Banco::conectar();
              $data = array();
              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $sql = "SELECT * FROM usuarios where id = :id";
              $q = $pdo->prepare($sql);
              $q->bindValue(':id', $_SESSION['UsuarioID']);
              $q->execute();
              if($q->rowCount() > 0) {
                $data = $q->fetch();
              }
            ?>
            <div class="row">
              <div class="col-xs-12 col-sm-6 col-lg-4">
                <div class="panel panel-danger element-box-shadow market-place">
                  <div class="panel-heading no-padding">
                    <div class="div-market-place">
                      <h3> Dias de Ativação</h3>

                      <?php
                      $data1 = date("Y-m-d");
                      $data2 = $data['dt_cadastro'];
                      // converte as datas para o formato timestamp
                      $d1 = strtotime($data1); 
                      $d2 = strtotime($data2);
                      // verifica a diferença em segundos entre as duas datas e divide pelo número de segundos que um dia possui
                      $dataFinal = ($d2 - $d1) /86400;
                      // caso a data 2 seja menor que a data 1
                      if($dataFinal < 0)
                      $dataFinal = $dataFinal * -1;
                      ?>
                      <h1><?php echo $dataFinal; ?> de 365 dias</h1>
                      <h2>Entrou dia: <br /><?php echo converte($data['dt_cadastro'],2); ?></h2>
                      <h5 class="text-bold text-white text-center"><button class="btn btn-light btn-sm" data-toggle="modal" data-target="#modalIndicar"><font color="#000000">Quero indicar um amigo!</font></button></a></h5><br>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-lg-4">
                <div class="panel panel-success element-box-shadow market-place">
                  <div class="panel-heading no-padding">
                    <div class="div-market-place">
                      <h3> Lucro Total Previsto Mês </h3>
                      <h1>R$ 
                      <?php
                        $porcentagem_mensal = ( $saldo / 100 ) * 15 + $saldo;
                        echo  number_format($porcentagem_mensal,2,",",".") ;
                      ?>
                      </h1>
                      <h2>Plano Atual: <?php if($data['plano'] == '1'){ echo 'BRONZE'; } if($data['plano'] == '2'){ echo 'PRATA'; } if($data['plano'] == '3'){ echo 'OURO'; }  ?></h2>
                      <p class="text-bold text-white"><?php if($data['plano'] == '1'){ echo '5% fixo mensal'; } if($data['plano'] == '2'){ echo '10% fixo mensal'; } if($data['plano'] == '3'){ echo '15% fixo mensal'; }  ?></p><br />
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-lg-4">
                <div class="panel panel-info element-box-shadow market-place">
                  <div class="panel-heading no-padding">
                    <div class="div-market-place">
                      <h3> Saldo Disponível</h3>
                      <h1>R$ 
                      <?php
                      $saldo_hoje = ( $saldo / 100 ) * 0.5 * $dataFinal + $saldo;
                      echo  number_format($saldo_hoje,2,",",".") ;
                      ?>
                      </h1>
                      <h3>Lucro de ontem:<br />R$ 
                      <?php
                        $porcentagem_diaria = ( $saldo / 100 ) * 0.5;
                        echo  number_format($porcentagem_diaria,2,",",".") ;
                      ?>
                      </h3>
                      <h5 class="text-bold text-white text-center">Saque automático todo dia 5 de cada mês.</h5>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="spacer_30"></div>
            <!--
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
            -->
          </div>


          
          <div class="spacer_30"></div>
          
          <!-- Chama o rodapé -->
          <?php include("includes/footer.php");?>

        </div>
      </div>

      <!-- Start -\ modal -->
      <div id="modalIndicar" class="modal fade" role="dialog">
        <div class="modal-dialog">
                  
          <form action="sendmail/indicar-amigo" method="POST">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Indique um Amigo</h4>
              </div>
              <div class="modal-body">
                  <div class="row">
                    <div class="col-lg-6"><br />
                      <div class="form-group">
                        <label for="nome">Nome do amigo(a).</label>
                        <input type="text" class="form-control" placeholder="José da Silva" name="nome" autocomplete="off" onChange="this.value=this.value.toUpperCase()" required>
                      </div>
                    </div>
                    <div class="col-lg-6"><br />
                      <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="text" class="form-control" placeholder="jose.silva@dominio.com.br" name="email" autocomplete="off" onChange="this.value=this.value.toLowerCase()" required>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Indicar</button>
              </div>
            </div>
          </form>
        </div>
      </div>   
      <!--- End -\ Modal -->


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
