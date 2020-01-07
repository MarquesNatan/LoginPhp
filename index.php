<?php
	require_once 'CLASSES/usuarios.php';
	$u = new Usuario; 
?>

<!DOCTYPE html>
<html lang="pt-b">
<head>
	<meta charset="utf-8">
	<title>Login Project</title>
	<link rel="stylesheet" href="CSS/estilo.css">
</head>
<body>
<div id="corpo-formulario">
	<h1>Entrar</h1>
	<form method="POST">
		<input type="email" name="email" placeholder="Usuário">
		<input type="password" name="password" placeholder="Senha">
		<input type="submit" value="Acessar">
		<a href="cadastrar.php">Ainda não é inscrito?<strong>Cadastre-se</strong></a>
	</form>
</div>
<?php
if(isset($_POST['email'])){
	$email = addslashes($_POST['email']);
	$password = addslashes($_POST['password']);

	if(!empty($email) && !empty($password)){
		$u->conectar("projeto_login", "localhost", "root", "");
		if($u->msgErro == ""){
			if($u->logar($email, $password)){
				header("location: areaPrivada.php");
			}else{
				echo "Email e/ou senha estão incorretos";
			}

		}else{
			echo "Erro".$u->msgErro;
		}
	}else{
		echo "Preencha todos os campos";
	}


}else{

}
?>

</body>
</html>