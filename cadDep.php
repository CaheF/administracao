<?php
include ('back/conectar.php'); // Conexão com o banco de dados
include ('menu.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'] ?? null;

    // Insere o novo departamento
    $sql = "INSERT INTO departamento (nome, descricao) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("ss", $nome, $descricao);

        if ($stmt->execute()) {
            echo "<p>Departamento cadastrado com sucesso!</p>";
        } else {
            echo "<p>Erro ao cadastrar departamento: " . $stmt->error . "</p>";
        }
        $stmt->close();
    } else {
        echo "<p>Erro ao preparar a consulta: " . $conn->error . "</p>";
    }
    
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Departamentos</title>
    <link rel="stylesheet" href="CSS/cadDep.css">
    <link rel="stylesheet" href="CSS/menu.css">
</head>
<body>
    <div class="container">
        <h2>Cadastro de Departamento</h2>
        <form action="cadDep.php" method="POST">
            <label for="nome">Nome do Departamento:</label>
            <input type="text" name="nome" id="nome" required>

            <label for="descricao">Descrição (opcional):</label>
            <input type="text" name="descricao" id="descricao">

            <button type="submit">Cadastrar Departamento</button>
        </form>
    </div>
</body>
</html>
