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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['conq']) && isset($_POST['score']) && $_POST['score'] == 20 && isset($_POST['modo']) && $_POST['modo'] == 'normal') {
    $sql_update = "UPDATE perfilconquistas SET geraln = 1 WHERE usuario = '$usuario'";

    if ($conn->query($sql_update) === TRUE) {
    } else {
        $conn->error;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['conq']) && isset($_POST['score']) && $_POST['score'] == 20 && isset($_POST['modo']) && $_POST['modo'] == 'cronometrado') {
    $sql_update = "UPDATE perfilconquistas SET geralc = 1 WHERE usuario = '$usuario'";

    if ($conn->query($sql_update) === TRUE) {
    } else {
        $conn->error;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['conq']) && isset($_POST['score']) && $_POST['score'] == 20 && isset($_POST['modo']) && $_POST['modo'] == 'infinito') {
    $sql_update = "UPDATE perfilconquistas SET gerali = 1 WHERE usuario = '$usuario'";

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
        background-image: url('Iniciar.jpg');
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
        color: white;
        text-align: center;
    }

    p {
        font-size: 17px;
        margin-bottom: 15px;
        color: white;
        text-align: center;
    }

    .options {
        display: flex;
        flex-direction: column;
    }

    .options label {
        background-color: #262626;
        color: white;
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
        background-color: rgb(0, 0, 0);
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
        background-color: rgb(0, 0, 0);
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
        flex-direction: column;
        /* Coloca os itens (texto e botões) em uma coluna */
        justify-content: center;
        align-items: center;
        /* Centraliza os itens */
        gap: 20px;
        /* Espaço entre o texto e os botões */
        margin-top: 20px;
    }

    #end-buttons button {
        margin: 0 10px;
        /* Espaço horizontal entre os botões */
    }

    #end-buttons .button-container {
        display: flex;
        /* Faz os botões ficarem lado a lado */
        justify-content: center;
        gap: 10px;
        /* Espaço entre os botões */
    }


    #score {
        font-size: 17px;
        color: white;
        text-align: center;
    }

    #timer {
        font-size: 17px;
        color: #ffffff;
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
        font-size: 20px;
        /* Tamanho maior para os emojis */
        font-weight: bold;
        display: flex;
        justify-content: center;
        /* Centraliza o conteúdo */
        align-items: center;
        /* Alinha verticalmente */
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
        <img src="voltarwhite.png" alt="Voltar" onclick="window.location.href='quiz-txt.php'">
    </button>

    <div id="mode-selection">
        <h2 style="color: white;">Escolha o Modo de Jogo</h2>
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
                <img src="voltarwhite.png" alt="Voltar" onclick="window.location.href='geral.php'">
            </button>
        </div>
        <div id="timer" style="display: none;"></div>
    </div>
    <div id="end-buttons" style="display: none;">
        <p id="score"></p> <!-- Resultado final do jogo -->
        <div class="button-container">
            <form method="POST">
                <button type="submit" id="restartButtonEnd" name="conq">Jogar novamente</button>
                <button type="submit" id="backButtonEnd" name="conq">Voltar para a página inicial</button>
                <input type="text" id="txtscr" value="" name="score" hidden>
                <input type="text" id="txtmod" value="" name="modo" hidden>
            </form>
        </div>
    </div>

    <script>
        const questions = [
            { question: "1 - Qual é o nome completo do TXT?", options: ["Tomorrow X Together", "Together for Tomorrow", "Tomorrow and Together", "Tomorrow X Friends"], answer: 0 },
            { question: "2 - Qual é a data de debut do TXT?", options: ["4 de março de 2019", "5 de março de 2019", "12 de fevereiro de 2019", "10 de março de 2019"], answer: 0 },
            { question: "3 - Qual é o nome do fandom do TXT?", options: ["MOA", "STAY", "ARMY", "ENGENE"], answer: 0 },
            { question: "4 - Quantos membros o TXT tem?", options: ["4", "5", "6", "7"], answer: 1 },
            { question: "5 - Qual é o selo responsável pelo TXT?", options: ["YG Entertainment", "JYP Entertainment", "SM Entertainment", "HYBE"], answer: 3 },
            { question: "6 - Qual foi o primeiro álbum do TXT?", options: ["The Dream Chapter: MAGIC", "The Dream Chapter: ETERNITY", "The Dream Chapter: STAR", "The Chaos Chapter: FREEZE"], answer: 2 },
            { question: "7 - Qual foi o primeiro single do TXT?", options: ["CROWN", "Blue Hour", "Cat & Dog", "Run Away"], answer: 0 },
            { question: "8 - Qual membro é o líder do TXT?", options: ["Yeonjun", "Soobin", "Taehyun", "Beomgyu"], answer: 1 },
            { question: "9 - Qual é a ordem de idade dos membros, do mais velho para o mais novo?", options: ["Yeonjun, Soobin, Beomgyu, Taehyun, Huening Kai", "Soobin, Yeonjun, Taehyun, Beomgyu, Huening Kai", "Beomgyu, Yeonjun, Soobin, Taehyun, Huening Kai", "Yeonjun, Soobin, Taehyun, Huening Kai, Beomgyu"], answer: 0 },
            { question: "10 - Qual é o nome do álbum japonês de estreia do TXT?", options: ["Still Dreaming", "Run Away", "Blue Hour", "The Chaos Chapter"], answer: 0 },
            { question: "11 - Qual membro é fluente em inglês?", options: ["Huening Kai", "Beomgyu", "Yeonjun", "Taehyun"], answer: 0 },
            { question: "12 - Qual é o tema principal do álbum 'The Dream Chapter?", options: ["Sonhos e juventude", "Amizade e aventuras", "Liberdade e rebeldia", "Amor e autodescoberta"], answer: 0 },
            { question: "13 - Qual música trouxe maior reconhecimento internacional ao TXT?", options: ["Blue Hour", "CROWN", "Run Away", "LO$ER=LO♡ER"], answer: 2 },
            { question: "14 - Qual membro do TXT nasceu nos Estados Unidos?", options: ["Soobin", "Taehyun", "Huening Kai", "Beomgyu"], answer: 2 },
            { question: "15 - Qual é o signo do zodíaco de Yeonjun?", options: ["Libra", "Escorpião", "Virgem", "Sagitário"], answer: 0 },
            { question: "16 - Qual é o ponto forte do TXT como grupo?", options: ["Vocais poderosos e performances únicas", "Somente dança", "Harmonia visual", "Presença nas redes sociais"], answer: 0 },
            { question: "17 -Qual álbum do TXT foi lançado em 2020?", options: ["The Dream Chapter: MAGIC", "The Dream Chapter: ETERNITY", "The Chaos Chapter: FREEZE", "The Dream Chapter: STAR"], answer: 1 },
            { question: "18 - Qual membro é conhecido por ser brincalhão e cheio de energia?", options: ["Beomgyu", "Soobin", "Taehyun", "Huening Kai"], answer: 0 },
            { question: "19 - Qual é o significado do nome 'Tomorrow X Together'?", options: ["Caminhar juntos para um novo amanhã", "Lutar juntos pelos sonhos", "Amar e viver juntos", "Explorar juntos o futuro"], answer: 0 },
            { question: "20 - Qual é o conceito principal da música 'CROWN'?", options: ["Autoaceitação e superação", "Amor romântico", "Amizade eterna", "Busca pela felicidade"], answer: 0 }
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
            remainingTime = 30;
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