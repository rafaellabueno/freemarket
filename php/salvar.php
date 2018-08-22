<?php
require_once("../conexao/conexao.php");
$nome=filter_var($_POST['nome'], FILTER_SANITIZE_STRING);
$email=filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
$senha=password_hash($_POST['senha'], PASSWORD_BCRYPT);

 $comando = $conexao->prepare("SELECT * FROM usuario WHERE email = ?");
 $comando->bindparam(1, $email);
 $comando->execute();
 $linhas = $comando->rowCount();
 $linha = $comando->fetch(PDO::FETCH_ASSOC);
 if ($linhas != 0) {
    header("Location: ../view/registrar.php?erro=E-mail já está sendo utilizado");
}
else {
 $comando = $conexao->prepare("insert into usuario(nome, email, senha) values (?,?,?)");
 $comando->bindparam(1, $nome);
 $comando->bindparam(2, $email);
 $comando->bindparam(3, $senha);
 $comando->execute();
 $comando = $conexao->prepare("SELECT * FROM usuario WHERE email = ?");
 $comando->bindparam(1, $email);
 $comando->execute();
 $user = $comando->fetch(PDO::FETCH_ASSOC);
 $_SESSION['id'] = $user['id'];
 
  header('Location: ../view/index.php');
}
?>


