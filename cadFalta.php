<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require('back/conectar.php');

    $documento = $_POST['documento'];
    $dataFalta = $_POST['dataFalta'];

    // Obter o ID do funcionário com base no documento
    $sql = "SELECT idFuncionario FROM funcionarios WHERE documento = ?";
    $stmt1 = $conn->prepare($sql); // Use uma nova variável para a primeira declaração
    $stmt1->bind_param("s", $documento);
    $stmt1->execute();
    $stmt1->store_result();

    if ($stmt1->num_rows > 0) {
        $stmt1->bind_result($idFuncionario);
        $stmt1->fetch();

        // Inserir a falta na tabela
        $sql = "INSERT INTO faltas (idFuncionario, dataFalta) VALUES (?, ?)";
        $stmt2 = $conn->prepare($sql); // Use uma nova variável para a segunda declaração
        $stmt2->bind_param("is", $idFuncionario, $dataFalta);
        if ($stmt2->execute()) {
            $message = "<p style='color: green;'>Falta registrada com sucesso!</p>";
        } else {
            $message = "<p style='color: red;'>Erro ao registrar falta: " . $stmt2->error . "</p>";
        }

        $stmt2->close(); // Feche a segunda declaração aqui
    } else {
        $message = "<p style='color: red;'>Funcionário não encontrado.</p>";
    }

    $stmt1->close(); // Feche a primeira declaração aqui
    $conn->close(); // Feche a conexão
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Faltas</title>
    <link rel="stylesheet" href="CSS/cadFalta.css">
    <link rel="stylesheet" href="CSS/menu.css">
</head>
<body>
    <nav>
        <?php include('menu.php'); ?>
    </nav>
    
    <div class="container">
        <h2>Registrar Falta</h2>
        <form action="cadFalta.php" method="POST">
            <label for="documento">Documento do Funcionário:</label>
            <input type="text" id="documento" name="documento" required>

            <label for="dataFalta">Data da Falta:</label>
            <input type="date" id="dataFalta" name="dataFalta" required>

            <input type="submit" value="Registrar Falta">
        </form>

        <?php
        // Exibir mensagens de erro ou sucesso
        if (isset($message)) {
            echo $message;
        }
        ?>
    </div>
</body>
</html>
