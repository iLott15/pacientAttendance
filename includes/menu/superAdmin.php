<!-- Sidebar Menu -->
<ul class="sidebar_menu" data-widget="tree">
    <li class="header" style="margin-top: 15px">MENU</li>

    <li class="">
        <a href="index.php">
            <i class="icon ph-bold ph-house-simple"></i>
            <span class="menu-name">Início</span>
        </a>
    </li>
    <!-- Optionally, you can add icons to the links -->

    <li style="margin-top: 5px" <?php if ($action == "listPacients") {
                                    echo "class=\"active\"";
                                } ?>>
        <a href="pacients.php?action=listPacients">
            <i class="icon ph-bold ph-user"></i>
            <span class="menu-name">Pacientes</span>
        </a>
    </li>

    <li style="margin-top: 5px" <?php if ($action == "listSchedule") {
                                    echo "class=\"active\"";
                                } ?>>
        <a href="schedule.php?action=listSchedule">
            <i class="icon ph-bold ph-notebook"></i>
            <span class="menu-name">Agenda</span>
        </a>
    </li>

    <li style="margin-top: 5px" <?php if ($action == "listMedicalRecord") {
                                    echo "class=\"active\"";
                                } ?>>
        <a href="medicalRecords.php?action=listMedicalRecord">
            <i class="icon ph-bold ph-note-pencil"></i>
            <span class="menu-name">Prontuário</span>
        </a>
    </li>

    <li style="margin-top: 5px" <?php if ($action == "listMedicalRecord") {
                                    echo "class=\"active\"";
                                } ?>>
        <a href="medicalRecords.php?action=listMedicalRecord">
            <i class="icon ph-bold ph-book"></i>
            <span class="menu-name">Diário do Paciente</span>
        </a>
    </li>
</ul>

<!-- Menu de cruds para o sistema -->
<ul class="sidebar_menu" data-widget="tree">
    <li class="header" style="margin-top: 15px">CRUD's</li>

    <li <?php if ($action == "listServiceTypes") {
            echo "class=\"active\"";
        } ?>>
        <a href="serviceTypes.php?action=listServiceTypes">
            <i class="icon fa fa-comments-o"></i>
            <span class="menu-name">Lista de Atendimentos</span>
        </a>
    </li>

    <li style="margin-top: 5px" <?php if ($action == "listDoctorType") {
                                    echo "class=\"active\"";
                                } ?>>
        <a href="doctors.php?action=listDoctorType">
            <i class="icon fa fa-user-md"></i>
            <span class="menu-name">Lista de Especialidades</span>
        </a>
    </li>

    <li style="margin-top: 5px" <?php if ($action == "listLoadingText") {
                                    echo "class=\"active\"";
                                } ?>>
        <a href="loadingText.php?action=listLoadingText">
            <i class="icon fa fa-commenting-o"></i>
            <span class="menu-name">Mensagens de Carregamento</span>
        </a>
    </li>
</ul>

<?php
loaderVerification();
?>
<!-- Styles -->
<link rel="stylesheet" href="/includes/class/custom-style.css">