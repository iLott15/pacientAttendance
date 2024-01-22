<?php
if (userPermission($_SESSION['userId']) == 15) {
?>
    <!-- Main content -->
    <section class="content container-fluid">

        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <i class="fa fa-bars"></i>
                        <h3 class="box-title">Quantidade de Médicos por Tipo</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th width="30%;" style="text-align:center">Tipo</th>
                                    <th width="70%;" style="text-align:center">Ativo | Inativo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $queryCountUsers = $mySQL->sql("SELECT userType,
                                                                    SUM(CASE WHEN userStatus = 1 THEN 1 ELSE 0 END) AS countAt,
                                                                    SUM(CASE WHEN userStatus = 0 THEN 1 ELSE 0 END) AS countIn
                                                                FROM users
                                                                GROUP BY userType
                                                            ");

                                while ($dataUser = mysqli_fetch_array($queryCountUsers)) {
                                    $countAtivo = $dataUser['countAt'];
                                    $countInativo = $dataUser['countIn'];

                                    $textAt = '<span class="badge bg-green" title="Ativos">' . $countAtivo . '</span>';
                                    $textIn = '<span class="badge bg-red" title="Inativos">' . $countInativo . '</span>';
                                ?>
                                    <tr>
                                        <td width="30%;" align="center"><?= translateUserType($dataUser['userType']) ?></td>
                                        <td width="70%;" align="center"><?= $textAt . " | " . $textIn ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <!-- ./col -->
                    <div class="col-xs-6">
                        <!-- small box -->
                        <div class="small-box">
                            <div class="inner">
                                <?php
                                $queryCount = $mySQL->sql("SELECT userType,
                                                                SUM(CASE WHEN userType = 'pacient' THEN 1 ELSE 0 END) AS countPacient,
                                                                SUM(CASE WHEN userType = 'doctor' THEN 1 ELSE 0 END) AS countDoctor
                                                            FROM users
                                                            WHERE userType IN ('pacient', 'doctor') 
                                                            AND userStatus = 1
                                                        ");
                                $dataCount = mysqli_fetch_array($queryCount);
                                ?>
                                <h3 style="margin-top: 5px"><?= $dataCount['countPacient'] ?></h3>
                                <p>Total Geral de Pacientes</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-xs-6">
                        <!-- small box -->
                        <div class="small-box">
                            <div class="inner">
                                <h3 style="margin-top: 5px"><?= $dataCount['countDoctor'] ?></h3>
                                <p>Total Geral de Doutores</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-user-md"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
            </div>

            <section class="connectedSortable">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-info" style="box-shadow: 2px 4px 8px rgba(0, 0, 0, 0.1)">
                            <div class="box-header with-border">
                                <i class="fa fa-clock-o"></i>
                                <h3 class="box-title">Espaço para criar algo</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">

                                </div><!-- /.row -->
                            </div>
                        </div>
                    </div>
            </section>
        </div>

    </section>

<?php
}
?>