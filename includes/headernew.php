<?php

header('Content-Type: text/html; charset=utf-8');

include("includes/converte.php");

//envia email se for sexta depois das 15:00 ----
$diahj = date('Y-m-d');
$diasemana_numero = date('w', strtotime($diahj));

$hora_envio = date('H:i');
include("includes/database.php");
$pdo = Banco::conectar();

if($diasemana_numero == 6 && $hora_envio > '15:00'){



    $sql2s = "SELECT count(id) as qt FROM envioemail where data_envio='".$diahj."' ";
    foreach($pdo->query($sql2s)as $row)
    {
            if($row['qt'] == 0){
                    echo "<script>location.href = 'envia_email.php';</script>";
                                                    }

    }

}


# Inicnando a variavel que vai indentificar se temos que exibir o modal ou não
$exibirModal = false;
# Verificando se não existe o cookie
if(!isset($_COOKIE["usuarioVisualizouModal"]))
{
# Caso não exista entra aqui.

# Vamos criar o cookie com duração de 1 semana
$diasparaexpirar = 365;
//setcookie('usuarioVisualizouModal', 'SIM', (time() + ($diasparaexpirar * 24 * 3600)));
setcookie('usuarioVisualizouModal', 'SIM', (time()+18000));

# Seto nossa variavel de controle com o valor TRUE ( Verdadeiro)
$exibirModal = true;
}

?>


<!DOCTYPE html>
<html lang="pt-br">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
	  <link rel="icon" type="image/png" sizes="16x16" href="css/login/favicon.png">
  <title>Grupo Massa | SISCON</title>
    <!-- Bootstrap Core CSS -->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/plugins/datatables/media/css/dataTables.bootstrap4.css">
    <!-- chartist CSS -->
    <link href="assets/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="assets/plugins/chartist-js/dist/chartist-init.css" rel="stylesheet">
    <link href="assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!--This page css - Morris CSS -->
    <link href="assets/plugins/c3-master/c3.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
	 <!-- summernotes CSS -->
    <link href="assets/plugins/summernote/dist/summernote-bs4.css" rel="stylesheet" />
    <!-- You can change the theme colors from here -->
    <link href="css/colors/default-dark.css" id="theme" rel="stylesheet">
	<link href="css/pages/tab-page.css" rel="stylesheet">
	<link href="assets/plugins/wizard/steps.css" rel="stylesheet">
	<link href="css/pages/dashboard3.css" rel="stylesheet">
    <script src="plugins/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="plugins/dist/sweetalert2.min.css">
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.mask.min.js"></script>
    <script type="text/javascript" src="js/jquery.maskedinput.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>  

    
</head>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
     <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Grupo Massa</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
           
            <nav class="navbar top-navbar navbar-expand-md navbar-light">

     
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                <a class="sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" title="Menu" href="#"><i class="ti-menu"></i></a> 
                    <?php if($_SESSION['UsuarioNivel'] == 2 || $_SESSION['UsuarioNivel'] == 3 || $_SESSION['UsuarioNivel'] == 4){ ?>
                    <a class="navbar-brand" href="dashboardmaster?acao=1">
                    <?php } if($_SESSION['UsuarioNivel'] == 6){ ?>
                    <a class="navbar-brand" href="dashboardmastermanager?acao=1">
                    <?php } if($_SESSION['UsuarioNivel'] == 8 || $_SESSION['UsuarioNivel'] == 9){ ?>
                    <a class="navbar-brand" href="dashboardequipments">
                    <?php } if($_SESSION['UsuarioNivel'] == 7){ ?>
                    <a class="navbar-brand" href="patrimonialselectbroadcaster">
                    <?php } if($_SESSION['UsuarioNivel'] == 11){ ?>
                    <a class="navbar-brand" href="dashboardtechnicalcenter">
                    <?php } if($_SESSION['UsuarioNivel'] == 10 || $_SESSION['UsuarioNivel'] == 12){ ?>
                    <a class="navbar-brand" href="dashboardrf?acao=1">
                    <?php } if($_SESSION['UsuarioNivel'] == 1 || $_SESSION['UsuarioNivel'] == 100){ ?>
                    <a class="navbar-brand" href="dashboard?acao=1">
                    <?php } ?>

                    <?php 
                            //Calcula qtdades
                            $atrasadas1 = 0;             
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $sql5 = "SELECT StatusOcorrencia FROM ocorrencias where StatusOcorrencia in ('A')";
                                foreach($pdo->query($sql5)as $row)
                                    {
                                        
                                        $data_mysql = $row['dataSolicitado'];
                                        $timestamp = strtotime($data_mysql);
                                        $timestamp2 = strtotime($data_mysql);
                                        $dif = '<font size="2">' . date('Y-m-d', $timestamp) . ' ' . date('H:i:s', $timestamp2) . ' </font>';


                                    $dif = strtotime(date("Y-m-d")) - strtotime(converte($row['dataSolicitado'],1));
                                    if($dif > 0){
                                            
                                    // ATIVIDADES       
                                    $atrasadas1 = $atrasadas1 + 1;
                                    $porc1 = ($atrasadas1 * 100) / $qt_tt1;
                                        }
                                    }
                                    if($atrasadas1 > 0){
                                    echo "<script>SimpleAlert(); </script>";
                                        }
                                    if($_GET['acao1'] == 0){
                                            $acao1 = $_GET['tipo'];
                                        }else{  
                                        $acao1 = 'inicio';
                                        }
                        ?>

                        

                    <!-- <a class="navbar-brand" href="dashboard"> -->

                        <!-- Logo icon --><b>
                        
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                             <!-- Light Logo icon -->
                          </b>
                        <!--End Logo icon -->
                        <!-- Logo text --><span>
                         <!-- dark Logo text -->
                         <!-- Light Logo text -->    
                           </div>
                           <img src="assets/images/background/logoSis.jpg" width="300" height="60" alt="homepage" class="light-logo" />
                  
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item">  </li>
                        <li class="nav-item2"> <a class=" hidden-sm-down text-muted  waves-dark" ><i class="ti-menu2"></i></a> </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                    
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        <?php if($atrasadas1 >= 0 && ($_SESSION['UsuarioNivel'] == 1 || $_SESSION['UsuarioNivel'] == 100)){ ?>
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-message"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox scale-up">
                            <ul>
                                    <li>
                                        <div class="drop-title">Notificações</div>
                                    </li>
                                    <li>
                                        <div class="message-center">
                                            <a href="TicketViewerTechnician.php">
                                                <div class="btn btn-danger btn-circle"><i class="fas fa-life-ring"></i></div>
                                                <div class="mail-contnet">
                                                    <h5>Existem <font color="#FF3E3E"><?php echo $atrasadas1; ?></font> chamados em atrado!</h5> <span class="mail-desc">Favor verificar.</span> </div>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <?php } ?>
                       
                     
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->

                        
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/users/varun.jpg" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="assets/images/users/varun.jpg" alt="<?php echo $_SESSION['UsuarioNome'];?>"></div>
                                            <div class="u-text"><br />
                                                <h4><?php echo $_SESSION['UsuarioNome']; ?></h4>
                                                <p class="text-muted"><?php echo $_SESSION['UsuarioEmail']; ?></p>
                                            </div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="minhaconta"><i class="ti-user"></i> Minha Conta</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="includes/logout"><i class="fa fa-power-off"></i> Sair</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
              
            </nav>  </div>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->