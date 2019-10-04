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
         
          <!-- PAGE CONTENT -->
          <div id="crypto_address" class="right_col crypto_address" role="main">
            <div class="spacer_30"></div>
            <div class="clearfix"></div>
            <div class="header-title-breadcrumb element-box-shadow">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7 col-sm-6 col-xs-12 text-left">
                          <h3>Saques Efetuados</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="spacer_30"></div>
            <div class="clearfix"></div>
            <div class="panel panel-default element-box-shadow">
              <div class="panel-body padding_30">
                <div class="invoices-section">
                  <table class="table table-striped table-hover no-margin">
                    <thead>
                      <tr>
                        <th>Saque #</th>
                        <th class="text-center">Data do Saque</th>
                        <th class="text-center">Dia Referência</th>
                        <th class="text-center">Valor do Saque</th>
                        <th class="text-center">Comprovante</th>
                        <th class="text-right">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                      $sql = 'SELECT * FROM saques WHERE usuario = "'.$_SESSION['UsuarioID'].'" ';

                      foreach ($pdo->query($sql) as $row) {
                          if ($row['id']) {
                              $saque = '<font size="2" color="#D96D00">' . $row['id'] . '</font>';
                          }
                          if ($row['dt_saque']) {
                            $dt_saque = '<font size="2">' . converte($row['dt_saque'],2) . '</font>';
                          }
                          if ($row['dt_referencia']) {
                            $dt_referencia = '<font size="2">' . $row['dt_referencia'] . '</font>';
                          }
                          if ($row['valor']) {
                              $valor = '<font size="2"><strong>' . $row['valor'] . '</strong></font>';
                          }
                          if ($row['comprovante']) {
                              $comprovante = '<font size="2">' . $row['comprovante'] . '</font>';
                          }
                          if ($row['status'] == 1) {
                            $status = '<font size="2"><span class="label label-info">Pendente</span></font>';
                          }
                          if ($row['status'] == 2) {
                              $status = '<font size="2"><span class="label label-success">Concluído</span></font>';
                          }

                          echo "<tr>";
                          echo "<td>" . $saque . "</td>";
                          echo "<td>" . $dt_saque . "</td>";
                          echo "<td>" . $dt_referencia . "</td>";
                          echo "<td> R$" . $valor . "</td>";
                          echo "<td>" . $comprovante . "</td>";
                          echo "<td>" . $status . "</td>";
                      }
                      echo "</tr>";
                      ?>
                    </tbody>
                  </table>
                </div><!-- invoices -->
              </div>
            </div>
          </div><!-- END - PAGE CONTENT -->

          <!-- Chama o cabeçalho e o menu -->
          <?php include("includes/footer.php");?>

        </div>
      </div>

      <!-- JS SCRIPTS -->
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/jquery.scrollbar.min.js"></script>
      <script src="assets/plugins/modernizr/modernizr.custom.js"></script>
      <script src="assets/plugins/classie/classie.js"></script>  
      <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
      <!-- Custom Theme Scripts -->
      <script src="assets/js/custom.min.js"></script>
      <script src="assets/js/preloader.min.js"></script>
    </div>
  </body>
</html>
