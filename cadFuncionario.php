<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require('back/conectar.php');

    $nome = $_POST['nome'];
    $dataNascimento = $_POST['dataNascimento'];
    $documento = $_POST['documento'];
    $departamento = $_POST['departamento'];
    $salario = $_POST['salario'];

    // Verifica se o funcionário já está cadastrado
    $sql = "SELECT idFuncionario FROM funcionarios WHERE documento = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $documento);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<p>Funcionário já cadastrado.</p>";
    } else {
        // Inserir novo funcionário
        $sql = "INSERT INTO funcionarios (nome, dataNascimento, documento, departamento, salario) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $nome, $dataNascimento, $documento, $departamento, $salario);
        $stmt->execute();
        
        // Verifica se o cadastro foi realizado com sucesso
        if ($stmt->affected_rows > 0) {
            echo "<p>Funcionário cadastrado com sucesso!</p>";
        } else {
            echo "<p>Erro ao realizar o cadastro.</p>";
        }
        $stmt->close();
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
}

// Obter a lista de departamentos
require('back/conectar.php');
$departamentos = [];
$sql = "SELECT idDepartamento, nome FROM departamento";
$result = $conn->query($sql);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $departamentos[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Funcionários</title>
    <link rel="stylesheet" href="CSS/menu.css">
</head>
<body>
    <h2>Cadastro de Funcionários</h2>
    <form action="cadFuncionario.php" method="POST">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="dataNascimento">Data de Nascimento:</label><br>
        <input type="date" id="dataNascimento" name="dataNascimento" required><br><br>

        <label for="documento">Documento (RG ou CPF):</label><br>
        <input type="text" id="documento" name="documento" required><br><br>

        <label for="departamento">Departamento:</label><br>
        <select id="departamento" name="departamento" required>
            <option value="">Selecione um departamento</option>
            <?php foreach ($departamentos as $dep): ?>
                <option value="<?php echo $dep['idDepartamento']; ?>">
                    <?php echo htmlspecialchars($dep['nome']); ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="salario">Salário:</label><br>
        <input type="number" step="0.01" id="salario" name="salario" required><br><br>

        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>

<?php
    include('menu.php');
?>
