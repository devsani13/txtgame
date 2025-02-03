<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bdtxt";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro de conexão com o banco de dados: " . $conn->connect_error);
}

// Capturar dados do formulário
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

// Consulta SQL para verificar se o usuário existe
$sql = "SELECT * FROM perfilconquistas WHERE usuario='$usuario' AND senha='$senha'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Usuário encontrado, iniciar sessão e redirecionar
    $_SESSION['usuario'] = $usuario;
    header("Location: quiz-txt.php");
    exit();
} else {
    // Usuário não encontrado
    echo "Usuário ou senha incorretos.";
    echo "<br>";
    echo "<button onclick=\"window.location.href='login.html'\">Tentar novamente</button>";
}

$conn->close();
?>