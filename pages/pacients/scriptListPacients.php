<script>
    function deletePacient(userId) {
        // Make the API call to delete the user
        $.ajax({
                url: "pages/pacients/includes/api/deletePacient.ajax.php",
                type: "POST",
                data: {
                    userId
                },
                dataType: "json",
            })
            .done(function(data) {
                if (data.success) {
                    // Show success message using Toastify
                    Toastify({
                        text: "Isso! Paciente deletado com sucesso!",
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
                        text: "Poxa! Infelizmente não foi possível excluir o usuário.",
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
                    text: "Erro ao tentar excluir usuário no banco de dados.",
                    duration: 10500,
                    position: "center",
                    backgroundColor: "#f70000",
                    stopOnFocus: true,
                }).showToast();
            });
    }
</script>