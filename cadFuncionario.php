<?php
$message = ''; // Variável para armazenar mensagens

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require('back/conectar.php');

    $nome = $_POST['nome'];
    $dataNasc = $_POST['dataNasc'];
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
        $message = "<p class='result error'>Funcionário já cadastrado.</p>";
    } else {
        // Inserir novo funcionário
        $sql = "INSERT INTO funcionarios (nome, dataNasc, documento, departamento, salario) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $nome, $dataNasc, $documento, $departamento, $salario);
        $stmt->execute();
        
        // Verifica se o cadastro foi realizado com sucesso
        if ($stmt->affected_rows > 0) {
            $message = "<p class='result success'>Funcionário cadastrado com sucesso!</p>";
        } else {
            $message = "<p class='result error'>Erro ao realizar o cadastro.</p>";
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
    <link rel="stylesheet" href="CSS/cadFuncionario.css">
    <link rel="icon" href="images/pngMaleta.png">
</head>
<body>

    <form action="cadFuncionario.php" method="POST">
    <h2>Cadastro de Funcionários</h2>
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="dataNasc">Data de Nascimento:</label>
        <input type="date" id="dataNasc" name="dataNasc" required>

        <label for="documento">Documento (RG ou CPF):</label>
        <input type="text" id="documento" name="documento" required>

        <label for="departamento">Departamento:</label>
        <select id="departamento" name="departamento" required>
            <option value="">Selecione um departamento</option>
            <?php foreach ($departamentos as $dep): ?>
                <option value="<?php echo $dep['idDepartamento']; ?>">
                    <?php echo htmlspecialchars($dep['nome']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="salario">Salário:</label>
        <input type="number" step="0.01" id="salario" name="salario" required>

        <input type="submit" value="Cadastrar">
           <!-- Exibir a mensagem aqui -->
    <?php if ($message): ?>
        <div><?php echo $message; ?></div>
    <?php endif; ?>
    </form>
</body>
</html>

<?php
include('menu.php');
?>
