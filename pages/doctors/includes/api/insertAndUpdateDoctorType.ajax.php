<?php

require_once('../../../../includes/config.php');
require_once('../../../../includes/class/class.Functions.php');

global $mySQL;
$mySQL->sql('SET character_set_results=utf8');

$doctorTypeId = mysqli_real_escape_string($mySQL->link, $_POST['doctorTypeId']);
$doctorTypeName = mysqli_real_escape_string($mySQL->link, mb_strtoupper($_POST['doctorTypeName']));

if (empty($doctorTypeId)) {
    $query = $mySQL->sql("INSERT INTO 
                            doctor_types 
                                (
                                    doctorTypeName
                                )
                            VALUES
                                (
                                    '" . $doctorTypeName . "'
                                )
                                ") or die("<h4 class='widgettitle title-danger'>Erro ao inserir dados no banco de dados</h4><br />");
    $doctorTypeId = mysqli_insert_id($mySQL->link);
} else {
    $query = $mySQL->sql("UPDATE 
                            doctor_types
                        SET 
                            doctorTypeName = '" . $doctorTypeName . "'
                        WHERE 
                            doctorTypeId = '" . $doctorTypeId . "'
                        ") or die("<h4 class='widgettitle title-danger'>Erro ao atualizar item no banco de dados.</h4><br />");
}

echo json_encode($doctorTypeId);
