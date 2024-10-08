<?php
// Conexão com o banco de dados usando porta 3308 e senha 'etec2024'
$servername = "localhost";
$username = "root";
$password = "etec2024";
$dbname = "hackathon";
$port = 3308;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verificar se os campos foram enviados via POST
if (isset($_POST['idFuncionario']) && isset($_POST['dataFalta'])) {
    $idFuncionario = $_POST['idFuncionario'];
    $dataFalta = $_POST['dataFalta'];

    // Verificar se os campos não estão vazios
    if (!empty($idFuncionario) && !empty($dataFalta)) {
        // SQL para inserir os dados na tabela faltas
        $sql = "INSERT INTO faltas (idFuncionario, dataFalta) VALUES ('$idFuncionario', '$dataFalta')";

        if ($conn->query($sql) === TRUE) {
            echo "Falta registrada com sucesso!";
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Erro: Todos os campos devem ser preenchidos.";
    }
} else {
    echo "Erro: Dados não enviados corretamente.";
}

// Fechar conexão
$conn->close();
?>
