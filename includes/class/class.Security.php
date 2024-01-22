<?php
// Conexão direta com o banco
//Lembrar de ajustar configuração com o banco de dados central
//$link = mysqli_connect('localhost', 'semedweb', 'key!databaseadmin')  or die('MySQL: Nao foi possivel conectar-se ao banco de dados');
//mysqli_select_db('sigem', $link) or die('MySQL: Nao foi possivel conectar-se ao banco de dados');

//$mySQL->sql('SET character_set_results=utf8');

// Início de sessão
session_start();

function validateUser($userMail, $userPassword)
{
	global $mySQL;
	$userMail = mysqli_real_escape_string($mySQL->link, $userMail);
	$userPassword = mysqli_real_escape_string($mySQL->link, $userPassword);

	$query = $mySQL->sql("SELECT `userId`, `userPermission`, `userName`, `userMail`, `userFromSystem`, `userType`
							FROM `users` 
							WHERE ( `userMail` = '" . $userMail . "' OR `userCPF` = '" . $userMail . "' ) 
							AND `userPassword` = '" . $userPassword . "' 
							AND `userStatus` = 1 
							LIMIT 1
						");
	$result = mysqli_fetch_assoc($query);

	$userVerify = TRUE;
	if ($result['userPermission'] == 1) {
		$queryuserVerify = $mySQL->sql("SELECT `userId`
										FROM `users`
										WHERE `userId` = '" . $result['userId'] . "' 
										AND `userStatus` = 1
										LIMIT 1
									");
		if (mysqli_num_rows($queryuserVerify) == 0) {
			$userVerify = FALSE;
		}
	}

	if (empty($result) or ($userMail == "") or ($userPassword == "") or (!$userVerify)) {
		return false;
	} else {
		$_SESSION['userId'] = $result['userId'];
		$_SESSION['userName'] = $result['userName'];
		$_SESSION['userMail'] = $result['userMail'];
		$_SESSION['userPermission'] = $result['userPermission'];
		$_SESSION['userFromSystem'] = $result['userFromSystem'];
		$_SESSION['userType'] = $result['userType'];
		$_SESSION['userMail'] = $userMail;
		$_SESSION['userPassword'] = $userPassword;

		return true;
	}
}

function forceHTTPS()
{
	if ($_SERVER['SERVER_PORT'] != '443' and (!str_contains($_SERVER['SERVER_NAME'], 'homolog') and !str_contains($_SERVER['SERVER_NAME'], 'localhost'))) {
		$url = $_SERVER['SERVER_NAME'];

		$new_url = "https://" . $url . $_SERVER['REQUEST_URI'];
		header("Location: $new_url");
		exit;
	}
}

function protectPage()
{
	global $system;
	global $mySQL;

	if (!isset($_SESSION['userId']) or !isset($_SESSION['userName'])) {
		getOut();
	} elseif (!validateUser($_SESSION['userMail'], $_SESSION['userPassword'])) {
		getOut();
	}
}


function goError($erro)
{
	include('includes/config.php');
	header("Location: error.php?action=" . $erro);
	exit;
}

function getOut()
{
	//include('includes/config.php');
	unset($_SESSION['userId'], $_SESSION['userName'], $_SESSION['userMail'], $_SESSION['userPassword']);
	header("Location: login.php");
	exit;
}
?>