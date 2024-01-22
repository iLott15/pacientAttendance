<?php
if ($action == "listDoctorType") {
    if (userPermission($_SESSION['userId']) < 14) {

?>
        <script>
            window.location = 'error.php?action=001';
        </script>
    <?php
    }
    require_once('includes/class/class.Functions.php');
    require_once('includes/class/class.Scripts.php');

    $declineWords = randomDeclineMsg();
    $successWords = randomSuccessMsg();
    ?>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <i class="fa fa-bars"></i>
                        <h3 class="box-title">Listagem e cadastro de especialidades dos médicos no sistema</h3>
                    </div>
                    <div class="box-header">
                        <a href="#myModalNewTypeDoc" data-toggle="modal" style="margin-bottom: 10px;">
                            <button class="btn btn-block btn-primary buttonDotStyleFull">
                                <font color="#fff">
                                    <i class="fa fa-plus-square"></i> &nbsp;Nova Especialidade
                                </font>
                            </button>
                        </a>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?php
                        // Query to fetch user data from the "users" table
                        $queryTypeDoc = $mySQL->sql("SELECT *
                                                    FROM doctor_types
                                                    ORDER BY doctorTypeName
                                                ");
                        $dataNumTypeDoc = mysqli_num_rows($queryTypeDoc);

                        $arrayTypeDoc = $arrayTypeDocId = array();

                        while ($dataTypeDoc = mysqli_fetch_array($queryTypeDoc)) {
                            // Check if the user ID is not already in the array
                            if (!in_array($dataTypeDoc['doctorTypeId'], $arrayTypeDocId)) {
                                $arrayTypeDocId[] = $dataTypeDoc['doctorTypeId'];
                            }

                            // Store user data in temporary array
                            $arrayTemp[0] = $dataTypeDoc['doctorTypeId'];
                            $arrayTemp[1] = $dataTypeDoc['doctorTypeName'];

                            // Count the number of occurrences for each user ID
                            $arrayTypeDoc[$dataTypeDoc['doctorTypeId']][0] = $arrayTypeDoc[$dataTypeDoc['doctorTypeId']][0] + 1;

                            // Store the user data in an array indexed by user ID
                            $arrayTypeDoc[$dataTypeDoc['doctorTypeId']][1][] = $arrayTemp;
                        }
                        if ($dataNumTypeDoc == 0) { // Check if the number of users is zero
                        ?>
                            <div class="callout" style="color: #850404; background: #ffd5cd; border-color: #850404; border-radius: 8px;">
                                <h4><?= $declineWords ?> 😓</h4>
                                <p>Nenhuma especialidade foi encontrada no nosso banco de dados!</p>
                            </div>
                        <?php
                        } else {
                        ?>

                            <table class="table table-bordered table-striped tableStyle">
                                <thead style="background-color: #bbdaf2;">
                                    <tr>
                                        <th width="70%" style="text-align: center">
                                            Especialidade
                                        </th>
                                        <th width="30%" style="text-align: center">
                                            Ações
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $nIds = count($arrayTypeDocId); // Calculate the number of elements in the array $arrayTypeDocId
                                    // Loop through the array of user IDs
                                    for ($i = 0; $i < $nIds; $i++) {
                                        //$encodedId = base64_encode($arrayTypeDoc[$arrayTypeDocId[$i]][1][0][0]); //This line of code encodes the value using base64 and assigns it to the variable.
                                        $doctorTypeId = $arrayTypeDoc[$arrayTypeDocId[$i]][1][0][0];

                                    ?>
                                        <tr>
                                            <td align="center">
                                                <?= !empty($arrayTypeDoc[$arrayTypeDocId[$i]][1][0][1]) ? $arrayTypeDoc[$arrayTypeDocId[$i]][1][0][1] : '-' ?>
                                            </td>
                                            <td align="center">
                                                <div>
                                                    <a href="doctors.php?action=editDoctorType&doctorTypeId=<?= $doctorTypeId ?>">
                                                        <button class="btn btn-default buttonDotStyle" data-toggle="tooltip" data-placement="top" title="Editar Especialidade">
                                                            <i class="ph ph-pencil-simple"></i>
                                                        </button>
                                                    </a>

                                                    <button class="btn btn-danger buttonDotStyle" data-toggle="tooltip" data-placement="right" title="Excluir" onclick="confirmDelete('<?= $doctorTypeId ?>'); lockInteraction();">
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

                <!--########################## MODAL NOVA MENSAGEEM ##################################-->

                <div class="modal modal-default fade" id="myModalNewTypeDoc">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" id="closeModal" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" style="color: #000;">×</span>
                                </button>
                                <h4 class="modal-title">Informações para a Nova Especialidade</h4>
                            </div>
                            <form method="POST" id="formNewDoctorType">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <label>Nome da Especialidade:</label>
                                                <input type="text" class="form-control inputDotStyle" style="text-transform: uppercase;" name="doctorTypeName"></input>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <button type="submit" name="insertDoctorType" class="btn btn-info" style="width: 100%; height: 50px;">
                                                    <i class="glyphicon glyphicon-floppy-save"></i>
                                                    &nbsp;<b>Salvar Nova Especialidade</b>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <script>
                    var closeButton = document.getElementById('closeModal');
                    var modal = document.getElementById('myModalNewTypeDoc');

                    modal.addEventListener('click', function(event) {
                        event.stopPropagation();
                    });

                    closeButton.addEventListener('click', function() {
                        // Fecha o modal usando o Bootstrap
                        $('#myModalNewTypeDoc').modal('hide');
                    });

                    // Quando o modal for fechado
                    $('#myModalNewTypeDoc').on('hidden.bs.modal', function() {
                        location.reload(); // Recarrega a página ao fechar o modal
                    });
                </script>


            </div><!-- /.col -->
        </div><!-- /.row -->
    </section>

<?php
    include('pages/doctors/scriptListDoctorType.php');

    loaderVerification();
}
?>