<?php
#TIP: DO NOT CHANGE ANYTHING HERE OR YOU WILL BURN IN HELL :D

//defines local translation date
setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");

//defines local path
ini_set('include_path', '../:' . ini_get('include_path'));

require_once('class/class.DotEnv.php');

use DotEnv\DotEnv;

(new DotEnv(__DIR__ . '/.env'))->load();

require_once("connect.php");

//Definição do sistema central de acordo com o banco de dados 'systems'
$systemId = $_ENV['SYSTEM_ID'];
$querySystem = $mySQL->sql(" SELECT * FROM systems WHERE systemId = $systemId");
$system = mysqli_fetch_array($querySystem);
$mesesTraduzidos = [
    'January' => 'Janeiro',
    'February' => 'Fevereiro',
    'March' => 'Março',
    'April' => 'Abril',
    'May' => 'Maio',
    'June' => 'Junho',
    'July' => 'Julho',
    'August' => 'Agosto',
    'September' => 'Setembro',
    'October' => 'Outubro',
    'November' => 'Novembro',
    'December' => 'Dezembro'
];
?>