<?php
$servidor = "localhost:3306";
$user = "root";
$senha = "etec2023";
$banco = "hackathon";

// Cria a conexão
$conn = new mysqli($servidor, $user, $senha, $banco);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>