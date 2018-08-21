<?php
   session_start();
   if(isset($_SESSION['oi'])){
?>
<meta charset="UTF-8"/>
<title>Prog</title>
</head>
<body>
    <div>
        <p>Olá, <?php echo $_SESSION['oi'] ?></p>
    </div>
    <div>
	<a href = "session.php">
            Sair
        </a>
    </div>
</body>
</html>
<?php
   }
   else{
	header('Location: login.php');
}
?>