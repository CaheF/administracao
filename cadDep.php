<?php
include ('back/conectar.php'); // Conexão com o banco de dados
include ('menu.php');

$resultMessage = ''; // Inicializa a variável para a mensagem

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'] ?? null;

    // Verifica se o departamento já existe
    $checkSql = "SELECT COUNT(*) FROM departamento WHERE nome = ?";
    $checkStmt = $conn->prepare($checkSql);
    
    if ($checkStmt) {
        $checkStmt->bind_param("s", $nome);
        $checkStmt->execute();
        $checkStmt->bind_result($count);
        $checkStmt->fetch();
        $checkStmt->close();

        // Se o departamento já existir, informa ao usuário
        if ($count > 0) {
            $resultMessage = "<p class='error'>O departamento '$nome' já existe!</p>";
        } else {
            // Insere o novo departamento
            $sql = "INSERT INTO departamento (nome, descricao) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            
            if ($stmt) {
                $stmt->bind_param("ss", $nome, $descricao);

                if ($stmt->execute()) {
                    $resultMessage = "<p class='success'>Departamento cadastrado com sucesso!</p>";
                } else {
                    $resultMessage = "<p class='error'>Erro ao cadastrar departamento: " . $stmt->error . "</p>";
                }
                $stmt->close();
            } else {
                $resultMessage = "<p class='error'>Erro ao preparar a consulta: " . $conn->error . "</p>";
            }
        }
    } else {
        $resultMessage = "<p class='error'>Erro ao preparar a consulta: " . $conn->error . "</p>";
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
    <link rel="icon" href="images/pngMaleta.webp">
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
        <!-- Exibe as mensagens aqui -->
        <div class="result"><?php echo $resultMessage; ?></div>
    </div>
</body>
</html>
