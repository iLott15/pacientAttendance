<?php
if ($action == "editDoctorType") {
    if (userPermission($_SESSION['userId']) < 14) {
?>
        <script>
            window.location = 'error.php?action=001';
        </script>
    <?php
    }
    $doctorTypeId = mysqli_real_escape_string($mySQL->link, $_GET['doctorTypeId']);

    $queryDT = $mySQL->sql("SELECT doctorTypeName
                            FROM doctor_types
                            WHERE doctorTypeId = '" . $doctorTypeId . "'
                        ");
    $dataDT = mysqli_fetch_array($queryDT);


    ?>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Editar Especialidade</h3>
                        <a href="doctors.php?action=listDoctorType">
                            <button type="button" class="btn btn-info pull-right" data-toggle="tooltip" data-placement="left" title="Voltar">
                                <i class="fa fa-angle-left"></i>&nbsp;Voltar
                            </button>
                        </a>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <form  method="POST" id="formEditDoctorType">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label>Especialidade</label>
                                            <input type="text" class="form-control" name="doctorTypeName" placeholder="Digite o nome da Especialidade" autocomplete="off" value="<?= $dataDT['doctorTypeName'] ?>" style="text-transform: uppercase;">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="hidden" name="doctorTypeId" value="<?= $doctorTypeId ?>">
                                            <button type="submit" name="updateDoctorType" class="btn btn-info" style="width: 100%; height: 50px;">
                                                Atualizar Especialidade
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
<?php
include('pages/doctors/includes/scriptEditDoctorType.php');
}
?>