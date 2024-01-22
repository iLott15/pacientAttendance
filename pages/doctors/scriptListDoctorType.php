<script>
   

    //insert via api
    $('#formNewDoctorType').submit(function(e) {
        e.preventDefault();
        let data = $(this).serializeArray();

        $.ajax({
            url: "pages/doctors/includes/api/insertAndUpdateDoctorType.ajax.php",
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
            $('#doctorTypeId').val(resposta);
        });

    });

    function confirmDelete(doctorTypeId) {
        if (confirm('Tem certeza que deseja excluir esta Especialidade?')) {
            deleteDoctorType(doctorTypeId);
            lockInteraction();
        } else {
            // Show error message using Toastify
            Toastify({
                text: "Eita! Por ter sido cancelado, não deletamos a Especialidade.",
                duration: 10500,
                position: "center",
                backgroundColor: "#917423",
                stopOnFocus: true,
            }).showToast();
            lockInteraction();

            // Delay before reloading the page
            var delayMillis = 2000; // 2 seconds
            setTimeout(function() {
                location.reload();
            }, delayMillis);
        }
    }

    function deleteDoctorType(doctorTypeId) {
        // Make the API call to delete the user
        $.ajax({
                url: "pages/doctors/includes/api/deleteDoctorType.ajax.php",
                type: "POST",
                data: {
                    doctorTypeId
                },
                dataType: "json",
            })
            .done(function(data) {
                if (data.success) {
                    // Show success message using Toastify
                    Toastify({
                        text: "Isso! Especialidade deletada com sucesso!",
                        duration: 10500,
                        position: "center",
                        backgroundColor: "#2E8B57",
                        stopOnFocus: true,
                    }).showToast();

                    // Delay before reloading the page
                    var delayMillis = 2000; // 2 seconds
                    setTimeout(function() {
                        location.reload();
                    }, delayMillis);
                } else {
                    // Show error message using Toastify
                    Toastify({
                        text: "Poxa! Infelizmente não foi possível excluir a Especialidade.",
                        duration: 10500,
                        position: "center",
                        backgroundColor: "#f70000",
                        stopOnFocus: true,
                    }).showToast();
                }
            })
            .fail(function(jqXHR, textStatus) {
                // Show error message using Toastify
                Toastify({
                    text: "Erro ao tentar excluir Especialidade no banco de dados.",
                    duration: 10500,
                    position: "center",
                    backgroundColor: "#f70000",
                    stopOnFocus: true,
                }).showToast();
                lockInteraction();

                // Delay before reloading the page
                var delayMillis = 2000; // 2 seconds
                setTimeout(function() {
                    location.reload();
                }, delayMillis);
            });
    }
</script>