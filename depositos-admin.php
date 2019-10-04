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

          // Chama função para pegar o POST de cada FORM
          function get_post_action($name)
          {
              $params = func_get_args();

              foreach ($params as $name) {
                  if (isset($_POST[$name])) {
                      return $name;
                  }
              }
          }


          // Verifica qual botao foi clicado
          switch (get_post_action('gerarBoleto', 'confirmarBoleto')) {

            case 'gerarBoleto':

            $n_identificacao = $_POST['n_identificacao'];

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
                    
                    $sql = "UPDATE depositos set dt_vencimento = :vencimento, boleto = :boleto, n_identificacao = :n_identificacao, status = '2'  WHERE id = :id";
                    $q = $pdo->prepare($sql);
                    $q->bindValue(':vencimento', $dt_vencimento);
                    $q->bindValue(':boleto', $tmpname);
                    $q->bindValue(':n_identificacao', $n_identificacao);
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
          
          break;
    
          case 'confirmarBoleto':
        
              $id_deposito  = $_POST['id'];
              $dt_pagamento = date("Y-m-d");
              $status       = '4'; # CONFIRMADO PAGAMENTO
        
              $validacao = true;
        
              // começa a SALVAR antes de fechar
              if ($validacao) {
        
                      $sqlConfirmacao = 'UPDATE depositos set dt_pagamento = ?, status = ? WHERE id = "' . $id_deposito . '"  ';
                      $q = $pdo->prepare($sqlConfirmacao);
                      $q->execute(array($dt_pagamento, $status));
                      echo "<script>alert('CONFIRMAÇÃO DE DEPÓSITO REALIZADA COM SUCESSO!');</script>";
              }
              break;
        
          default:
              
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
                        <th>Nº Identificacão</th>
                        <th>Vencimento</th>
                        <th class="text-center" width="80">Ação</th>
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
                          <?php if($result['boleto'] == ''){ ?>
                          <td class="text-center"><button class="btn btn-danger btn-sm" data-toggle="modal" data-modal="#modalBoleto" data-id="<?php echo $result['id']; ?>">Enviar boleto</button></td>
                          <?php }else{ ?>
                          <td class="text-center"><form method="POST" enctype="multipart/form-data"><input type="hidden" name="id" value="<?php echo $result['id']; ?>" ><button type="submit" class="btn btn-success btn-sm" name="confirmarBoleto">Confirmar Depósito</button></form></td>
                          <?php }
                          } ?>
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
                        <div class="col-lg-5"><br />
                          <div class="form-group">
                            <label for="dt_vencimento">Nº Identificação.</label>
                            <input type="number" class="form-control" name="n_identificacao">
                          </div>
                        </div>
                        <div class="col-lg-12">
                            <label for="boleto">Selecione o boleto.</label>
                            <input type="file" class="form-control"  name="boleto" />
                        </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" value="gerarBoleto" name="gerarBoleto">Gerar boleto</button>
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