<?php
require_once("../conexao/conexao.php");

$nome=$_POST['nome'];
$email=$_POST['email'];
$senha=password_hash($_POST['senha'], PASSWORD_BCRYPT);

 $comando = $conexao->prepare("SELECT * FROM usuario WHERE email = '$email'");
 $comando->execute();
 $linhas = $comando->rowCount();
 $linha = $comando->fetch(PDO::FETCH_ASSOC);
 if ($linhas != 0) {
    header("Location: ../view/registrar.php?erro=E-mail já está sendo utilizado");
}
else {
 $comando = $conexao->prepare("insert into usuario(nome, email, senha) values ('$nome', '$email', '$senha')");
 $comando->execute();
 $user = $comando->fetch(PDO::FETCH_ASSOC);
 $_SESSION['id'] = $user['id'];
  header('Location: ../view/index.php');
}
?>


