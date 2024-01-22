<?php
if (userPermission($_SESSION['userId']) == 2) {
?>
    <!-- Main content -->
    <section class="content container-fluid">

        <div class="row">
            <div class="col-md-6">

                <div class="box">
                    <div class="box-header">
                        <i class="fa fa-bars"></i>
                        <h3 class="box-title">Lista de Pacientes</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th width="30%;" align="center">Nome</th>
                                    <th width="20%;" align="center">Contato</th>
                                    <th width="20%;" align="center">Status</th>
                                    <th width="10%;" align="center">Horário</th>
                                    <th width="20%;" align="center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td width="30%;" align="center"></td>
                                    <td width="20%;" align="center"></td>
                                    <td width="20%;" align="center"></td>
                                    <td width="10%;" align="center"></td>
                                    <td width="20%;" align="center">
                                        <button type="button" class="btn btn-primary btn-xs btn-flat actionButton1" style="margin-bottom: 3px; width: 90px"><i class="ph ph-pencil-simple"></i> Editar</button>
                                        <button type="button" class="btn btn-danger btn-xs btn-flat actionButton2" style="width: 90px"><i class="ph ph-trash-simple"></i> Desmarcar</button>
                                    </td>
                                </tr>

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
                                <h3 style="margin-top: 5px">44</h3>
                                <p>Total de Pacientes</p>
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
                                <h3 style="margin-top: 5px">15</h3>
                                <p>Pacientes na Semana</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-calendar-check-o"></i>
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
                                <h3 class="box-title">Visualização dos atendimentos do dia</h3>
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