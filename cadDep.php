<?php
include ('back/conectar.php'); // Conexão com o banco de dados

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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
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
