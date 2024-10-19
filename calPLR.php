<?php
include ('back/conectar.php'); // Conexão com o banco de dados
include ('menu.php'); // Inclui o menu

function calcularPLR($idFuncionario, $percentual = 0.65) {
    global $conn;

    // Consultar o salário do funcionário
    $sql = "SELECT salario FROM funcionarios WHERE idFuncionario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idFuncionario);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if ($result) {
        $salario = $result['salario'];
        $plrFinal = $salario * $percentual;
        return $plrFinal;
    }

    return 0; // Retornar 0 se não encontrar o salário
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomeFuncionario = $_POST['nomeFuncionario'];
    $documento = $_POST['documento'];

    // Obter o ID do funcionário com base no nome e documento
    $sql = "SELECT idFuncionario FROM funcionarios WHERE nome = ? AND documento = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nomeFuncionario, $documento);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($idFuncionario);
        $stmt->fetch();
        
        // Calcular PLR
        $plr = calcularPLR($idFuncionario);

        // Redireciona de volta com os resultados
        header("Location: ?nomeFuncionario=" . urlencode($nomeFuncionario) . "&documento=" . urlencode($documento) . "&plr=$plr");
        exit();
    } else {
        $error = "Funcionário não encontrado.";
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
    <title>Cálculo de PLR</title>
    <link rel="stylesheet" href="CSS/menu.css">
    <link rel="icon" href="images/pngMaleta.webp">
</head>
<body>
    <div class="container">
        <h2>Cálculo de PLR</h2>
        <form method="POST">
            <label for="nomeFuncionario">Nome do Funcionário:</label>
            <input type="text" name="nomeFuncionario" id="nomeFuncionario" required>

            <label for="documento">Documento (RG ou CPF):</label>
            <input type="text" name="documento" id="documento" required>

            <button type="submit">Calcular PLR</button>
        </form>
        <?php if (isset($_GET['plr'])): ?>
            <div class="result">
                O PLR do funcionário <?php echo htmlspecialchars($_GET['nomeFuncionario']); ?> é: R$ <?php echo number_format($_GET['plr'], 2, ',', '.'); ?>
            </div>
        <?php elseif (isset($error)): ?>
            <div class="result" style="color: red;">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
