<?php
require_once("../conexao/conexao.php");

$nome=filter_var($_POST['nome'], FILTER_SANITIZE_STRING);
$email=filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$descricao=filter_var($_POST['descricao'], FILTER_SANITIZE_STRING);
$id = $_SESSION['id'];
 $comando = $conexao->prepare("SELECT * FROM usuario WHERE id = ?");
 $comando->bindParam(1, $id);
 $comando->execute();
 $linhas = $comando->rowCount();
 $linha = $comando->fetch(PDO::FETCH_ASSOC); 
 if ($linhas) {
 	$id = $linha['id'];
 	$comando = $conexao->prepare("UPDATE usuario SET nome='$nome',email='$email',descricao='$descricao' WHERE id=?");
 	$comando->bindParam(1, $id);
 	$comando->execute();
 	

   header("Location: ../view/usuario.php");
}
?>