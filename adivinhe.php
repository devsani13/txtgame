<!DOCTYPE html>
<html lang="pt">
    <head>
        <title>Adivinhe o Idol</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
                background-image: url('fundo.jpg');
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
            }

            #game-container {
                text-align: center;
                background-color: #e4faff;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 4px 10px rgba(30, 0, 255, 0.1);
                width: 80%;
                max-width: 600px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            #image-container {
                display: flex;
                justify-content: center;
                margin-bottom: 20px;
            }

            #idol-image {
                width: 260px;
                height: 150px;
                border-radius: 12px;
            }
            h1 {
                color: #09003a;
                font-size: 30px;
                line-height: 30px;
            }
            #options-container {
                display: flex;
                justify-content: center;
                margin-top: 20px;
            }

            button {
                background-color: #09003a;
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
                background-color: #0e0078;
            }

            #nextButton {
                text-align: center;
            }

            #backButton2 {
                position: absolute;
                top: 20px;
                right: 20px;
                border-radius: 100px;
                width: 55px;
                height: 55px;
                background-color: white;
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
            #backButton {
                border-radius: 100px;
                width: 45px;
                height: 45px;
                background-color: white;
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

            #feedback {
                margin-top: 10px;
                font-size: 20px; /* Tamanho maior para os emojis */
                font-weight: bold;
                display: flex;
                justify-content: center; /* Centraliza o conteúdo */
                align-items: center; /* Alinha verticalmente */
            }

            #end-buttons {
                display: flex;
                flex-direction: row;
                justify-content: center;
                gap: 10px;
                position: relative;
                bottom: 20px;
                width: 100%;
            }

            /* Novos estilos para a tela de seleção de modos */
            #mode-selection {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }

            #mode-selection button {
                margin: 15px;
            }

            /* Adicionando um estilo para o tempo */
            #timer {
                font-size: 20px;
                font-weight: bold;
                color: #09003a;
                margin-top: 20px;
            }
            #button-container {
                display: flex;
                justify-content: center;
                gap: 5px;
                margin-top: 20px;
            }

            /* Estilo da tela de carregamento */
            #loadingScreen {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(255, 255, 255, 0.8);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 9999;
                display: none; /* Inicialmente escondido */
            }

            /* O círculo giratório (spinner) */
            .spinner {
                border: 4px solid #f3f3f3;
                border-top: 4px solid #09003a;
                border-radius: 50%;
                width: 50px;
                height: 50px;
                animation: spin 1s linear infinite;
            }

            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
        </style>
    </head>
