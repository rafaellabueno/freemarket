<?php
	require_once("../conexao/conexao.php");
	$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
	$senha = $_POST['senha'];

 	$comando = $conexao->prepare("SELECT * FROM usuario WHERE email = ?");
 	$comando->bindParam(1, $email);
 	$comando->execute();
 	$usuario = $comando->rowCount();
 	$user = $comando->fetch(PDO::FETCH_ASSOC);

	if($usuario == 1 and password_verify($senha, $user['senha'])) {
	    $_SESSION['id'] = $user['id'];
	    header("Location: ../view/index.php");
	} else {
	     header("Location: ../view/login.php?erro=Os dados informados não batem com as nossas credenciais");
	}
?>
