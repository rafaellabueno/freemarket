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

  <style>

/*
 * Specific styles of signin component
 */
/*
 * General styles
 */
.card-container.card {
    max-width: 350px;
    padding: 40px 40px;
}

.btn {
    font-weight: 700;
    height: 36px;
    -moz-user-select: none;
    -webkit-user-select: none;
    user-select: none;
    cursor: default;
}

/*
 * Card component
 */
.card {
    /* just in case there no content*/
    padding: 20px 25px 30px;
    margin: 0 auto 25px;
    margin-top: 50px;
    /* shadows and rounded borders */
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
}

.profile-img-card {
    width: 100%;
    height: 200px;
    margin: 0 auto 10px;
    display: block;
}

.reauth-email {
    display: block;
    line-height: 2;
    margin-bottom: 10px;
    font-size: 14px;
    text-align: center;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin #nome,
.form-signin #senha {
    direction: ltr;
    height: 44px;
    font-size: 16px;
}

.form-signin input[type=email],
.form-signin input[type=password],
.form-signin input[type=text],
.form-signin button {
    width: 100%;
    display: block;
    margin-bottom: 10px;
    z-index: 1;
    position: relative;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

body {
    padding: 0px;
    border: 0px;
    margin: 0px;
    height: 100%;
}


</style>

</head>


<body>

    <div class="container">
        <div class="card card-container">
            <?php if(isset($_GET['erro'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo "{$_GET['erro']}"; ?>
            </div>
            <?php } ?>
            <img id="profile-img" class="profile-img-card" src="../assets/img/logo.png" /> 
            <form class="form-signin" action="../php/loginPHP.php" method="post">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" id="email" name="email" class="form-control" placeholder="E-mail" required autofocus>
                <input type="password" id="senha" name="senha" class="form-control" placeholder="Senha" required>
                <button class="btn btn-primary btn-block btn-signin" type="submit">Logar</button>
            </form>
            <a href="registrar.php" style="text-decoration: none;"><center>Registre-se</center></a>
 
        </div>
    </div>

</body>


</html>