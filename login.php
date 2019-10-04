<!-- Referencia o Banco de Dados -->
<?php include("includes/database.php");?>

<?php
# Inicnando a variavel que vai indentificar se temos que exibir o modal ou não
$exibirModal = false;
# Verificando se não existe o cookie
if(!isset($_COOKIE["usuarioVisualizouModal"]))
{
# Caso não exista entra aqui.

# Vamos criar o cookie com duração de 1 semana
$diasparaexpirar = 1;
setcookie('usuarioVisualizouModal', 'SIM', (time() + ($diasparaexpirar * 24 * 3600)));

# Seto nossa variavel de controle com o valor TRUE ( Verdadeiro)
$exibirModal = true;
}

preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $matches);
if(count($matches)<2){
  preg_match('/Trident\/\d{1,2}.\d{1,2}; rv:([0-9]*)/', $_SERVER['HTTP_USER_AGENT'], $matches);
}

if (count($matches) > 1 && $matches[1] <= 11){
    header('Location: IE.php'); die();
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
		<!-- Simple line icons -->
		<link href="assets/css/simple-line-icons.css" rel="stylesheet">
    <!-- Font awesome icons -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
		<!-- Custom Style -->
    <link href="assets/css/custom.css" rel="stylesheet">
    <link href="assets/css/media.css" rel="stylesheet">
    <link id="ui-current-skin" href="assets/css/skin-colors/skin-yellow.css" rel="stylesheet">
    <!-- Custom Font -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	</head>
  <body id="login-page" class="nav-md all-pages data_background preloader-off developer-mode"  data-background="assets/images/background.png">
    <div  class="container st-container st-effect">
      <div class="block-page text-center">
        <a href="index.html"><img src="assets/images/logo1.png" alt="cryptic-logo"></a>
        <h3 class="text-white text-bold">Faça seu Login</h3>
        <div class="row">
          <div class="col-xs-12">
            <form method="post" action="includes/valida-usuario">
              <div class="input--akira">
                <span class="input input--akira">
                  <input class="input__field input__field--akira" type="email" name="email" id="email" autocomplete="off" autofocus required />
                  <label class="input__label input__label--akira" for="input-1">
                    <span class="input__label-content input__label-content--akira">Email</span>
                  </label>
                </span><br>
                <span class="input input--akira">
                  <input class="input__field input__field--akira" type="password" id="senha" name="senha" autocomplete="off" required />
                  <label class="input__label input__label--akira" for="input-1">
                    <span class="input__label-content input__label-content--akira">Password</span>
                  </label>
                </span>
              </div>
              <input class="form-control form-control-login text-bold" type="submit" value="Login">
            </form>
          </div>         
          
        </div>
        <p class="text-white"><a href="register">Criar uma Conta</a></p>
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
    
  </body>
</html>
