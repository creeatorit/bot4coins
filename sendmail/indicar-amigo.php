<?php
  // A sessão precisa ser iniciada em cada página diferente
  if (!isset($_SESSION)) session_start();

  $nivel_necessario = 1;

  // Verifica se não há a variável da sessão que identifica o usuário
  if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] <$nivel_necessario)) {
      // Destrói a sessão por segurança
      session_destroy();
      // Redireciona o visitante de volta pro login
      header("Location: login"); exit;
  }

?>

<?php

$nome			= $_POST['nome'];
$cct			= $_POST['email'];


  function converte($data, $op) {
  
    if($op == 1) {
      $new_data = explode("/", $data);
      $new_data = array_reverse($new_data);
      $new_data = implode("-", $new_data);
    } elseif($op == 2) {
      $new_data = explode("-", $data);
      $new_data = array_reverse($new_data);
      $new_data = implode("/", $new_data);
      if($new_data == '00/00/0000') {
        $new_data = '';
      }
    }
    return $new_data;
  
  }
  
require("plugins/PHPMailer/class.phpmailer.php");
	$dt			= date("Y-m-d");
	$hr			= date("H:i");


 //================envia email======================


  $msg =  '

<html>
<head>
<style type="text/css">
table#alter tr th {
	background: #2CABE3;
	font-color: #FFFFFF;
	}

table td {
	background: #DDDDDD;
	}

.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
}
.style2 {
	color: #022561;
	font-weight: bold;
}
.style3 {color: #999999}
</style>
</head>
<body>

 <p class="style1">Ol&aacute;,</p>
 <p class="style1">Você conhece o sistema de investimento em criptomoedas? </p><br><br>
 <p class="style1"><a href="http://www.bot4coins.com" target="_blank">Clique aqui para saber mais!</p><br>
 
 <p class="style1">---<br>
   <span class="style3">E-mail enviado atrav&eacute;s do Bot4Coins.<br>
   www.bot4coins.com.</span></p>
</body>
</html>

';

$smtp 	 = 'smtp.gmail.com';
$logine  = 'creeator.it@gmail.com';
$passwd  = 'minhasenha';
$aut 	 = 'TRUE';
$retorn  = 'creeator.it@gmail.com';
$porta 	 = '587';


// Inicia a classe PHPMailer
$mail = new PHPMailer();
 
// Define os dados do servidor e tipo de conex�o
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsSMTP(); // Define que a mensagem ser� SMTP
//$mail->SMTPDebug = true;
$mail->Host = $smtp; // Endere�o do servidor SMTP (caso queira utilizar a autentica��o, utilize o host smtp.seudom�nio.com.br)
$mail->SMTPAuth = true; // Usar autentica��o SMTP (obrigat�rio para smtp.seudom�nio.com.br)
$mail->SMTPSecure = 'tls';
$mail->Port = $porta;
//$mail->SMTPSecure = 'tls';
$mail->Username = $logine; // Usu�rio do servidor SMTP (endere�o de email)
$mail->Password = $passwd; // Senha do servidor SMTP (senha do email usado)
 
// Define o remetente
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->From = $logine; // Seu e-mail
$mail->Sender = $logine; // Seu e-mail
$mail->FromName = $nome; // Seu nome
 
// Define os destinat�rio(s)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->AddAddress($cct, $ass);
//$mail->AddBCC($cct2, $ass); // C�pia Oculta


//$mail->AddAddress('e-mail@destino2.com.br');
//$mail->AddCC('contabilidade@moriah.cnt.br', 'Contato'); // Copia
//$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // C�pia Oculta
 
// Define os dados t�cnicos da Mensagem
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsHTML(true); // Define que o e-mail ser� enviado como HTML
$mail->CharSet = 'utf-8'; // Charset da mensagem (opcional)
 
// Define a mensagem (Texto e Assunto)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->Subject  = $assunto; // Assunto da mensagem
$mail->Body = utf8_decode($msg);
//$mail->AltBody = 'Este � o corpo da mensagem de teste, em Texto Plano! \r\n 
//<IMG src="http://seudom�nio.com.br/imagem.jpg" alt=":)"  class="wp-smiley"> ';
 
// Define os anexos (opcional)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
//$mail->AddAttachment("/home/login/documento.pdf", "novo_nome.pdf");  // Insere um anexo
 
// Envia o e-mail
$enviado = $mail->Send();
 
// Limpa os destinat�rios e os anexos
$mail->ClearAllRecipients();
$mail->ClearAttachments();
 
//echo "<script>location.href = 'dashboard.php?acao=1';</script>";
echo "<script>alert('INDICAÇÃO ENVIADA COM SUCESSO!');location.href='../dashboard';</script>";

?>
