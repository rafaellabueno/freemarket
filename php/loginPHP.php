<?php
	require_once("../conexao/conexao.php");
	$email = $_POST['email'];
	$senha = $_POST['senha'];

	$sql = "SELECT email, senha FROM usuario WHERE email = '$email'";
	$salvar = mysqli_query($conexao,$sql);
	$usuario = mysqli_affected_rows($conexao);
	$linha = mysqli_fetch_assoc($salvar);

	$sql2 = "SELECT * FROM usuario WHERE email = '$email'";
 	$result = mysqli_query($conexao, $sql2) or die(mysqli_error());
 	$user = mysqli_fetch_assoc($result);
	if($usuario == 1 and password_verify($senha, $linha['senha'])) {
	    $_SESSION['id'] = $user['id'];
	    header("Location: ../view/index.php");
	} else {
	     header("Location: ../view/login.php?erro=Os dados informados não batem com as nossas credenciais");
	}
?>
