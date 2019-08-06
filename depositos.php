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
                              $boleto = '<font size="2">' . $row['boleto'] . '</font>';
                          }
                          if ($row['dt_vencimento']) {
                              $vencimento = '<font size="2">' . $row['dt_vencimento'] . '</font>';
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

                          echo "<tr>";
                          echo "<td>" . $pagamento . "</td>";
                          echo "<td>" . $solicitacao . "</td>";
                          echo "<td>R$ " . $valor . "</td>";
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
                      <input class="form-control" name="deposito" id="deposito" placeholder="1.000,00" type="text" autocomplete="off" onKeyPress="return(moeda(this,'.',',',event))" required>
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
      <!-- Custom Theme Scripts -->
      <script src="assets/js/preloader.min.js"></script>
      <script src="assets/js/custom.min.js"></script>
	  
	  <script language="javascript">   
    function moeda(a, e, r, t) {
        let n = ""
          , h = j = 0
          , u = tamanho2 = 0
          , l = ajd2 = ""
          , o = window.Event ? t.which : t.keyCode;
        if (13 == o || 8 == o)
            return !0;
        if (n = String.fromCharCode(o),
        -1 == "0123456789".indexOf(n))
            return !1;
        for (u = a.value.length,
        h = 0; h < u && ("0" == a.value.charAt(h) || a.value.charAt(h) == r); h++)
            ;
        for (l = ""; h < u; h++)
            -1 != "0123456789".indexOf(a.value.charAt(h)) && (l += a.value.charAt(h));
        if (l += n,
        0 == (u = l.length) && (a.value = ""),
        1 == u && (a.value = "0" + r + "0" + l),
        2 == u && (a.value = "0" + r + l),
        u > 2) {
            for (ajd2 = "",
            j = 0,
            h = u - 3; h >= 0; h--)
                3 == j && (ajd2 += e,
                j = 0),
                ajd2 += l.charAt(h),
                j++;
            for (a.value = "",
            tamanho2 = ajd2.length,
            h = tamanho2 - 1; h >= 0; h--)
                a.value += ajd2.charAt(h);
            a.value += r + l.substr(u - 2, u)
        }
        return !1
    }
    </script>
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
        $boleto         = '-';
        $dt_vencimento  = '-';
        $dt_pagamento   = '-';
        $status         = '1';
        }


        //Inserindo no Banco:
        if($validacao)
        {
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