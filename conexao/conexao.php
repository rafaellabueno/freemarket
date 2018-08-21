<?php
	session_start(); 
	$conexao = mysqli_connect('localhost', 'root','','mercadodibre'); 
	$salvar = mysqli_set_charset($conexao,"UTF8");

	if(!$conexao){
		echo "Falha na conexão";
	}
?>