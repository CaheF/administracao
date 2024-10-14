<?php
include 'conexao.php'; // Conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'] ?? null;

    $sql = "INSERT INTO departamento (nome, descricao) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nome, $descricao);

    if ($stmt->execute()) {
        echo "Departamento cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar departamento: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
