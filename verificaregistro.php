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

// Verificar se o usuário já existe
$sql_verificar = "SELECT * FROM perfilconquistas WHERE usuario = ?";
$stmt_verificar = $conn->prepare($sql_verificar);
$stmt_verificar->bind_param("s", $usuario);
$stmt_verificar->execute();
$result_verificar = $stmt_verificar->get_result();

if ($result_verificar->num_rows > 0) {
    echo "Usuário já existe!";
} else {
    // Inserir novo usuário
    $sql_inserir = "INSERT INTO perfilconquistas (usuario, senha) VALUES (?, ?)";
    $stmt_inserir = $conn->prepare($sql_inserir);
    $stmt_inserir->bind_param("ss", $usuario, $senha);
    
    if ($stmt_inserir->execute()) {
        $_SESSION['usuario'] = $usuario;
        header("Location: login.html");
        exit();
    } else {
        echo "Erro ao cadastrar usuário.";
    }
    
    $stmt_inserir->close();
}

$stmt_verificar->close();
$conn->close();
?>