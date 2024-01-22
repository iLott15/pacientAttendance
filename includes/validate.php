<?php
require_once("config.php");
require_once("class/class.Security.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$userMail = (isset($_POST['userMail'])) ? mysqli_real_escape_string($mySQL->link, $_POST['userMail']) : '';
	$userPassword = (isset($_POST['userPassword'])) ? mysqli_real_escape_string($mySQL->link, $_POST['userPassword']) : '';
	$userPassword = md5($userPassword);

	$userPasswordEmptyVerificatio = $userPassword;
	$userUserEmptyVerificatio = $userMail;
	$date = date("d/m/Y");
	$hour = date("H:i");

	if ((validateUser($userMail, $userPassword) == true) and ($userPasswordEmptyVerificatio != "") and ($userUserEmptyVerificatio != "")) {
		$query = $mySQL->sql("SELECT `userChangePassword` , `userPermission`, `userId`
								FROM users 
								WHERE ( `userMail` = '" . $userMail . "' OR `userCPF` = '" . $userMail . "' )  
								AND `userPassword` = '" . $userPassword . "' 
								AND `userStatus` = '1' ");
		$dataUser = mysqli_fetch_assoc($query);

		if ($dataUser['userChangePassword'] == 1) {
			header("Location: ../login.php?action=changePassword");
			exit;
		} else {
			header("Location: ../index.php");
			exit;
		}
	} else {
		unset($_SESSION['userId'], $_SESSION['userName'], $_SESSION['userMail'], $_SESSION['userPassword']);
		header("Location: ../login.php?error=1");
		exit;
	}
}
?>