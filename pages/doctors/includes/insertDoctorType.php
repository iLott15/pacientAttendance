<?php
if (isset($_POST['insertDoctorType'])) {
    if (userPermission($_SESSION['userId']) < 14) {
?>
        <script>
            window.location = 'error.php?action=001';
        </script>
<?php
    }

    // GET VARIABLES VIA POST
    $doctorTypeName = mysqli_real_escape_string($mySQL->link, mb_strtoupper($_POST['doctorTypeName']));

    $query = $mySQL->sql("INSERT INTO 
                            doctor_types 
                            (
                                doctorTypeName
                            )
                            VALUES 
                            (			
                                '" . $doctorTypeName . "'
                            )
                        ");
    $doctorTypeId = mysqli_insert_id($mySQL->link);
    changeLog($system, $page, 'Criou nova especialidade - ' . $doctorTypeId);

    header("Location: doctors.php?action=listDoctorType&inDT");
}
if (isset($_GET['inDT'])) {
    echo "
		<div class=\"row\" style=\" margin-left: 2px; margin-right: 2px; margin-bottom: -60px;\">
			<div class=\"col-md-12\">
				<div class=\"alert alert-success alert-dismissable\">
          			<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
          			<h4>	<i class=\"icon fa fa-check\"></i> Pronto!</h4>
          			Cadastro de Especialidade feito com sucesso!
        		</div>
      		</div>
   		</div>
   		<br><br>";
}
?>