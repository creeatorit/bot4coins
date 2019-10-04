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
         
          <!-- PAGE CONTENT -->
          <div class="right_col pricing-tables" role="main">
            <div class="spacer_30"></div>
            <div class="clearfix"></div>
            <div class="header-title-breadcrumb element-box-shadow">
              <div class="container">
                  <div class="row">
                      <div class="col-md-7 col-sm-6 col-xs-12 text-left">
                        <h3>Escolha Seu Plano</h3>
                      </div>
                  </div>
              </div>
            </div>
            <div class="spacer_80"></div>
            <section class="pricing-section bg-12">
              <div class="pricing pricing--palden">
                  <?php if($data['plano'] == '1'){ ?>
                  <div class="pricing__item pricing__item--featured">
                  <?php }else{ ?>
                  <div class="pricing__item">
                  <?php } ?>
                      <div class="pricing__deco">
                          <svg class="pricing__deco-img" version="1.1" id="Layer_1" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="300px" height="100px" viewBox="0 0 300 100" enable-background="new 0 0 300 100" xml:space="preserve">
                              <path class="deco-layer deco-layer--1" opacity="0.6" fill="#FFFFFF" d="M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729
    c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z" />
                              <path class="deco-layer deco-layer--2" opacity="0.6" fill="#FFFFFF" d="M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729
    c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z" />
                              <path class="deco-layer deco-layer--3" opacity="0.7" fill="#FFFFFF" d="M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716
    H42.401L43.415,98.342z" />
                              <path class="deco-layer deco-layer--4" fill="#FFFFFF" d="M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428
    c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z" />
                          </svg>
                          <div class="pricing__price"><span class="pricing__currency"></span>BRONZE</div>
                          <h3 class="pricing__title text-bold">De R$1.000 a R$4.999</h3>
                      </div>
                      <ul class="pricing__feature-list">
                          <li class="pricing__feature text-bold">Robot X - Minerador</li>
                          <li class="pricing__feature">5% Mensal<br><span>Renda Fixa</span></li>
                          <li class="pricing__feature">Moeda:<br><span>OURO</span></li>
                      </ul>
                      <?php if($data['plano'] == '1'){ ?>
                      <button class="btn btn-default btn-rounded">Meu Plano</button>
                      <?php }else{ ?>
                      <button class="btn btn-secondary btn-rounded button-element">Escolher esse Plano</button>
                      <?php } ?>
                  </div>
                  <?php if($data['plano'] == '2'){ ?>
                  <div class="pricing__item pricing__item--featured">
                  <?php }else{ ?>
                  <div class="pricing__item">
                  <?php } ?>
                      <div class="pricing__deco">
                          <svg class="pricing__deco-img" version="1.1" id="Layer_2" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="300px" height="100px" viewBox="0 0 300 100" enable-background="new 0 0 300 100" xml:space="preserve">
                              <path class="deco-layer deco-layer--1" opacity="0.6" fill="#FFFFFF" d="M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729
    c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z" />
                              <path class="deco-layer deco-layer--2" opacity="0.6" fill="#FFFFFF" d="M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729
    c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z" />
                              <path class="deco-layer deco-layer--3" opacity="0.7" fill="#FFFFFF" d="M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716
    H42.401L43.415,98.342z" />
                              <path class="deco-layer deco-layer--4" fill="#FFFFFF" d="M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428
    c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z" />
                          </svg>
                          <div class="pricing__price"><span class="pricing__currency"></span>PRATA</div>
                          <h3 class="pricing__title text-bold">De R$5.000 a R$9.999</h3>
                      </div>
                      <ul class="pricing__feature-list">
                          <li class="pricing__feature text-bold">Cyborg Z - Trader PRO</li>
                          <li class="pricing__feature">10% Mensal<br><span>Renda Fixa</span></li>
                          <li class="pricing__feature">Moeda:<br><span>OURO</span></li>
                      </ul>
                      <?php if($data['plano'] == '2'){ ?>
                      <button class="btn btn-default btn-rounded">Meu Plano</button>
                      <?php }else{ ?>
                      <button class="btn btn-secondary btn-rounded button-element">Escolher esse Plano</button>
                      <?php } ?>
                  </div>
                  <?php if($data['plano'] == '3'){ ?>
                  <div class="pricing__item pricing__item--featured">
                  <?php }else{ ?>
                  <div class="pricing__item">
                  <?php } ?>
                      <div class="pricing__deco">
                          <svg class="pricing__deco-img" version="1.1" id="Layer_3" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="300px" height="100px" viewBox="0 0 300 100" enable-background="new 0 0 300 100" xml:space="preserve">
                              <path class="deco-layer deco-layer--1" opacity="0.6" fill="#FFFFFF" d="M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729
    c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z" />
                              <path class="deco-layer deco-layer--2" opacity="0.6" fill="#FFFFFF" d="M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729
    c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z" />
                              <path class="deco-layer deco-layer--3" opacity="0.7" fill="#FFFFFF" d="M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716
    H42.401L43.415,98.342z" />
                              <path class="deco-layer deco-layer--4" fill="#FFFFFF" d="M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428
    c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z" />
                          </svg>
                          <div class="pricing__price"><span class="pricing__currency"></span>OURO</div>
                          <h3 class="pricing__title text-bold">Acima de R$10.000</h3>
                      </div>
                      <ul class="pricing__feature-list">
                          <li class="pricing__feature text-bold">Robot X + Cyborg Z</li>
                          <li class="pricing__feature">15% Mensal<br><span>Renda Fixa</span></li>
                          <li class="pricing__feature">Moeda:<br><span>OURO</span></li>
                      </ul>
                      <?php if($data['plano'] == '3'){ ?>
                      <button class="btn btn-default btn-rounded">Meu Plano</button>
                      <?php }else{ ?>
                      <button class="btn btn-secondary btn-rounded button-element">Escolher esse Plano</button>
                      <?php } ?>
                  </div>
              </div>
            </section>
            <a href="#" class="scrollToTop"><i class="fa fa-chevron-up text-white" aria-hidden="true"></i></a>
          </div>

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
      <script src="assets/plugins/dataTables/jquery.dataTables.min.js"></script>
      <!-- Custom Theme Scripts -->
      <script src="assets/js/custom.min.js"></script>
      <script src="assets/js/preloader.min.js"></script>
    </div>
  </body>
</html>
