<script>
    //update via api
    $('#formEditDoctorType').submit(function(e) {
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
</script>