<?php
if (isset($_POST['updateUserPassword'])) {
	// GET VARIABLES VIA POST
	$userId = mysqli_real_escape_string($mySQL->link, $_POST['userId']);
	$oldUserPassword = md5($_POST['oldUserPassword']);
	$newUserPassword = mysqli_real_escape_string($mySQL->link, $_POST['newUserPassword']);
	$newUserPasswordConfirm = mysqli_real_escape_string($mySQL->link, $_POST['newUserPasswordConfirm']);
	$resetPassword = mysqli_real_escape_string($mySQL->link, $_POST['resetPassword']);
	$userCPF = mysqli_real_escape_string($mySQL->link, $_POST['userCPF']);
	$newUserPassword = md5($newUserPassword);
	$newUserPasswordConfirm = md5($newUserPasswordConfirm);
	//END GET VARIABLES VIA POST

	//ERROR HANDLING
	$errorDescription = "";
	$errorConfirm = TRUE;
	$errorVerification = TRUE;
	if ($resetPassword != 1) {

		if ($oldUserPassword != $_SESSION['userPassword']) {
			$errorDescription = $errorDescription . "<div class=\"alert alert-danger alert-dismissable\">
											                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
											                <h4>	<i class=\"icon fa fa-fan\"></i> Ops!</h4>
											                ERRO: Senha antiga não confere!
											            </div>";
		} else {
			$errorVerification = FALSE;
		}

		if ($newUserPassword != $newUserPasswordConfirm) {
			$errorDescription = $errorDescription . "<div class=\"alert alert-danger alert-dismissable\">
											                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
											                <h4>	<i class=\"icon fa fa-fan\"></i> Ops!</h4>
											                ERRO: Senhas não conferem!
											            </div>";
		} else {
			$errorConfirm = FALSE;
		}

		//END ERROR HANDLING

		if (($errorConfirm == FALSE) and ($errorVerification == FALSE)) {
			if ($userId == $_SESSION['userId']) {
				$_SESSION['userPassword'] = $newUserPassword;
			}
			$query = $mySQL->sql("UPDATE 
										users 
									SET 
										userPassword = '" . $newUserPassword . "'
									WHERE 
										userId = '" . $userId . "'")
				or die(mysqli_error($mySQL->link, "<h4 class='widgettitle title-danger'>Erro ao atualizar usuário!</h4><br />"));
			changeLog($system, $page, 'Alterou a senha - ' . $userName);
			echo "<div class=\"alert alert-success\"><button data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>Senha alterada com sucesso!</div></br>";
		} else {
			echo $errorDescription;
		}
	} else {
		$newUserPassword = $userCPF;
		////// Remover caracteres ////////
		$newUserPassword = trim($newUserPassword);
		$newUserPassword = str_replace(".", "", $newUserPassword);
		$newUserPassword = str_replace("-", "", $newUserPassword);
		//////////////////////////////// 
		$newUserPassword = md5($newUserPassword);
		if ($userId == $_SESSION['userId']) {
			$_SESSION['userPassword'] = $newUserPassword;
		}
		if ($_SESSION['userPermission'] >= 10) {
			$query = $mySQL->sql("UPDATE 
										users 
									  SET 
										userPassword = '" . $newUserPassword . "',
										userChangePassword = 1
									  WHERE 
										userId = '" . $userId . "'")
				or die(mysqli_error($mySQL->link, "<h4 class='widgettitle title-danger'>Erro ao atualizar usuário!</h4><br />"));
			changeLog($system, $page, 'Alterou a senha - ' . $userName);

			echo "<div class=\"alert alert-success\"><button data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>Senha resetada com sucesso!</br>A nova senha desse usuário é o seu CPF sem caracteres especiais.</div></br>";
		} else {
			echo "
				<div class=\"alert alert-danger alert-dismissable\">
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
					<h4>	<i class=\"icon fa fa-fan\"></i> Ops!</h4>
					Desculpe, mas você não tem permissão para resetar a sua senha.
				</div>";
		}
	}
} // FIM - Mudança de senha


/* inicio resetar senha*/
if (isset($_GET['resetUserPassword'])) {
	$userId = mysqli_real_escape_string($mySQL->link, $_GET['userId']);

	$query = $mySQL->sql("UPDATE 
								users 
							SET 
								userPassword = userCPF,
								userPassword = REPLACE (userPassword,'.',''),
								userPassword = REPLACE (userPassword,'-',''),
								userPassword = MD5(userPassword),
								userChangePassword = '1'
							WHERE 
								userId = '" . $userId . "'")
		or die(mysqli_error($mySQL->link, "<h4 class='widgettitle title-danger'>Erro ao atualizar usuário!</h4><br />"));
	changeLog($system, $page, 'Alterou a senha - ' . $userName);
	echo "
			<div class=\"alert alert-success\">
				<button data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>
				Opa! Senha resetada com sucesso!</br>A nova senha desse usuário é o seu CPF com todos seus caracteres.
			</div>";

	if ($userMail != "") {
		$userMail = userMail($userId);
		$mail->addAddress($userMail);
		// Informa se vamos enviar mensagens usando HTML
		$mail->IsHTML(true);
		//Nome do Remetente
		$mail->FromName = $system['systemName'];
		//Assunto do e-mail
		$mail->Subject = 'Reset de senha :: ' . $system['systemName'] . '';
		// Mensagem que vai no corpo do e-mail
		$mail->Body = '
						<h1>Olá! Somos do  ' . $system['systemName'] . '!</h1>
		                <br>
		                <h2>Verificamos que sua senha foi resetada.</h2>
		                Para entrar no sistema acesse <a target="_blank" href="' . $system['systemURLProduction'] . '">' . $system['systemURLProduction'] . '</a> e utilize: 
		                <br>
		                Login: ' . $userMail . ' 
		                <br>
		                Senha: seu CPF (sem caracteres especiais).    
		                ';
		$mail->Send();
	}
} else {
	echo $errorDescription;
}
