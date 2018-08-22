<?php
	require_once("../conexao/conexao.php");
	$id = $_GET['id'];
	$comando = $conexao->prepare("SELECT produto.produto FROM produto WHERE produto.id = $id");
    $comando->execute();
    $produto = $comando->fetch(PDO::FETCH_ASSOC);

	$key = array_search($_GET['id'], $_SESSION['carrinho']);

	foreach ($_SESSION['produto'] as $k => $p) {
		if ($p['id'] == $id) {
			unset($_SESSION['produto'][$k]);
		}
	}

	if($key!==false){
    	unset($_SESSION['carrinho'][$key]);
	}


	header('Location: ../view/produto.php?id='.$_GET['id']);
?>