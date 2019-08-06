<?php

header('Content-type: text/html; charset=utf-8');

error_reporting(E_ALL);
ini_set('display_errors', 1);

// inclui o arquivo de inicialização
//require 'init.php';
require 'database.php';

// resgata variáveis do formulário
$email = isset($_POST['email']) ? $_POST['email'] : '';
$senha = isset($_POST['senha']) ? $_POST['senha'] : '';

if (empty($email) || empty($senha)) {
    echo "<script>alert('OPS! INFORME O USUÁRIO E SENHA.');location.href='../';</script>";
    exit;
}

// cria o hash da senha
//$passwordHash = make_hash($password);

//$PDO = db_connect();
$PDO = Banco::conectar();

//$sql = "SELECT `id`, `praca`, `nome`, `email`, `nivel`, `senha` FROM `usuarios` WHERE (`usuario` = '".$usuario."') AND (`senha` = '".$senha."') AND (`ativo` = 1) LIMIT 1";
$sql = "SELECT * FROM usuarios WHERE email = :email AND senha = sha1(:senha) AND status = 1 LIMIT 1";
$stmt = $PDO->prepare($sql);

$stmt->bindParam(':email', $email);
$stmt->bindParam(':senha', $senha);

$stmt->execute();

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($users) != 1) {
    echo "<script>alert('OPS! USUÁRIO OU SENHA INVÁLIDOS.');location.href='logout.php';</script>";
    exit;
} else {

    // pega o primeiro usuário
    //$user = $users[0];
    $resultado = $users[0];

    //session_start();
    if (!isset($_SESSION)) session_start();

    $_SESSION['UsuarioID']            = $resultado['id'];
    $_SESSION['UsuarioNome']          = $resultado['nome'];
    $_SESSION['UsuarioSobrenome']     = $resultado['sobrenome'];
    $_SESSION['UsuarioEmail']         = $resultado['email'];
    $_SESSION['UsuarioTelefone']      = $resultado['telefone'];
    $_SESSION['UsuarioNivel']         = $resultado['nivel'];
    $_SESSION['UsuarioSenha']         = $resultado['senha'];


    //session_start();
    if ($_SESSION['UsuarioSenha'] == '123') {
        header("Location: ../recupera-senha?acao=0&id='" . $_SESSION['UsuarioID'] . "' ");
        exit;
    } if($_SESSION['UsuarioNivel'] == '100') {
        header("Location: ../dashboard-admin");
        exit;
    } else {
        header("Location: ../dashboard");
        exit;
    }
    
}
