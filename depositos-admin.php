<!-- Chama o cabeçalho e o menu -->
<?php include("includes/header.php");?>
         
          <?php 
            if(!empty($_POST['dt_vencimento'])) {
                        
              $dt_vencimento = implode('-',array_reverse(explode('/',$_POST['dt_vencimento'])));

              // $valor = str_replace(',','.', str_replace('.','', $valor));
              
              // Verifica se o boleto foi enviado
              if(count($_FILES['boleto']) > 0) {

                if($_FILES['boleto']['type'] == 'application/pdf') {
                  $tmpname = md5(time() . rand(0, 999)) . '.pdf';
                  $destino = 'assets/files/boletos/';
                  
                  if (!is_dir($destino)){       // Se a pasta não existir cria     
                    mkdir($destino, 0777, true);
                  }
                  
                  if(move_uploaded_file($_FILES['boleto']['tmp_name'], $destino.$tmpname)) {
                    $pdo = Banco::conectar();
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    $sql = "UPDATE depositos set dt_vencimento = :vencimento, boleto = :boleto, status = '2'  WHERE id = :id";
                    $q = $pdo->prepare($sql);
                    $q->bindValue(':vencimento', $dt_vencimento);
                    $q->bindValue(':boleto', $tmpname);
                    $q->bindValue(':id', $_POST['id']);
                    $q->execute();
                    if($q->rowCount() > 0) {
                      echo "<script>alert('BOLETO GERADO COM SUCESSO!');</script>";
                      echo "<script>window.location.href = 'window.location.href</script>";
                    } else {
                      echo "<script>alert('OOPS! OCORREU ALGUEM ERRO PARA GERAR O BOLETO, TENTE NOVAMENTE.');</script>";
                    }
                    Banco::desconectar();
                  }

               }
                
              }
              

            }
          ?>
          <!-- PAGE CONTENT -->
          <div id="crypto_address" class="right_col crypto_address" role="main">
            <div class="spacer_30"></div>
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
            <div class="spacer_30"></div>
            <div class="clearfix"></div>
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
                        <th class="text-center" width="80">Ação</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $results = array();
                      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                      $sql = 'SELECT  CONCAT(usuarios.nome, " " , usuarios.sobrenome) as cliente, depositos.id, depositos.dt_solicitacao, depositos.boleto, depositos.valor, depositos.status                     
                       FROM  depositos
                       LEFT JOIN usuarios on usuarios.id = depositos.usuario';
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
                          <td data-register-id="<?php echo $result['id']; ?>"><?php echo $result['id']; ?></td>
                          <td data-register-cliente="<?php echo utf8_encode($result['cliente']); ?>"><?php echo utf8_encode($result['cliente']); ?></td>
                          <td data-register-data="<?php echo $result['dt_solicitacao']; ?>"><?php echo $result['dt_solicitacao']; ?></td>
                          <td data-register-valor="valor">R$ <?php echo $result['valor']; ?></td>
                          <td><a href="assets/files/boletos/<?php echo !empty($result['boleto']) ? $result['boleto']:'#'; ?>" target="_blank" class="btn-link"><?php echo !empty($result['boleto']) ? 'Visualizar boleto' : 'Boleto não encontrado';?></a></td>
                          <td class="text-center"><button class="btn btn-danger btn-sm" data-toggle="modal" data-modal="#modalBoleto" data-id="<?php echo $result['id']; ?>">Enviar boleto</button></td>
                        </tr>
                      <?php endforeach; ?>
                     
                    </tbody>
                  </table>
                </div><!-- invoices -->
              </div>
            </div>
          </div><!-- END - PAGE CONTENT -->
          
          <!-- Start -\ modal -->
          <div id="modalBoleto" class="modal fade" role="dialog">
            <div class="modal-dialog">
                      
              <form method="POST" enctype="multipart/form-data">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Enviar boleto</h4>
                  </div>
                  <div class="modal-body">
                      <div class="row">
                        <input type="hidden" class="form-control" name="id" />
                        <div class="col-lg-12" data="dadosCliente"></div>
                        <div class="col-lg-3"><br />
                          <div class="form-group">
                            <label for="dt_vencimento">Data vencimento.</label>
                            <input type="tel" class="form-control" placeholder="00/00/0000" name="dt_vencimento">
                          </div>
                        </div>
                        <div class="col-lg-12">
                            <label for="boleto">Selecione o boleto.</label>
                            <input type="file" class="form-control"  name="boleto" />
                        </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" value="gerarBoleto">Gerar boleto</button>
                  </div>
                </div>
              </form>
            </div>
          </div>   
          <!--- End -\ Modal -->

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
        $boleto         = '-';
        $dt_vencimento  = '-';
        $dt_pagamento   = '-';
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