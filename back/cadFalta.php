<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "etec2024";
$dbname = "hackathon";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Capturar dados do formulário
$id_funcionario = $_POST['id_funcionario'];
$data_falta = $_POST['data_falta'];

// SQL para inserir os dados na tabela faltas
$sql = "INSERT INTO faltas (id_funcionario, data_falta)
        VALUES ('$id_funcionario', '$data_falta')";

if ($conn->query($sql) === TRUE) {
    echo "Falta registrada com sucesso!";
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

// Fechar conexão
$conn->close();
?>