<body>
    <!-- Tela de Carregamento -->
    <div id="loadingScreen">
        <div class="spinner"></div>
        <p>Carregando...</p>
    </div>

    <button id="backButton2">
        <img src="voltar.png" alt="Voltar" onclick="window.location.href='quiz-txt.php';">
    </button>    

    <div id="mode-selection">
        <h1>Escolha o Modo de Jogo</h1>
        <button id="modoNormalButton">Modo Normal</button>
        <button id="modoCronometradoButton">Modo Cronometrado</button>
        <button id="modoInfinitoButton">Modo Infinito</button>
    </div>

    <div id="game-container" style="display: none;">
        <h1 id="gameTitle">Adivinhe o Idol pela Imagem!</h1>
        <div id="image-container">
            <img id="idol-image" src="idol1.jpg" alt="Imagem do Idol" width="300" style="border-radius: 12px;">
        </div>

        <div id="options-container"></div>
        <div id="feedback" style="display: none;"></div> <!-- Div para o feedback -->
        <div id="button-container">
            <button id="nextButton">Próxima</button>
            <button id="backButton">
                <img src="voltar.png" alt="Voltar" onclick="window.location.href='adivinhe.php';">
            </button>
        </div>
        <div id="timer" style="display: none;"></div>

        <!-- Mover os botões de fim de jogo para dentro do game-container -->
        <div id="end-buttons" style="display: none;">
            <button id="restartButtonEnd">Jogar novamente</button>
            <button id="backButtonEnd">Voltar para a página inicial</button>
        </div>
    </div>

    <script>
        // Exibe a tela de carregamento
        function showLoading() {
            document.getElementById('loadingScreen').style.display = 'flex';
        }

        // Esconde a tela de carregamento
        function hideLoading() {
            document.getElementById('loadingScreen').style.display = 'none';
        }

        window.addEventListener('load', function() {
            hideLoading();  // Esconde a tela de carregamento quando a página é carregada
        });

        // Lista de idols e suas imagens
        const idols = [    
            { name: 'Yeonjun', img: 'maoyeon.jpg', options: ['Yeonjun', 'Huening Kai', 'Beomgyu', 'Taehyun'] }, 
            { name: 'Soobin', img: 'soobeye.jpg', options: ['Yeonjun', 'Soobin', 'Beomgyu', 'Taehyun'] },
            { name: 'Taehyun', img: 'maotae.jpg', options: ['Yeonjun', 'Soobin', 'Beomgyu', 'Taehyun'] },
            { name: 'Huening Kai', img: 'kaieye.jpg', options: ['Yeonjun', 'Huening Kai', 'Soobin', 'Beomgyu'] },
            { name: 'Beomgyu', img: 'maobeom.jpg', options: ['Beomgyu', 'Soobin', 'Huening Kai', 'Taehyun'] },
            { name: 'Taehyun', img: 'taeheye.jpg', options: ['Yeonjun', 'Soobin', 'Beomgyu', 'Taehyun'] },
            { name: 'Soobin', img: 'maosoobin.jpg', options: ['Yeonjun', 'Soobin', 'Beomgyu', 'Taehyun'] },
            { name: 'Beomgyu', img: 'beomeye.jpg', options: ['Beomgyu', 'Soobin', 'Huening Kai', 'Taehyun'] },
            { name: 'Huening Kai', img: 'maokai.jpg', options: ['Yeonjun', 'Huening Kai', 'Soobin', 'Beomgyu'] }, 
            { name: 'Yeonjun', img: 'yeoneye.jpg', options: ['Yeonjun', 'Huening Kai', 'Beomgyu', 'Taehyun'] },
        ];

        let currentIdolIndex = 0;
        let correctAnswers = 0;
        let wrongAnswers = 0;
        let remainingTime = 30;
        let wrongAttempts = 0;
        let gameMode = '';
        let timerInterval;

        // Função para escolher o modo de jogo
        document.getElementById('modoNormalButton').addEventListener('click', () => startGame('normal'));
        document.getElementById('modoCronometradoButton').addEventListener('click', () => startGame('cronometrado'));
        document.getElementById('modoInfinitoButton').addEventListener('click', () => startGame('infinito'));

        // Função que inicia o jogo dependendo do modo
        function startGame(mode) {
            gameMode = mode;
            showLoading();  // Mostra a animação de carregamento enquanto o jogo começa
            setTimeout(() => {
                hideLoading();  // Esconde a tela de carregamento após 2 segundos
                document.getElementById('mode-selection').style.display = 'none';
                document.getElementById('game-container').style.display = 'block';
                nextIdol();
                if (mode === 'cronometrado') {
                    startTimer();
                }
            }, 2000);  // Tempo de carregamento de 2 segundos
        }

        // Função para começar o cronômetro
        function startTimer() {
            document.getElementById('timer').style.display = 'block';
            timerInterval = setInterval(function() {
                if (remainingTime > 0) {
                    document.getElementById('timer').textContent = `Tempo: ${remainingTime}s`;
                    remainingTime--;
                } else {
                    clearInterval(timerInterval);
                    endGame();
                }
            }, 1000);
        }

        // Função para passar para o próximo idol
        function nextIdol() {
            if (currentIdolIndex >= idols.length) {
                endGame();
                return;
            }

            const currentIdol = idols[currentIdolIndex];
            document.getElementById('idol-image').src = currentIdol.img;
            const optionsContainer = document.getElementById('options-container');
            optionsContainer.innerHTML = '';

            currentIdol.options.forEach(option => {
                const button = document.createElement('button');
                button.textContent = option;
                button.onclick = () => handleAnswer(option, currentIdol.name);
                optionsContainer.appendChild(button);
            });

            currentIdolIndex++;
        }

        // Função que trata a resposta
        function handleAnswer(selected, correct) {
            const feedback = document.getElementById('feedback');
            if (selected === correct) {
                feedback.textContent = '🎉🎉🎉🎉';
                correctAnswers++;
            } else {
                feedback.textContent = '❌❌❌❌';
                wrongAnswers++;
                wrongAttempts++;

                if (wrongAttempts >= 3) {
                    endGame();
                    return;
                }
            }
            feedback.style.display = 'block';
            setTimeout(() => {
                feedback.style.display = 'none';
                nextIdol();
            }, 1500);
        }

        // Função para encerrar o jogo
        function endGame() {
            clearInterval(timerInterval);
            document.getElementById('game-container').style.display = 'none';
            document.getElementById('end-buttons').style.display = 'flex';
            alert(`Fim de Jogo! Você acertou ${correctAnswers} de ${idols.length} idols.`);
        }

        // Funções para reiniciar ou voltar para a tela inicial
        document.getElementById('restartButtonEnd').addEventListener('click', () => {
            correctAnswers = 0;
            wrongAnswers = 0;
            currentIdolIndex = 0;
            startGame(gameMode);
        });

        document.getElementById('backButtonEnd').addEventListener('click', () => {
            window.location.href = 'quiz-txt.php';
        });
    </script>
</body>
</html>
