<?php
	require_once("../conexao/conexao.php");
	if(isset($_SESSION['id'])){
	$_SESSION['carrinho'][] = $_GET['id'];
	$id = $_GET['id'];
	$comando = $conexao->prepare("SELECT produto.produto, produto.valor FROM produto WHERE produto.id = ?");
	$comando->bindParam(1, $id);
    $comando->execute();
    $produto = $comando->fetch(PDO::FETCH_ASSOC);
	$_SESSION['produto'][] = array('id' => $id,'produto' => $produto['produto'], 'valor' => $produto['valor']);
	header('Location: ../view/produto.php?id='.$id);
	}
	else{
		$url = '../view/produto.php?id='.$_GET['id'];
		header('Location: ../view/login.php?url='.$url);
	}
?>
