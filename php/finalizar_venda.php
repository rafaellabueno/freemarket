<?php
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
	  require_once("../conexao/conexao.php");
    require_once("../vendor/autoload.php");
    $mail = new PHPMailer(true);
    $mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        )
    );

	$id = $_SESSION['id'];
	$total = $_GET['total'];

	$fuso = new DateTimeZone('America/Sao_Paulo');
  	$data = new DateTime();
  	$data->setTimezone($fuso);
  	$data = $data->format('Y-m-d H:i:s');

  foreach ($_SESSION['carrinho'] as $p) {
        $comando2 = $conexao->prepare("SELECT id, produto, valor, qtd FROM produto WHERE id = ?");
        $comando2->bindparam(1, $p, PDO::PARAM_INT);
        $comando2->execute();
        $produto[] = $comando2->fetch(PDO::FETCH_ASSOC);
  }

  foreach ($produto as $key => $p) {
        $contagem = array_count_values($_SESSION['carrinho']); 
        if($p['id'] == $contagem[$p['id']]){
        $v = $p['qtd'] - $contagem[$p['id']];
        $comando = $conexao->prepare("UPDATE produto SET qtd = ".$v." WHERE id = ?");
        $comando->bindparam(1, $p['id']);
        $comando->execute();
        }
        if($p['qtd'] - $contagem[$p['id']] < 0){
          $_SESSION['erro'] = 'erro';
          header('Location: ../view/erro.php');
        }
  }

	$comando = $conexao->prepare("insert into compra(data, total, usuario_id) values (?,?,?)");
 	$comando->bindparam(1, $data, PDO::PARAM_STR);
 	$comando->bindparam(2, $total, PDO::PARAM_INT);
 	$comando->bindparam(3, $id, PDO::PARAM_INT);
 	$comando->execute();

 	$id_compra = $conexao->lastInsertId();
	header('Location: ../view/recibo.php?compra='.$id_compra);
	  $comando = $conexao->prepare("SELECT nome, email, descricao FROM usuario WHERE id = ?");
    $comando->bindparam(1, $id);
    $comando->execute();
    $linha = $comando->fetch(PDO::FETCH_ASSOC);
    $arquivo = fopen("recibo.txt", "a");
    $escreve = fwrite($arquivo, "MercadoDibre\n\n\n");
    $valor = 0;
    foreach ($produto as $key => $p) {
       $escreve = fwrite($arquivo, "Produto: ".$p['produto']."      Valor:".$p['valor']."\n");
       $valor = $valor + $p['valor'];
    }
      $escreve = fwrite($arquivo, "\nTotal da compra: ".$valor."\n");
        $mail->isSMTP();  
        $mail->SMTPDebug = 2;   
                                                               
        $mail->Host = 'smtp.gmail.com';  
        $mail->SMTPAuth = true;                              
        $mail->Username = 'rafaellasbueno@gmail.com';          
        $mail->Password = 'bumkvcjmxebzfebh';                        
        $mail->SMTPSecure = 'ssl';                           
        $mail->Port = 465;                   
       
        
        $mail->setFrom('rafaellasbueno@gmail.com', 'Mailer');    
        $mail->addAddress($linha['email']);          

        $mail->addAttachment('recibo.txt');

        $mail->isHTML(true);                              
        $mail->Subject = 'MercadoDibre';
        $mail->Body    = '<b>Sua compra foi realizada com sucesso! O recibo da sua compra encontra-se em anexo</b><br>';
        $mail->send();
        $arquivo="recibo.txt";
        unlink($arquivo);

  foreach ($_SESSION['carrinho'] as $p) {
        $comando = $conexao->prepare("insert into compra_produto(compra_id, produto_id) values (?,?)");
        $comando->bindparam(1, $id_compra, PDO::PARAM_INT);
        $comando->bindparam(2, $p, PDO::PARAM_INT);
        $comando->execute();
  }

	unset($_SESSION['produto']); 
	unset($_SESSION['carrinho']); 

?>