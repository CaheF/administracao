<?php
// Configurações de conexão
$servername = "localhost";
$username = "root";
$password = "etec2024";
$dbname = "hackathon";
$port = 3308;

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
