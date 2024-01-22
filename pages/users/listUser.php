<?php
if ($action == "listUser") {
    if (userPermission($_SESSION['userId']) < 14) {
?>
        <script>
            window.location = 'error.php?action=001';
        </script>
    <?php
    }

    ?>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <i class="fa fa-bars"></i>
                        <h3 class="box-title">Lista de cadastro de Usuários no sistema</h3>
                    </div>
                    <div class="box-header">
                        <a href="users.php?action=newUser" style="margin-bottom: 10px;">
                            <button class="btn btn-block btn-primary buttonDotStyleFull">
                                <font color="#fff">
                                    <i class="fa fa-plus-square"></i> &nbsp;Novo Usuário
                                </font>
                            </button>
                        </a>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?php
                        // Query to fetch user data from the "users" table
                        $queryUser = $mySQL->sql("SELECT userId, userName, userStatus, userCPF, userMail, userNameMother, userNameFather, userPhone, userType
                                                    FROM users
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
                            $arrayTemp[6] = $dataUser['userNameMother'];
                            $arrayTemp[7] = $dataUser['userNameFather'];
                            $arrayTemp[8] = $dataUser['userStatus'];

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
                                        <th width="30%">
                                            Dados do Usuário
                                        </th>
                                        <th width="25%">
                                            Contatos
                                        </th>
                                        <th width="25%">
                                            Vínculos
                                        </th>
                                        <th width="20%" style="text-align: center">
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
                                            <td width="30%">
                                                <?= !empty($arrayUser[$arrayIdUser[$i]][1][0][1]) ? $arrayUser[$arrayIdUser[$i]][1][0][1] : '-' ?><br>
                                                <?= !empty($arrayUser[$arrayIdUser[$i]][1][0][2]) ? MascaraCPF($arrayUser[$arrayIdUser[$i]][1][0][2]) : '-' ?><br>
                                                <?= translateUserType($arrayUser[$arrayIdUser[$i]][1][0][5]) ?><br>
                                            </td>
                                            <td width="25%">
                                                <?= !empty($arrayUser[$arrayIdUser[$i]][1][0][3]) ? $arrayUser[$arrayIdUser[$i]][1][0][3] : '-' ?><br>
                                                <?= !empty($arrayUser[$arrayIdUser[$i]][1][0][4]) ? MaskPhone($arrayUser[$arrayIdUser[$i]][1][0][4]) : '-' ?>
                                            </td>
                                            <td width="25%">
                                                <?= !empty($arrayUser[$arrayIdUser[$i]][1][0][6]) ? $arrayUser[$arrayIdUser[$i]][1][0][6] : '-' ?><br>
                                                <?= !empty($arrayUser[$arrayIdUser[$i]][1][0][7]) ? $arrayUser[$arrayIdUser[$i]][1][0][7] : '-' ?>
                                            </td>
                                            <td width="20%" align="center">
                                                <div>
                                                    <a href="users.php?action=editUser&userId=<?= $userId ?>">
                                                        <button class="btn btn-default buttonDotStyle" data-toggle="tooltip" data-placement="top" title="Editar Usuário">
                                                            <i class="ph ph-pencil-simple"></i>
                                                        </button>
                                                    </a>

                                                    <button class="btn btn-danger buttonDotStyle" data-toggle="tooltip" data-placement="right" title="Excluir" onclick="confirmDelete('<?= $userId ?>'); lockInteraction();">
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
    include('pages/users/scriptListUser.php');
}
?>