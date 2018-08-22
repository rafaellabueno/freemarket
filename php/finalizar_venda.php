<?php
	require_once("../conexao/conexao.php");
	ini_set("SMTP", "smtp.gmail.com");
	ini_set("smtp_port", "465");
	ini_set("sendmail_from", "rafaellasbueno@gmail.com");

	$id = $_SESSION['id'];
	$total = $_GET['total'];

	$fuso = new DateTimeZone('America/Sao_Paulo');
  	$data = new DateTime();
  	$data->setTimezone($fuso);
  	$data = $data->format('Y-m-d H:i:s');

	$comando = $conexao->prepare("insert into compra(data, total, usuario_id) values (?,?,?)");
 	$comando->bindparam(1, $data, PDO::PARAM_STR);
 	$comando->bindparam(2, $total, PDO::PARAM_INT);
 	$comando->bindparam(3, $id, PDO::PARAM_INT);
 	$comando->execute();

 	$id_compra = $conexao->lastInsertId();

	foreach ($_SESSION['carrinho'] as $p) {
		$comando = $conexao->prepare("insert into compra_produto(compra_id, produto_id) values (?,?)");
		$comando->bindparam(1, $id_compra, PDO::PARAM_INT);
 		$comando->bindparam(2, $p, PDO::PARAM_INT);
 		$comando->execute();
	}
	
	$comando = $conexao->prepare("SELECT nome, email, descricao FROM usuario WHERE id = ?");
    $comando->bindparam(1, $id);
    $comando->execute();
    $linha = $comando->fetch(PDO::FETCH_ASSOC);
	//mail($linha['email'], 'MercadoDibre', 'Sua compra foi finalizada com sucesso');

	unset($_SESSION['produto']); 
	unset($_SESSION['carrinho']); 

	header('Location: ../view/historico.php');
?>