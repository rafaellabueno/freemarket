<?php
require_once("../conexao/conexao.php");

$nome=$_POST['nome'];
$email=$_POST['email'];
$e = $_SESSION['oi'];
 $sql = "SELECT * FROM usuario WHERE email = '$e'";
 $result = mysqli_query($conexao, $sql) or die(mysqli_error());
 $linhas = mysqli_num_rows($result); 
 $linha = mysqli_fetch_assoc($result); 
 if ($linhas) {
 	$id = $linha['id'];
 	$sql = "UPDATE usuario SET nome='$nome',email='$email' WHERE id='$id'";
 	$result = mysqli_query($conexao, $sql);
 	

   header("Location: ../view/usuario.php");
}
?>