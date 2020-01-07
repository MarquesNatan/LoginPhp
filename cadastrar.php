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
	<div id="corpo-formulario-cad">
	<h1>Cadastrar</h1>
	<form method="POST">
		<input type="text" name="name" placeholder="Nome Completo">
		<input type="text" name="phone" placeholder="Telefone">
		<input type="email" name="email" placeholder="Usuário">
		<input type="password" name="password" placeholder="Senha">
		<input type="password" name="confPassword" placeholder="Confirmar senha">
		<input type="submit" value="Cadastrar"> 
	</form>

</div>
<?php 
if(isset($_POST['name'])){
	$name = addslashes($_POST['name']);
	$phone = addslashes($_POST['phone']);
	$email = addslashes($_POST['email']);
	$password = addslashes($_POST['password']);
	$confPassword = addslashes($_POST['confPassword']);

	if(!empty($name) && !empty($phone) && !empty($email) && !empty($password)&& !empty($confPassword))
	{
		$u->conectar("projeto_login", "localhost", "root", "");
		if($u->msgErro == "")
		{
			if($password == $confPassword)
			{
				if($u->cadastrar($name, $phone, $email, $password))
				{
					echo "Email cadastrado com sucesso!";

				}else
				{
					echo "email já cadastrado!";

				}
				

			}else
			{
				echo "As senhas não correspondem";

			}

		}else
		{
			echo "Erro: ".$u->msgErro;
		}


	}else
	{
		echo "Preencha todos os campos!";
	}
}
 ?>



</body>
</html>