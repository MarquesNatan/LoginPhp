
<?php

Class Usuario
{
	private $pdo;
	public $msgErro = ""; 

	public function conectar($nome, $host, $usuario, $senha)
	{
		global $pdo;

		try {
					$pdo = new PDO("mysql:dbname=".$nome.";host=".$host, $usuario, $senha);

		}catch (PDOException $e){
			global $msgErro;
			$msgErro = $e->getMessage();
		}
	}
	public function cadastrar($nome, $telefone, $email, $senha)
	{
		global $pdo;
		//Verificar se já esta cadastrado  
		$sql = $pdo->prepare("SELECT id_usuario FROM usuario WHERE email = :e");
		$sql->bindValue(":e", $email);
		$sql->execute();
		if($sql->rowCount() > 0){
			return false; 
		}else{
			$sql = $pdo->prepare("INSERT usuario (nome, telefone, email, senha) VALUES (:n, :t, :e, :s)");
			$sql->bindValue(":n", $nome);
			$sql->bindValue(":t", $telefone);
			$sql->bindValue(":e", $email);
			$sql->bindValue(":s", $senha);
			$sql->execute();
			return true; 
		}
	}

	public function logar($email, $senha)
	{
		global $pdo;
		//Verificar se o usuário esta cadastrado
		$sql = $pdo->prepare("SELECT id_usuario FROM usuario WHERE email = :e AND senha = :s"); 
		$sql->bindValue(":e", $email);
		$sql->bindValue(":s", $senha); 
		$sql->execute();
		if($sql->rowCount() > 0){
			$dado = $sql->fetch();
			session_start();
			$_SESSION['id_usuario'] = $dado['id_usuario'];
			return true;
		}else{
			return false;  
		}
	}
}
?>