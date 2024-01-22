<?php
if ($action == "listPacients") {
    //if (userPermissionSystemId($_SESSION['userId']) < 14) {

    require_once('includes/class/class.Functions.php');
    require_once('includes/class/class.Scripts.php');
    include('pages/pacients/scriptListPacient.php');

?>
    <script>
        // window.location = 'error.php?action=001';
    </script>
    <?php
    // }
    ?>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <i class="fa fa-bars"></i>
                        <h3 class="box-title">Lista Geral de Pacientes</h3>
                    </div>
                    <div class="box-header">
                        <a href="pacients.php?action=newPacient" style="margin-bottom: 10px;">
                            <button class="btn btn-block btn-primary buttonDotStyleFull">
                                <font color="#fff">
                                    <i class="fa fa-plus-square"></i> &nbsp;Novo Paciente
                                </font>
                            </button>
                        </a>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?php
                        // Query to fetch user data from the "users" table
                        $queryUser = $mySQL->sql("SELECT userId, userName, userStatus, userCPF, userMail, userNameMother, userNameFather, userDeficiency, userDeficiencyType, userPhone, userType
                                                    FROM users
                                                    WHERE userType = 'pacient'
                                                    ORDER BY userName
                                                ");
                        $dataNumUsers = mysqli_num_rows($queryUser);

                        $arrayUser = $arrayIdUser = array();

                        while ($dataUser = mysqli_fetch_array($queryUser)) {
                            // Check if the user ID is not already in the array
                            if (!in_array($dataUser['userId'], $arrayIdUser)) {
                                $arrayIdUser[] = $dataUser['userId'];
                            }

                            // Store user data in temporary array
                            $arrayTemp[0] = $dataUser['userId'];
                            $arrayTemp[1] = $dataUser['userName'];
                            $arrayTemp[2] = $dataUser['userCPF'];
                            $arrayTemp[3] = $dataUser['userMail'];
                            $arrayTemp[4] = $dataUser['userPhone'];
                            $arrayTemp[5] = $dataUser['userType'];
                            $arrayTemp[6] = $dataUser['userMother'];
                            $arrayTemp[7] = $dataUser['userFather'];
                            $arrayTemp[8] = $dataUser['userStatus'];
                            $arrayTemp[9] = $dataUser['userDeficiency'];
                            $arrayTemp[10] = $dataUser['userDeficiencyType'];

                            // Count the number of occurrences for each user ID
                            $arrayUser[$dataUser['userId']][0] = $arrayUser[$dataUser['userId']][0] + 1;

                            // Store the user data in an array indexed by user ID
                            $arrayUser[$dataUser['userId']][1][] = $arrayTemp;
                        }
                        if ($dataNumUsers == 0) { // Check if the number of users is zero
                        ?>
                            <div class="callout" style="color: #850404; background: #ffd5cd; border-color: #850404; border-radius: 8px;">
                                <h4>Oh poxa! 😓</h4>
                                <p>Nenhum Usuário encontrado no nosso banco de dados!</p>
                            </div>
                        <?php
                        } else {
                        ?>

                            <table class="table table-bordered table-striped tableStyle">
                                <thead style="background-color: #bbdaf2;">
                                    <tr>
                                        <th>
                                            Nome/CPF
                                        </th>
                                        <th>
                                            Contatos
                                        </th>
                                        <th>
                                            Médico Responsável
                                        </th>
                                        <th>
                                            Paciente especial / Tipo
                                        </th>
                                        <th>
                                            Ações
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $nIds = count($arrayIdUser); // Calculate the number of elements in the array $arrayIdUser
                                    // Loop through the array of user IDs
                                    for ($i = 0; $i < $nIds; $i++) {
                                        //$encodedId = base64_encode($arrayUser[$arrayIdUser[$i]][1][0][0]); //This line of code encodes the value using base64 and assigns it to the variable.
                                        $userId = $arrayUser[$arrayIdUser[$i]][1][0][0];

                                    ?>
                                        <tr>
                                            <td>
                                                <?= !empty($arrayUser[$arrayIdUser[$i]][1][0][1]) ? $arrayUser[$arrayIdUser[$i]][1][0][1] : '-' ?><br>
                                                <?= !empty($arrayUser[$arrayIdUser[$i]][1][0][2]) ? MascaraCPF($arrayUser[$arrayIdUser[$i]][1][0][2]) : '-' ?><br>
                                                <?= translateUserType($arrayUser[$arrayIdUser[$i]][1][0][5]) ?><br>
                                            </td>
                                            <td>
                                                <?= !empty($arrayUser[$arrayIdUser[$i]][1][0][3]) ? $arrayUser[$arrayIdUser[$i]][1][0][3] : '-' ?><br>
                                                <?= !empty($arrayUser[$arrayIdUser[$i]][1][0][4]) ? MaskPhone($arrayUser[$arrayIdUser[$i]][1][0][4]) : '-' ?><br>
                                                <?= !empty($arrayUser[$arrayIdUser[$i]][1][0][6]) ? $arrayUser[$arrayIdUser[$i]][1][0][6] : '-' ?><br>
                                                <?= !empty($arrayUser[$arrayIdUser[$i]][1][0][7]) ? $arrayUser[$arrayIdUser[$i]][1][0][7] : '-' ?>
                                            </td>
                                            <td>
                                                
                                            </td>
                                            <td>
                                                <?= !empty($arrayUser[$arrayIdUser[$i]][1][0][9]) ? $arrayUser[$arrayIdUser[$i]][1][0][9] : '-' ?><br>
                                                <?= !empty($arrayUser[$arrayIdUser[$i]][1][0][10]) ? $arrayUser[$arrayIdUser[$i]][1][0][10] : '-' ?>
                                            </td>
                                            <td align="center">
                                                <div>
                                                    <a href="pacients.php?action=editPacient&userId=<?= $userId ?>">
                                                        <button class="btn btn-default buttonDotStyle" data-toggle="tooltip" data-placement="top" title="Editar Paciente">
                                                            <i class="ph ph-pencil-simple"></i>
                                                        </button>
                                                    </a>

                                                    <a href="pacients.php?action=linkDoctor&userId=<?= $userId ?>">
                                                        <button class="btn btn-info buttonDotStyle" data-toggle="tooltip" data-placement="top" title="Vincular Paciente a Médico">
                                                            <i class="fa fa-random"></i>
                                                        </button>
                                                    </a>

                                                    <button class="btn btn-danger buttonDotStyle" data-toggle="tooltip" data-placement="right" title="Excluir Paciente" onclick="deletePacient('<?= $userId ?>'); lockInteraction();">
                                                        <i class="ph ph-trash-simple"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        <?php
                        }
                        ?>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section>

<?php
    loaderVerification();
}
?>