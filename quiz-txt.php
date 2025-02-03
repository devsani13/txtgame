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

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <title>Quiz TXT</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 10px;
            background-image: url('Iniciar.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            font-family: Cambria;
        }

        button {
            background-color: #262626;
            color: white;
            border-radius: 12px;
            width: 175px;
            height: 60px;
            border: none;
            cursor: pointer;
            font-family: Cambria;
            font-weight: 600;
        }

        .theme-options,
        .start-options {
            display: none;
            flex-direction: row;
            gap: 10px;
            margin-top: 10px;
        }

        .theme-options button,
        .start-options a {
            background-color: #4e4e4e;
            color: white;
            width: 85px;
            height: 85px;
            text-align: center;
            justify-content: center;
            align-items: center;
            display: flex;
            border-radius: 12px;
            cursor: pointer;
        }

        .start-options button {
            background-color: #4e4e4e;
            color: white;
            width: 85px;
            height: 85px;
            text-align: center;
            justify-content: center;
            align-items: center;
            display: flex;
            border-radius: 12px;
            cursor: pointer;
        }

        .theme-options button:hover,
        .start-options a:hover {
            background-color: #717171;
        }

        .start-options button:hover {
            background-color: #717171;
        }

        .language-options {
            display: none;
            flex-direction: row;
            gap: 10px;
            margin-top: 10px;
        }

        .language-options img {
            width: 30px;
            height: 27px;
            cursor: pointer;
        }

        #profile-container {
            position: fixed;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -20%);
            background-color: rgb(175, 175, 175);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        #consquistas-container {
            position: fixed;
            top: 20%;
            right: 50%;
            transform: translate(-20%, -50%);
            background-color: rgb(175, 175, 175);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .profile-pic:hover {
            border-color: #717171;
        }

        .profile-pic {
            text-align: center;
        }

        #open-profile {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-image: url(user.png);
            background-size: 60% 60%;
            background-repeat: no-repeat;
            background-position: center;
            color: white;
            border-radius: 50px;
            padding: 10px 20px;
            cursor: pointer;
            width: 100px;
            height: 100px;
        }

        #open-profile2 {
            position: fixed;
            bottom: 20px;
            left: 20px;
            background-image: url(conquistas.png);
            background-size: 60% 60%;
            background-repeat: no-repeat;
            background-position: center;
            color: white;
            border-radius: 50px;
            cursor: pointer;
            width: 100px;
            height: 100px;
        }

        #save-profile {
            background-color: #4e4e4e;
            color: white;
            border-radius: 12px;
            width: 175px;
            height: 60px;
            border: none;
            cursor: pointer;
            font-family: Cambria;
            font-weight: 600;
            margin-top: 15px;
        }

        #profile-pictures {
            display: grid;
            grid-template-columns: repeat(5, auto);
            gap: 10px;
            /* Espaçamento entre as fotos */
        }

        .start-options button {
            background-color: #4e4e4e;
            color: white;
            width: 175px;
            height: 60px;
            border-radius: 12px;
            cursor: pointer;
            font-family: Cambria;
            font-weight: 600;
        }
    </style>
</head>

