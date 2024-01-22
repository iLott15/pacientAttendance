<script type="text/javascript">
    // Função para aplicar a máscara de CPF
    function applyCpfMask() {
        let cpfInput = document.getElementById('userCPFEdit');
        let x = cpfInput.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,3})(\d{0,2})/);
        cpfInput.value = !x[2] ? x[1] : x[1] + '.' + x[2] + (x[3] ? '.' : '') + x[3] + (x[4] ? '-' + x[4] : '');
    }

    // Chame a função quando a página for carregada
    window.addEventListener('load', applyCpfMask);

    // Adicione um ouvinte de evento 'input' para atualizações futuras
    document.getElementById('userCPFEdit').addEventListener('input', applyCpfMask);

    //#######################

    //Função para máscara de RG
    // Função para aplicar a máscara de RG
    function applyRgMask() {
        let rgInput = document.getElementById('userRGEdit');
        let value = rgInput.value.replace(/[^0-9x]/gi, ''); // Remove todos os caracteres exceto números e 'x'
        let formattedValue = '';

        if (value.length <= 8) {
            formattedValue = value.replace(/(\d{1})(\d{3})(\d{3})([0-9x]{1})/, '$1.$2.$3-$4');
        } else {
            formattedValue = value.replace(/(\d{2})(\d{3})(\d{3})([0-9x]{1})/, '$1.$2.$3-$4');
        }

        rgInput.value = formattedValue;
    }

    // Chame a função quando a página for carregada
    window.addEventListener('load', applyRgMask);

    //#######################

    //Função para bloquear data além do dia atual
    function atualizarDataMaxima() {
        const inputDate = document.getElementById('userBornEdit');
        const dataAtual = new Date().toISOString().split('T')[0];
        inputDate.setAttribute('max', dataAtual);
    }

    // Chama a função para definir a data máxima inicialmente
    atualizarDataMaxima();

    // Define um intervalo de atualização (por exemplo, a cada minuto)
    setInterval(atualizarDataMaxima, 60000); // 60000 milissegundos = 1 minuto

    //#######################

    //Função para máscara de Phone
    document.getElementById('userPhoneEdit').addEventListener('input', function(e) {
        x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,5})(\d{0,4})/);
        e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    });

    //#######################

    //Função para máscara de Phone
    document.getElementById('userFatherPhoneEdit').addEventListener('input', function(e) {
        x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,5})(\d{0,4})/);
        e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    });

    //#######################

    //Função para máscara de Phone
    document.getElementById('userMotherPhoneEdit').addEventListener('input', function(e) {
        x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,5})(\d{0,4})/);
        e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    });

    //Função para verificar se o email é válido
    function verificarEmail() {
        var emailInput = document.getElementById("userMailEdit");
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

    $(document).ready(function() {
        // Recupere o valor do tipo de usuário do banco e defina o valor padrão
        var userTypeFromDB = $("#userTypeEdit").val(); // Substitua isso pelo valor real do banco

        // Configure o valor padrão no campo select
        $("#userTypeEdit").val(userTypeFromDB);

        // Execute a lógica de exibição com base no valor padrão
        // Dispara o evento de mudança no elemento #userTypeEdit (pode ser útil ao carregar a página)
        $("#userTypeEdit").change();

        // Lógica inicial com base no tipo de usuário obtido de algum lugar chamado userTypeFromDB
        if (userTypeFromDB == "superAdmin" || userTypeFromDB == "admin") {
            // Mostra os elementos relacionados a admin e habilita os inputs
            $("#divAdminEdit, #divAdminDateBeginEdit, #divAdminDateEndEdit").show().find(":input").prop("disabled", false);

            // Oculta elementos relacionados a doctor e desabilita os inputs
            $("#divDoctorStatusEdit, #divDoctorEdit, #divDoctorDateBeginEdit, #divDoctorDateEndEdit").hide().find(":input").prop("disabled", true);
        } else if (userTypeFromDB == "doctor") {
            // Mostra elementos relacionados a doctor e habilita os inputs
            $("#divDoctorStatusEdit, #divDoctorEdit, #divDoctorDateBeginEdit, #divDoctorDateEndEdit").show().find(":input").prop("disabled", false);

            // Oculta elementos relacionados a admin e desabilita os inputs
            $("#divAdminEdit, #divAdminDateBeginEdit, #divAdminDateEndEdit").hide().find(":input").prop("disabled", true);
        } else if (userTypeFromDB == "pacient") {
            // Mostra elementos relacionados a pacient e habilita os inputs
            $("#divPacientStatusEdit, #divPacientEdit, #divPacientDateBeginEdit, #divPacientDateEndEdit").show().find(":input").prop("disabled", false);

            // Oculta elementos relacionados a admin e desabilita os inputs
            $("#divAdminEdit, #divAdminDateBeginEdit, #divAdminDateEndEdit").hide().find(":input").prop("disabled", true);
        } else {
            // Oculta todos os elementos e desabilita os inputs para outros tipos de usuário
            $("#divAdminEdit, #divAdminDateBeginEdit, #divAdminDateEndEdit, #divDoctorStatusEdit, #divDoctorEdit, #divDoctorDateBeginEdit, #divDoctorDateEndEdit")
                .hide().find(":input").prop("disabled", true);
        }

        // Adiciona um manipulador de evento para o evento de mudança no elemento #userTypeEdit
        $("#userTypeEdit").on("change", function() {
            // Obtém o valor selecionado
            var selectedValue = $(this).val();

            // Lógica de exibição para Super Admin e Admin
            if (selectedValue == "superAdmin") {
                // Mostra elementos relacionados a admin e habilita os inputs
                $("#divAdminEdit, #divAdminDateBeginEdit, #divAdminDateEndEdit").show().find(":input").prop("disabled", false);

                // Oculta elementos relacionados a doctor e desabilita os inputs
                $("#divDoctorStatusEdit, #divDoctorEdit, #divDoctorDateBeginEdit, #divDoctorDateEndEdit").hide().find(":input").prop("disabled", true);
                $("#divPacientStatusEdit, #divPacientEdit, #divPacientDateBeginEdit, #divPacientDateEndEdit").hide().find(":input").prop("disabled", true);

            }
            // Lógica de exibição para Doctor
            else if (selectedValue == "doctor") {
                // Mostra elementos relacionados a doctor e habilita os inputs
                $("#divDoctorStatusEdit, #divDoctorEdit, #divDoctorDateBeginEdit, #divDoctorDateEndEdit").show().find(":input").prop("disabled", false);

                // Oculta elementos relacionados a admin e desabilita os inputs
                $("#divAdminEdit, #divAdminDateBeginEdit, #divAdminDateEndEdit").hide().find(":input").prop("disabled", true);
                $("#divPacientStatusEdit, #divPacientEdit, #divPacientDateBeginEdit, #divPacientDateEndEdit").hide().find(":input").prop("disabled", true);

            }
            // Lógica de exibição para Doctor
            else if (selectedValue == "pacient") {
                // Mostra elementos relacionados a doctor e habilita os inputs
                $("#divPacientStatusEdit, #divPacientEdit, #divPacientDateBeginEdit, #divPacientDateEndEdit").show().find(":input").prop("disabled", false);

                // Oculta elementos relacionados a admin e desabilita os inputs
                $("#divAdminEdit, #divAdminDateBeginEdit, #divAdminDateEndEdit").hide().find(":input").prop("disabled", true);
                $("#divDoctorStatusEdit, #divDoctorEdit, #divDoctorDateBeginEdit, #divDoctorDateEndEdit").hide().find(":input").prop("disabled", true);

            }
            // Esconder todas as divs para outros tipos de usuário
            else {
                // Oculta todos os elementos e desabilita os inputs para outros tipos de usuário
                $("#divAdminEdit, #divAdminDateBeginEdit, #divAdminDateEndEdit, #divDoctorStatusEdit, #divDoctorEdit, #divDoctorDateBeginEdit, #divDoctorDateEndEdit, #divPacientStatusEdit, #divPacientEdit, #divPacientDateBeginEdit, #divPacientDateEndEdit")
                    .hide().find(":input").prop("disabled", true);
            }
        });
    });

    //#######################

    //insert e update via api -- Essa api serve tanto para o newUser e editUser, pois dentro da api, verifica se existe userId, se não houver, faz o insert, se houver, faz o update
    $('#formEditUser').submit(function(e) {
        e.preventDefault();
        let data = $(this).serializeArray();

        $.ajax({
            url: "pages/users/includes/api/updateUser.ajax.php",
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
            $('#userIdEdit').val(resposta);
        });

    });

    // Função para copiar o CPF
    function copyText() {
        var userCPF = document.getElementById('userCPFEdit');
        if (userCPF) {
            var cpfSCE = userCPF.value.replace(/[^\d]+/g, '');
            if (cpfSCE.length === 11) {
                var tempCPF = document.createElement('input');
                tempCPF.value = cpfSCE;
                document.body.appendChild(tempCPF);

                tempCPF.select();
                tempCPF.setSelectionRange(0, 99999);
                document.execCommand('copy');

                document.body.removeChild(tempCPF);

                Toastify({
                    text: 'CPF copiado com sucesso!',
                    style: {
                        background: 'green'
                    },
                    duration: 5000,
                    close: true
                }).showToast();
            } else {
                Toastify({
                    text: 'Não foi possível copiar o CPF!',
                    style: {
                        background: 'red'
                    },
                    duration: 5000,
                    close: true
                }).showToast();
            }
        }
    }
</script>