<?php

/*
if (!isset($_SESSION)) session_start();

$nivel_necessario = 1;
if (!isset($_SESSION['UsuarioID']) or ($_SESSION['UsuarioNivel'] < $nivel_necessario)) {
    session_destroy();
    header("Location: index.php");
    exit;
}

$exibirModal = false;
if (!isset($_COOKIE["usuarioVisualizouModal"])) {

    $diasparaexpirar = 7;
    setcookie('usuarioVisualizouModal', 'SIM', (time() + ($diasparaexpirar * 24 * 3600)));

    $exibirModal = true;
}
*/

include("includes/database.php");
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
  <body id="register-page" class="nav-md all-pages data_background preloader-off developer-mode"  data-background="assets/images/background.png">
    <div  class="container st-container st-effect">
      <div class="block-page text-center">
      <a href="index.html"><br /><img src="assets/images/logo1.png" alt="cryptic-logo"></a>
        <h3 class="text-white text-bold">Faça Seu Cadastro</h3>
        <div class="spacer_10"></div>
        <form action="register" method="post">
          <div class="row">
          <div class="input--akira">
            <div class="col-xs-12">
            <span class="input input--akira">
              <input class="input__field input__field--akira" type="text" name="nome" id="nome" autocomplete="off" required />
              <label class="input__label input__label--akira" for="input-1">
                <span class="input__label-content input__label-content--akira">Nome</span>
              </label>
            </span>
            <span class="input input--akira">
                <input class="input__field input__field--akira" type="text" name="sobrenome" id="sobrenome" autocomplete="off" required />
                <label class="input__label input__label--akira" for="input-1">
                  <span class="input__label-content input__label-content--akira">Sobrenome</span>
                </label>
              </span>
            <span class="input input--akira">
              <input class="input__field input__field--akira" type="email" name="email" id="email" autocomplete="off" onChange="this.value=this.value.toLowerCase()" required />
              <label class="input__label input__label--akira" for="input-1">
                <span class="input__label-content input__label-content--akira">Email</span>
              </label>
            </span>
            <span class="input input--akira">
              <input class="input__field input__field--akira" type="password" name="senha" id="senha" autocomplete="off" required />
              <label class="input__label input__label--akira" for="input-1">
                <span class="input__label-content input__label-content--akira">Senha</span>
              </label>
            </span>
            <span class="input input--akira">
              <select class="form-control input__field--akira" type="text" name="plano" id="plano" autocomplete="off" required />
                <option></option>
                <option value="1">BRONZE</option>
                <option value="2">PRATA</option>
                <option value="3">OURO</option>
              </select>
              <label class="input__label input__label--akira" for="select">
                <span class="input__label-content input__label-content--akira">Escolha o plano</span>
              </label>
            </span>
          </div>
          </div>
          </div>
          <!--
          <div class="register-check">
            <input type="checkbox" id="c1" name="terms" value="terms">
            <label for="c1" class="text-white"><span></span>Aceito os Termos e Condições</label>
          </div>
          -->
          <input class="form-control text-bold" type="submit" value="criar minha conta">
        </form>
        <p class="text-white">ou <a href="login" class="text-bold">Fazer Login</a></p>
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
    </div>
  </body>
</html>

<!-- INICIA SQL PARA INSERÇÃO DE USUÁRIOS -->
<?php

    if(!empty($_POST))
    {
      
        $nome        = $_POST['nome'];
        $sobrenome   = $_POST['sobrenome'];
	      $email       = $_POST['email'];
        $senha       = sha1($_POST['senha']);        
        $plano       = $_POST['plano'];

        //Validaçao dos campos:
        $validacao = true;

        //Insere data e hora do cadastro no BD
        $dt_cadastro = date("Y-m-d");
        $hr_cadastro = date("H:i:s");
        $status      = '1';
        $nivel       = '1';
        $termos      = '1';
        }


        //Inserindo no Banco:
        if($validacao)
        {
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO usuarios (nome, sobrenome, email, senha, status, nivel, termos, plano, dt_cadastro, hr_cadastro) VALUES(?,?,?,?,?,?,?,?,?,?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($nome,$sobrenome,$email,$senha,$status,$nivel,$termos,$plano,$dt_cadastro,$hr_cadastro));
            Banco::desconectar();

	    echo "<script>alert('CADASTRO REALIZADO COM SUCESSO!');location.href='login';</script>";

        }
?>
<!-- FINALIZA SQL PARA INSERÇÃO DE USUÁRIOS -->