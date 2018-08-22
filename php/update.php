<?php
require_once("../conexao/conexao.php");

$nome=$_POST['nome'];
$email=$_POST['email'];
$id = $_SESSION['id'];
 $comando = $conexao->prepare("SELECT * FROM usuario WHERE id = $id");
 $comando->execute();
 $linhas = $comando->rowCount();
 $linha = $comando->fetch(PDO::FETCH_ASSOC); 
 if ($linhas) {
 	$id = $linha['id'];
 	$comando = $conexao->prepare("UPDATE usuario SET nome='$nome',email='$email' WHERE id='$id'");
 	$comando->execute();
 	

   header("Location: ../view/usuario.php");
}
?>