<?php
if (!isset($_GET['action'])) {
  $action = "login";
} else {
  $action = $_GET['action'];
}
include('includes/class/class.Security.php');
include('includes/class/class.Functions.php');
include('includes/config.php');
include('includes/connect.php');

$declineWords = randomDeclineMsg();
$successWords = randomSuccessMsg();

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title><?= $system['systemName'] ?> | <?= $system['systemDescription'] ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link href="includes/class/custom-style.css" rel="stylesheet" type="text/css" />
  <!-- Bootstrap 3.3.4 -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- Font Awesome Icons -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <!-- Theme style -->
  <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  <!-- iCheck -->
  <link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />



  <link rel="stylesheet" href="/includes/class/custom-style.css">


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <!-- favicon-->
  <link rel="shortcut icon" href="">


</head>

<body class="login-page" style="background-image: url('archives/sectorLogo/helthControlLogo/wallpaper.png');background-repeat: no-repeat;background-attachment: fixed;  background-size: cover;">

  <div class="login-box">
    <div class="login-logo">
      <img src="" width="300px" style="padding: 10px;" />
    </div>
    <?php
    ############################################# LOGIN PAGE #########################################
    if ($action == "login") {
    ?>
      <?php
      if ($_GET['error'] == 1) {
      ?>
        <div class="alert alert-danger alert-dismissable msgStyleLogin">
          <h4><i class="icon fa fa-ban"></i> <?= $declineWords ?> Erro:</h4>
          Usuário ou Senha inválido
        </div>
      <?php
      }
      ?>

      <div class="login-box-body styleBoxLogin">
        <div class="login-logo">
          <a>Bem vindo ao <b><?= $system['systemName'] ?></b></a>
          <br>
          <p class="login-box-msg" style="font-size: 15px">Entre para iniciar a sua sessão.</p>
        </div>

        <form action="includes/validate.php" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control inputLoginStyle" name="userMail" placeholder="E-mail ou CPF" />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control inputPasswordStyle" name="userPassword" placeholder="Senha" />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">

            <div class="col-xs-12">
              <button name="submit" class="btn btn-primary btn-block btn-flat buttonLoginStyle">Entrar</button>
            
              <div class="checkbox icheck" style="text-align: center;">
                <label>
                  <input type="checkbox"> Manter conectado
                </label>
              </div>
            </div><!-- /.col -->
          </div>
        </form>
        <?php
      }

      ######################################## CHANGE PASSWORD PAGE #########################################
      if ($action == "changePassword") {
        if (isset($_POST['changePassword'])) {

          //get new password
          $userNewPassword = mysqli_real_escape_string($mySQL->link, $_POST['userNewPassword']);
          $userNewPasswordConfirm = mysqli_real_escape_string($mySQL->link, $_POST['userNewPasswordConfirm']);

          //verifies passwords match
          if ($userNewPassword == $userNewPasswordConfirm) {

            //encrypt new password
            $encryptedNewPassword = md5($userNewPassword);
            //get session values of user
            $userMail = $_SESSION['userMail'];
            $userOldPassword = $_SESSION['userPassword'];

            //update new password encrypted and `userChangePassword` status
            $updateNewPassword = $mySQL->sql("UPDATE users SET `userPassword`='" . $encryptedNewPassword . "', `userChangePassword`='0' WHERE ( `userMail` = '" . $userMail . "' OR `userRegistry` = '" . $userMail . "' ) AND userPassword = '" . $userOldPassword . "'");

            $error = 0;
          } else {
            /* Holy shit, passwords do not match. 
           Redirect user to `changePassword` page again, 
           with error description */

            echo "<script> window.location='login.php?action=changePassword&error=1';</script>";
            exit;
          }

        ?>

          <div class="alert alert-success alert-dismissable msgStyleLogin">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-info"></i> <?= $successWords ?></h4>
            Sua senha foi alterada com sucesso, agora você pode dormir tranquilo.
          </div>
          <div class="col-xs-12">
            <button onclick="location.href='index.php'" class="btn btn-primary btn-block btn-flat buttonLoginStyle">Acessar o sistema</button>
          </div><!-- /.col -->


        <?php
        } else {
        ?>
          <?php
          if (!isset($_GET['error'])) {
            $error = "0";
          } else {
            $error = $_GET['error'];
          }

          if ($error == 0) {
          ?>

            <div class="alert alert-info alert-dismissable msgStyleLogin">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <font style="text-align: center;">
                <h4><i class="icon fa fa-info"></i> <?= $successWords ?></h4>
              </font>
              <h4>
                Vejo que é o seu primeiro login :)
                <br>
                Para sua segurança, redefina sua senha por uma do seu desejo.
              </h4>
            </div>
          <?php
          } elseif ($error == 1) {
          ?>
            <div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-ban"></i>Ops!</h4>
              As senhas não são iguais. Por favor tente novamente.
            </div>
          <?php
          }
          ?>

          <div class="login-box-body styleBoxLogin">
            <form action="login.php?action=changePassword" method="post">
              <div class="form-group has-feedback">
                <input type="password" class="form-control inputDotStyle" name="userNewPassword" placeholder="Nova senha" pattern=".{6,40}" required title="Mínimo 6 dígitos" />
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                <input type="password" class="form-control inputDotStyle" name="userNewPasswordConfirm" placeholder="Confirmação da nova senha" pattern=".{6,40}" required title="Mínimo 6 dígitos" />
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
              <div class="row">

                <div class="col-xs-12">
                  <button name="changePassword" class="btn btn-primary btn-block btn-flat buttonDotStyle">Alterar Senha</button>
                </div><!-- /.col -->
              </div>
            </form>
        <?php
        }
      }
        ?>
          </div><!-- /.login-box-body -->
      </div><!-- /.login-box -->

      <!-- jQuery 2.1.4 -->
      <script src="plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
      <!-- Bootstrap 3.3.2 JS -->
      <script src="../../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
      <!-- iCheck -->
      <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
      <script>
        $(function() {
          $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
          });
        });
      </script>
      <div class="main">
        <div class="content">
        </div>

        <div id="footer">
          &nbsp;&nbsp;<strong><u>iLottWeb ®<i class="fa fa-registered"></i> Todos os direitos reservados.</strong></u>
        </div>

      </div>
</body>

</html>