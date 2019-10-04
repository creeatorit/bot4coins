<?php
// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();

$nivel_necessario = 100;

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

<?php
// Busca o valor depositado com status 4 (concluído)
$valor_deposito = array();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = 'SELECT SUM(valor) AS valor FROM depositos WHERE status = "4"';
$stmt = $pdo->prepare($sql);
//$stmt->bindValue(':usuario', $UserID);
$stmt->execute();
if($stmt->rowCount() > 0) {
  $result = $stmt->fetch();
  $valor_depositado = $result['valor'];
}
?>

<?php 
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $sqlCountUsers = "SELECT count(id) as qt FROM usuarios WHERE status = 1 and nivel = 1";
 foreach ($pdo->query($sqlCountUsers) as $rowCountUsers) {
     $qtCountUsers = $rowCountUsers['qt'];
 }
?>


         
          <!-- PAGE CONTENT -->
          <div class="right_col" id="dashboard-v2" role="main">
            <div class="spacer_30"></div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-xs-12 col-sm-6 col-lg-4">
                <div class="panel panel-danger element-box-shadow market-place">
                  <div class="panel-heading no-padding">
                    <div class="div-market-place">
                      <h3> Usuários Ativos</h3><br />
                      <h1><?php echo $qtCountUsers; ?></h1><br /><br />
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-6 col-lg-4">
                <div class="panel panel-success element-box-shadow market-place">
                  <div class="panel-heading no-padding">
                    <div class="div-market-place">
                      <h3> Total Investido </h3>
                      <h1>R$ <?php echo number_format($valor_depositado,2,",","."); ?></h1>
                      <h5 class="text-center">Valor total investido sem acréscimo do juros diário e mensal.</h5>
                    </div>
                  </div>
                </div>
              </div>
              <!--
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
              -->
            </div>
            
            <div class="clearfix"></div>
            <div class="header-title-breadcrumb element-box-shadow">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7 col-sm-6 col-xs-12 text-left">
                          <h3>Depósitos pendentes</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default element-box-shadow">
              <div class="panel-body padding_30">
                <div class="invoices-section">
                  <table class="table table-striped table-hover no-margin">
                    <thead>
                      <tr>
                        <th>Cód.</th>
                        <th>Cliente</th>
                        <th class="text-center" width="150">Data da Solicitação</th>
                        <th class="text-center" width="100">Valor do Pagamento</th>
                        <th>Boleto</th>
                        <th>Nº Identificacão</th>
                        <th>Vencimento</th>
                        <!-- <th class="text-center" width="80">Ação</th> -->
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $results = array();
                      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                      $sql = 'SELECT  CONCAT(usuarios.nome, " " , usuarios.sobrenome) as cliente, depositos.id, depositos.dt_solicitacao, depositos.boleto, depositos.n_identificacao, depositos.dt_vencimento, depositos.valor, depositos.status                     
                       FROM  depositos
                       LEFT JOIN usuarios on usuarios.id = depositos.usuario ORDER BY id DESC ';
                      $stmt = $pdo->prepare($sql);
                      $stmt->execute();
                      if($stmt->rowCount() > 0) {
                        $results = $stmt->fetchAll();
                      }
                      $status = array(
                        array('Aguardando Boleto', 'info'),
                        array('Aguardando Pagamento', 'warning'),
                        array('Boleto Vencido', 'danger'),
                        array('Concluído', 'success')                         
                      );
                      ?>
                      <?php foreach($results as $result): ?>
                        <tr>
                          <?php if(($result['status'] == '1') || ($result['status'] == '2')){ ?>
                          <td data-register-id="<?php echo $result['id']; ?>"><?php echo $result['id']; ?></td>
                          <td data-register-cliente="<?php echo utf8_encode($result['cliente']); ?>"><?php echo utf8_encode($result['cliente']); ?></td>
                          <td data-register-data="<?php echo converte($result['dt_solicitacao'],2); ?>"><?php echo converte($result['dt_solicitacao'],2); ?></td>
                          <td data-register-valor="valor">R$ <?php echo $result['valor']; ?></td>
                          <td><a href="assets/files/boletos/<?php echo !empty($result['boleto']) ? $result['boleto']:'#'; ?>" target="_blank" class="btn-link"><?php echo !empty($result['boleto']) ? 'Visualizar boleto' : '<font color="#ff4933">Boleto não encontrado</font>';?></a></td>
                          <td data-register-identificacao="n_identificacao"><?php if($result['n_identificacao'] == ''){ echo 'Sem Identificação'; }else{ echo $result['n_identificacao']; } ?></td>
                          <td data-register-vencimento="dt_vencimento">
                          <?php 
                            $dt_atual		          = date("Y-m-d"); // data atual
                            $timestamp_dt_atual 	= strtotime($dt_atual); // converte para timestamp Unix
                            
                            $dt_expira	        	= $result['dt_vencimento']; // data de expiração do anúncio
                            $timestamp_dt_expira	= strtotime($dt_expira); // converte para timestamp Unix
                            
                            // data atual é maior que a data de expiração
                            if ($timestamp_dt_atual > $timestamp_dt_expira) { // true
                              echo "<font color='#ff4933' class='text-center text-bold'>VENCIDO</font><br />";
                              
                            }else{ // false
                              echo converte($result['dt_vencimento'],2);
                            }
                          ?>
                          </td>
                          <?php
                          } ?>
                        </tr>
                      <?php endforeach; ?>
                     
                    </tbody>
                  </table>
                </div><!-- invoices -->
              </div>
            </div>
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
