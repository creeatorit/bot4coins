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
                          <h3>Pagamentos Efetuados</h3>
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
                        <th>Pagamento #</th>
                        <th class="text-center">Data da Solicitação</th>
                        <th class="text-center">Valor do Pagamento</th>
                        <th class="text-center">Link do Boleto</th>
                        <th class="text-right">Vencimento</th>
                        <th class="text-center">Data do Pagamento</th>
                        <th class="text-center">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                      $sql = 'SELECT * FROM depositos WHERE usuario = "'.$_SESSION['UsuarioID'].'" ';

                      foreach ($pdo->query($sql) as $row) {
                          if ($row['id']) {
                              $pagamento = '<font size="2" color="#D96D00">' . $row['id'] . '</font>';
                          }
                          if ($row['dt_solicitacao']) {
                            $solicitacao = '<font size="2">' . converte($row['dt_solicitacao'],2) . '</font>';
                        }
                          if ($row['valor']) {
                              $valor = '<font size="2"><strong>' . $row['valor'] . '</strong></font>';
                          }
                          if ($row['boleto']) {
                              $boleto = '<font size="2"><a href="assets/files/boletos/' . $row['boleto'] . '" target="_blank" class="btn-link">Visualizar boleto</a></font>';
                          } else {
                            $boleto = 'Não encontrado';
                          }
                          if ($row['dt_vencimento']) {
                              $vencimento = '<font size="2">' . converte($row['dt_vencimento'],2) . '</font>';
                          }
                          if ($row['dt_pagamento']) {
                              $dt_pagamento = '<font size="2">' . $row['dt_pagamento'] . '</font>';
                          }
                          if ($row['status'] == 1) {
                            $status = '<font size="2"><span class="label label-info">Aguardando Boleto</span></font>';
                          }
                          if ($row['status'] == 2) {
                              $status = '<font size="2"><span class="label label-warning">Aguardando Pagamento</span></font>';
                          }
                          if ($row['status'] == 3) {
                              $status = '<font size="2"><span class="label label-danger">Boleto Vencido</span></font>';
                          }
                          if ($row['status'] == 4) {
                              $status = '<font size="2"><span class="label label-success">Concluído</span></font>';
                          }
                          // $valor = number_format(floatval($valor), 2, '.', ',') ;
                          echo "<tr>";
                          echo "<td>" . $pagamento . "</td>";
                          echo "<td>" . $solicitacao . "</td>";
                          echo "<td>R$ ". $valor . "</td>";
                          echo "<td>" . $boleto . "</td>";
                          echo "<td>" . $vencimento . "</td>";
                          echo "<td>" . $dt_pagamento . "</td>";
                          echo "<td>" . $status . "</td>";
                      }
                      echo "</tr>";
                      ?>
                    </tbody>
                  </table>
                </div><!-- invoices -->
              </div>
            </div>
            <form action="depositos.php" method="POST">
              <fieldset>
              <div class="form-body">
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <input class="form-control moeda" name="deposito" id="deposito" placeholder="1.000,00" type="tel" autocomplete="off" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <button class="btn btn-primary btn-lg button-element" type="submit">Solicitar Novo Depósito</button>
                    </div>
                  </div>
                  </div>
              </div>
              </fieldset>
            </form>
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
      <script type="text/javascript" src="js/jquery.mask.min.js"></script>
      <script type="text/javascript" src="js/jquery.mask-init.min.js"></script>
      <!-- Custom Theme Scripts -->
      <script src="assets/js/preloader.min.js"></script>
      <script src="assets/js/custom.min.js"></script>
	  
	  
    </div>
  </body>
</html>

<!-- INICIA SQL PARA INSERÇÃO DE DEPÓSITOS -->
<?php

    if(!empty($_POST))
    {
      
        $valor = $_POST['deposito'];      

        //Validaçao dos campos:
        $validacao = true;

        //Insere data e hora do cadastro no BD
        $usuario        = $_SESSION['UsuarioID'];
        $dt_solicitacao = date("Y-m-d");
        $boleto         = '';
        $dt_vencimento  = 'Não disponível';
        $dt_pagamento   = 'Não disponível';
        $status         = '1';
        }


        //Inserindo no Banco:
        if($validacao)
        {
          $valor = str_replace(',','.', str_replace('.','', $valor));
          // echo "<script>alert('".str_replace(',','.', str_replace('.','', $valor))."')</script>";exit;
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO depositos (usuario, dt_solicitacao, valor, boleto, dt_vencimento, dt_pagamento, status) VALUES(?,?,?,?,?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($usuario,$dt_solicitacao,$valor,$boleto,$dt_vencimento,$dt_pagamento,$status));
            Banco::desconectar();

	    echo "<script>alert('SOLICITAÇÃO DE DEPÓSITO REALIZADA COM SUCESSO!');location.href='depositos.php';</script>";

        }
?>
<!-- FINALIZA SQL PARA INSERÇÃO DE DEPÓSITOS -->