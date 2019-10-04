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
         
          <!-- PAGE CONTENT -->
          <div class="right_col" id="members-page-v2" role="main">
            <div class="spacer_30"></div>
            <div class="clearfix"></div>
            <div class="panel panel-default element-box-shadow">
              <div class="wpb_column vc_column_container vc_col-sm-12">
                 <div class="vc_column-inner vc_custom_1509623292032">
                    <div class="wpb_wrapper">
                       <div class="spacer_30"></div>
                       <div class="clearfix"></div>
                       <div class="mt_members1 mt_slider_members_5a7af0d4e103b row animateIn wow fadeIn owl-carousel owl-theme animated undefined animated members-page-v2">
                          <div class="owl-wrapper-outer">
                             <div class="owl-wrapper">
                                <div class="owl-item hover_class">
                                   <div class="col-md-12 relative">
                                      <div class="row">
                                        <?php
                                          $sql = 'SELECT * FROM usuarios where status = 1 AND nivel = 1';
                                          $stmt = $pdo->prepare($sql);
                                          $stmt->bindValue(':status', $status);
                                          $stmt->execute();
                                          $result = $stmt->fetchAll();
                                          foreach($result as $row){
                                        ?>
                                          <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                            <div class="members_img_holder">
                                                <div><img src="assets/images/img_profiles/<?php echo $row['foto'];?>"></div>
                                                <div class="member01-content">
                                                  <div class="member01-content-inside">
                                                    <h3 class="member01_name text-center"><a href="historico?id=<?php echo $row['id']; ?>"><?php echo $row['nome']; ?> <?php echo $row['sobrenome']; ?></a></h3>
                                                    <h3 class="text-bold ext-center"><font size="2">Status: <?php if($row['status'] == '1'){ echo "<font color='#33ff46'>Ativo</font>"; } if($row['status'] == '2'){ echo "<font color='#ff4933'>Inativo</font>"; } ?></font></h3>
                                                    <!-- <h3 class="member01_position text-center"><font size="2"><strong>Nível:</strong> <?php if($row['nivel'] == '1'){ echo "<font color='#0000FF'>USUÁRIO</font>"; } if($row['nivel'] == '100'){echo "<font color='#00B200'>ADMINISTRADOR</font>"; } ?></font></h3> -->
                                                    <div class="content-div-content">
                                                      <h5 class="text-bold">Dias Ativado:
                                                      <?php
                                                        $data1 = date("Y-m-d");
                                                        $data2 = $row['dt_cadastro'];
                                                        // converte as datas para o formato timestamp
                                                        $d1 = strtotime($data1); 
                                                        $d2 = strtotime($data2);
                                                        // verifica a diferença em segundos entre as duas datas e divide pelo número de segundos que um dia possui
                                                        $dataFinal = ($d2 - $d1) /86400;
                                                        // caso a data 2 seja menor que a data 1
                                                        if($dataFinal < 0)
                                                        $dataFinal = $dataFinal * -1;
                                                        
                                                        echo $dataFinal;
                                                      ?>
                                                      </h5>
                                                      <hr>
                                                      <div class="panel panel-warning members-activity">
                                                        <div class="panel-heading">
                                                          <div class="row">
                                                            <div class="col-xs-4">
                                                              <i class="fa fa-shield"></i>
                                                            </div>
                                                            <div class="col-xs-4">
                                                              <i class="fa fa-group"></i>
                                                            </div>
                                                            <div class="col-xs-4">
                                                              <i class="fa fa-money"></i>
                                                            </div>
                                                          </div>
                                                          <div class="row">
                                                            <div class="col-xs-4">
                                                              <p><?php if($row['plano'] == '1'){ echo "BRONZE"; } if($row['plano'] == '2'){ echo "PRATA"; } if($row['plano'] == '3'){ echo "OURO"; } ?></p>
                                                            </div>
                                                            <div class="col-xs-4">
                                                              <p>0</p>
                                                            </div>
                                                            <?php 
                                                              // Busca o valor depositado com status 4 (concluído)
                                                              $valor_deposito = array();
                                                              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                              $sql = 'SELECT SUM(valor) AS valor FROM  depositos WHERE usuario = :usuario AND status = "4"';
                                                              $stmt = $pdo->prepare($sql);
                                                              $stmt->bindValue(':usuario', $row['id']);
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
                                                              $stmt->bindValue(':usuario', $row['id']);
                                                              $stmt->execute();
                                                              if($stmt->rowCount() > 0) {
                                                                $result = $stmt->fetch();
                                                                $valor_sacado = $result['valor'];
                                                              }
                                                              
                                                              $saldo = $valor_depositado-$valor_sacado;
                                                            ?>
                                                            <div class="col-xs-4">
                                                              <p>
                                                              <?php
                                                                $saldo_hoje = ( $saldo / 100 ) * 0.5 * $dataFinal + $saldo;
                                                                echo  number_format($saldo_hoje,2,",",".") ;
                                                              ?>
                                                              </p>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>                                                      
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                          </div>
                                          <?php } ?>
                                      </div>
                                   </div>
                                </div>
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
            </div>
          </div>
          
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
      <!-- Custom Theme Scripts -->
      <script src="assets/js/custom.min.js"></script>
      <script src="assets/js/preloader.min.js"></script>
    </div>
  </body>
</html>
