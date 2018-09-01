<?php
   require_once("../conexao/conexao.php");
    if(isset($_SESSION['id']) && isset($_GET['compra'])){
     $id_compra = $_GET['compra'];
     $comando = $conexao->prepare("SELECT produto.produto, produto.valor, produto.descricao FROM produto INNER JOIN compra_produto ON produto.id = compra_produto.produto_id INNER JOIN compra ON compra_produto.compra_id = compra.id WHERE compra.id = ? ");
     $comando->bindparam(1, $id_compra, PDO::PARAM_INT);
     $comando->execute();
     $contP = $comando->rowCount();
     if($contP == 1){
      $produtos = $comando->fetch(PDO::FETCH_ASSOC);
      }
      else{
        $produtos = $comando->fetchAll(PDO::FETCH_ASSOC);
      }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/logo.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Mercado Dibre
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="../assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
      <div class="logo">
        <a href="./index.php" class="simple-text logo-normal">
          Mercado Dibre
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <?php if(isset($_SESSION['id'])){ ?>
          <li class="nav-item  ">
            <a class="nav-link" href="./usuario.php">
              <i class="material-icons">person</i>
              <p>Meu Perfil</p>
            </a>
          </li>
          <?php } ?>
          <li class="nav-item ">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents2" data-parent="#exampleAccordion">
              <i class="material-icons">add</i>
              <p>Times</p>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseComponents2">
                        <li>
                            <a class="nav-link" href="./flamengo.php">
                                <img id="profile-img" title="Flamengo" style="width: 25px;" src="../assets/img/Flamengo.png" />
                                  Flamengo
                            </a>
                        </li> 
                        <li>
                            <a class="nav-link" href="./fluminense.php">
                                <img id="profile-img" title="Fluminense" style="width: 25px;" src="../assets/img/Fluminense.png" />
                                Fluminense
                            </a>
                        </li> 
                        <li>
                            <a class="nav-link" href="./gremio.php">
                                <img id="profile-img" title="Gremio" style="width: 25px;" src="../assets/img/Gremio.png" />
                                Grêmio
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="./juventus.php">
                                <img id="profile-img" title="Juventus" style="width: 20px;" src="../assets/img/Juventus.png" />
                                Juventus
                            </a>
                        </li> 
              </ul>

          </li>
          <?php if(isset($_SESSION['id'])){ ?>
          <li class="nav-item ">
            <a class="nav-link" href="./historico.php">
              <i class="material-icons">content_paste</i>
              <p>Histórico de Compras</p>
            </a>
          </li>
          <?php } ?>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">add_shopping_cart</i>
                   <?php if(isset($_SESSION['carrinho'])){ ?>
                  <span class="notification"><?php echo count($_SESSION['carrinho']); ?></span>
                  <?php } else{ ?>
                  <span class="notification">0</span>
                  <?php } ?>
                  <p class="d-lg-none d-md-block">
                    Some Actions
                  </p>
                </a>
                 <?php if(isset($_SESSION['produto'])){ ?>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <?php foreach($_SESSION['produto'] as $p){ ?>
                  <a class="dropdown-item" href="./produto.php?id=<?=$p['id'];?>"><?php echo $p['produto'] ?></a>
                  <?php } ?>
                  <a class="dropdown-item" href="./carrinho.php">Finalizar Venda</a>
                </div>
                <?php } ?>
              </li>
              <?php if(isset($_SESSION['id'])){ ?>
              <li class="nav-item">
                <a class="nav-link" href = "../php/session.php">
                  <i class="material-icons">exit_to_app</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
              </li>
              <?php } else{ ?>
              <?php $url = '../view/produto.php?id='.$id ?>
              <li class="nav-item">
                <a class="nav-link" href = "./login.php?url=<?=$url?>">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
              </li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
          <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
                Sua compra foi realizada com sucesso! Enviamos um recibo para o seu e-mail com as informações da compra.
              </div>
              <div class="card">
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <tbody>
                      <?php $valor = 0; $cont = 1;?>
                      <?php if($contP != 1){ foreach($produtos as $key => $p){ ?>
                        <tr>
                          <td>
                            <?php echo $cont; $cont++; ?>
                          </td>
                          <td>
                            <?php echo $p['produto'] ?>
                          </td>
                          <td>
                           <?php echo $p['valor'] ?>
                           <?php $valor = $valor + $p['valor']; ?>
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                      <?php } } else{ ?>
                        <tr>
                          <td>
                            <?php echo $cont; $cont++; ?>
                          </td>
                          <td>
                            <?php echo $produtos['produto'] ?>
                          </td>
                          <td>
                           <?php echo $produtos['valor'] ?>
                           <?php $valor = $valor + $produtos['valor']; ?>
                          </td>
                          <td>
                            
                          </td>
                        </tr>
                        <?php } ?>
                        <tr>
                          <td>
                            
                          </td>
                          <td>
                            
                          </td>
                          <td>
                            
                          </td>
                          <td>
                            <?php echo 'Total:'. $valor ?>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="../assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chartist JS -->
  <script src="../assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=2.1.0" type="text/javascript"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      //init DateTimePickers
      md.initFormExtendedDatetimepickers();
    });
  </script>
</body>

</html>
<?php
  } else{
    header('Location: ./index.php');
  }
?>