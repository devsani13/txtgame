<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bdtxt";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Erro de conexão com o banco de dados: " . $conn->connect_error);
}

// Capturar o nome do usuário (enviado pelo login)
session_start();
if (!isset($_SESSION['usuario'])) {
    echo "Você precisa fazer login para acessar esta página.";
    exit();
}
$usuario = $_SESSION['usuario'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['conq']) && isset($_POST['score']) && $_POST['score'] == 15 && isset($_POST['modo']) && $_POST['modo'] == 'normal') {
    $sql_update = "UPDATE perfilconquistas SET soobinn = 1 WHERE usuario = '$usuario'";

    if ($conn->query($sql_update) === TRUE) {
    } else {
        $conn->error;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['conq']) && isset($_POST['score']) && $_POST['score'] == 15 && isset($_POST['modo']) && $_POST['modo'] == 'cronometrado') {
    $sql_update = "UPDATE perfilconquistas SET soobinc = 1 WHERE usuario = '$usuario'";

    if ($conn->query($sql_update) === TRUE) {
    } else {
        $conn->error;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['conq']) && isset($_POST['score']) && $_POST['score'] == 15 && isset($_POST['modo']) && $_POST['modo'] == 'infinito') {
    $sql_update = "UPDATE perfilconquistas SET soobini = 1 WHERE usuario = '$usuario'";

    if ($conn->query($sql_update) === TRUE) {
    } else {
        $conn->error;
    }
}

$conn->close();

?>

<html lang="pt">
    <title>Quiz Geral</title>
    <style>
        body {
            height: 100vh;
            justify-content: center;
            background-image: url('choiyongmeong.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            font-family: Cambria;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 20px;

        }
        .question-container {
            max-width: 600px;
            width: 100%;
            margin-bottom: 5px;
        }

        .question {
            font-size: 17px;
            margin-bottom: 15px;
            color: rgb(0, 0, 0);
            text-align: center;
        }
        p {
            font-size: 17px;
            margin-bottom: 15px;
            color: rgb(0, 0, 0);
            text-align: center;
        }
        .options {
            display: flex;
            flex-direction: column;
        }

        .options label {
            background-color: #262626;
            color: rgb(255, 255, 255);
            border-radius: 12px;
            border: none;
            margin: 5px 0;
            padding: 10px;
            cursor: pointer;
            text-align: left;
            transition: background-color 0.3s;
        }

        button {
            background-color: #262626;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            font-family: Cambria;
            border-radius: 5px;
            margin: 10px;
            width: 135px;
            text-align: center;
            line-height: 16px;
        }

        button:hover {
            background-color: #525252;
        }


        .result-container {
            display: none;
            text-align: center;
        }
        #quizContainer {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
}
#mode-selection {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        #mode-selection button {
            margin: 10px;
        }

        #backButton {
            border-radius: 100px;
            width: 45px;
            height: 45px;
            background-color: rgb(255, 255, 255);
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: none;
            cursor: pointer;
        }
        #backButton img {
            width: 50px;
            height: 50px;
        }
        #backButton2 {
            position: absolute;
            top: 20px;
            right: 20px;
            border-radius: 100px;
            width: 55px;
            height: 55px;
            background-color: rgb(255, 255, 255);
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: none;
            cursor: pointer;
        }

        #backButton2 img {
            width: 60px;
            height: 60px;
        }
        #nextButton {
            text-align: center;
        }
        #question-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        #end-buttons {
    display: flex;
    flex-direction: column; /* Coloca os itens (texto e botões) em uma coluna */
    justify-content: center;
    align-items: center; /* Centraliza os itens */
    gap: 20px; /* Espaço entre o texto e os botões */
    margin-top: 20px;
}

#end-buttons button {
    margin: 0 10px; /* Espaço horizontal entre os botões */
}

#end-buttons .button-container {
    display: flex; /* Faz os botões ficarem lado a lado */
    justify-content: center;
    gap: 10px; /* Espaço entre os botões */
}


