<?php
if ($action == "editUser") {
    if (userPermission($_SESSION['userId']) < 14) {
?>
        <script>
            window.location = 'error.php?action=001';
        </script>
    <?php
    }
    ?>

    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>

    <?php
    include('pages/users/includes/updateUserPassword.php');

    $userId = mysqli_real_escape_string($mySQL->link, $_GET['userId']);

    $queryUsers = $mySQL->sql("SELECT * from users where userId = '" . $userId . "'");
    $dataUser = mysqli_fetch_array($queryUsers);

    $queryDoctor = $mySQL->sql("SELECT dt.doctorTypeId, d.doctorDateBegin, d.doctorDateEnd
                                FROM doctor_types as dt 
                                INNER JOIN doctors as d on dt.doctorTypeId = d.doctorTypeId 
                                where d.doctorUserId = '" . $userId . "'");
    $dataDoctor = mysqli_fetch_array($queryDoctor);

    $queryPacient = $mySQL->sql("SELECT * from pacients where pacientUserId = '" . $userId . "'");
    $dataPacient = mysqli_fetch_array($queryPacient);
    ?>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <form method="POST" id="formEditUser">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-xs-12">
                            <!-- Horizontal Form -->
                            <div class="box box-primary boxStyle">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Informações para cadastro do Novo Usuário</h3>
                                    <a href="users.php?action=listUser">
                                        <button type="button" class="btn btn-info pull-right buttonStyle" data-toggle="tooltip" data-placement="left" title="Voltar">
                                            <i class="fa fa-angle-left"></i>&nbsp;Voltar
                                        </button>
                                    </a>
                                    <button type="button" onclick="copyText()" name="copyCPF" class="btn btn-default pull-right" data-toggle="tooltip" data-placement="left" title="Copiar CPF">
                                        <i class="fa fa-copy"></i>&nbsp;Copiar CPF
                                    </button>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-xs-2">
                                            <label>Senha:</label>
                                            <a href="users.php?action=editUser&userId=<?= $dataUser['userId'] ?>&resetUserPassword=1" onclick="return confirm('Deseja realmente resetar a senha desse usuário? A nova senha desse usuário será seu CPF sem os caracteres especiais!');">Resetar senha?</a>
                                        </div>

                                        <div class="col-xs-2">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <font style="color: red; font-size: 14px;"><b>*</b></font></label><br>
                                                <label class="radio-label">
                                                    <input type="radio" name="userStatus" id="userStatusEdit1" value="1" <?= $dataUser['userStatus'] == '1' ? 'checked' : '' ?>>
                                                    Ativo&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" name="userStatus" id="userStatusEdit2" value="0" <?= $dataUser['userStatus'] == '0' ? 'checked' : '' ?>>
                                                    Inativo
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-xs-2">
                                            <div class="form-group">
                                                <label>Tipo de Usuário<font style="color: red; font-size: 14px;"><b>*</b></font></label>
                                                <select class="form-control inputDotStyle" name="userType" id="userTypeEdit" required>
                                                    <option value="" <?= $dataUser['userType'] == '' ? 'selected' : '' ?>>
                                                        Escolha o tipo do usuário...
                                                    </option>
                                                    <option id="superAdminEdit" value="superAdmin" <?= $dataUser['userType'] == 'superAdmin' ? 'selected' : '' ?>>
                                                        Super Administrador
                                                    </option>
                                                    <option id="doctorEdit" value="doctor" <?= $dataUser['userType'] == 'doctor' ? 'selected' : '' ?>>
                                                        Doutor/Médico
                                                    </option>
                                                    <option id="pacientEdit" value="pacient" <?= $dataUser['userType'] == 'pacient' ? 'selected' : '' ?>>
                                                        Paciente
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- ######################### INPUTS SUPERADMIN/ADMIN ######################### -->
                                        <div class="col-xs-2" id="divAdminEdit" style="display: none;">
                                            <div class="form-group">
                                                <label>Status do Administrador</label>
                                                <font style="color: red; font-size: 14px;"><b>*</b></font></label><br>
                                                <label class="radio-label">
                                                    <input type="radio" name="adminStatus" id="adminStatus1Edit" value="1" checked>
                                                    Ativo&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" name="adminStatus" id="adminStatus0Edit" value="0">
                                                    Inativo
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-xs-2" id="divAdminDateBeginEdit" style="display: none;">
                                            <div class="form-group">
                                                <label>Data Inicial:</label>
                                                <font style="color: red; font-size: 14px;"><b>*</b></font></label><br>
                                                <input type="date" class="form-control inputDotStyle" max="<?= date('Y-m-d') ?>" id="adminDateBeginEdit" name="adminDateBegin" value="">
                                            </div>
                                        </div>

                                        <div class="col-xs-2" id="divAdminDateEndEdit" style="display: none;">
                                            <div class="form-group">
                                                <label>Data Final:</label>
                                                <input type="date" class="form-control inputDotStyle" min="<?= date('Y-m-d') ?>" id="adminDateEndEdit" name="adminDateEnd" value="">
                                            </div>
                                        </div>

                                        <!-- ######################### INPUTS DOCTOR ######################### -->
                                        <div class="col-xs-2" id="divDoctorStatusEdit" style="display: none;">
                                            <div class="form-group">
                                                <label>Status do Médico</label>
                                                <font style="color: red; font-size: 14px;"><b>*</b></font></label><br>
                                                <label class="radio-label">
                                                    <input type="radio" name="doctorStatus" id="doctorStatus1Edit" value="1" checked>
                                                    Ativo&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" name="doctorStatus" id="doctorStatus0Edit" value="0">
                                                    Inativo
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-xs-3" id="divDoctorEdit" style="display: none;">
                                            <div class="form-group">
                                                <label>Especialidade</label>
                                                <font style="color: red; font-size: 14px;"><b>*</b></font></label><br>
                                                <select class="form-control inputDotStyle" name="doctorTypeId" id="doctorTypeIdEdit">
                                                    <option value="">Selecione a Especialidade...</option>
                                                    <?php
                                                    $queryDoc = $mySQL->sql("SELECT * FROM doctor_types ORDER BY doctorTypeName");
                                                    while ($dataDoc = mysqli_fetch_array($queryDoc)) {
                                                    ?>
                                                        <option value="<?= $dataDoc['doctorTypeId'] ?>" <?= $dataDoc['doctorTypeId'] == $dataDoctor['doctorTypeId'] ? 'selected' : '' ?>><?= $dataDoc['doctorTypeName'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xs-2" id="divDoctorDateBeginEdit" style="display: none;">
                                            <div class="form-group">
                                                <label>Data Inicial:</label>
                                                <font style="color: red; font-size: 14px;"><b>*</b></font></label><br>
                                                <input type="date" class="form-control inputDotStyle" max="<?= date('Y-m-d') ?>" id="doctorDateBeginEdit" name="doctorDateBegin" value="<?= $dataDoctor['doctorDateBegin'] ?>">
                                            </div>
                                        </div>

                                        <div class="col-xs-2" id="divDoctorDateEndEdit" style="display: none;">
                                            <div class="form-group">
                                                <label>Data Final:</label>
                                                <font style="color: red; font-size: 14px;"><b>*</b></font></label><br>
                                                <input type="date" class="form-control inputDotStyle" min="<?= date('Y-m-d') ?>" id="doctorDateEndEdit" name="doctorDateEnd" value="<?= $dataDoctor['doctorDateEnd'] ?>">
                                            </div>
                                        </div>

                                        <!-- ######################### INPUTS PACIENTS ######################### -->
                                        <div class="col-xs-2" id="divPacientStatusDiv" style="display: none;">
                                            <div class="form-group">
                                                <label>Status do Paciente:</label>
                                                <font style="color: red; font-size: 14px;"><b>*</b></font></label><br>
                                                <label class="radio-label">
                                                    <input type="radio" name="pacientStatus" id="pacientStatus1Edit" value="1" checked>
                                                    Ativo&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" name="pacientStatus" id="pacientStatus0Edit" value="0">
                                                    Inativo
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-xs-3" id="divPacientEdit" style="display: none;">
                                            <div class="form-group">
                                                <label>Médico de atendimento:</label>
                                                <font style="color: red; font-size: 14px;"><b>*</b></font></label><br>
                                                <select class="form-control inputDotStyle" name="doctorId" id="doctorIdEdit">
                                                    <option value="">Selecione o Médico...</option>
                                                    <?php
                                                    $queryDocUser = $mySQL->sql("SELECT d.doctorId, dt.doctorTypeName, u.userName 
                                                                                FROM doctors as d
                                                                                inner join doctor_types as dt on d.doctorTypeId = dt.doctorTypeId
                                                                                inner join users as u on d.doctorUserId = u.userId
                                                                                and d.doctorStatus = 1
                                                                                ORDER BY u.userName");
                                                    while ($dataDocUser = mysqli_fetch_array($queryDocUser)) {
                                                    ?>
                                                        <option value="<?= $dataDocUser['doctorTypeId'] ?>" <?= $dataDocUser['doctorTypeId'] == $dataPacient['pacientDoctorId'] ? 'selected' : '' ?>>
                                                            <?= $dataDocUser['userName'] . ' - ' . $dataDocUser['doctorTypeName'] ?>
                                                        </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xs-2" id="divPacientDateBeginEdit" style="display: none;">
                                            <div class="form-group">
                                                <label>Data Inicial:</label>
                                                <font style="color: red; font-size: 14px;"><b>*</b></font></label><br>
                                                <input type="date" class="form-control inputDotStyle" max="<?= date('Y-m-d') ?>" id="pacientDateBeginEdit" name="pacientDateBegin" value="<?= $dataPacient['pacientDateBegin'] ?>">
                                            </div>
                                        </div>

                                        <div class="col-xs-2" id="divPacientDateEndEdit" style="display: none;">
                                            <div class="form-group">
                                                <label>Data Final:</label>
                                                <font style="color: red; font-size: 14px;"><b>*</b></font></label><br>
                                                <input type="date" class="form-control inputDotStyle" min="<?= date('Y-m-d') ?>" id="pacientDateEndEdit" name="pacientDateEnd" value="<?= $dataPacient['pacientDateEnd'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ###################### FIM DE INPUTS DO TIPOS DE USERS ###################### -->



                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="form-group">
                                                <label>Nome Completo<font style="color: red; font-size: 14px;"><b>*</b></font></label>
                                                <input type="text" class="form-control inputDotStyle" style="text-transform: uppercase;" name="userName" title="Digite o Nome completo." placeholder="Nome do Usuário" required id="userNameEdit" value="<?= $dataUser['userName'] ?>">
                                            </div>
                                        </div>

                                        <div class="col-xs-2">
                                            <div class="form-group">
                                                <label>Data de Nascimento<font style="color: red; font-size: 14px;"><b>*</b></font></label>
                                                <input type="date" class="form-control inputDotStyle" name="userBorn" id="userBornEdit" max="9999-12-31" title="Informe a data de nascimento, campo obrigatório!" required value="<?= $dataUser['userBorn'] ?>">
                                            </div>
                                        </div>

                                        <div class="col-xs-4">
                                            <div class="form-group">
                                                <label>E-mail</label>
                                                <font style="color: red; font-size: 14px;"><b>*</b></font>
                                                <input type="email" class="form-control inputDotStyle" name="userMail" title="Digite um email válido" id="userMail" onchange="verificarEmail()" placeholder="DIGITE UM EMAIL VÁLIDO" value="<?= $dataUser['userMail'] ?>">
                                            </div>
                                        </div>

                                        <div class="col-xs-2">
                                            <div class="form-group">
                                                <label>CPF<font style="color: red; font-size: 14px;"><b>*</b></font></label>
                                                <input maxlength="14" type="text" class="form-control inputDotStyle" name="userCPF" data-inputmask="&quot;mask&quot;: &quot;999.999.999-99&quot;" data-mask="" placeholder="___.___.___-__" id="userCPFEdit" required value="<?= $dataUser['userCPF'] ?>">
                                            </div>
                                        </div>

                                        <div class="col-xs-2">
                                            <div class="form-group">
                                                <label>RG</label>
                                                <input maxlength="12" type="text" class="form-control inputDotStyle" name="userRG" data-inputmask='"mask": "&quot;mask&quot;: &quot;99.999.999-9&quot;"' data-mask="" placeholder="_.___.___-_" id="userRGEdit" value="<?= $dataUser['userRG'] ?>">
                                            </div>
                                        </div>

                                        <div class="col-xs-4">
                                            <label>Unidade Federal</label>
                                            <select class="form-control inputDotStyle" name="userUF" id="userUFEdit">
                                                <option value="">Informe o Estado emissor...</option>
                                                <?php
                                                $queryEstados = $mySQL->sql("SELECT * FROM estados ORDER BY nome ");
                                                while ($dateEstado = mysqli_fetch_array($queryEstados)) {
                                                ?>
                                                    <option value="<?= $dateEstado['id'] ?>" <?= $dataUser['userUF'] == $dateEstado['id'] ? 'selected' : '' ?>>
                                                        <?= $dateEstado['nome'] ?>
                                                    </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-xs-4">
                                            <label>Orgão Emissor</label>
                                            <select class="form-control inputDotStyle" name="userOrgan" id="userOrganEdit">
                                                <option value="" <?= $dataUser['userOrgan'] == '' ? 'selected' : '' ?>>
                                                    Selecione o Orgão emissor...
                                                </option>
                                                <option value="SSP" <?= $dataUser['userOrgan'] == 'SSP' ? 'selected' : '' ?>>
                                                    SSP - Secretaria de Segurança Pública
                                                </option>
                                                <option value="COREN" <?= $dataUser['userOrgan'] == 'COREN' ? 'selected' : '' ?>>
                                                    COREN - Conselho Regional de Enfermagem
                                                </option>
                                                <option value="CRA" <?= $dataUser['userOrgan'] == 'CRA' ? 'selected' : '' ?>>
                                                    CRA - Conselho Regional de Administração
                                                </option>
                                                <option value="CRAS" <?= $dataUser['userOrgan'] == 'CRAS' ? 'selected' : '' ?>>
                                                    CRAS - Con selho Regional de Assistentes Sociais
                                                </option>
                                                <option value="CRB" <?= $dataUser['userOrgan'] == 'CRB' ? 'selected' : '' ?>>
                                                    CRB - Conselho Regional de Biblioteconomia
                                                </option>
                                                <option value="CRC" <?= $dataUser['userOrgan'] == 'CRC' ? 'selected' : '' ?>>
                                                    CRC - Conselho Regional de Contabilidade
                                                </option>
                                                <option value="CRE" <?= $dataUser['userOrgan'] == 'CRE' ? 'selected' : '' ?>>
                                                    CRE - Conselho Regional de Estatística
                                                </option>
                                                <option value="CREA" <?= $dataUser['userOrgan'] == 'CREA' ? 'selected' : '' ?>>
                                                    CREA - Conselho Regional de Engenharia Arquitetura e Agronomia
                                                </option>
                                                <option value="CRECI" <?= $dataUser['userOrgan'] == 'CRECI' ? 'selected' : '' ?>>
                                                    CRECI - Conselho Regional de Corretores de Imóveis
                                                </option>
                                                <option value="CREFIT" <?= $dataUser['userOrgan'] == 'CREFIT' ? 'selected' : '' ?>>
                                                    CREFIT - Conselho Regional de Fisioterapia e Terapia Ocupacional
                                                </option>
                                                <option value="CRF" <?= $dataUser['userOrgan'] == 'CRF' ? 'selected' : '' ?>>
                                                    CRF - Conselho Regional de Farmácia
                                                </option>
                                                <option value="CRM" <?= $dataUser['userOrgan'] == 'CRM' ? 'selected' : '' ?>>
                                                    CRM - Conselho Regional de Medicina
                                                </option>
                                                <option value="CRN" <?= $dataUser['userOrgan'] == 'CRN' ? 'selected' : '' ?>>
                                                    CRN - Conselho Regional de Nutrição
                                                </option>
                                                <option value="CRO" <?= $dataUser['userOrgan'] == 'CRO' ? 'selected' : '' ?>>
                                                    CRO - Conselho Regional de Odontologia
                                                </option>
                                                <option value="CRP" <?= $dataUser['userOrgan'] == 'CRP' ? 'selected' : '' ?>>
                                                    CRP - Conselho Regional de Psicologia
                                                </option>
                                                <option value="CRPRE" <?= $dataUser['userOrgan'] == 'CRPRE' ? 'selected' : '' ?>>
                                                    CRPRE - Conselho Regional de Profissionais de Relações Públicas
                                                </option>
                                                <option value="CRQ" <?= $dataUser['userOrgan'] == 'CRQ' ? 'selected' : '' ?>>
                                                    CRQ - Conselho Regional de Química
                                                </option>
                                                <option value="CRRC" <?= $dataUser['userOrgan'] == 'CRRC' ? 'selected' : '' ?>>
                                                    CRRC - Conselho Regional de Representantes Comerciais
                                                </option>
                                                <option value="CRMV" <?= $dataUser['userOrgan'] == 'CRMV' ? 'selected' : '' ?>>
                                                    CRMV - Conselho Regional de Medicina Veterinária
                                                </option>
                                                <option value="DPF" <?= $dataUser['userOrgan'] == 'DPF' ? 'selected' : '' ?>>
                                                    DPF - Polícia Federal
                                                </option>
                                                <option value="EST" <?= $dataUser['userOrgan'] == 'EST' ? 'selected' : '' ?>>
                                                    EST - Documentos Estrangeiros
                                                </option>
                                                <option value="I CLA" <?= $dataUser['userOrgan'] == 'I CLA' ? 'selected' : '' ?>>
                                                    I CLA - Carteira de Identidade Classista
                                                </option>
                                                <option value="MAE" <?= $dataUser['userOrgan'] == 'MAE' ? 'selected' : '' ?>>
                                                    MAE - Ministério da Aeronáutica
                                                </option>
                                                <option value="MEX" <?= $dataUser['userOrgan'] == 'MEX' ? 'selected' : '' ?>>
                                                    MEX - Ministério do Exército
                                                </option>
                                                <option value="MMA" <?= $dataUser['userOrgan'] == 'MMA' ? 'selected' : '' ?>>
                                                    MMA - Ministério da Marinha
                                                </option>
                                                <option value="OAB" <?= $dataUser['userOrgan'] == 'OAB' ? 'selected' : '' ?>>
                                                    OAB - Ordem dos Advogados do Brasil
                                                </option>
                                                <option value="OMB" <?= $dataUser['userOrgan'] == 'OMB' ? 'selected' : '' ?>>
                                                    OMB - Ordens dos Músicos do Brasil
                                                </option>
                                                <option value="IFP" <?= $dataUser['userOrgan'] == 'IFP' ? 'selected' : '' ?>>
                                                    IFP - Instituto de Identificação Félix Pacheco
                                                </option>
                                                <option value="OUT" <?= $dataUser['userOrgan'] == 'OUT' ? 'selected' : '' ?>>
                                                    OUT - Outros Emissores
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col-xs-2">
                                            <div class="form-group">
                                                <label>Telefone</label>
                                                <font style="color: red; font-size: 14px;"><b>*</b></font>
                                                <input maxlength="15" type="text" class="form-control inputDotStyle" name="userPhone" data-inputmask='"mask": "(99) 99999-9999"' data-mask="" placeholder="(__) _____-____" required id="userPhoneEdit" value="<?= $dataUser['userPhone'] ?>">
                                            </div>
                                        </div>

                                        <div class="col-xs-4">
                                            <div class="form-group">
                                                <label>Nome Completo do Pai</label>
                                                <input type="text" class="form-control inputDotStyle" style="text-transform: uppercase;" id="userNameFatherEdit" name="userNameFather" title="Digite o Nome completo do Pai." placeholder="Nome completo do Pai" value="<?= $dataUser['userNameFather'] ?>">
                                            </div>
                                        </div>

                                        <div class="col-xs-2">
                                            <div class="form-group">
                                                <label>Telefone do Pai</label>
                                                <input maxlength="15" type="text" class="form-control inputDotStyle" name="userFatherPhone" data-inputmask='"mask": "(99) 99999-9999"' data-mask="" placeholder="(__) _____-____" id="userFatherPhoneEdit" value="<?= $dataUser['userFatherPhone'] ?>">
                                            </div>
                                        </div>

                                        <div class="col-xs-4">
                                            <div class="form-group">
                                                <label>Nome Completo da Mãe</label>
                                                <input type="text" class="form-control inputDotStyle" style="text-transform: uppercase;" name="userNameMother" id="userNameMotherEdit" title="Digite o Nome completo da Mãe." placeholder="Nome completo da Mãe" value="<?= $dataUser['userNameMother'] ?>">
                                            </div>
                                        </div>

                                        <div class="col-xs-2">
                                            <div class="form-group">
                                                <label>Telefone da Mãe</label>
                                                <input maxlength="15" type="text" class="form-control inputDotStyle" name="userMotherPhone" data-inputmask='"mask": "(99) 99999-9999"' data-mask="" placeholder="(__) _____-____" id="userMotherPhoneEdit" value="<?= $dataUser['userMotherPhone'] ?>">
                                            </div>
                                        </div>

                                        <div class="col-xs-3">
                                            <div class="form-group">
                                                <label>Nacionalidade:</label>
                                                <select class="form-control inputDotStyle" id="userNationalityEdit" name="userNationality" title="Nacionalidade">
                                                    <option value="">Selecione um país...</option>
                                                    <?php
                                                    $queryCountry = $mySQL->sql("SELECT * FROM pais");
                                                    while ($dataCountry = mysqli_fetch_array($queryCountry)) {
                                                    ?>
                                                        <option value="<?= $dataCountry['paisId'] ?>" <?= $dataUser['userNationality'] == $dataCountry['paisId'] ? 'selected' : '' ?>>
                                                            <?= $dataCountry['paisNome'] ?>
                                                        </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xs-3">
                                            <div class="form-group">
                                                <label>Estado: <small>(Apenas para Brasil)</small></label>
                                                <select class="form-control inputDotStyle" id="userNaturalityEdit" name="userNaturality" title="Estado">
                                                    <option value="">Selecione o estado...</option>
                                                    <?php
                                                    $queryState = $mySQL->sql("SELECT * FROM estados");
                                                    while ($dataState = mysqli_fetch_array($queryState)) {
                                                    ?>
                                                        <option value="<?= $dataState['id'] ?>" <?= $dataUser['userNaturality'] == $dataState['id'] ? 'selected' : '' ?>>
                                                            <?= $dataState['nome'] ?> - <?= $dataState['sigla'] ?>
                                                        </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xs-4">
                                            <div class="form-group">
                                                <label>Cidade: <small>(Apenas para Brasil)</small></label>
                                                <select class="form-control inputDotStyle select2-search__field" id="userAddressCityEdit" name="userAddressCity" title="Estado">
                                                    <option value="">Selecione a cidade...</option>
                                                    <?php
                                                    $queryCity = $mySQL->sql("SELECT * FROM cidades order by nome");
                                                    while ($dataCity = mysqli_fetch_array($queryCity)) {
                                                    ?>
                                                        <option value="<?= $dataCity['id'] ?>" <?= $dataUser['userAddressCity'] == $dataCity['id'] ? 'selected' : '' ?>>
                                                            <?= $dataCity['nome'] ?>
                                                        </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xs-2">
                                            <div class="form-group">
                                                <label>CEP</label>
                                                <input type="number" class="form-control inputDotStyle" style="text-transform: uppercase;" name="userAddressCEP" id="userAddressCEPEdit" title="Digite o CEP" data-inputmask='"mask": "99.999-999"' data-mask="" placeholder="__.___-___" maxlength="10" value="<?= $dataUser['userAddressCEP'] ?>">
                                            </div>
                                        </div>

                                        <script>
                                            // Função para preencher os campos com os dados do CEP
                                            function fillAddressFields(data) {
                                                document.getElementsByName("userAddressStreet")[0].value = data.logradouro;
                                                document.getElementsByName("userAddressNumber")[0].value = "";
                                                document.getElementsByName("userAddressDistrict")[0].value = data.bairro;
                                            }

                                            // Função para buscar informações do CEP na API ViaCEP
                                            function getAddressDataByCEP(cep) {
                                                const url = `https://viacep.com.br/ws/${cep}/json/`;

                                                fetch(url)
                                                    .then(response => response.json())
                                                    .then(data => {
                                                        if (!data.erro) {
                                                            fillAddressFields(data);
                                                        } else {
                                                            // Caso o CEP seja inválido ou não encontrado
                                                            alert("CEP inválido ou não encontrado!");
                                                        }
                                                    })
                                                    .catch(error => console.error("Erro ao buscar CEP:", error));
                                            }

                                            // Event listener para monitorar a digitação do CEP
                                            document.getElementsByName("userAddressCEP")[0].addEventListener("blur", function(event) {
                                                const cep = event.target.value.replace(/\D/g, ""); // Remove caracteres não numéricos
                                                if (cep.length === 8) {
                                                    getAddressDataByCEP(cep);
                                                }
                                            });
                                        </script>


                                        <div class="col-xs-2">
                                            <div class="form-group">
                                                <label>Bairro</label>
                                                <input type="text" class="form-control inputDotStyle" style="text-transform: uppercase;" name="userAddressDistrict" id="userAddressDistrictEdit" placeholder="Bairro" value="<?= $dataUser['userAddressDistrict'] ?>">
                                            </div>
                                        </div>

                                        <div class="col-xs-4">
                                            <div class="form-group">
                                                <label>Rua</label>
                                                <input type="text" class="form-control inputDotStyle" style="text-transform: uppercase;" name="userAddressStreet" id="userAddressStreetEdit" placeholder="Rua" value="<?= $dataUser['userAddressStreet'] ?>">
                                            </div>
                                        </div>

                                        <div class="col-xs-2">
                                            <div class="form-group">
                                                <label>Nº</label>
                                                <input type="number" class="form-control inputDotStyle" style="text-transform: uppercase;" name="userAddressNumber" id="userAddressNumberEdit" title="Digite o Número" placeholder="Número" value="<?= $dataUser['userAddressNumber'] ?>">
                                            </div>
                                        </div>

                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <label>Complemento</label>
                                                <input type="text" class="form-control inputDotStyle" style="text-transform: uppercase;" name="userAddressComplement" id="userAddressComplementEdit" placeholder="Complemento" value="<?= $dataUser['userAddressComplement'] ?>">
                                            </div>
                                        </div>

                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <label>Observações</label>
                                                <textarea class="form-control inputDotStyle" name="userObs" id="userObsEdit" cols="30" rows="10"> <?= $dataUser['userObs'] ?></textarea>

                                            </div>
                                        </div>

                                        <div class="col-xs-12">
                                            <input type="hidden" name="userId" id="userIdEdit" value="<?= $userId ?>">
                                            <button type="submit" class="btn btn-info pull-right buttonDotStyleFull">
                                                <i class="glyphicon glyphicon-floppy-save"></i>
                                                &nbsp;<b>Atualizar Informações</b>
                                            </button>
                                        </div>
                                    </div><!-- /.row-->
                                </div><!--/.col (left) -->
                            </div> <!-- /.row -->
                        </div><!-- /.col-xs-12 -->
                    </div><!-- /.row -->
                </form><!-- /.form -->
            </div><!-- /.box-body -->
        </div><!-- /.box -->
        <?php include('pages/users/includes/scriptEditUser.php'); ?>
    </section><!-- /.content -->

    <script>
        //MÁSCARA CPF INPUT
        $(document).ready(function() {
            $('#userCPFEdit').mask('000.000.000-00');
        });

        // MÁSCARA RG INPUT
        $(document).ready(function() {
            $('#userRGEdit').mask('00.000.000-0');
        });

        // MÁSCARA CEP INPUT
        $(document).ready(function() {
            $('#userCEPEdit').mask('99999-999');
        });
    </script>

<?php
    loaderVerification();
}
?>