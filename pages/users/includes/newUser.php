<?php
if ($action == "newUser") {
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
    $userId = mysqli_real_escape_string($mySQL->link, $_POST['userId']);
    ?>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <form method="POST" id="formNewUser">
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
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <div class="box-body formBody">
                                    <div class="row">
                                        <div class="col-xs-2">
                                            <div class="form-group">
                                                <label>Status do Usuário:</label>
                                                <font style="color: red; font-size: 14px;"><b>*</b></font></label><br>
                                                <label class="radio-label">
                                                    <input type="radio" name="userStatus" id="userStatus" value="1" checked>
                                                    Ativo&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" name="userStatus" id="userStatus" value="0">
                                                    Inativo
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-xs-3">
                                            <div class="form-group">
                                                <label>Tipo de Usuário:</label>
                                                <font style="color: red; font-size: 14px;"><b>*</b></font> 
                                                <select class="form-control inputDotStyle" name="userType" id="userType" required>
                                                    <option value="">Escolha o tipo do usuário...</option>
                                                    <option id="superAdmin" value="superAdmin">Super Administrador</option>
                                                    <option id="doctor" value="doctor">Doutor/Médico</option>
                                                    <option id="pacient" value="pacient">Paciente</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- ######################### INPUTS SUPERADMIN ######################### -->
                                        <div class="col-xs-2" id="divAdmin" style="display: none;">
                                            <div class="form-group">
                                                <label>Status do Administrador:</label>
                                                <font style="color: red; font-size: 14px;"><b>*</b></font></label><br>
                                                <label class="radio-label">
                                                    <input type="radio" name="adminStatus" id="adminStatus1" value="1" checked>
                                                    Ativo&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" name="adminStatus" id="adminStatus0" value="0">
                                                    Inativo
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-xs-2" id="divAdminDateBegin" style="display: none;">
                                            <div class="form-group">
                                                <label>Data Inicial:</label>
                                                <font style="color: red; font-size: 14px;"><b>*</b></font></label><br>
                                                <input type="date" class="form-control inputDotStyle" max="<?= date('Y-m-d') ?>" id="adminDateBegin" name="adminDateBegin">
                                            </div>
                                        </div>

                                        <div class="col-xs-2" id="divAdminDateEnd" style="display: none;">
                                            <div class="form-group">
                                                <label>Data Final:</label>
                                                <font style="color: red; font-size: 14px;"><b>*</b></font></label><br>
                                                <input type="date" class="form-control inputDotStyle" min="<?= date('Y-m-d') ?>" id="adminDateEnd" name="adminDateEnd">
                                            </div>
                                        </div>

                                        <!-- ######################### INPUTS DOCTOR ######################### -->
                                        <div class="col-xs-2" id="divDoctorStatus" style="display: none;">
                                            <div class="form-group">
                                                <label>Status do Médico:</label>
                                                <font style="color: red; font-size: 14px;"><b>*</b></font></label><br>
                                                <label class="radio-label">
                                                    <input type="radio" name="doctorStatus" id="doctorStatus1" value="1" checked>
                                                    Ativo&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" name="doctorStatus" id="doctorStatus0" value="0">
                                                    Inativo
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-xs-4" id="divDoctor" style="display: none;">
                                            <div class="form-group">
                                                <label>Especialidade:</label>
                                                <font style="color: red; font-size: 14px;"><b>*</b></font></label><br>
                                                <select class="form-control inputDotStyle" name="doctorTypeId" id="doctorTypeId">
                                                    <option value="">Selecione uma Especialidade...</option>
                                                    <?php
                                                    $queryDoc = $mySQL->sql("SELECT * FROM doctor_types ORDER BY doctorTypeName");
                                                    while ($dataDoc = mysqli_fetch_array($queryDoc)) {
                                                    ?>
                                                        <option value="<?= $dataDoc['doctorTypeId'] ?>"><?= $dataDoc['doctorTypeName'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xs-2" id="divDoctorDateBegin" style="display: none;">
                                            <div class="form-group">
                                                <label>Data Inicial:</label>
                                                <font style="color: red; font-size: 14px;"><b>*</b></font></label><br>
                                                <input type="date" class="form-control inputDotStyle" max="<?= date('Y-m-d') ?>" id="doctorDateBegin" name="doctorDateBegin">
                                            </div>
                                        </div>

                                        <div class="col-xs-2" id="divDoctorDateEnd" style="display: none;">
                                            <div class="form-group">
                                                <label>Data Final:</label>
                                                <font style="color: red; font-size: 14px;"><b>*</b></font></label><br>
                                                <input type="date" class="form-control inputDotStyle" min="<?= date('Y-m-d') ?>" id="doctorDateEnd" name="doctorDateEnd">
                                            </div>
                                        </div>

                                        <!-- ######################### INPUTS PACIENTS ######################### -->

                                        <div class="col-xs-2" id="divPacientStatus" style="display: none;">
                                            <div class="form-group">
                                                <label>Status do Paciente:</label>
                                                <font style="color: red; font-size: 14px;"><b>*</b></font></label><br>
                                                <label class="radio-label">
                                                    <input type="radio" name="pacientStatus" id="pacientStatus1" value="1" checked>
                                                    Ativo&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" name="pacientStatus" id="pacientStatus0" value="0">
                                                    Inativo
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-xs-4" id="divPacientDoctor" style="display: none;">
                                            <div class="form-group">
                                                <label>Paciente de:</label>
                                                <font style="color: red; font-size: 14px;"><b>*</b></font></label><br>
                                                <select name="pacientDoctorId" id="pacientDoctorId" class="form-control inputDotStyle">
                                                    <option value="">Selecione um Médico.</option>
                                                    <?php
                                                    $queryPacDoc = $mySQL->sql("SELECT u.userId, u.userName, dt.doctorTypeName
                                                                                FROM users AS u
                                                                                INNER JOIN doctors AS d ON u.userId = d.doctorUserId
                                                                                INNER JOIN doctor_types AS dt ON d.doctorTypeId = dt.doctorTypeId
                                                                                WHERE u.userType = 'doctor'
                                                                                AND d.doctorStatus = 1");
                                                    while ($dataPacDoc = mysqli_fetch_array($queryPacDoc)) {
                                                    ?>
                                                        <option value="<?= $dataPacDoc['userId'] ?>"><?= $dataPacDoc['userName'] . ' - ' . $dataPacDoc['doctorTypeName']?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xs-2" id="divPacientDateBegin" style="display: none;">
                                            <div class="form-group">
                                                <label>Data Inicial:</label>
                                                <font style="color: red; font-size: 14px;"><b>*</b></font></label><br>
                                                <input type="date" class="form-control inputDotStyle" max="<?= date('Y-m-d') ?>" id="pacientDateBegin" name="pacientDateBegin">
                                            </div>
                                        </div>

                                        <div class="col-xs-2" id="divPacientDateEnd" style="display: none;">
                                            <div class="form-group">
                                                <label>Data Final:</label>
                                                <font style="color: red; font-size: 14px;"><b>*</b></font></label><br>
                                                <input type="date" class="form-control inputDotStyle" min="<?= date('Y-m-d') ?>" id="pacientDateEnd" name="pacientDateEnd">
                                            </div>
                                        </div>

                                    </div>

                                    <!-- ######################### END OF INPUTS ADMIN/DOCTOR/PACIENT ######################### -->

                                    <div class="row">
                                        <div class="col-xs-4">
                                            <div class="form-group">
                                                <label>Nome Completo<font style="color: red; font-size: 14px;"><b>*</b></font></label>
                                                <input type="text" class="form-control inputDotStyle" style="text-transform: uppercase;" name="userName" title="Digite o Nome completo." placeholder="Nome do Usuário" required id="userName">
                                            </div>
                                        </div>

                                        <div class="col-xs-2">
                                            <div class="form-group">
                                                <label>Data de Nascimento<font style="color: red; font-size: 14px;"><b>*</b></font></label>
                                                <input type="date" class="form-control inputDotStyle" name="userBorn" id="userBorn" max="9999-12-31" title="Informe a data de nascimento, campo obrigatório!" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-4">
                                            <div class="form-group">
                                                <label>E-mail</label>
                                                <font style="color: red; font-size: 14px;"><b>*</b></font>
                                                <input type="email" class="form-control inputDotStyle" name="userMail" title="Digite um email válido" id="userMail" onchange="verificarEmail()" placeholder="DIGITE UM EMAIL VÁLIDO">
                                            </div>
                                        </div>

                                        <div class="col-xs-2">
                                            <div class="form-group">
                                                <label>CPF<font style="color: red; font-size: 14px;"><b>*</b></font></label>
                                                <input maxlength="14" type="text" class="form-control inputDotStyle" name="userCPF" data-inputmask="&quot;mask&quot;: &quot;999.999.999-99&quot;" data-mask="" placeholder="___.___.___-__" id="userCPF" required id="userCPF">
                                            </div>
                                        </div>

                                        <div class="col-xs-2">
                                            <div class="form-group">
                                                <label>RG</label>
                                                <input maxlength="12" type="text" class="form-control inputDotStyle" name="userRG" data-inputmask='"mask": "&quot;mask&quot;: &quot;99.999.999-9&quot;"' data-mask="" placeholder="_.___.___-_" id="userRG">
                                            </div>
                                        </div>

                                        <div class="col-xs-4">
                                            <label>Unidade Federal</label>
                                            <select class="form-control inputDotStyle" name="userUF" id="userUF">
                                                <option value="">Informe o Estado emissor...</option>
                                                <?php
                                                $queryEstados = $mySQL->sql("SELECT * FROM estados ORDER BY nome ");
                                                while ($dateEstado = mysqli_fetch_array($queryEstados)) {
                                                ?>
                                                    <option value="<?= $dateEstado['id'] ?>" /><?= $dateEstado['nome'] ?>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-xs-4">
                                            <label>Orgão Emissor</label>
                                            <select class="form-control inputDotStyle" name="userOrgan" id="userOrgan">
                                                <option value="">Selecione o Orgão emissor...</option>
                                                <option value="SSP">SSP - Secretaria de Segurança Pública</option>
                                                <option value="COREN">COREN - Conselho Regional de Enfermagem</option>
                                                <option value="CRA">CRA - Conselho Regional de Administração</option>
                                                <option value="CRAS">CRAS - Con selho Regional de Assistentes Sociais</option>
                                                <option value="CRB">CRB - Conselho Regional de Biblioteconomia</option>
                                                <option value="CRC">CRC - Conselho Regional de Contabilidade</option>
                                                <option value="CRE">CRE - Conselho Regional de Estatística</option>
                                                <option value="CREA">CREA - Conselho Regional de Engenharia Arquitetura e Agronomia</option>
                                                <option value="CRECI">CRECI - Conselho Regional de Corretores de Imóveis</option>
                                                <option value="CREFIT">CREFIT - Conselho Regional de Fisioterapia e Terapia Ocupacional</option>
                                                <option value="CRF">CRF - Conselho Regional de Farmácia</option>
                                                <option value="CRM">CRM - Conselho Regional de Medicina</option>
                                                <option value="CRN">CRN - Conselho Regional de Nutrição</option>
                                                <option value="CRO">CRO - Conselho Regional de Odontologia</option>
                                                <option value="CRP">CRP - Conselho Regional de Psicologia</option>
                                                <option value="CRPRE">CRPRE - Conselho Regional de Profissionais de Relações Públicas</option>
                                                <option value="CRQ">CRQ - Conselho Regional de Química</option>
                                                <option value="CRRC">CRRC - Conselho Regional de Representantes Comerciais</option>
                                                <option value="CRMV">CRMV - Conselho Regional de Medicina Veterinária</option>
                                                <option value="DPF">DPF - Polícia Federal</option>
                                                <option value="EST">EST - Documentos Estrangeiros</option>
                                                <option value="I CLA">I CLA - Carteira de Identidade Classista</option>
                                                <option value="MAE">MAE - Ministério da Aeronáutica</option>
                                                <option value="MEX">MEX - Ministério do Exército</option>
                                                <option value="MMA">MMA - Ministério da Marinha</option>
                                                <option value="OAB">OAB - Ordem dos Advogados do Brasil</option>
                                                <option value="OMB">OMB - Ordens dos Músicos do Brasil</option>
                                                <option value="IFP">IFP - Instituto de Identificação Félix Pacheco</option>
                                                <option value="OUT">OUT - Outros Emissores</option>
                                            </select>
                                        </div>

                                        <div class="col-xs-2">
                                            <div class="form-group">
                                                <label>Telefone</label>
                                                <font style="color: red; font-size: 14px;"><b>*</b></font>
                                                <input maxlength="15" type="text" class="form-control inputDotStyle" name="userPhone" data-inputmask='"mask": "(99) 99999-9999"' data-mask="" placeholder="(__) _____-____" id="userPhone" required id="userPhone">
                                            </div>
                                        </div>

                                        <div class="col-xs-4">
                                            <div class="form-group">
                                                <label>Nome Completo do Pai</label>
                                                <input type="text" class="form-control inputDotStyle" style="text-transform: uppercase;" id="userNameFather" name="userNameFather" title="Digite o Nome completo do Pai." placeholder="Nome completo do Pai">
                                            </div>
                                        </div>

                                        <div class="col-xs-2">
                                            <div class="form-group">
                                                <label>Telefone do Pai</label>
                                                <input maxlength="15" type="text" class="form-control inputDotStyle" name="userFatherPhone" data-inputmask='"mask": "(99) 99999-9999"' data-mask="" placeholder="(__) _____-____" id="userFatherPhone">
                                            </div>
                                        </div>

                                        <div class="col-xs-4">
                                            <div class="form-group">
                                                <label>Nome Completo da Mãe</label>
                                                <input type="text" class="form-control inputDotStyle" style="text-transform: uppercase;" name="userNameMother" id="userNameMother" title="Digite o Nome completo da Mãe." placeholder="Nome completo da Mãe">
                                            </div>
                                        </div>

                                        <div class="col-xs-2">
                                            <div class="form-group">
                                                <label>Telefone da Mãe</label>
                                                <input maxlength="15" type="text" class="form-control inputDotStyle" name="userMotherPhone" data-inputmask='"mask": "(99) 99999-9999"' data-mask="" placeholder="(__) _____-____" id="userMotherPhone">
                                            </div>
                                        </div>

                                        <div class="col-xs-3">
                                            <div class="form-group">
                                                <label>Nacionalidade:</label>
                                                <select class="form-control inputDotStyle" id="userNationality" name="userNationality" title="Nacionalidade">
                                                    <option value="">Selecione um país...</option>
                                                    <?php
                                                    $queryCountry = $mySQL->sql("SELECT * FROM pais");
                                                    while ($dataCountry = mysqli_fetch_array($queryCountry)) {
                                                    ?>
                                                        <option value="<?= $dataCountry['paisId'] ?>"><?= $dataCountry['paisNome'] ?> </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xs-3">
                                            <div class="form-group">
                                                <label>Estado: <small>(Apenas para Brasil)</small></label>
                                                <select class="form-control inputDotStyle" id="userNaturality" name="userNaturality" title="Estado">
                                                    <option value="">Selecione o estado...</option>
                                                    <?php
                                                    $queryState = $mySQL->sql("SELECT * FROM estados");
                                                    while ($dataState = mysqli_fetch_array($queryState)) {
                                                    ?>
                                                        <option value="<?= $dataState['id'] ?>"><?= $dataState['nome'] ?> - <?= $dataState['sigla'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xs-4">
                                            <div class="form-group">
                                                <label>Cidade: <small>(Apenas para Brasil)</small></label>
                                                <select class="form-control inputDotStyle select2-search__field" id="userAddressCity" name="userAddressCity" title="Estado">
                                                    <option value="">Selecione a cidade...</option>
                                                    <?php
                                                    $queryCity = $mySQL->sql("SELECT * FROM cidades order by nome");
                                                    while ($dataCity = mysqli_fetch_array($queryCity)) {
                                                    ?>
                                                        <option value="<?= $dataCity['id'] ?>"><?= $dataCity['nome'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xs-2">
                                            <div class="form-group">
                                                <label>CEP</label>
                                                <input type="number" class="form-control inputDotStyle" name="userAddressCEP" id="userAddressCEP" title="Digite o CEP" data-inputmask='"mask": "99.999-999"' data-mask="" placeholder="__.___-___" maxlength="10">
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


                                        <div class="col-xs-4">
                                            <div class="form-group">
                                                <label>Bairro</label>
                                                <input type="text" class="form-control inputDotStyle" style="text-transform: uppercase;" name="userAddressDistrict" id="userAddressDistrict" placeholder="Bairro">
                                            </div>
                                        </div>

                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label>Rua</label>
                                                <input type="text" class="form-control inputDotStyle" style="text-transform: uppercase;" name="userAddressStreet" id="userAddressStreet" placeholder="Rua">
                                            </div>
                                        </div>

                                        <div class="col-xs-2">
                                            <div class="form-group">
                                                <label>Nº</label>
                                                <input type="number" class="form-control inputDotStyle" style="text-transform: uppercase;" name="userAddressNumber" id="userAddressNumber" title="Digite o Número" placeholder="Número">
                                            </div>
                                        </div>

                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <label>Complemento</label>
                                                <input type="text" class="form-control inputDotStyle" style="text-transform: uppercase;" name="userAddressComplement" id="userAddressComplement" placeholder="Complemento">
                                            </div>
                                        </div>

                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <label>Observações</label>
                                                <textarea class="form-control inputDotStyle" style="text-transform: uppercase;" name="userObs" id="userObs" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-xs-12">
                                            <input type="hidden" name="userId" id="userId" value="<?= $userId ?>">
                                            <button type="submit" class="btn btn-info pull-right buttonDotStyleFull">
                                                <i class="glyphicon glyphicon-floppy-save"></i>
                                                &nbsp;<b>Salvar Informações</b>
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
        <?php include('pages/users/includes/scriptNewUser.php'); ?>
    </section><!-- /.content -->

    <script>
        //MÁSCARA CPF INPUT
        $(document).ready(function() {
            $('#userCPF').mask('000.000.000-00');
        });

        // MÁSCARA RG INPUT
        $(document).ready(function() {
            $('#userRG').mask('00.000.000-0');
        });

        // MÁSCARA CEP INPUT
        $(document).ready(function() {
            $('#userCEP').mask('99999-999');
        });
    </script>

<?php
    loaderVerification();
}
?>