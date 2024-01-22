<?php
function changeLog($system, $page, $action)
{
  global $mySQL;
  $changeUser = $_SESSION['userName'];
  $changeDate = date_create("America/Bahia");
  $changeDate = date_format($changeDate, "d/m/Y H:i");
  $sql = "INSERT INTO change_log (`changeUser`, `changeDate`, `changePage`, `changeSystem`, `changeAction`) VALUES ('" . $changeUser . "', '" . $changeDate . "', '" . $page . "', '" . $system . "', '" . $action . "')";
  $query = $mySQL->sql($sql);
}

function userPermission($userId)
{
  global $mySQL;
  global $system;

  $sql = $mySQL->sql("SELECT userPermission 
                      FROM users
                      WHERE userId = " . $userId . " LIMIT 1
                    ");
  $return = mysqli_fetch_array($sql);
  return $return['userPermission'];
}

function reduzirNome($texto, $tamanho)
{
  global $mySQL;
  // Se o nome for maior que o permitido
  if (strlen($texto) > ($tamanho - 2)) {
    $texto = strip_tags($texto);

    // Pego o primeiro nome
    $palavas    = explode(' ', $texto);
    $nome       = $palavas[0];

    // Pego o ultimo nome
    $palavas    = explode(' ', $texto);
    $sobrenome  = trim($palavas[count($palavas) - 1]);

    // Vejo qual e a posicao do ultimo nome
    $ult_posicao = count($palavas) - 1;

    // Crio uma variavel para receber os nomes do meio abreviados
    $meio = '';

    // Listo todos os nomes do meios e abrevio eles
    for ($a = 1; $a < $ult_posicao; $a++) :

      // Enquanto o tamanho do nome nao atingir o limite de caracteres
      // completo com o nomes do meio abreviado
      if (strlen($nome . ' ' . $meio . ' ' . $sobrenome) <= $tamanho) :
        $meio .= ' ' . strtoupper(substr($palavas[$a], 0, 1));
      endif;
    endfor;
  } else {
    $nome       = $texto;
    $meio       = '';
    $sobrenome  = '';
  }

  return trim($nome . $meio . ' ' . $sobrenome);
}


function redrectURL($url)
{
  echo "<script language= \"JavaScript\">" . $url . "</script>";
}

function Mask($mask, $str)
{

  $str = str_replace(" ", "", $str);

  for ($i = 0; $i < strlen($str); $i++) {
    $mask[strpos($mask, "#")] = $str[$i];
  }

  return $mask;
}


function MaskPhone($phone)
{
  $str = strlen($phone);
  if ($str == 8) {
    return Mask("####-####", $phone);
  } else if ($str == 9) {
    return Mask("#####-####", $phone);
  } else if ($str == 10 or $str == 11) {
    return Mask("(##) ####-####", $phone);
  } else if ($str == 12) {
    return Mask("(##) #####-####", $phone);
  } else if ($str > 12) {
    return $phone;
  } else {
    return "";
  }
}

function MascaraX($_string, $_mascara)
{
  $_mascara_finalizada = '';
  $_posicao = 0;
  for ($_x = 0; $_x <= strlen($_mascara) - 1; $_x++) {
    if ($_mascara[$_x] == '#') {
      if (isset($_string[$_posicao])) $_mascara_finalizada .= $_string[$_posicao++];
    } else {
      if (isset($_mascara[$_x])) $_mascara_finalizada .= $_mascara[$_x];
    }
  }
  return $_mascara_finalizada;
}

function MascaraCPF($_string)
{
  $_mascara_finalizada = '';
  $_posicao = 0;
  $_mascara = "###.###.#**-**";
  for ($_x = 0; $_x <= strlen($_mascara) - 1; $_x++) {
    if ($_mascara[$_x] == '#') {
      if (isset($_string[$_posicao])) $_mascara_finalizada .= $_string[$_posicao++];
    } elseif ($_mascara[$_x] == '*') {
      $_posicao++;
      $_mascara_finalizada .= $_mascara[$_x];
    } else {
      if (isset($_mascara[$_x])) $_mascara_finalizada .= $_mascara[$_x];
    }
  }
  return $_mascara_finalizada;
}

function formatarCPF($cpf)
{
  global $mySQL;
  if (strlen($cpf) == 10) {
    $cpf = "0" . $cpf;
  }

  $parte_um     = substr($cpf, 0, 3);
  $parte_dois   = substr($cpf, 3, 3);
  $parte_tres   = substr($cpf, 6, 3);
  $parte_quatro = substr($cpf, 9, 2);

  $monta_cpf = "$parte_um.$parte_dois.$parte_tres-$parte_quatro";

  return $monta_cpf;
}

function clearCPFandCNPJ($valor)
{
  global $mySQL;
  $valor = trim($valor);
  $valor = str_replace(".", "", $valor);
  $valor = str_replace(",", "", $valor);
  $valor = str_replace("-", "", $valor);
  $valor = str_replace("/", "", $valor);
  $valor = str_replace("_", "", $valor);

  return $valor;
}

function clearPhone($valor)
{
  global $mySQL;
  $valor = trim($valor);
  $valor = str_replace("-", "", $valor);
  $valor = str_replace("(", "", $valor);
  $valor = str_replace(")", "", $valor);
  return $valor;
}

function dateFormateToDataBase($date)
{
  $aux = explode('/', $date);
  return $aux[2] . "-" . $aux[1] . "-" . $aux[0];
}

function standardizationUserBorn($userBorn)
{
  $userBorn = str_replace("_", "", $userBorn);
  $userBorn = trim($userBorn);
  if (strlen($userBorn) >= 8 and strlen($userBorn) <= 10) {
    $userBorn = str_replace("/", "-", $userBorn);
    if (date_create($userBorn)) {
      $userBorn = date_create($userBorn);
      if (date_format($userBorn, 'd/m/Y')) {
        $userBorn = date_format($userBorn, 'd/m/Y');
        return $userBorn;
      } else {
        return '';
      }
    } else {
      return '';
    }
  } else {
    return '';
  }
}

function userName($userId)
{
  global $mySQL;

  $sql = $mySQL->sql("SELECT userName FROM `users` WHERE `userId` = '" . $userId . "' ");

  $return = mysqli_fetch_array($sql);

  return $return['userName'];
}

function translateUserStatus($userStatus)
{
  if ($userStatus == 0) {
    $status = "Inativo";
  } else if ($userStatus == 1) {
    $status = "Ativo";
  }
  return $status;
}

function translateUserType($userType)
{
  if ($userType == 'superAdmin') {
    $trad = 'Super Administrador';
  } elseif ($userType == 'admin') {
    $trad = 'Administrador';
  }
  if ($userType == 'doctor') {
    $trad = 'Doutor';
  }
  if ($userType == 'pacient') {
    $trad = 'Paciente';
  }
  return $trad;
}

function userMail($userId)
{
  global $mySQL;

  $sql = $mySQL->sql("SELECT userMail FROM `users` WHERE `userId` = '" . $userId . "'");
  
  $return = mysqli_fetch_array($sql);
  return $return['userMail'];
}

function randomSuccessMsg(){
  $successWords = array('Irado', 'Massa', 'Top', 'Isso aí', 'Opa!', 'Eba.', 'Uhu!!', 'Oba!');
  $successWordsPrint = $successWords[rand(0, count($successWords) - 1)];
  return $successWordsPrint;
}

function randomDeclineMsg(){
  $declineWords = array('Oh poxa!', 'Ah não!', 'Caramba.', 'Ops!', 'Eita!', 'Caraca!', 'Puts!');
  $declineWordsPrint = $declineWords[rand(0, count($declineWords) - 1)];
  return $declineWordsPrint;
}