<?php
include 'conexao.php'; // Conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idFuncionario = $_POST['idFuncionario'];
    $dataFolga = $_POST['dataFolga'];
    $motivo = $_POST['motivo'] ?? null;

    $sql = "INSERT INTO folga (idFuncionario, dataFolga, motivo) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $idFuncionario, $dataFolga, $motivo);

    if ($stmt->execute()) {
        echo "Folga cadastrada com sucesso!";
    } else {
        echo "Erro ao cadastrar folga: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
