<?php
	$servidor = "200.150.68.50:3306";
	$usuario = "root";
	$senha = "m0n1t0r@";
	$dbname = "grupomassa_tecnica";
	//$dbname = "grupomassa_developer";
	
	//Criar a conexão
	$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
?>