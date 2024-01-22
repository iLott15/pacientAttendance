<?php

require_once('../../../../includes/config.php');
require_once('../../../../includes/class/class.Functions.php');

global $mySQL;
$mySQL->sql('SET character_set_results=utf8');

$userId = mysqli_real_escape_string($mySQL->link, $_POST['userId']);

$userType = mysqli_real_escape_string($mySQL->link, $_POST['userType']);
$userStatus = mysqli_real_escape_string($mySQL->link, $_POST['userStatus']);
$userName = mysqli_real_escape_string($mySQL->link, strtoupper($_POST['userName']));
$userBorn = mysqli_real_escape_string($mySQL->link, $_POST['userBorn']);
$userMail = mysqli_real_escape_string($mySQL->link, $_POST['userMail']);
$userCPF = mysqli_real_escape_string($mySQL->link, $_POST['userCPF']);
$userRG = mysqli_real_escape_string($mySQL->link, $_POST['userRG']);
$userUF = mysqli_real_escape_string($mySQL->link, $_POST['userUF']);
$userOrgan = mysqli_real_escape_string($mySQL->link, $_POST['userOrgan']);
$userPhone = mysqli_real_escape_string($mySQL->link, $_POST['userPhone']);
$userNameFather = mysqli_real_escape_string($mySQL->link, strtoupper($_POST['userNameFather']));
$userFatherPhone = mysqli_real_escape_string($mySQL->link, $_POST['userFatherPhone']);
$userNameMother = mysqli_real_escape_string($mySQL->link, strtoupper($_POST['userNameMother']));
$userMotherPhone = mysqli_real_escape_string($mySQL->link, $_POST['userMotherPhone']);
$userNationality = mysqli_real_escape_string($mySQL->link, $_POST['userNationality']);
$userNaturality = mysqli_real_escape_string($mySQL->link, strtoupper($_POST['userNaturality']));
$userAddressCity = mysqli_real_escape_string($mySQL->link, strtoupper($_POST['userAddressCity']));
$userAddressCEP = mysqli_real_escape_string($mySQL->link, strtoupper($_POST['userAddressCEP']));
$userAddressDistrict = mysqli_real_escape_string($mySQL->link, strtoupper($_POST['userAddressDistrict']));
$userAddressStreet = mysqli_real_escape_string($mySQL->link, $_POST['userAddressStreet']);
$userAddressNumber = mysqli_real_escape_string($mySQL->link, $_POST['userAddressNumber']);
$userAddressComplement = mysqli_real_escape_string($mySQL->link, strtoupper($_POST['userAddressComplement']));
$userObs = mysqli_real_escape_string($mySQL->link, strtoupper($_POST['userObs']));

$userCPF = clearCPFandCNPJ($userCPF);
$userRG = clearCPFandCNPJ($userRG);
$userPhone = clearPhone($userPhone);
$userFatherPhone = clearPhone($userFatherPhone);
$userMotherPhone = clearPhone($userMotherPhone);


//userPermission defined by userType
if ($userType == "superAdmin") {
    $userPermission == 15;
    $adminId = mysqli_real_escape_string($mySQL->link, $_POST['adminId']);
    $adminStatus = mysqli_real_escape_string($mySQL->link, $_POST['adminStatus']);
    $adminDateBegin = mysqli_real_escape_string($mySQL->link, $_POST['adminDateBegin']);
    $adminDateEnd = mysqli_real_escape_string($mySQL->link, $_POST['adminDateEnd']);
} elseif ($userType == "doctor") {
    $userPermission == 2;
    $doctorId = mysqli_real_escape_string($mySQL->link, $_POST['doctorId']);
    $doctorTypeId = mysqli_real_escape_string($mySQL->link, $_POST['doctorTypeId']);
    $doctorDateBegin = mysqli_real_escape_string($mySQL->link, $_POST['doctorDateBegin']);
    $doctorDateEnd = mysqli_real_escape_string($mySQL->link, $_POST['doctorDateEnd']);
    $doctorStatus = mysqli_real_escape_string($mySQL->link, $_POST['doctorStatus']);
} elseif ($userType == "pacient") {
    $userPermission == 1;
    $pacientId = mysqli_real_escape_string($mySQL->link, $_POST['pacientId']);
    $pacientDoctorId = mysqli_real_escape_string($mySQL->link, $_POST['pacientDoctorId']);
    $pacientStatus = mysqli_real_escape_string($mySQL->link, $_POST['pacientStatus']);
    $pacientDateBegin = mysqli_real_escape_string($mySQL->link, $_POST['pacientDateBegin']);
    $pacientDateEnd = mysqli_real_escape_string($mySQL->link, $_POST['pacientDateEnd']);
}

