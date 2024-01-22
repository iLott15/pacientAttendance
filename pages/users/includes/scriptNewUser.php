<script type="text/javascript">
    //Função para máscara de CPF
    document.getElementById('userCPF').addEventListener('input', function(e) {
        x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,3})(\d{0,2})/);
        e.target.value = !x[2] ? x[1] : x[1] + '.' + x[2] + (x[3] ? '.' : '') + x[3] + (x[4] ? '-' + x[4] : '');
    });

    //Função para máscara de RG
    document.getElementById('userRG').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        let formattedValue = '';

        if (value.length <= 8) {
            formattedValue = value.replace(/(\d{1})(\d{3})(\d{3})(\d{1})/, '$1.$2.$3-$4');
        } else {
            formattedValue = value.replace(/(\d{2})(\d{3})(\d{3})(\d{1})/, '$1.$2.$3-$4');
        }

        e.target.value = formattedValue;
    });

    //#######################

    //Função para máscara de Phone
    document.getElementById('userPhone').addEventListener('input', function(e) {
        x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,5})(\d{0,4})/);
        e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    });

    //#######################

    //Função para máscara de Phone
    document.getElementById('userFatherPhone').addEventListener('input', function(e) {
        x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,5})(\d{0,4})/);
        e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    });

    //#######################

    //Função para máscara de Phone
    document.getElementById('userMotherPhone').addEventListener('input', function(e) {
        x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,5})(\d{0,4})/);
        e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    });

    //#######################

    //Função para bloquear data além do dia atual
    function atualizarDataMaxima() {
        const inputDate = document.getElementById('userBorn');
        const dataAtual = new Date().toISOString().split('T')[0];
        inputDate.setAttribute('max', dataAtual);
    }

    // Chama a função para definir a data máxima inicialmente
    atualizarDataMaxima();

    // Define um intervalo de atualização (por exemplo, a cada minuto)
    setInterval(atualizarDataMaxima, 60000); // 60000 milissegundos = 1 minuto

    //#######################

    //Função para verificar se email é válido
    function verificarEmail() {
        var emailInput = document.getElementById("userMail");
        var email = userMail.value;

        var regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (regex.test(email)) {
            Toastify({
                text: "Email válido.",
                duration: 5000,
                gravity: "top",
                position: "center",
                backgroundColor: "green",
                stopOnFocus: true
            }).showToast();

            return true;

        } else {
            Toastify({
                text: "Email inválido, por favor, faça a correção",
                duration: 5000,
                gravity: "top",
                position: "center",
                backgroundColor: "red",
                stopOnFocus: true
            }).showToast();

            userMail.value = "";
            return false;
        }
    }

    //#######################

    //insert e update via api -- Essa api serve tanto para o newUser e editUser, pois dentro da api, verifica se existe userId, se não houver, faz o insert, se houver, faz o update
    $('#formNewUser').submit(function(e) {
        e.preventDefault();
        let data = $(this).serializeArray();

        $.ajax({
            url: "pages/users/includes/api/insertUser.ajax.php",
            type: "POST",
            data: data,
            dataType: "json"
        }).done(function(resposta) {
            //console.log(resposta);
            Toastify({
                text: 'Dados salvos com sucesso!',
                duration: 10500,
                position: "center",
                backgroundColor: "#2E8B57",
                stopOnFocus: true,
            }).showToast();

        }).fail(function(jqXHR, textStatus) {
            // console.log("Request failed: " + textStatus);
            Toastify({
                text: 'Erro ao salvar os dados!',
                duration: 10500,
                position: "center",
                backgroundColor: "#f70000",
                stopOnFocus: true,
            }).showToast();

        }).always(function(resposta) {
            //console.log(resposta);
            $('#userId').val(resposta);
        });

    });


    //########################

    //script para ocultar/exibir informações conforme o tipo do usuário
    $(document).ready(function() {
        $("#userType").on("change", function() {
            if ($(this).val() == "superAdmin" || $(this).val() == "admin") {

                // Mostra a divDoctor para o tipo "superAdmin/admin"
                $("#divAdmin").show();
                $("#divAdminDateBegin").show();
                $("#divAdminDateEnd").show();

                //habilitando o required dos botões
                $("#divAdmin :input").prop("disabled", false);
                $("#divAdminDateBegin :input").prop("disabled", false);
                $("#divAdminDateEnd :input").prop("disabled", false);

                //escondendo botões que não são do tipo doctors/pacients
                $("#divDoctor").hide();
                $("#divDoctorStatus").hide();
                $("#divDoctorDateBegin").hide();
                $("#divDoctorDateEnd").hide();

                $("#divPacient").hide();
                $("#divPacientDateBegin").hide();
                $("#divPacientDateEnd").hide();
                $("#divPacientStatus").hide();
                $("#divPacientDoctor").hide();

                //desabilitando o required dos botões
                $("#divDoctor :input").prop("disabled", true);
                $("#divDoctorStatus :input").prop("disabled", true);
                $("#divDoctorDateBegin :input").prop("disabled", true);
                $("#divDoctorDateEnd :input").prop("disabled", true);

                $("#divPacient :input").prop("disabled", false);
                $("#divPacientDateBegin :input").prop("disabled", false);
                $("#divPacientDateEnd :input").prop("disabled", false);
                $("#divPacientStatus :input").prop("disabled", false);
                $("#divPacientDoctor :input").prop("disabled", false);

            } else if ($(this).val() == "doctor") {

                // Mostra a divDoctor para o tipo "doctor"
                $("#divDoctor").show();
                $("#divDoctorStatus").show();
                $("#divDoctorDateBegin").show();
                $("#divDoctorDateEnd").show();

                //habilitando o required dos botões
                $("#divDoctor :input").prop("disabled", false);
                $("#divDoctorStatus :input").prop("disabled", false);
                $("#divDoctorDateBegin :input").prop("disabled", false);
                $("#divDoctorDateEnd :input").prop("disabled", false);

                //escondendo botões que não são do tipo superAdmin/admin/pacients
                $("#divAdmin").hide();
                $("#divAdminDateBegin").hide();
                $("#divAdminDateEnd").hide();

                $("#divPacient").hide();
                $("#divPacientDateBegin").hide();
                $("#divPacientDateEnd").hide();
                $("#divPacientStatus").hide();
                $("#divPacientDoctor").hide();

                //desabilitando o required dos botões
                $("#divAdmin :input").prop("disabled", true);
                $("#divAdminDateBegin :input").prop("disabled", true);
                $("#divAdminDateEnd :input").prop("disabled", true);

                $("#divPacient :input").prop("disabled", true);
                $("#divPacientDateBegin :input").prop("disabled", true);
                $("#divPacientDateEnd :input").prop("disabled", true);
                $("#divPacientStatus :input").prop("disabled", true);
                $("#divPacientDoctor :input").prop("disabled", true);

            } else if ($(this).val() == "pacient") {

                // Mostra a divPacient para o tipo "pacient"
                $("#divPacient").show();
                $("#divPacientDateBegin").show();
                $("#divPacientDateEnd").show();
                $("#divPacientStatus").show();
                $("#divPacientDoctor").show();

                //habilitando o required dos botões
                $("#divPacient :input").prop("disabled", false);
                $("#divPacientDateBegin :input").prop("disabled", false);
                $("#divPacientDateEnd :input").prop("disabled", false);
                $("#divPacientStatus :input").prop("disabled", false);
                $("#divPacientDoctor :input").prop("disabled", false);

                //escondendo botões que não são do tipo superAdmin/admin/doctor
                $("#divAdmin").hide();
                $("#divAdminDateBegin").hide();
                $("#divAdminDateEnd").hide();

                $("#divDoctor").hide();
                $("#divDoctorDateBegin").hide();
                $("#divDoctorDateEnd").hide();
                $("#divDoctorStatus").hide();

                //desabilitando o required dos botões
                $("#divAdmin :input").prop("disabled", true);
                $("#divAdminDateBegin :input").prop("disabled", true);
                $("#divAdminDateEnd :input").prop("disabled", true);

                $("#divDoctor :input").prop("disabled", true);
                $("#divDoctorDateBegin :input").prop("disabled", true);
                $("#divDoctorDateEnd :input").prop("disabled", true);
                $("#divDoctorStatus :input").prop("disabled", true);

            } else { //esconder todas as div's que não precisam aparecer até ser selecionado um tipo de usuário

                //admin
                $("#divAdmin").hide();
                $("#divAdminDateBegin").hide();
                $("#divAdminDateEnd").hide();
                //doctor
                $("#divDoctor").hide();
                $("#divDoctorStatus").hide();
                $("#divDoctorDateBegin").hide();
                $("#divDoctorDateEnd").hide();
                //pacient
                $("#divPacient").hide();
                $("#divPacientDateBegin").hide();
                $("#divPacientDateEnd").hide();
                $("#divPacientStatus").hide();
                $("#divPacientDoctor").hide();

                //admin
                $("#divAdmin :input").prop("disabled", true);
                $("#divAdminDateBegin :input").prop("disabled", true);
                $("#divAdminDateEnd :input").prop("disabled", true);
                //doctors
                $("#divDoctor :input").prop("disabled", true);
                $("#divDoctorStatus :input").prop("disabled", true);
                $("#divDoctorDateBegin :input").prop("disabled", true);
                $("#divDoctorDateEnd :input").prop("disabled", true);
                //pacient
                $("#divPacient :input").prop("disabled", true);
                $("#divPacientDateBegin :input").prop("disabled", true);
                $("#divPacientDateEnd :input").prop("disabled", true);
                $("#divPacientStatus :input").prop("disabled", true);
                $("#divPacientDoctor :input").prop("disabled", true);
            }
        });
    });
</script>