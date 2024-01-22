<?php
function getRandomLoadingText() {

    global $mySQL;

    // Executa a consulta
    $result = $mySQL->sql("SELECT * FROM loading_texts ORDER BY RAND() LIMIT 1");;

    // Verifica se a consulta retornou algum resultado
    if ($result->num_rows > 0) {
        // Obtém os dados da linha selecionada e retorna um array
        $row = $result->fetch_assoc();
        return $row;
    } else {
        // Caso não haja resultados, retorna um array vazio
        return array();
    }

}

function getRandomLoadingMessage() {
    // Define as mensagens e suas probabilidades
    $messages = [
        ["message" => "Carregando...", "probability" => 15],
        ["message" => "Processando...", "probability" => 25],
        ["message" => "Buscando um cafezinho ☕, já já voltamos 😋...", "probability" => 25],
        ["message" => "Só um momentinho 😃 ...", "probability" => 10],
        ["message" => "Aguarde...", "probability" => 5],
        ["message" => "Opa, só um momento...", "probability" => 10],
        ["message" => "Estamos correndo para trazer suas informações! 🏃💨 ...", "probability" => 10],
        ["message" => "Analisando...", "probability" => 10],
        ["message" => "Buscando os dados...", "probability" => 15],
        ["message" => "Enquanto carregamos suas informações, hidrate-se 🍺...", "probability" => 20],
        ["message" => "A mágica irá acontecer 🧙🏽‍♂️...", "probability" => 20],
        ["message" => "O sistema está carregando sua página🧑🏽‍💻...", "probability" => 10]



    ];

    // Gera um número aleatório entre 1 e 100
    $randomNumber = rand(1, 100);

    // Percorre as mensagens e verifica se o número aleatório está dentro da probabilidade
    $cumulativeProbability = 0;
    foreach ($messages as $message) {
        $cumulativeProbability += $message["probability"];
        if ($randomNumber <= $cumulativeProbability) {
            return $message["message"];
        }
    }

    // Caso não seja possível determinar uma mensagem, retorna vazio
    return "";
}
?>
<style>
#loader {
    position: fixed;
    top: 0;
    right: 0;
    width: 100%;
    height: 100%;
    background-color: #ffffffaa;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    color: #fff;
    text-shadow: 1px 2px 4px rgba(100, 100, 100, 0.8);
    font-weight: bold;
    flex-direction: column;
    text-align: center;
}

#loader span {
    margin-top: 10px;
}

#loader span.quote {
    margin: 0 120px;
    font-size: 16px;
    font-style: italic;
    color: #414345;
    quotes: "\201C" "\201D"; /* Código das aspas duplas */
}

#loader span.actor {
    font-size: 16px;
    font-weight: bold;
    color: #414345;
    text-align: right;
}

#loader .processing {
    background-color: rgba(0, 166, 90, 0.8);
    padding: 10px;
    font-size: 18px;
    border-radius: 10px;
    margin-bottom: 15px;
    position: relative;
    overflow: hidden;
}

#loader .processing::before {
    content: "";
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background-color: rgba(255, 255, 255, 0.5);
    opacity: 0;
    transform: rotate(30deg) scale(0);
    animation: lightEffect 2.5s linear infinite;
}

@keyframes lightEffect {
    0% {
    opacity: 0;
    transform: rotate(30deg) scale(0);
    }
    50% {
    opacity: 1;
    transform: rotate(30deg) scale(1);
    }
    100% {
    opacity: 0;
    transform: rotate(30deg) scale(0);
    }
}
</style>
<script>
// Bloqueia a interação do usuário após o envio do formulário
function lockInteraction() {
    var processingText = "<?= getRandomLoadingMessage() ?>";
    <?php
    $dataRandomLoadingText = getRandomLoadingText();
    ?>
    var quoteText = "<?= $dataRandomLoadingText['loadingTextDescription'] ?>";
    var actorText = "<?= $dataRandomLoadingText['loadingTextActor'] ?>";

    // Exibe a frase "Processando...", "May the force be with you" e "Mestre Yoda" durante o carregamento da página
    var loader = document.createElement('div');
    loader.id = 'loader';
    loader.innerHTML = '<span class="processing"><span class="light-effect">' + processingText + '</span></span><span class="quote">\u201C' + quoteText + '\u201D</span><span class="actor">' + actorText + '</span>';
    document.body.appendChild(loader);

    // Desabilita todos os botões do formulário
    var buttons = document.querySelectorAll('button');
    for (var i = 0; i < buttons.length; i++) {
    buttons[i].disabled = true;
    }

    // Desabilita todos os links da página
    var links = document.querySelectorAll('a');
    for (var i = 0; i < links.length; i++) {
    links[i].onclick = function(event) {
        event.preventDefault();
    };
    }

    // Bloqueia a tecla F5 e o atalho Ctrl + R
    window.onkeydown = function(event) {
    if (event.keyCode == 116 || (event.ctrlKey && event.keyCode == 82)) {
        event.preventDefault();
    }
    };
}

// Desbloqueia a interação do usuário após a página ser totalmente carregada
function unlockInteraction() {
    // Remove o elemento de carregamento
    var loader = document.getElementById('loader');
    loader.parentNode.removeChild(loader);

    // Habilita todos os botões do formulário
    var buttons = document.querySelectorAll('button');
    for (var i = 0; i < buttons.length; i++) {
    buttons[i].disabled = false;
    }

    // Habilita todos os links da página
    var links = document.querySelectorAll('a');
    for (var i = 0; i < links.length; i++) {
    links[i].onclick = null;
    }

    // Remove o bloqueio da tecla F5 e do atalho Ctrl + R
    window.onkeydown = null;
}


</script>

<?php
function loaderVerification(){
?>
    <script>
        // Adiciona ouvinte de eventos para o evento 'beforeunload'
        window.addEventListener('beforeunload', function() {
            lockInteraction();
        });
    </script>
<?php
}
?>