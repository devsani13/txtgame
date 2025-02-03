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

// Consultar as conquistas do usuário
$sql = "SELECT * FROM perfilconquistas WHERE usuario = '$usuario'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Função para definir a imagem com tooltip
    function obterImagem($conquista, $modo)
    {
        $imagem = $conquista ? "<div class='conq' title='Conquista obtida no modo $modo'><img src='cconq.png' alt='Obtida' width='40'></div>" : "<div class='conq' title='Conquista não obtida no modo $modo'><img src='sconq.png' alt='Não obtida' class='sconq' width='40'></div>";
        return $imagem;
    }

    // Preparar imagens de conquistas
    $conquistas = [
        "geraln" => obterImagem($row['geraln'], "normal"),
        "geralc" => obterImagem($row['geralc'], "cronometrado"),
        "gerali" => obterImagem($row['gerali'], "infinito"),
        "yeonjunn" => obterImagem($row['yeonjunn'], "normal"),
        "yeonjunc" => obterImagem($row['yeonjunc'], "cronometrado"),
        "yeonjuni" => obterImagem($row['yeonjuni'], "infinito"),
        "soobinn" => obterImagem($row['soobinn'], "normal"),
        "soobinc" => obterImagem($row['soobinc'], "cronometrado"),
        "soobini" => obterImagem($row['soobini'], "infinito"),
        "beomgyun" => obterImagem($row['beomgyun'], "normal"),
        "beomgyuc" => obterImagem($row['beomgyuc'], "cronometrado"),
        "beomgyui" => obterImagem($row['beomgyui'], "infinito"),
        "taehyunn" => obterImagem($row['taehyunn'], "normal"),
        "taehyunc" => obterImagem($row['taehyunc'], "cronometrado"),
        "taehyuni" => obterImagem($row['taehyuni'], "infinito"),
        "kain" => obterImagem($row['kain'], "normal"),
        "kaic" => obterImagem($row['kaic'], "cronometrado"),
        "kaii" => obterImagem($row['kaii'], "infinito"),
        "adivinhen" => obterImagem($row['adivinhen'], "normal"),
        "adivinhec" => obterImagem($row['adivinhec'], "cronometrado"),
        "adivinhei" => obterImagem($row['adivinhei'], "infinito"),
    ];
} else {
    echo "Usuário não encontrado ou sem conquistas registradas.";
    $conn->close();
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conquistas</title>
    <style>
        body {
            height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            background-image: url('Iniciar.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            overflow: hidden;
        }

        .geral {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #262626;
            width: 750px;
            height: 600px;
            padding: 20px;
            border-radius: 30px;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            max-width: 750px;
            margin: auto;
        }

        .grid-item {
            border: 0;
            padding: 10px;
            border-radius: 10px;
            background-color: #4e4e4e;
            color: white;
        }

        .full-row {
            grid-column: span 3;
        }

        .conquistas-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            width: 200px;
            margin: auto;
        }

        #backButton2 {
            position: fixed;
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

        .conq {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            border-radius: 360px;
            background-color: transparent;
            border: 2px solid transparent;
            width: 60px;
            height: 60px;
            position: relative;
            /* Necessário para o pseudo-elemento */
            overflow: hidden;
            transition: transform 0.3s ease, border-color 0.3s ease, background-color 0.3s ease;
        }

        .conq img {
            position: relative;
            /* Garante que a imagem interna fique no topo */
            z-index: 1;
            /* A imagem ficará acima do pseudo-elemento */
            transition: transform 0.3s ease;
            /* Suaviza a transição da imagem */
        }

        .conq::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: transparent;
            /* Inicialmente transparente */
            filter: blur(4px);
            /* Inicialmente desfocada */
            z-index: 0;
            /* Fica atrás da imagem interna */
            transition: background-color 0.3s ease, filter 0.3s ease;
            /* Transições suaves */
        }

        .conq:hover {
            border: 2px solid white;
            transform: scale(1.3);
            /* Aumenta o tamanho suavemente para o efeito de explosão */
        }

        .conq:hover img {
            transform: scale(0.9);
            /* Reduz a imagem para dar o efeito de explosão */
        }

        .conq:hover::before {
            background-image: url(color.jpg);
            /* A imagem de fundo aparece no hover */
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            background-color: rgba(255, 255, 255, 0.3);
            /* Cor de fundo suave */
            filter: blur(0px);
            /* Remove o desfoque ao passar o mouse */
            animation: fadeInBackground 1s forwards;
            /* Animação de fade-in para a imagem */
        }

        @keyframes fadeInBackground {
            0% {
                background-color: rgba(255, 255, 255, 0);
                filter: blur(10px);
            }

            100% {
                background-color: rgba(255, 255, 255, 0.3);
                filter: blur(0px);
            }
        }
    </style>
</head>

<body>
    <button id="backButton2">
        <img src="voltarwhite.png" alt="Voltar" onclick="window.location.href='quiz-txt.php'">
    </button>
    <div class="geral">
        <h1 style="color: white">Bem-vindo, <?php echo htmlspecialchars($usuario); ?>!</h1>
        <h2 style="color: white">Suas Conquistas:</h2>

        <div class="grid-container">
            <div class="grid-item">
                <h3>Geral</h3>
                <div class="conquistas-container">
                    <?php echo $conquistas["geraln"] . $conquistas["geralc"] . $conquistas["gerali"]; ?>
                </div>
            </div>
            <div class="grid-item">
                <h3>Yeonjun</h3>
                <div class="conquistas-container">
                    <?php echo $conquistas["yeonjunn"] . $conquistas["yeonjunc"] . $conquistas["yeonjuni"]; ?>
                </div>
            </div>
            <div class="grid-item">
                <h3>Soobin</h3>
                <div class="conquistas-container">
                    <?php echo $conquistas["soobinn"] . $conquistas["soobinc"] . $conquistas["soobini"]; ?>
                </div>
            </div>
            <div class="grid-item">
                <h3>Beomgyu</h3>
                <div class="conquistas-container">
                    <?php echo $conquistas["beomgyun"] . $conquistas["beomgyuc"] . $conquistas["beomgyui"]; ?>
                </div>
            </div>
            <div class="grid-item">
                <h3>Taehyun</h3>
                <div class="conquistas-container">
                    <?php echo $conquistas["taehyunn"] . $conquistas["taehyunc"] . $conquistas["taehyuni"]; ?>
                </div>
            </div>
            <div class="grid-item">
                <h3>Kai</h3>
                <div class="conquistas-container">
                    <?php echo $conquistas["kain"] . $conquistas["kaic"] . $conquistas["kaii"]; ?>
                </div>
            </div>
            <div class="grid-item full-row">
                <h3>Adivinhe</h3>
                <div class="conquistas-container">
                    <?php echo $conquistas["adivinhen"] . $conquistas["adivinhec"] . $conquistas["adivinhei"]; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>