$query = $mySQL->sql("UPDATE 
                            users
                        set 
                            userType = '" . $userType . "',
                            userStatus = '" . $userStatus . "',
                            userName = '" . $userName . "',
                            userBorn = '" . $userBorn . "',
                            userMail = '" . $userMail . "',
                            userCPF = '" . $userCPF . "',
                            userRG = '" . $userRG . "',
                            userUF = '" . $userUF . "',
                            userOrgan = '" . $userOrgan . "',
                            userPhone = '" . $userPhone . "',
                            userNameFather = '" . $userNameFather . "',
                            userFatherPhone = '" . $userFatherPhone . "',
                            userNameMother = '" . $userNameMother . "',
                            userMotherPhone = '" . $userMotherPhone . "',
                            userNationality = '" . $userNationality . "',
                            userNaturality = '" . $userNaturality . "',
                            userAddressCity = '" . $userAddressCity . "',
                            userAddressCEP = '" . $userAddressCEP . "',
                            userAddressDistrict = '" . $userAddressDistrict . "',
                            userAddressStreet = '" . $userAddressStreet . "',
                            userAddressNumber = '" . $userAddressNumber . "',
                            userAddressComplement = '" . $userAddressComplement . "',
                            userObs = '" . $userObs . "'
                        where 
                            userId = '" . $userId . "'
                        ") or die("<h4 class='widgettitle title-danger'>Erro ao atualizar item no banco de dados.</h4><br />");

if ($userType == "superAdmin") { //fill in data relating to level 14 - administrator and 15 - super administrator

    $query = $mySQL->sql("UPDATE 
                                administrators
                            set 
                                adminUserId = '" . $userId . "',
                                adminStatus = '" . $adminStatus . "',
                                adminDateBegin = '" . $adminDateBegin . "',
                                adminDateEnd = '" . $adminDateEnd . "',
                            where 
                                adminId = '" . $adminId . "'
                            ") or die("<h4 class='widgettitle title-danger'>Erro ao atualizar item no banco de dados.</h4><br />");
} else if ($userType == 'doctor') { //fill in data relating to the doctorate level

    $query = $mySQL->sql("UPDATE 
                                doctors
                            set 
                                doctorTypeId = '" . $doctorTypeId . "',
                                doctorDateBegin = '" . $doctorDateBegin . "',
                                doctorDateEnd = '" . $doctorDateEnd . "',
                                doctorStatus = '" . $doctorStatus . "'
                            where 
                                doctorId = '" . $doctorId . "'
                            ") or die("<h4 class='widgettitle title-danger'>Erro ao atualizar item no banco de dados.</h4><br />");
} else if ($userType == 'pacient') { //fill in data relating to the doctorate level

    $query = $mySQL->sql("UPDATE 
                                pacients
                            set 
                                pacientStatus = '" . $pacientStatus . "',
                                pacientDoctorId = '" . $pacientDoctorId . "',
                                pacintDateBegin = '" . $pacintDateBegin . "',
                                pacientDateEnd = '" . $pacientDateEnd . "'
                            where 
                                pacientId = '" . $pacientId . "'
                            ") or die("<h4 class='widgettitle title-danger'>Erro ao atualizar item no banco de dados.</h4><br />");
}


echo json_encode($userId);
