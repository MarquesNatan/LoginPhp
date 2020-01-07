<?php
	session_start();
	if(!isset($_SESSION['id_usuario'])){
		header("location: cadastrar.php");
		exit();
	}
?>

Seja Bem vindo(a) à área privada