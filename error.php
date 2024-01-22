<?php
$page = "error";

require_once('includes/config.php');
//inclui o header
require_once('includes/header.php');
//conexão com o banco
require_once('includes/connect.php');

?>

<?php
if ($action == "001") {
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Página de error
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Error</a></li>
        <li class="active">001 error</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="error-page">
        <h2 class="headline text-yellow">001</h2>
        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i> Oops! Parece haver algum problema! </h3>
          <p>
            Nós pedimos desculpas pelo incoveniente, mas o seu usuário não possui permissão para acessar está página.
            Para dúvidas entre em contato com a instituíção informando o número do erro para verificarmos se há algum problema.
          </p>
        </div><!-- /.error-content -->
      </div><!-- /.error-page -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
<?php
}
?>

<?php


//inclui o footer
require_once('includes/footer.php');
?>