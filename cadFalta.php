<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require('back/conectar.php');

    $documento = $_POST['documento'];
    $dataFalta = $_POST['dataFalta'];

    // Obter o ID do funcionário com base no documento
    $sql = "SELECT idFuncionario FROM funcionarios WHERE documento = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $documento);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($idFuncionario);
        $stmt->fetch();

        // Inserir a falta na tabela
        $sql = "INSERT INTO faltas (idFuncionario, dataFalta) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $idFuncionario, $dataFalta);
        if ($stmt->execute()) {
            echo "<p>Falta registrada com sucesso!</p>";
        } else {
            echo "<p>Erro ao registrar falta: " . $stmt->error . "</p>";
        }
    } else {
        echo "<p>Funcionário não encontrado.</p>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Faltas</title>
    <link rel="stylesheet" href="CSS/menu.css">
</head>
<body>
    <h2>Registrar Falta</h2>
    <form action="cadFalta.php" method="POST">
        <label for="documento">Documento do Funcionário:</label><br>
        <input type="text" id="documento" name="documento" required><br><br>

        <label for="dataFalta">Data da Falta:</label><br>
        <input type="date" id="dataFalta" name="dataFalta" required><br><br>

        <input type="submit" value="Cadastrar Falta">
    </form>
</body>
</html>
<?php
        include('menu.php');
?>