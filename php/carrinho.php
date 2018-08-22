<?php
	require_once("../conexao/conexao.php");
	$_SESSION['carrinho'][] = $_GET['id'];
	$id = $_GET['id'];
	$comando = $conexao->prepare("SELECT produto.produto FROM produto WHERE produto.id = $id");
    $comando->execute();
    $produto = $comando->fetch(PDO::FETCH_ASSOC);
	$_SESSION['produto'][] = array('id' => $id,'produto' => $produto['produto']);
	header('Location: ../view/produto.php?id='.$id);
?>
