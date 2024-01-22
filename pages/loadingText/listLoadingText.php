<?php
if ($action == "listLoadingText") {
    if (userPermission($_SESSION['userId']) < 14) {
?>
        <script>
            window.location = 'error.php?action=001';
        </script>
    <?php
    }
    ?>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <i class="fa fa-bars"></i>
                        <h3 class="box-title">Lista de Mensagem</h3>
                    </div>
                    <div class="box-header">
                        <a href="#myModalNewText" data-toggle="modal" style="margin-bottom: 10px;">
                            <button class="btn btn-block btn-primary buttonDotStyleFull">
                                <font color="#fff">
                                    <i class="fa fa-plus-square"></i> &nbsp;Nova Mensagem
                                </font>
                            </button>
                        </a>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-striped tableStyle">
                            <thead style="background-color: #bbdaf2;">
                                <tr>
                                    <th style="text-align: center">Mensagem</th>
                                    <th style="text-align: center">Autor</th>
                                    <th style="text-align: center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $queryText = $mySQL->sql("SELECT *
                                                        FROM loading_texts
                                                        ORDER BY loadingTextId DESC");
                                while ($data = mysqli_fetch_array($queryText)) {
                                ?>
                                    <tr>
                                        <td>
                                            <?= $data['loadingTextDescription'] ?>
                                        </td>
                                        <td align="center">
                                            <?= $data['loadingTextActor'] ?>
                                        </td>
                                        <td align="center">
                                            <div>
                                                <a href="loadingText.php?action=editLoadingText&loadingTextId=<?= $data['loadingTextId'] ?>" title="Editar Mensagem">
                                                    <button class="btn btn-default buttonDotStyle">
                                                        <i class="ph ph-pencil-simple"></i>
                                                    </button>
                                                </a>
                                                <a href="loadingText.php?action=deleteLoadingText&loadingTextId=<?= $data['loadingTextId'] ?>" title="Excluir Mensagem" onClick="return confirm('Tem certeza que quer deletar a mensagem?');">
                                                    <button class="btn btn-danger buttonDotStyle">
                                                        <i class="ph ph-trash-simple"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>

                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->

    <!--########################## MODAL NOVA MENSAGEEM ##################################-->

    <div class="modal modal-default fade" id="myModalNewText">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Informações para a Nova Mensagem</h4>
                </div>
                <form method="POST" action="loadingText.php?action=insertLoadingText">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>Mensagem</label>
                                    <textarea class="form-control" name="loadingTextDescription" rows="3" cols="15"></textarea>
                                </div>
                            </div>

                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>Autor</label>
                                    <input type="text" class="form-control" name="loadingTextActor" placeholder="Digite o nome do autor" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" name="insertLoadingText" class="btn btn-info" style="width: 100%; height: 50px;">
                                        Salvar informações sobre a Nova Mensagem
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
}
?>