<?php
$page = "loadingText";

require_once('includes/config.php');
//inclui o header
require_once('includes/header.php');
//conexão com o banco
require_once('includes/connect.php');


require_once('includes/class/class.Functions.php');
require_once('includes/class/class.Scripts.php');

?>

<!-- Styles -->
<link rel="stylesheet" href="/includes/class/custom-style.css">

<!-- Content Wrapper. Contains page content -->
<div class="wrapper-content">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Mensagens de Carregamento
      <!-- <small>Preview</small> -->
    </h1>
    <div class="breadcrumb-list">
      <ol class="breadcrumb">
        <li><a href="#"><i class="ph-bold ph-house-simple"></i> Home</a></li>
        <li><a href="#">Mensagens de Carregamento</a></li>
        <?php
        if ($action == "editLoadingText") {
        ?>
          <li class="active">Editar Mensagem</li>
        <?php
        }
        if ($action == "listLoadingText") {
        ?>
          <li class="active">Lista de Mensagens</li>
        <?php
        }
        ?>
      </ol>
    </div>
  </section>

  <?php

  ################ INCLUDES LOADING TEXT ##################
  include("pages/loadingText/includes/deleteLoadingText.php"); //página de deletar mensagens
  include("pages/loadingText/includes/updateLoadingText.php"); //página para editar mensagens
  include("pages/loadingText/includes/insertLoadingText.php"); //página de inserir mensagens

  ################ LIST LOADING TEXT ##################
  include("pages/loadingText/listLoadingText.php"); //página de listagem das mensagens
  include("pages/loadingText/editLoadingText.php"); //página para editar mensagens


  //inclui o footer
  include('includes/footer.php')
  ?>

  <!-- Sidebar Toggle JavaScript -->
  <?php require_once('/includes/class/class.Scripts.php'); ?>