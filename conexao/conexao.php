<?php
	session_start(); 
	$conexao = new PDO('mysql:host=localhost;dbname=mercadodibre;charset=utf8', 'root', '');

	if(!$conexao){
		echo "Falha na conexão";
	}
?>