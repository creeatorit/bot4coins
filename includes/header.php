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
    header("Location: index.php");
    exit;
}

?>


<?php
# Inicnando a variavel que vai indentificar se temos que exibir o modal ou não
$exibirModal = false;
# Verificando se não existe o cookie
if (!isset($_COOKIE["usuarioVisualizouModal"])) {
    # Caso não exista entra aqui.

    # Vamos criar o cookie com duração de 1 semana
    $diasparaexpirar = 7;
    setcookie('usuarioVisualizouModal', 'SIM', (time() + ($diasparaexpirar * 24 * 3600)));

    # Seto nossa variavel de controle com o valor TRUE ( Verdadeiro)
    $exibirModal = true;
} ?>

<?php

header('Content-Type: text/html; charset=utf-8');

include("includes/converte.php");
include("includes/database.php");
$pdo = Banco::conectar();

# Inicnando a variavel que vai indentificar se temos que exibir o modal ou não
$exibirModal = false;
# Verificando se não existe o cookie
if(!isset($_COOKIE["usuarioVisualizouModal"]))
{
# Caso não exista entra aqui.

# Vamos criar o cookie com duração de 1 semana
$diasparaexpirar = 1;
//setcookie('usuarioVisualizouModal', 'SIM', (time() + ($diasparaexpirar * 24 * 3600)));
setcookie('usuarioVisualizouModal', 'SIM', (time()+18000));

# Seto nossa variavel de controle com o valor TRUE ( Verdadeiro)
$exibirModal = true;
}

?>


<!DOCTYPE html>
<html lang="pt_BR">
	<head>
		<meta charset="UTF-8">
    <meta name="keywords" content="HTML,CSS,JavaScript">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="assets/images/favicon.png" type="image/ico" />
		<title>Bot4Coins - Invista no mercado de Criptomoedas</title>
		<!-- CSS -->
		<!-- Bootstrap -->
    <link href="assets/plugins/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="assets/plugins/dataTables/jquery.dataTables.min.css" rel="stylesheet">
    <link href="assets/fonts/cryptocoins.css" rel="stylesheet">
		<!-- Simple line icons -->
		<link href="assets/css/simple-line-icons.css" rel="stylesheet">
    <!-- Font awesome icons -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome-animation.min.css" rel="stylesheet">
    <!-- Calendar -->
    <link href="assets/plugins/calendar/fullcalendar.css" rel="stylesheet">
    <link href="assets/plugins/calendar/jquery.qtip.css" rel="stylesheet">
		<!-- Custom Style -->
    <link href="assets/plugins/select2/select2.min.css" rel="stylesheet">
		<link href="assets/css/custom.css" rel="stylesheet">
    <link id="ui-current-skin" href="assets/css/skin-colors/skin-yellow.css" rel="stylesheet">
    <link href="assets/css/media.css" rel="stylesheet">
    <!-- Charts -->
    <link href="assets/plugins/rickshaw/rickshaw.min.css" rel="stylesheet">
    <!-- Custom Font -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.maskedinput.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    
    <script type="text/javascript" src="js/app.js"></script>
	</head>
  <body class="nav-md preloader-off developer-mode">
    <div class="pace-cover"></div>
    <div id="st-container" class="st-container st-effect">
      <!-- MAIN PAGE CONTAINER -->
      <div class="container body">
        <div class="main_container">
          <!-- LEFT PRIMARY NAVIGATION -->
          <div class="col-md-3 left_col">
            <div class="scroll-view">
              <div class="navbar nav_title">
                <h1 class="logo_wrapper">
                <?php if ($_SESSION['UsuarioNivel'] == '1') { ?>
                  <a href="dashboard.php" class="site_logo">
                <?php } if ($_SESSION['UsuarioNivel'] == '100') { ?>
                  <a href="dashboard-admin.php" class="site_logo">
                <?php } ?>
                    <img class="logo" src="assets/images/cryptic-logo.png" alt="cryptic logo">
                    <span class="logo-text">Bot4Coins</span>
                  </a>
                </h1>
              </div>
              <div class="clearfix"></div>
              <!-- Menu Users -->
              <?php if ($_SESSION['UsuarioNivel'] == '1') { ?>
              <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                  <div class="menu_section">
                      <ul class="nav side-menu">
                          <li><a href="dashboard"><i class="icon-home icons"></i> <span>Página Inicial</span></a></li> 
                          <li><a href="member-profile"><i class="icon-people icons"></i> <span>Meus Dados</span></a></li>  
                          <li><a href="depositos"><i class="icon-layers icons"></i> <span>Meus Pagamentos</span></a></li>     
                          <li><a href="saques"><i class="icon-refresh icons"></i> <span>Meus Saques</span></a></li>                        
                          <li><a href="meu-plano"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <span>Meu Plano</span></a></li>
                          <li><a href="faq"><i class="fa fa-question" aria-hidden="true"></i> <span>Dúvidas Frequentes</span></a></li>
                        </ul>
                  </div>
                </div>
              
              <!-- Menu Admin -->
              <?php } if ($_SESSION['UsuarioNivel'] == '100') { ?>
              <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                <div class="menu_section">
                    <ul class="nav side-menu">
                        <li><a href="dashboard-admin"><i class="icon-home icons"></i> <span>Página Inicial</span></a></li> 
                        <li><a href="members-admin"><i class="icon-people icons"></i> <span>Nossos Membros</span></a></li>  
                        <li><a href="depositos-admin"><i class="icon-layers icons"></i> <span>Depositos pendentes</span></a></li>   
                        <li><a href="depositos"><i class="icon-layers icons"></i> <span>Pagamentos Recebidos</span></a></li>     
                        <li><a href="saques"><i class="icon-refresh icons"></i> <span>Saques Efetuados</span></a></li>                        
                        <li><a href="meu-plano"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <span>Nosso Financeiro</span></a></li>
                      </ul>
                </div>
              </div>
              <?php } ?>
              <!-- /sidebar menu -->
            
              <!-- /menu footer buttons -->
            </div>
          </div>
          <!-- TOP SECONDARY NAVIGATION -->
          <div class="top_nav">
            <div class="nav_menu">
              <ul class="nav navbar-nav navbar-left">
                <li class="toggle-li">
                  <div class="nav toggle burger-nav">
                    <a id="menu_toggle">
                      <div class="burger">
                        <span></span>
                        <span></span>
                        <span></span>
                      </div>
                    </a>
                  </div>
                </li>               
              </ul> <!-- top menu ul -->
              <?php 
               $pdo = Banco::conectar();
               $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               $sql = "SELECT foto FROM usuarios WHERE id = :id";
               $q = $pdo->prepare($sql);
               $q->bindValue(':id', $_SESSION['UsuarioID']);
               $q->execute();
               if($q->rowCount() > 0) {
                 $data = $q->fetch();
               }
               Banco::desconectar();
               ?>
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="assets/images/img_profiles/<?php echo $data['foto']; ?>" alt="" class="user-photo-preview">
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="member-profile"> Minha conta</a></li>
                    <li><a href="faq">Ajuda</a></li>
                    <li><a href="includes/sair"><i class="fa fa-sign-out pull-right"></i> Sair</a></li>
                  </ul>
                </li>
                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number faa-horizontal" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope faa-horizontal animated"></i>
                    <span class="badge faa-horizontal animated">3</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="assets/images/profile-pic.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="assets/images/profile-pic.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">4 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="assets/images/profile-pic.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">6 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts </strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li> 
              </ul>
            </div>
          </div>