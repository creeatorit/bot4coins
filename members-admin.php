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
                                          $sql = 'SELECT * FROM usuarios where status = 1';
                                          $stmt = $pdo->prepare($sql);
                                          $stmt->bindValue(':status', $status);
                                          $stmt->execute();
                                          $result = $stmt->fetchAll();
                                          foreach($result as $row){
                                        ?>
                                          <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                            <div class="members_img_holder">
                                                <div class="memeber01-img-holder"><img src="assets/images/bitcurrency_member1.jpg"></div>
                                                <div class="member01-content">
                                                  <div class="member01-content-inside">
                                                    <h3 class="member01_name text-center"><a href="historico?id=<?php echo $row['id']; ?>"><?php echo $row['nome']; ?></a></h3>
                                                    <h3 class="member01_position text-center"><font size="2"><?php echo $row['nome']; ?> <?php echo $row['sobrenome']; ?></font></h3>
                                                    <h3 class="member01_position text-center"><font size="2"><?php if($row['status'] == '1'){ echo "ATIVADO"; } ?> | <?php echo $row['sexo']; ?> | <?php echo converte($row['nascimento'],2); ?></font></h3>
                                                    <h3 class="member01_position text-center"><font size="2"><strong>Nível:</strong> <?php if($row['nivel'] == '1'){ echo "<font color='#0000FF'>USUÁRIO</font>"; } if($row['nivel'] == '100'){echo "<font color='#00B200'>ADMINISTRADOR</font>"; } ?></font></h3>
                                                    <div class="content-div-content">
                                                      <h3 class="member01_position">Dias Ativado: 35 dias</h3>
                                                      <div class="bar-content">
                                                        <label class="green-bar"></label>
                                                        <label class="green-bar"></label>
                                                        <label class="green-bar"></label>
                                                        <label class="gray-bar"></label>
                                                        <label class="gray-bar"></label>
                                                      </div>
                                                      <div class="panel panel-info members-activity">
                                                        <div class="panel-heading">
                                                          <div class="row">
                                                            <div class="col-xs-4">
                                                              <i class="icon-bubbles"></i>
                                                            </div>
                                                            <div class="col-xs-4">
                                                              <i class="icon-user"></i>
                                                            </div>
                                                            <div class="col-xs-4">
                                                              <i class="icon-briefcase"></i>
                                                            </div>
                                                          </div>
                                                          <div class="row">
                                                            <div class="col-xs-4">
                                                              <p>Bronze</p>
                                                            </div>
                                                            <div class="col-xs-4">
                                                              <p>0</p>
                                                            </div>
                                                            <div class="col-xs-4">
                                                              <p>R$4.500</p>
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
