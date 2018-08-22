<?php
	session_start(); 
	$conexao = new PDO('mysql:host=localhost;dbname=mercadodibre', 'root', '');

	if(!$conexao){
		echo "Falha na conexão";
	}
?>