#score {
    font-size: 17px;
    color: rgb(0, 0, 0);
    text-align: center;
}

        #timer {
            font-size: 17px;
            color: #000000;
            margin-top: 20px;
        }
         #button-container {
        display: flex;
        justify-content: center;
        gap: 5px;
        margin-top: 20px;
    }
    #feedback {
    margin-top: 10px;
    font-size: 20px; /* Tamanho maior para os emojis */
    font-weight: bold;
    display: flex;
    justify-content: center; /* Centraliza o conteúdo */
    align-items: center; /* Alinha verticalmente */
}
#game-container {
            text-align: center;
            background-color: transparent;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 600px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        #question-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <button id="backButton2">
        <img src="voltarblack.png" alt="Voltar" onclick="window.location.href='quiz-txt.php';">
    </button>    

    <div id="mode-selection">
        <h2 style="color: rgb(0, 0, 0);">Escolha o Modo de Jogo</h2>
        <button id="modoNormalButton">Modo Normal</button>
        <button id="modoCronometradoButton">Modo Cronometrado</button>
        <button id="modoInfinitoButton">Modo Infinito</button>
    </div>

    <div id="game-container" style="display: none;">
        <div class="question-container" id="questionContainer">
            <!-- A pergunta será exibida aqui -->
        </div>
        <div id="feedback"></div>
        <div id="button-container">
            <button id="nextButton">Próxima</button>
            <button id="backButton">
                <img src="voltarblack.png" alt="Voltar" onclick="window.location.href='soobin.php';">
            </button>
        </div>
        <div id="timer" style="display: none;"></div>
    </div>
    <div id="end-buttons" style="display: none;">
        <p id="score"></p> <!-- Resultado final do jogo -->
        <form method="POST">
                <button type="submit" id="restartButtonEnd" name="conq">Jogar novamente</button>
                <button type="submit" id="backButtonEnd" name="conq">Voltar para a página inicial</button>
                <input type="text" id="txtscr" value="" name="score" hidden>
                <input type="text" id="txtmod" value="" name="modo" hidden>
            </form>
    </div>   

    <script>
    const questions = [
    { question: "1 - Qual é o nome completo de Soobin?", options: ["Choi Soobin", "Choi Seojun", "Choi Subin", "Choi Subeom"], answer: 0 },
    { question: "2 - Qual é a data de nascimento de Soobin?", options: ["5 de dezembro de 2000", "4 de agosto de 2000", "14 de dezembro de 2000", "3 de julho de 2000"], answer: 0 },
    { question: "3 - Qual é o signo de Soobin?", options: ["Sagitário", "Capricórnio", "Virgem", "Leão"], answer: 0 },
    { question: "4 - Qual é a altura de Soobin?", options: ["185 cm", "181 cm", "187 cm", "182 cm"], answer: 2 },
    { question: "5 - Qual é o tipo sanguíneo de Soobin?", options: ["A", "B", "AB", "O"], answer: 0 },
    { question: "6 - Qual é o MBTI de Soobin?", options: ["ISFP", "ENFP", "INFJ", "ENTP"], answer: 0 },
    { question: "7 - Qual é o prato favorito de Soobin?", options: ["Frango", "Tteokbokki", "Sorvete", "Carne de porco"], answer: 1 },
    { question: "8 - Qual é o hobby de Soobin?", options: ["Ler", "Jogar videogame", "Comer sobremesas", "Jardinagem"], answer: 2 },
    { question: "9 - Qual é o emoji representativo de Soobin?", options: ["🐰", "🐻", "🐦", "🐱"], answer: 0 },
    { question: "10 - Qual é a cor favorita de Soobin?", options: ["Azul", "Ciano", "Preto", "Rosa"], answer: 1 },
    { question: "11 - Qual é a comida que Soobin não gosta?", options: ["Batata-doce", "Frutos do mar", "Abóbora", "Pimenta"], answer: 2 },
    { question: "12 - Qual é o ponto forte de Soobin segundo ele mesmo?", options: ["Sua gentileza", "Sua paciência", "Sua liderança", "Seu carisma"], answer: 2 },
    { question: "13 - Qual é o talento especial de Soobin?", options: ["Imitar vozes de personagens", "Desenhar", "Ler rápido", "Dormir profundamente"], answer: 0 },
    { question: "14 - Qual é a fruta favorita de Soobin?", options: ["Manga", "Morango", "Laranja", "Maçã"], answer: 1 },
    { question: "15 - Que posição Soobin ocupa no TXT?", options: ["Líder, vocalista e dançarino", "Líder e rapper principal", "Apenas vocalista", "Dançarino principal"], answer: 0 }
    ];

    let currentQuestionIndex = 0;
    let score = 0;
    let remainingTime = 30;
    let wrongAnswers = 0;
    let gameMode = '';
    let timerInterval;

    const questionContainer = document.getElementById('questionContainer');
    const nextButton = document.getElementById('nextButton');
    const modeSelection = document.getElementById('mode-selection');
    const gameContainer = document.getElementById('game-container');
    const timerDisplay = document.getElementById('timer');
    const feedback = document.getElementById('feedback');
    const endButtons = document.getElementById('end-buttons');

    // Função para escolher o modo de jogo
    document.getElementById('modoNormalButton').addEventListener('click', () => startGame('normal'));
    document.getElementById('modoCronometradoButton').addEventListener('click', () => startGame('cronometrado'));
    document.getElementById('modoInfinitoButton').addEventListener('click', () => startGame('infinito'));

    function startGame(mode) {
        gameMode = mode;

        // Oculta a seleção de modo e exibe o contêiner do jogo
        modeSelection.style.display = 'none';
        gameContainer.style.display = 'flex';

        if (gameMode === 'cronometrado') {
            timerDisplay.style.display = 'block';
            startTimer();
        } else {
            timerDisplay.style.display = 'none';
        }

        currentQuestionIndex = 0;
        score = 0;
        wrongAnswers = 0;
        feedback.textContent = '';
        displayQuestion();
    }

    // Função para exibir a pergunta
    function displayQuestion() {
        const question = questions[currentQuestionIndex];
        questionContainer.innerHTML = `
            <div class="question">
                <p>${question.question}</p>
                <div class="options">
                    ${question.options.map((option, i) => `
                        <label>
                            <input type="radio" name="question" value="${i}">
                            ${option}
                        </label>
                    `).join('')}
                </div>
            </div>
        `;
        nextButton.disabled = true; // Desabilita o botão "Próxima" até que o usuário selecione uma resposta
        document.querySelectorAll('input[name="question"]').forEach(option => {
            option.addEventListener('change', () => {
                nextButton.disabled = false; // Habilita o botão quando uma opção é selecionada
            });
        });
    }

    // Função para avançar para a próxima pergunta
    function nextQuestion() {
        const selectedOption = document.querySelector('input[name="question"]:checked');
        if (selectedOption) {
            const selectedAnswer = parseInt(selectedOption.value);
            if (selectedAnswer === questions[currentQuestionIndex].answer) {
                score++;
                feedback.textContent = '🎉🎉🎉🎉';
            } else {
                wrongAnswers++;
                feedback.textContent = '❌❌❌❌';
            }

            if (gameMode === 'infinito' && wrongAnswers >= 3) {
                showEndScreen();
                return;
            }
        }

        currentQuestionIndex++;
        if (currentQuestionIndex < questions.length) {
            displayQuestion();
        } else {
            showEndScreen(); // Exibe a tela de fim de jogo ao terminar as perguntas
        }
    }

    // Evento do botão "Próxima"
    nextButton.addEventListener('click', nextQuestion);

    // Função para exibir a tela de fim de jogo
    function showEndScreen() {
    clearInterval(timerInterval); // Para o temporizador, se estiver ativo
    gameContainer.style.display = 'none';
    endButtons.style.display = 'flex';

    const scoreElement = document.getElementById('score');
    scoreElement.textContent = `Fim de Jogo! Você acertou ${score} de ${questions.length} perguntas.`;
    document.getElementById("txtscr").value = score;
    document.getElementById("txtmod").value = gameMode;
}


    // Função para iniciar o temporizador
    function startTimer() {
        remainingTime = 20;
        timerDisplay.textContent = `Tempo restante: ${remainingTime} segundos`;
        timerInterval = setInterval(() => {
            remainingTime--;
            timerDisplay.textContent = `Tempo restante: ${remainingTime} segundos`;

            if (remainingTime <= 0) {
                clearInterval(timerInterval);
                showEndScreen();
            }
        }, 1000);
    }

    // Reiniciar ou voltar para o início
    document.getElementById('restartButtonEnd').addEventListener('click', () => location.reload());
    document.getElementById('backButtonEnd').addEventListener('click', () => window.location.href = 'quiz-txt.php');
</script>

</body>
</html>