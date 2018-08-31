<?php
	require_once("../conexao/conexao.php");
	$id = $_GET['id'];
	$comando = $conexao->prepare("SELECT produto.produto FROM produto WHERE produto.id = ?");
	$comando->bindParam(1, $id);
    $comando->execute();
    $produto = $comando->fetch(PDO::FETCH_ASSOC);

	$key = array_search($_GET['id'], $_SESSION['carrinho']);

	foreach ($_SESSION['produto'] as $k => $p) {
		if ($p['id'] == $id) {
			unset($_SESSION['produto'][$k]);
		}
		break;
	}

	if($key!==false){
    	unset($_SESSION['carrinho'][$key]);
	}

	if (empty($_SESSION['produto'])) {
		unset($_SESSION['produto']); 
		unset($_SESSION['carrinho']); 
	}

	header('Location: ../view/carrinho.php');
?>