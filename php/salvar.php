<?php
require_once("../conexao/conexao.php");

$nome=$_POST['nome'];
$email=$_POST['email'];
$senha=password_hash($_POST['senha'], PASSWORD_BCRYPT);

 $sql = "SELECT * FROM usuario WHERE email = '$email'";
 $result = mysqli_query($conexao, $sql) or die(mysqli_error());
 $linhas = mysqli_num_rows($result); 
 $linha = mysqli_fetch_assoc($result); 
 if ($linhas != 0) {
    header("Location: ../view/registrar.php?erro=E-mail já está sendo utilizado");
}
else {
 $sql = "insert into usuario(nome, email, senha) values ('$nome', '$email', '$senha')";
 mysqli_query($conexao,$sql);
 $_SESSION['oi'] = $email;
 header('Location: ../view/index.php');
}
?>


