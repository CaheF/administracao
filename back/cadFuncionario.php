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
$nome = $_POST['nome'];
$data_nascimento = $_POST['data_nascimento'];
$departamento = $_POST['departamento'];

// SQL para inserir os dados na tabela funcionários
$sql = "INSERT INTO funcionarios (nome, data_nascimento, departamento)
        VALUES ('$nome', '$data_nascimento', '$departamento')";

if ($conn->query($sql) === TRUE) {
    echo "Funcionário cadastrado com sucesso!";
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

// Fechar conexão
$conn->close();
?>