<body>

    <button id="startButton">Iniciar</button>
    <div class="start-options" id="startOptions">
        <a href="geral.php"><img src="txt.jpg" width="85px" height="85px" style="border-radius: 12px;"></button>
            <a href="yeonjun.php"><img src="yeonjun.jpg" width="85px" height="85px" style="border-radius: 12px;"></a>
            <a href="soobin.php"><img src="soobin.jpg" width="85px" height="85px" style="border-radius: 12px;"></a>
            <a href="beomgyu.php"><img src="beomgyu.jpg" width="85px" height="85px" style="border-radius: 12px;"></a>
            <a href="taehyun.php"><img src="taehyun.jpg" width="85px" height="85px" style="border-radius: 12px;"></a>
            <a href="hueningkai.php"><img src="huening.jpg" width="85px" height="85px" style="border-radius: 12px;"></a>
            <a href="adivinhe.php"><img src="adivinha.jpg" width="85px" height="85px" style="border-radius: 12px;"></a>
    </div>

    <button id="themeButton">Tema</button>
    <div class="theme-options" id="themeOptions">
        <button data-bg="url('Iniciar.jpg')" data-color="#262626" data-button-color="#262626" id="padraoButton"><img
                src="ppulbatuot5.jpg" alt="Padrão" width="85px" height="85px" style="border-radius: 12px;"></button>
        <button data-bg="url('hwangchoon.jpg')" data-color="#7a6747" data-button-color="#7a6747"><img src="hwang.jpg"
                alt="Hwang Choon" width="85px" height="85px" style="border-radius: 12px;"></button>
        <button data-bg="url('choiyongmeong.jpg')" data-color="#3a3837" data-button-color="#3a3837"><img
                src="yongmeong.jpg" alt="Choi Yong Meong" width="85px" height="85px"
                style="border-radius: 12px;"></button>
        <button data-bg="url('bamgeut.jpg')" data-color="#43403d" data-button-color="#43403d"><img src="bamgeutt.jpg"
                alt="Bamgeut" width="85px" height="85px" style="border-radius: 12px;"></button>
        <button data-bg="url('dagonyang.jpg')" data-color="#030202" data-button-color="#030202"><img src="dago.jpg"
                alt="Da Go Nyang" width="85px" height="85px" style="border-radius: 12px;"></button>
        <button data-bg="url('hmmnyaring.png')" data-color="#32384a" data-button-color="#32384a"><img src="hhmnya.jpg"
                alt="HMm Nya Ring" width="85px" height="85px" style="border-radius: 12px;"></button>
    </div>

    <button id="settingsButton">Idioma</button>
    <div class="language-options" id="languageOptions">
        <img src="brasil.png" alt="Português" id="portugueseFlag">
        <img src="eua.png" alt="English" id="englishFlag">
        <img src="espanha.png" alt="Español" id="spanishFlag">
        <img src="coreia.png" alt="Korean" id="koreanFlag">
    </div>

    <button id="open-profile2" onclick="window.location.href='conquistas.php';"></button>
    <div id="profile-container" style="display: none;">
        <h2>Escolha seu nome e foto de perfil</h2>

        <label for="player-name">Digite seu nome:</label>
        <input type="text" id="player-name" placeholder="Seu nome"
            style="border: none; border-radius: 12px; color: black;">

        <h3>Escolha uma foto de perfil:</h3>
        <div id="profile-pictures" style="display: grid; grid-template-columns: repeat(5, auto); gap: 10px;">
            <!-- Primeira fileira de imagens -->
            <img src="soobinicon.jpg" alt="Foto 1" class="profile-pic" data-pic="soobinicon.jpg"
                style="width: 65px; height: 65px; border-radius: 50%; cursor: pointer; border: 2px solid transparent;">
            <img src="yeonjunicon.jpg" alt="Foto 2" class="profile-pic" data-pic="yeonjunicon.jpg"
                style="width: 65px; height: 65px; border-radius: 50%; cursor: pointer; border: 2px solid transparent;">
            <img src="beomgyuicon.jpg" alt="Foto 3" class="profile-pic" data-pic="beomgyuicon.jpg"
                style="width: 65px; height: 65px; border-radius: 50%; cursor: pointer; border: 2px solid transparent;">
            <img src="taehyunicon.jpg" alt="Foto 4" class="profile-pic" data-pic="taehyunicon.jpg"
                style="width: 65px; height: 65px; border-radius: 50%; cursor: pointer; border: 2px solid transparent;">
            <img src="kaiicon.jpg" alt="Foto 5" class="profile-pic" data-pic="kaiicon.jpg"
                style="width: 65px; height: 65px; border-radius: 50%; cursor: pointer; border: 2px solid transparent;">

            <!-- Segunda fileira de imagens -->
            <img src="yongicon.jpg" alt="Foto 6" class="profile-pic" data-pic="yongicon.jpg"
                style="width: 65px; height: 65px; border-radius: 50%; cursor: pointer; border: 2px solid transparent;">
            <img src="hwangicon.jpg" alt="Foto 7" class="profile-pic" data-pic="hwangicon.jpg"
                style="width: 65px; height: 65px; border-radius: 50%; cursor: pointer; border: 2px solid transparent;">
            <img src="bamgeuticon.jpg" alt="Foto 8" class="profile-pic" data-pic="bamgeuticon.jpg"
                style="width: 65px; height: 65px; border-radius: 50%; cursor: pointer; border: 2px solid transparent;">
            <img src="dagoicon.jpg" alt="Foto 9" class="profile-pic" data-pic="dagoicon.jpg"
                style="width: 65px; height: 65px; border-radius: 50%; cursor: pointer; border: 2px solid transparent;">
            <img src="hhmicon.jpg" alt="Foto 10" class="profile-pic" data-pic="hhmicon.jpg"
                style="width: 65px; height: 65px; border-radius: 50%; cursor: pointer; border: 2px solid transparent;">

            <img src="soopao.jpg" alt="Foto 11" class="profile-pic" data-pic="soopao.jpg"
                style="width: 65px; height: 65px; border-radius: 50%; cursor: pointer; border: 2px solid transparent;">
            <img src="yeonpao.jpg" alt="Foto 12" class="profile-pic" data-pic="yeonpao.jpg"
                style="width: 65px; height: 65px; border-radius: 50%; cursor: pointer; border: 2px solid transparent;">
            <img src="beompao.jpg" alt="Foto 13" class="profile-pic" data-pic="beompao.jpg"
                style="width: 65px; height: 65px; border-radius: 50%; cursor: pointer; border: 2px solid transparent;">
            <img src="taepao.jpg" alt="Foto 14" class="profile-pic" data-pic="taepao.jpg"
                style="width: 65px; height: 65px; border-radius: 50%; cursor: pointer; border: 2px solid transparent;">
            <img src="kaipao.jpg" alt="Foto 15" class="profile-pic" data-pic="kaipao.jpg"
                style="width: 65px; height: 65px; border-radius: 50%; cursor: pointer; border: 2px solid transparent;">

            <img src="soorango.jpg" alt="Foto 16" class="profile-pic" data-pic="soorango.jpg"
                style="width: 65px; height: 65px; border-radius: 50%; cursor: pointer; border: 2px solid transparent;">
            <img src="yeonrango.jpg" alt="Foto 17" class="profile-pic" data-pic="yeonrango.jpg"
                style="width: 65px; height: 65px; border-radius: 50%; cursor: pointer; border: 2px solid transparent;">
            <img src="beomrango.jpg" alt="Foto 18" class="profile-pic" data-pic="beomrango.jpg"
                style="width: 65px; height: 65px; border-radius: 50%; cursor: pointer; border: 2px solid transparent;">
            <img src="taerango.jpg" alt="Foto 19" class="profile-pic" data-pic="taerango.jpg"
                style="width: 65px; height: 65px; border-radius: 50%; cursor: pointer; border: 2px solid transparent;">
            <img src="kairango.jpg" alt="Foto 20" class="profile-pic" data-pic="kairango.jpg"
                style="width: 65px; height: 65px; border-radius: 50%; cursor: pointer; border: 2px solid transparent;">
        </div>

        <button id="save-profile">Salvar</button>
    </div>

    <button id="open-profile"></button>

    <script>
        const themeButton = document.getElementById('themeButton');
        const themeOptions = document.getElementById('themeOptions');
        const languageOptions = document.getElementById('languageOptions');
        const settingsButton = document.getElementById('settingsButton');
        const startButton = document.getElementById('startButton');
        const startOptions = document.getElementById('startOptions');
        const geralButton = document.getElementById('geralButton');
        const padraoButton = document.getElementById('padraoButton');
        const body = document.body;
        const allButtons = document.querySelectorAll('button');
        const allLinks = document.querySelectorAll('.start-options a');  // Links de "Iniciar"

        // Exibe/oculta as opções de tema
        themeButton.addEventListener('click', () => {
            themeOptions.style.display = themeOptions.style.display === 'flex' ? 'none' : 'flex';
        });

        // Exibe/oculta as opções de iniciar
        startButton.addEventListener('click', () => {
            startOptions.style.display = startOptions.style.display === 'flex' ? 'none' : 'flex';
        });

        // Exibe/oculta as opções de idioma
        settingsButton.addEventListener('click', () => {
            languageOptions.style.display = languageOptions.style.display === 'flex' ? 'none' : 'flex';
        });

        // Altera a imagem de fundo do body e a cor de fundo dos botões
        themeOptions.addEventListener('click', (event) => {
            // Garante que o clique seja no botão, mesmo ao clicar na imagem
            const button = event.target.closest('button'); // Verifica o botão mais próximo
            if (button) {
                const newBg = button.getAttribute('data-bg');
                const newColor = button.getAttribute('data-color');
                const buttonColor = button.getAttribute('data-button-color');

                // Alterando o fundo do body e as cores dos botões
                body.style.backgroundImage = newBg;
                themeButton.style.backgroundColor = buttonColor;
                settingsButton.style.backgroundColor = buttonColor;
                startButton.style.backgroundColor = buttonColor;

                // Alterando a cor dos botões
                allButtons.forEach(btn => btn.style.backgroundColor = buttonColor);
                allLinks.forEach(link => link.style.backgroundColor = buttonColor);

                themeOptions.style.display = 'none';
            }
        });


        // Função para alterar o idioma
        const changeLanguage = (language) => {
            const elements = {
                startButton: "Iniciar",
                themeButton: "Tema",
                settingsButton: "Configurações",
                portugueseFlag: "brasil.png",
                englishFlag: "eua.png",
                spanishFlag: "espanha.png",
                koreanFlag: "coreia.png"
            };

            switch (language) {
                case 'pt':
                    document.title = 'Quiz TXT';
                    elements.startButton = "Iniciar";
                    elements.themeButton = "Tema";
                    elements.settingsButton = "Configurações";
                    break;
                case 'en':
                    document.title = 'Quiz TXT';
                    elements.startButton = "Start";
                    elements.themeButton = "Theme";
                    elements.settingsButton = "Settings";
                    break;
                case 'es':
                    document.title = 'Quiz TXT';
                    elements.startButton = "Iniciar";
                    elements.themeButton = "Tema";
                    elements.settingsButton = "Configuraciones";
                    break;
                case 'kr':
                    document.title = '퀴즈 TXT';
                    elements.startButton = "시작";
                    elements.themeButton = "주제";
                    elements.settingsButton = "설정";
                    break;
            }

            document.getElementById('startButton').innerText = elements.startButton;
            document.getElementById('themeButton').innerText = elements.themeButton;
            document.getElementById('settingsButton').innerText = elements.settingsButton;
            languageOptions.style.display = 'none';
        };

        document.getElementById('portugueseFlag').addEventListener('click', () => changeLanguage('pt'));
        document.getElementById('englishFlag').addEventListener('click', () => changeLanguage('en'));
        document.getElementById('spanishFlag').addEventListener('click', () => changeLanguage('es'));
        document.getElementById('koreanFlag').addEventListener('click', () => changeLanguage('kr'));

        const openProfileButton = document.getElementById('open-profile');
        const profileContainer = document.getElementById('profile-container');
        const saveProfileButton = document.getElementById('save-profile');
        const profilePictures = document.querySelectorAll('.profile-pic');
        const playerNameInput = document.getElementById('player-name');

        // Variáveis para armazenar escolhas (apenas durante a sessão atual)
        let selectedPicture = null;
        let playerName = "";

        // Exibir o menu de perfil
        openProfileButton.addEventListener('click', () => {
            profileContainer.style.display = 'block';
        });

        // Escolher a foto de perfil
        profilePictures.forEach(picture => {
            picture.addEventListener('click', () => {
                profilePictures.forEach(pic => pic.style.border = '2px solid transparent');
                picture.style.border = '2px solid #717171';
                selectedPicture = picture.getAttribute('data-pic');
            });
        });

        // Salvar perfil temporariamente
        saveProfileButton.addEventListener('click', () => {
            playerName = playerNameInput.value;

            if (!playerName || !selectedPicture) {
                alert('Por favor, escolha um nome e uma foto de perfil.');
                return;
            }

            alert('Perfil configurado com sucesso!');
            profileContainer.style.display = 'none';

            // Atualiza o perfil na interface
            updateProfile();
        });

        // Atualizar o perfil na interface
        function updateProfile() {
            if (playerName) {
                document.getElementById('startButton').innerText = `Bem-vindo (a), ${playerName}`;
            }

            if (selectedPicture) {
                openProfileButton.style.backgroundImage = `url(${selectedPicture})`;
                openProfileButton.style.backgroundSize = 'cover';
                openProfileButton.style.backgroundPosition = 'center';
                openProfileButton.innerText = ''; // Remove o texto
            }
        }

        // Não há necessidade de carregar dados salvos porque tudo será redefinido ao recarregar a página.

    </script>
</body>

</html>