<?php
if ($action == "editLoadingText") {
    if (userPermission($_SESSION['userId']) < 14) {
?>
        <script>
            window.location = 'error.php?action=001';
        </script>
    <?php
    }
    $loadingTextId = mysqli_real_escape_string($mySQL->link, $_GET['loadingTextId']);

    $queryLT = $mySQL->sql("SELECT loadingTextDescription, loadingTextActor
                            FROM loading_texts
                            WHERE loadingTextId = '" . $loadingTextId . "'
                        ");
    $dataLT = mysqli_fetch_array($queryLT);


    ?>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Editar Mensagem</h3>
                        <a href="loadingText.php?action=listLoadingText"><button type="button" class="btn btn-info pull-right" data-toggle="tooltip" data-placement="left" title="Voltar"><i class="fa fa-angle-left"></i>&nbsp;Voltar</button></a>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <form method="POST" action="loadingText.php?action=updateLoadingText">

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label>Mensagem</label>
                                            <textarea class="form-control" name="loadingTextDescription" rows="3" cols="15"><?= $dataLT['loadingTextDescription'] ?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label>Autor</label>
                                            <input type="text" class="form-control" name="loadingTextActor" placeholder="Digite o nome do autor" autocomplete="off" value="<?= $dataLT['loadingTextActor'] ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="hidden" name="loadingTextId" value="<?= $loadingTextId ?>">
                                            <button type="submit" name="updateLoadingText" class="btn btn-info" style="width: 100%; height: 50px;">
                                                Atualizar Mensagem
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
}
?>