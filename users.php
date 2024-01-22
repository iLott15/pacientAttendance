<?php
$page = "users";

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
      Usuários
      <!-- <small>Preview</small> -->
    </h1>
    <div class="breadcrumb-list">
      <ol class="breadcrumb">
        <li><a href="#"><i class="ph-bold ph-house-simple"></i>Home</a></li>
        <li><a href="#">Usários</a></li>
      </ol>
    </div>
  </section>

  <?php


  ############## Includes ###################
  include('pages/users/includes/deleteUser.php'); //delete user data file
  include('pages/users/includes/updateUser.php'); //update user data file
  include('pages/users/includes/insertUser.php'); //insert user data file
  include('pages/users/includes/editUser.php'); //edit user page
  include('pages/users/includes/newUser.php'); //create user page

  ############## Users ###################
  include('pages/users/listUser.php'); //user list page


  //inclui o footer
  include('includes/footer.php')
  ?>

  <!-- Sidebar Toggle JavaScript -->
  <?php require_once('/includes/class/class.Scripts.php'); ?>