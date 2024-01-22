<!DOCTYPE html>
<html>
<?php
$loadPageBegin = array_sum(explode(' ', microtime()));
ini_set('output_buffering', 1);

ini_set('display_errors', 1);

error_reporting(E_ERROR);

date_default_timezone_set('America/Sao_Paulo');

if (!isset($_GET['action'])) {
  $action = "start";
} else {
  $action = $_GET['action'];
}
if (!isset($_GET['tab'])) {
  $tab = "";
} else {
  $tab = $_GET['tab'];
}

require_once('includes/config.php');

//Includes security class and calls the class protectPage ();
require_once('includes/class/class.Security.php');

//Includes security class and calls the class protectPage ();
require_once('includes/class/class.Functions.php');

mb_internal_encoding('UTF-8');

protectPage();

?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $system['systemName'] ?> | <?= $system['systemDescription'] ?></title>
    <?php //Includes JS functions to load
    require_once('includes/class/class.LoaderFunctions.php');
    ?>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body class="hold-transition skin-blue sidebar-mini">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main_sidebar">

        <div class="sidebar-header">
            <!-- Logo -->
            <a href="index.php" class="big_logo">
                <span><?= $system['systemName'] ?></span>
            </a>
            <a href="index.php" class="mini_logo">
                <span>HControl</span>
            </a>
        </div>

        <section class="sidebar">
            <!-- Sidebar toggle button-->
            <div class="menu-btn">
                <i class="ph-bold ph-caret-left"></i>
            </div>

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="archives/users/img/avatar5.png" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?=$_SESSION["userName"]?></p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i><?=$_SESSION["userType"]?></a>
                </div>
            </div>

            <!-- sidebar: style can be found in sidebar.less -->
            <?php include('includes/menu/superAdmin.php') ?>

            <ul class="sidebar_menu" data-widget="tree">
                <li class="header">SISTEMA</li>
                <!-- Optionally, you can add icons to the links -->

                <li <?php if ($action == "listUser") {
                        echo "class=\"active\"";
                    } ?>>
                    <a href="users.php?action=listUser">
                        <i class="icon ph-bold ph-users"></i>
                        <span class="menu-name">Usuários no Sistema</span>
                    </a>
                </li>
                <li <?php if ($action == "configSystem") {
                        echo "class=\"active\"";
                    } ?>>
                    <a href="system.php?action=configSystem">
                        <i class="icon ph-bold ph-gear"></i>
                        <span class="menu-name">Configurações</span>
                    </a>
                </li>
                <li>
                    <a href="logout.php">
                        <i class="icon ph-bold ph-sign-out"></i>
                        <span class="menu-name"><strong>Sair</strong></span>
                    </a>
                </li>
            </ul>
        </section>
    </aside>

    <!-- Styles -->
    <link rel="stylesheet" href="/includes/class/custom-style.css">