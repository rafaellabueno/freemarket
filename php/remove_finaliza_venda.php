<?php
	require_once("../conexao/conexao.php");
	$id = $_GET['id'];
	$comando = $conexao->prepare("SELECT produto.produto FROM produto WHERE produto.id = ?");
	$comando->bindParam(1, $id);
    $comando->execute();
    $produto = $comando->fetch(PDO::FETCH_ASSOC);

	foreach ($_SESSION['produto'] as $k => $p) {
		if ($p['id'] == $id) {
			$key = array_search($p['id'], $_SESSION['carrinho']);
			unset($_SESSION['produto'][$k]);
			unset($_SESSION['carrinho'][$key]);
			break;
		}
	}


	if (empty($_SESSION['produto'])) {
		unset($_SESSION['produto']); 
		unset($_SESSION['carrinho']); 
	}

	header('Location: ../view/carrinho.php');
?>