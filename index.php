<?php
require_once('includes/config.php');

require_once('includes/header.php')
?>



<!-- Content Wrapper. Contains page content -->
<div class="wrapper-content">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?= $system['systemName'] ?>
    </h1>
    <div class="breadcrumb-list">
      <ol class="breadcrumb">
        <li><a href="#"><i class="ph-bold ph-house-simple"></i>Home</a></li>
      </ol>
    </div>
  </section>

  <?php include('includes/indexes/indexSuperAdmin.php') ?>

  <?php include('includes/footer.php') ?>

  <!-- Sidebar Toggle JavaScript -->
  <?php require_once('includes/class/class.Scripts.php'); ?>

  <!-- Styles -->
  <link rel="stylesheet" href="/includes/class/custom-style.css">