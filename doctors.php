<?php
$page = "doctors";

require_once('includes/config.php');
//inclui o header
require_once('includes/header.php');
//conexão com o banco
require_once('includes/connect.php');

include('includes/class/class.Scripts.php');
?>

<script>
</script>

<!-- Styles -->
<link rel="stylesheet" href="/includes/class/custom-style.css">

<!-- Content Wrapper. Contains page content -->
<div class="wrapper-content">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Médicos
      <!-- <small>Preview</small> -->
    </h1>
    <div class="breadcrumb-list">
      <ol class="breadcrumb">
        <li><a href="#"><i class="ph-bold ph-house-simple"></i>Home</a></li>
        <li><a href="#">Médicos</a></li>
      </ol>
    </div>
  </section>

  <?php


  ############## Includes ###################
  include('pages/doctors/includes/updateDoctorType.php'); //update doctor type page
  include('pages/doctors/includes/insertDoctorType.php'); //insert doctor type page
  include('pages/doctors/includes/editDoctorType.php'); //edit doctor type page


  ############## doctors ###################
  include('pages/doctors/listDoctorType.php'); //doctor type list page


  //inclui o footer
  include('includes/footer.php')
  ?>

  <!-- Sidebar Toggle JavaScript -->
  <?php require_once('/includes/class/class.Scripts.php'); ?>
  
  